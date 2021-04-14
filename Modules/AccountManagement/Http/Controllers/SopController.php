<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Entities\User;
use Modules\AccountManagement\Entities\SpecificationSopSetting;
use Modules\AccountManagement\Entities\AcceptableSpecy;
use Modules\AccountManagement\Entities\FreshFish;
use Modules\AccountManagement\Entities\MasterSpec;
use Modules\AccountManagement\Entities\ChemicalCriteria;
use Modules\AccountManagement\Entities\HeavyMetal;
use Modules\AccountManagement\Entities\MicrobiologicalCriteria;
use Modules\AccountManagement\Entities\SpecType;
use Modules\AccountManagement\Entities\SopFile;
use Modules\AccountManagement\Entities\UserSpecification;
use Modules\AccountManagement\Entities\Producer;
use Carbon\Carbon;
use Validator,DB;

class SopController extends Controller
{
    /*  get  SOP Specification */
    public function getSpecificationSop(Request $request){
        
        $result = Producer::select('id','name')
        ->where('id',$request->producer_id)
        // ->with('sop_settings')
        ->with(['sop_settings'=>function($query){ $query->select('*')->with('hgt_fish_cut_file_details')->with('hg_fish_cut_file_details'); }])
       // ->with('acceptable_species')
       //->with(['acceptable_species'=>function($query){ $query->select("SELECT D.id,D.producer_id,M.id as `acceptable_species_id`, (CASE WHEN D.scientific_name IS NULL THEN M.scientific_name ELSE D.scientific_name END ) as `scientific_name` , (CASE WHEN D.common_name IS NULL THEN M.common_name ELSE D.common_name END ) as `common_name` , D.created_at,D.updated_at FROM `master_accept_species` M left join (select * FROM `acceptable_species` WHERE `producer_id`=1) D on M.id=D.acceptable_species_id"); }])
        ->with('fresh_fish_test')
        
        ->with('chemical_criterias')
        ->with('heavy_metals')
        ->with('microbiological_criterias')
        ->with(['sop_files'=>function($query){ $query->select('*')->with('file_details'); }])
        ->first();
        if(!empty($result)){
            $result->acceptable_species = DB::select("SELECT D.id,D.producer_id,M.id as `acceptable_species_id`,(CASE WHEN D.is_checked IS NULL THEN 0 ELSE D.is_checked END ) as `is_checked`, (CASE WHEN D.scientific_name IS NULL THEN M.scientific_name ELSE D.scientific_name END ) as `scientific_name` , (CASE WHEN D.common_name IS NULL THEN M.common_name ELSE D.common_name END ) as `common_name` , D.created_at,D.updated_at FROM `master_accept_species` M left join (select * FROM `acceptable_species` WHERE `producer_id`=$request->producer_id) D on M.id=D.acceptable_species_id");
            $allSpectype = SpecType::get(); 
            $spec_data = array();
            foreach ($allSpectype as $key => $specType) {
                $alldata['id'] = $specType->id;
                $alldata['name'] = $specType->name;
                $alldata['producer_id'] = $specType->producer_id;
                $alldata['type'] = $specType->type;
                $alldata['checked'] = $specType->checked;
                $allUserSpec = DB::select("SELECT US.id,US.producer_id,US.spec_type,MS.id as spec_id ,(CASE WHEN US.is_checked IS NULL THEN 0 ELSE US.is_checked END ) as `is_checked`,MS.cut_type,MS.letter,MS.min_cut_length,MS.max_cut_length,MS.min_cut_weight,MS.max_cut_weight,US.min_cut_length_offset,US.max_cut_length_offset,US.min_cut_weight_offset,US.max_cut_weight_offset FROM `master_specs` MS left join (select * FROM user_specifications WHERE user_specifications.spec_type=$specType->id and user_specifications.producer_id=$request->producer_id ) US on MS.id =US.spec_id");
                $alldata['spec'] = $allUserSpec;
                array_push($spec_data,$alldata);
            }
            $result->length_width_specification=$spec_data;
            return response()->json($result, 200);
        }
        else{
            return response()->json(['error'=>'user not found!'], 401);  
        }
        
    } /*  End of get SOp Specification */




    /*  update  SOP Specification */
    public function updateSpecificationSop(Request $request){
        $validator = Validator::make($request->all(), [
            'producer_id' => 'required|numeric|min:1|max:999999',
            'sop_settings' => 'required|array',
            'acceptable_species' => 'required|array',
            // 'fresh_fish_test' => 'required|array',
            // 'length_width_specification' => 'required|array'
            'fresh_fish_test' => 'array',
            'length_width_specification' => 'array'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $getProducer = Producer::find($request->producer_id); 
        if(!empty($getProducer))
        {
            $producerId = $request->producer_id; 
            if(isset($request->sop_settings) && count($request->sop_settings)){
                $validator_sop_settings =Validator::make($request->all(), [
                    'sop_settings.production_and_storage_facilities'  => 'required|string|max:255', 
                    'sop_settings.hgt_fish_cut'                       => 'required|numeric|min:1|max:9999', 
                    'sop_settings.hg_fish_cut'                        => 'required|numeric|min:1|max:9999',
                ]);
                if($validator_sop_settings->fails()) {
                    return response()->json(['error'=>$validator_sop_settings->errors()], 401);      
                }
            }
            if(isset($request->acceptable_species) && count($request->acceptable_species)){ 
                $validator_acceptable_species =Validator::make($request->all(), [
                    'acceptable_species.*.is_checked'              => 'required|numeric|min:0|max:1', 
                    'acceptable_species.*.acceptable_species_id'   => 'required|numeric|min:1',
                    'acceptable_species.*.scientific_name'         => 'required|string|max:255',
                    'acceptable_species.*.common_name'             => 'required|string|max:255'
                ]);
                if ($validator_acceptable_species->fails()) {
                    return response()->json(['error'=>$validator_acceptable_species->errors()], 401);      
                }
            }
            if(isset($request->fresh_fish_test) && count($request->fresh_fish_test)){
                $validator_fresh_fish_test =Validator::make($request->all(), [
                    'fresh_fish_test.*.focus'               => 'required|string|max:255', 
                    'fresh_fish_test.*.quality_parameter'   => 'required|string|max:255',
                    'fresh_fish_test.*.target'              => 'required|string|max:255'
                ]);
                if ($validator_fresh_fish_test->fails()) {
                    return response()->json(['error'=>$validator_fresh_fish_test->errors()], 401);      
                }
            }
            if(isset($request->length_width_specification) && count($request->length_width_specification)){
                /*$validator_length_width_specification=Validator::make($request->all(), [
                    'length_width_specification.*.name'                          => 'required|string|max:255', 
                    'length_width_specification.*.checked'                       => 'required|numeric|min:0|max:1',
                    'length_width_specification.*.type'                          => 'required|numeric|min:1|max:9999',
                    'length_width_specification.*.spec'                          => 'required|array',
                    'length_width_specification.*.spec.*.spec_type'              => 'required|numeric|min:1|max:255',
                    'length_width_specification.*.spec.*.spec_id'                => 'required|numeric|min:1|max:255',
                    'length_width_specification.*.spec.*.is_checked'             => 'required|numeric|min:0|max:1',
                    'length_width_specification.*.spec.*.min_cut_length_offset'  => 'required|numeric|min:0|max:9999',
                    'length_width_specification.*.spec.*.max_cut_length_offset'  => 'required|numeric|min:0|max:9999',
                    'length_width_specification.*.spec.*.min_cut_weight_offset'  => 'required|numeric|min:0|max:9999',
                    'length_width_specification.*.spec.*.max_cut_weight_offset'  => 'required|numeric|min:0|max:9999'
                ]);
                if ($validator_length_width_specification->fails()) {
                    return response()->json(['error'=>$validator_length_width_specification->errors()], 401);      
                }*/
            }
            
            if(isset($request->sop_settings) && !empty($request->sop_settings)){
                $hgt_fish_cut = isset($request->sop_settings['hgt_fish_cut'])?$request->sop_settings['hgt_fish_cut']:null;
                $hg_fish_cut = isset($request->sop_settings['hg_fish_cut'])?$request->sop_settings['hg_fish_cut']:null;
                $specification_sop_file = isset($request->sop_settings['specification_sop_file'])?$request->sop_settings['specification_sop_file']:null;
                $this->update_sop_settings($request->sop_settings,$producerId,$hgt_fish_cut,$hg_fish_cut,$specification_sop_file);
            }
            if(isset($request->acceptable_species) && count($request->acceptable_species)){
                $this->update_acceptable_species($request->acceptable_species,$producerId);
            }
            if(isset($request->fresh_fish_test) && count($request->fresh_fish_test)){
                $this->update_fresh_fish_test($request->fresh_fish_test,$producerId);
            }
            if(isset($request->length_width_specification) && count($request->length_width_specification)){
                $this->update_length_width_specification($request->length_width_specification,$producerId);
            }

            if(isset($request->chemical_criterias) && count($request->chemical_criterias)){
                $this->update_chemical_criterias($request->chemical_criterias,$producerId);
            }

            if(isset($request->heavy_metals) && count($request->heavy_metals)){
                $this->update_heavy_metals($request->heavy_metals,$producerId);
            }
            if(isset($request->microbiological_criterias) && count($request->microbiological_criterias)){
                $this->update_microbiological_criterias($request->microbiological_criterias,$producerId);
            }
            
            if(isset($request->sop_files) && count($request->sop_files)){
                $this->update_sop_files($request->sop_files,$producerId);
            }
            $result = Producer::select('id','name')
            ->where('id',$request->producer_id)
            // ->with('sop_settings')
            ->with(['sop_settings'=>function($query){ $query->select('*')->with('hgt_fish_cut_file_details')->with('hg_fish_cut_file_details'); }])
            ->with('acceptable_species')
            ->with('fresh_fish_test')
            ->with('chemical_criterias')
            ->with('heavy_metals')
            ->with('microbiological_criterias')
            // ->with('sop_files')
            ->with(['sop_files'=>function($query){ $query->select('*')->with('file_details'); }])
            ->first(); 

            $allSpectype = SpecType::get(); 
            $spec_data = array();
            foreach ($allSpectype as $key => $specType) {
                $alldata['id'] = $specType->id;
                $alldata['name'] = $specType->name;
                $alldata['producer_id'] = $specType->producer_id;
                $alldata['type'] = $specType->type;
                $alldata['checked'] = $specType->checked;
                $allUserSpec = DB::select("SELECT US.id,US.producer_id,US.spec_type,MS.id as spec_id ,MS.cut_type,MS.min_cut_length,MS.max_cut_length,MS.min_cut_weight,MS.max_cut_weight,US.min_cut_length_offset,US.max_cut_length_offset,US.min_cut_weight_offset,US.max_cut_weight_offset FROM `master_specs` MS left join (select * FROM user_specifications WHERE user_specifications.spec_type=$specType->id and user_specifications.producer_id=$request->producer_id ) US on MS.id =US.spec_id");
                $alldata['spec']=$allUserSpec;
                array_push($spec_data,$alldata);
            }
            $result->length_width_specification=$spec_data;
            return response()->json($result, 200);
      }
      else{
        return response()->json(['error'=>"user not found !"], 401); 
      }
            
    
    } /*  End of update SOp Specification */

    public function  update_sop_settings($sop_settings,$producerId,$hgt_fish_cut_file,$hg_fish_cut_file,$specification_sop_file){
        $get_Sop_Setting=SpecificationSopSetting::where('producer_id',$producerId)->get(); 
        
        if($sop_settings['id']!=NULL){
            if($get_Sop_Setting->count()){
                $update_Sop_Setting=SpecificationSopSetting::where('producer_id',$producerId)->update([
                    "production_and_storage_facilities" => $sop_settings['production_and_storage_facilities'],
                    "hgt_fish_cut" => $hgt_fish_cut_file?$hgt_fish_cut_file:null,
                    "hg_fish_cut" => $hg_fish_cut_file?$hg_fish_cut_file:null,
                    "sardine" => $sop_settings['sardine'],
                    "mackerel" => $sop_settings['mackerel'],
                    "specification_sop_file" => $specification_sop_file?$specification_sop_file:null
                ]);
            }
        }  
        else{
            if($get_Sop_Setting->count()){
                $update_Sop_Setting=SpecificationSopSetting::where('producer_id',$producerId)->update([
                    "production_and_storage_facilities" => $sop_settings['production_and_storage_facilities'],
                    "hgt_fish_cut" => $hgt_fish_cut_file?$hgt_fish_cut_file:null,
                    "hg_fish_cut" => $hg_fish_cut_file?$hg_fish_cut_file:null,
                    "sardine" => $sop_settings['sardine'],
                    "mackerel" => $sop_settings['mackerel'],
                    "specification_sop_file" => $specification_sop_file?$specification_sop_file:null
                ]);
            }   
            else{
                $create_Sop_Setting=SpecificationSopSetting::create([
                    "producer_id" => $producerId,
                    "production_and_storage_facilities" => $sop_settings['production_and_storage_facilities'],
                    "hgt_fish_cut" => $hgt_fish_cut_file?$hgt_fish_cut_file:null,
                    "hg_fish_cut" => $hg_fish_cut_file?$hg_fish_cut_file:null,
                    "sardine" => $sop_settings['sardine'],
                    "mackerel" => $sop_settings['mackerel'],
                    "specification_sop_file" => $specification_sop_file?$specification_sop_file:null
                ]); 
            }  
        }
    }

    /* update  of the Accepts  Space*/
    public  function  update_acceptable_species($acceptable_species,$producerId){ 
        if(count($acceptable_species) && $producerId){ 
            foreach($acceptable_species as $species){  
                if(isset($species['id']) && $species['id']!=NULL){
                   $get_accept=AcceptableSpecy::where('id',$species['id'])->get();
                   if(count($get_accept)){
                       if(isset($species['delete']) && $species['delete']!="" && $species['delete']=='1'){
                            $delete_acceptableSpecy=AcceptableSpecy::where('id',$species['id'])->delete();  
                       }
                       else{
                            $update_acceptableSpecy=AcceptableSpecy::where('id',$species['id'])->update([
                                'producer_id'           => $producerId,
                                'is_checked'            => $species['is_checked'],
                                'acceptable_species_id' => $species['acceptable_species_id'],
                                'scientific_name'       => $species['scientific_name'],
                                'common_name'           => $species['common_name']
                            ]);
                       }
                    }
                }
                else{  
                   $create_acceptableSpecy=AcceptableSpecy::create([
                        'producer_id'            => $producerId,
                        'is_checked'             => $species['is_checked'],
                        'acceptable_species_id'  => $species['acceptable_species_id'],
                        'scientific_name'        => $species['scientific_name'],
                        'common_name'            => $species['common_name']
                    ]);
                }
            }
        }
    }

    /* update fresh fish */
    public function update_fresh_fish_test($fresh_fish_test,$producerId){
        if(count($fresh_fish_test) && $producerId){
            foreach($fresh_fish_test as $fresh_fish){
                if($fresh_fish['id']!=NULL){
                    // echo 'Update'; 
                   $get_result=FreshFish::where('id',$fresh_fish['id'])->get();
                   if(count($get_result)){
                       if(isset($fresh_fish['delete']) && $fresh_fish['delete']!="" && $fresh_fish['delete']=='1'){
                        $delete_freshFish=FreshFish::where('id',$fresh_fish['id'])->delete(); 
                       }
                       else{
                            $update_freshFish=FreshFish::where('id',$fresh_fish['id'])->update([
                                'producer_id' => $producerId,
                                'focus' => $fresh_fish['focus'],
                                'quality_parameter' => $fresh_fish['quality_parameter'],
                                'target' => $fresh_fish['target']
                            ]);
                       }
                        
                    }
                    
                }
                else{
                    //echo 'insert'; die; 
                    $create_freshFish=FreshFish::create([
                        'producer_id' => $producerId,
                        'focus' => $fresh_fish['focus'],
                        'quality_parameter' => $fresh_fish['quality_parameter'],
                        'target' => $fresh_fish['target']
                    ]);
                }
            }
        }
    }


    /* update the  Length with  specification */
    public  function update_length_width_specification($length_width_specification,$producerId){
        if(count($length_width_specification) && $producerId){ 
            foreach($length_width_specification as $spec_type){ 
                if($spec_type['id']!=NULL){
                     //echo 'Update'; die; 
                    
                   $get_result=SpecType::where('id',$spec_type['id'])->get();
                   if(isset($get_result) && count($get_result)){
                        $specTypeId = $spec_type['id'];
                        $update_SpecType=SpecType::where('id',$spec_type['id'])->update([
                            'producer_id' => $producerId,
                            'name' => $spec_type['name'],
                            'type' => $spec_type['type'],
                            'checked' => $spec_type['checked']
                        ]);
                    }
                    
                }
                else{
                   // echo 'insert'; die; 
                    $create_SpecType=SpecType::create([
                        'producer_id' => $producerId,
                        'name' => $spec_type['name'],
                        'type' => $spec_type['type'],
                        'checked' => $spec_type['checked']
                    ]);
                   $specTypeId= $create_SpecType->id;
                }

                /* update  SARDINE*/
                if(isset($spec_type['spec']) && count($spec_type['spec']) && $producerId){
                    //print_r($spec_type); die();
                    foreach($spec_type['spec'] as $length_width){
                        if($length_width['id']!=NULL){
                            //print_r($length_width); die();
                           $get_result=UserSpecification::where('id',$length_width['id'])->get();
                           if(isset($get_result) && count($get_result)){
                               //print_r($get_result); die();
                                $update_sardinesSpecs=UserSpecification::where('id',$length_width['id'])->update([
                                    'producer_id' => $producerId,
                                    'spec_type' => $specTypeId,
                                    'spec_id' => $length_width['spec_id'],
                                    'is_checked' => $length_width['is_checked'],
                                    'min_cut_length_offset' => $length_width['min_cut_length_offset'],
                                    'max_cut_length_offset' => $length_width['max_cut_length_offset'],
                                    'min_cut_weight_offset' => $length_width['min_cut_weight_offset'],
                                    'max_cut_weight_offset' => $length_width['max_cut_weight_offset']
                                ]);
                            }
                        }
                        else{
                            $create_sardinesSpecs=UserSpecification::create([
                                'producer_id' => $producerId,
                                'spec_type' => $specTypeId,
                                'spec_id' => $length_width['spec_id'],
                                'is_checked' => $length_width['is_checked'],
                                'min_cut_length_offset' => $length_width['min_cut_length_offset'],
                                'max_cut_length_offset' => $length_width['max_cut_length_offset'],
                                'min_cut_weight_offset' => $length_width['min_cut_weight_offset'],
                                'max_cut_weight_offset' => $length_width['max_cut_weight_offset']
                            ]);
                        }
                    }
                }
                /* END OF UPDATE SARDINE */
            }
        }
    }

    /* update Chemical Criterias */
    public  function  update_chemical_criterias($chemical_criterias,$producerId){
        if(isset($chemical_criterias) && count($chemical_criterias) && $producerId){
            foreach($chemical_criterias as $chemical){
                if($chemical['id']!=NULL){
                    //echo 'Update'; die; 
                   $get_result=ChemicalCriteria::where('id',$chemical['id'])->get();
                   if(isset($get_result) && count($get_result)){
                        $update_chemical_criterias=ChemicalCriteria::where('id',$chemical['id'])->update([
                            'producer_id' => $producerId,
                            'title' => isset($chemical['title'])?$chemical['title']:null,
                            'title_key' => isset($chemical['title_key'])?$chemical['title_key']:null,
                            'description' => isset($chemical['description'])?$chemical['description']:null
                        ]);
                    }
      
                }
                else{ 
                    //echo 'insert'; die; 
                    $create_chemical_criterias=ChemicalCriteria::create([
                        'producer_id' => $producerId,
                        'title' => isset($chemical['title'])?$chemical['title']:null,
                        'title_key' => isset($chemical['title_key'])?$chemical['title_key']:null,
                        'description' => isset($chemical['description'])?$chemical['description']:null
                    ]);
                }
            }
        }
    }


    /* update Heavy  meals */
    public  function  update_heavy_metals($heavy_metals,$producerId){
        if(isset($heavy_metals) && count($heavy_metals) && $producerId){
            foreach($heavy_metals as $row){
                if($row['id']!=NULL){
                    // echo 'Update'; die; 
                   $get_result=HeavyMetal::where('id',$row['id'])->get();
                   if(isset($get_result) && count($get_result)){
                        $update_heavy_metals=HeavyMetal::where('id',$row['id'])->update([
                            'producer_id' => $producerId,
                            'name' => $row['name'],
                            'name_key' => $row['name_key'],
                            'mark' => $row['mark'],
                            'max_limit_ppm' => $row['max_limit_ppm']
                        ]);
                    }
                }
                else{ 
                    $create_heavy_metals=HeavyMetal::create([
                        'producer_id' => $producerId,
                        'name' => $row['name'],
                        'name_key' => $row['name_key'],
                        'mark' => $row['mark'],
                        'max_limit_ppm' => $row['max_limit_ppm']
                    ]);
                }
            }
        }
    }

    /* update Microbiological criteria*/
    public  function  update_microbiological_criterias($microbiological_criterias,$producerId){
        if(isset($microbiological_criterias) && count($microbiological_criterias) && $producerId){
            foreach($microbiological_criterias as $row){
                if($row['id']!=NULL){
                    // echo 'Update'; die; 
                   $get_result=MicrobiologicalCriteria::where('id',$row['id'])->get();
                   if(count($get_result)){
                        $update_microbiological_criterias=MicrobiologicalCriteria::where('id',$row['id'])->update([
                            'producer_id' => $producerId,
                            'germs' => $row['germs'],
                            'n' => $row['n'],
                            'c' => $row['c'],
                            'nm' => $row['nm'],
                            'cm' => $row['cm']
                        ]);
                    }
                    
                }
                else{ 
                    // echo 'insert'; die; 
                    $create_microbiological_criterias=MicrobiologicalCriteria::create([
                        'producer_id' => $producerId,
                        'germs' => $row['germs'],
                        'n' => $row['n'],
                        'c' => $row['c'],
                        'nm' => $row['nm'],
                        'cm' => $row['cm']
                    ]);
                }
            }
        }
    }


    public  function  update_sop_files($sop_files,$producerId){
       
        if(isset($sop_files) && count($sop_files) && $producerId){
            foreach($sop_files as $row){

                $getSopFile=SopFile::where('file_id',$row['file_details']['id'])->get(); 
                if(!count($getSopFile)){
                    $sop_files=SopFile::create([
                        'producer_id' => $producerId,
                        'file_id' => $row['file_details']['id']
                    ]);
                }
                
            }
        }
    }

    /* get  All  SPECS */
    public  function  getSpecs(Request $request){
        $all_Specs=MasterSpec::get(); 
        return response()->json($all_Specs, 200);
    }

    /*  add User Spec type  */
    public function saveSpecType(Request $request,$producerId){
       $getProducer = Producer::find($producerId);
       if(!empty($getProducer)){
            $validator = Validator::make($request->all(), [
                'checked' => 'required|numeric|max:1|min:0',
                'name' => 'required|unique:spec_types',
                // 'type' => 'required'
            ]);
            if($request->checked < 0 ||  $request->checked > 1){
                return response()->json(['error'=>'checked  min value 0 and max value 1 must be valid'], 401);   
            }
            if($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
            $input=$request->all();
            $input['producer_id']=$producerId;
            $create_SpecType = SpecType::create($input);
            return response()->json($create_SpecType, 200);
       }
       else{
         return response()->json(['error'=>'this user does not exist!'], 401);   
        }
    } 

    /*  get  Spec Type of users*/
    public  function  getSpecType(Request $request,$producerId){
        $getProducer = Producer::find($producerId);
        if(!empty($getProducer)){
            $getUserAllSpec = SpecType::where('producer_id',$producerId)->get();
            return response()->json($getUserAllSpec, 200);
        }
        else{
            return response()->json(['error'=>'this user does not exist!'], 401);   
          }
    }

    /* update Spec type */
    public  function  updateSpecType(Request $request, $producerId,$id){
        $getProducer = Producer::find($producerId);
        if(!empty($getProducer)){
            $getSpec = SpecType::find($id);
            if(!empty($getSpec)){
                $validator = Validator::make($request->all(), [
                    'checked' => 'required|numeric|max:1|min:0',
                    'name' => 'required'
                ]);
                if($request->checked < 0 ||  $request->checked > 1){
                    return response()->json(['error'=>'checked  min value 0 and max value 1 must be valid'], 401);   
                }
                if($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
                }
                SpecType::where(['producer_id'=>$producerId,'id'=>$id])->update($request->all());
            }
            else{
                return response()->json(['error'=>'spec type not found!'], 401);  
            }
            $getSpec = SpecType::find($id);
            return response()->json($getSpec, 200);
        }
        else{
            return response()->json(['error'=>'user does not exist!'], 401);   
        } 
    }

    public function  deleteSpecType(Request $request,$producerId,$id){
        if($producerId  && $id){
             $user = Auth::user();
            if($user->role=='1'){ 
                $getSpec=SpecType::find($id);
                if(!empty($getSpec)){
                    $userSpecType=SpecType::destroy($id);
                    if($userSpecType){
                        return response()->json(['success' =>'user Spec type deleted'], 200); 
                    }
                    else{
                        return response()->json(['error'=>"somthing went wrong , try  again"], 401); 
                    }
                }
                else{
                    return response()->json(['error'=>"records not found "], 401); 
                }
            }
            else{
                return response()->json(['error'=>"you are not authorized to this action"], 401); 
            }

        }
    }

    
    /**
     * Add New  Species 
    */
    public  function  saveSpecies(Request $request){
        $validator = Validator::make($request->all(), [
            'cut_type' => 'required|unique:master_specs',
            'min_cut_length' => 'required|numeric|min:0',
            'max_cut_length' => 'required|numeric|min:0',
            'min_cut_weight' => 'required|numeric|min:0',
            'max_cut_weight' => 'required|numeric|min:0'
        ]);
        if($validator->fails()){ 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $createMasterSpecies = MasterSpec::create($request->all()); 
        return $createMasterSpecies; 
    }


    
    



}
