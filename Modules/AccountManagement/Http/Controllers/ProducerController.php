<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AccountManagement\Entities\Producer;
use Modules\AccountManagement\Entities\Section;
use Modules\AccountManagement\Entities\CustomFields;
use Modules\AccountManagement\Entities\CustomRows;
use Modules\AccountManagement\Entities\CustomProducerData;
use Modules\AccountManagement\Entities\UserAudit;
use Modules\AccountManagement\Entities\City;
use Modules\AccountManagement\Entities\Expedition;
use Modules\AccountManagement\Entities\ProducerAccess;
use Validator; 

class ProducerController extends Controller
{
    public function getProducer(Request $request){ 
        $producerId=$request->producer_id;
        $getProducer=Producer::find($producerId);
        if(!empty($getProducer)){
        $result=Producer::with(['profileImage','leaderDetails','producer_access','expedition','audit_info'])->find($producerId); 

        // $getAllSection=Section::get();
        // // $sectinsdata=array();
        // if(isset($getAllSection) && count($getAllSection))
        // {
        //     foreach($getAllSection as $section){
        //         $getFishing['custom_fields']=CustomFields::where(array('producer_id'=>$producerId,'section_id'=>$section->id))->get(); 
        //         $getFishing['custom_rows']=CustomRows::where(array('producer_id'=>$producerId,'section_id'=>$section->id))->with('customdata')->get(); 
        //         $result[strtolower($section->name)]=$getFishing;
        //     }
        // }
        // // $result->sections=$sectinsdata;

        if(!empty($request)){
            $result->sections=Section::
            with(['custom_fields'=>function($query) use ($producerId){
                $query->select('*')->where('producer_id',$producerId);
            }])
            ->with(['custom_rows'=>function($query) use ($producerId){
                $query->select('*')->where('producer_id',$producerId)
                ->with('customdata');
            }])->get();
        }
        

        // $getFishing['custom_fields']=CustomFields::where(array('producer_id'=>$producerId,'section_id'=>1))->get(); 
        // $getFishing['custom_rows']=CustomRows::where(array('producer_id'=>$producerId,'section_id'=>1))->with('datas')->get(); 
        // $result->fishing=$getFishing;

        // $getUnloading['custom_fields']=CustomFields::where(array('producer_id'=>$producerId,'section_id'=>2))->get(); 
        // $getUnloading['custom_rows']=CustomRows::where(array('producer_id'=>$producerId,'section_id'=>2))->with('datas')->get(); 
        // $result->unloading=$getUnloading;

        // $getSection['custom_fields']=CustomFields::where(array('producer_id'=>$producerId,'section_id'=>2))->get(); 
        // $getSection['custom_rows']=CustomRows::where(array('producer_id'=>$producerId,'section_id'=>2))->with('datas')->get(); 
        // $result->biodata=$getSection;
       
            return response()->json($result,200);
        }
        else{
            return response()->json(['error'=>"user not found"],401);
        }
        
    }
    /**
     * Create Proiducer
     */
    public function createProducer(Request $request){
      
        $validator = Validator::make($request->all(), [
            
            'name'                                => 'required|string|unique:producers',
            'country_id'                          => 'required|numeric|min:1|max:9999',
            'city_id'                             => 'required|numeric|min:1|max:9999',
            'code'                                => 'required|string|max:255',   
            'alpha_code'                          => 'required|string|max:255',
            'address'                             => 'required|string|max:255',
            'leader_id'                           => 'required|numeric|min:1|max:9999',
            'producer_type'                       => 'required|numeric|min:1|max:9999',
            'fao_fishing_zone'                    => 'required|string|max:255',
            'total_capacity_of_storage_reception' => 'required|string|max:255',
            'total_grading_capacity'              => 'required|string|max:255',
            'total_wr_processing_capacity'        => 'required|string|max:255',
            'total_cutting_capacity'              => 'required|numeric|min:1|max:9999',
            'image'                               => 'required',
            'sections'                            => 'required|array',
            'expedition'                          => 'required|array',
            'audit_info'                          => 'required|array',
            'producer_access'                     => 'required|array'
        ]); 
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        if(isset($request->sections) && count($request->sections)){
            $validatorSections = Validator::make($request->all(), [
                'sections.*.name' => 'required|string|max:255',
                'sections.*.name_key' => 'required|string|max:255',
                'sections.*.custom_fields'   => 'required|array',
                'sections.*.custom_fields.*.type'   => 'required|numeric',
                'sections.*.custom_rows'   => 'array',
                'sections.*.custom_fields.*.name'       => 'string',
                'sections.*.custom_rows.*.customdata'   => 'array',
                'sections.*.custom_rows.*.customdata.*.value'  => 'string'
            ]);
            if(!empty($validatorSections->fails())){
                return response()->json(['error'=>$validatorSections->errors()], 401);
            }
        }
        if(isset($request->expedition) && count($request->expedition)){
            $validatorExp = Validator::make($request->all(), [
                'expedition.*.key'   => 'required',
                'expedition.*.value' => 'required'
            ]);
            if(!empty($validatorExp->fails())){
                return response()->json(['error'=>$validatorExp->errors()], 401);
            }
        }
        if(isset($request->audit_info) && !empty($request->audit_info)){
            $validatoraudit_info = Validator::make($request->all(), [

                'audit_info.information'           => 'required',
                'audit_info.is_factory_approved'   => 'required|numeric|min:0|max:2',
                'audit_info.audit_date'            => 'required|date_format:Y-m-d',
                'audit_info.scoring'               => 'required',
                'audit_info.row_material'          => 'required',
                'audit_info.processing_facilities' => 'required',
                'audit_info.respect_cold_chain'    => 'required',
                'audit_info.storage'               => 'required',
                'audit_info.traceability'          => 'required'
            ]);
            if(!empty($validatoraudit_info->fails())){
                return response()->json(['error'=>$validatoraudit_info->errors()], 401);
            }
        }
        if(isset($request->producer_access) && count($request->producer_access)){
            $validatorproducer_access = validator::make($request->all(), [
                'producer_access.*.user_id' => 'required|numeric|min:1'
            ]);
            if(!empty($validatorproducer_access->fails())){
                return response()->json(['error'=>$validatorproducer_access->errors()], 401);
            }
        }
        $createDataProduces = array(
            'name'                                => $request->name,
            'country_id'                          => $request->country_id,
            'city_id'                             => $request->city_id,
            'code'                                => $request->code,
            'alpha_code'                          => $request->alpha_code,
            'address'                             => $request->address,
            'leader_id'                           => $request->leader_id,
            'producer_type'                       => $request->producer_type,
            'fao_fishing_zone'                    => $request->fao_fishing_zone,
            'total_capacity_of_storage_reception' => $request->total_capacity_of_storage_reception,
            'total_grading_capacity'              => $request->total_grading_capacity,
            'total_wr_processing_capacity'        => $request->total_wr_processing_capacity,
            'total_cutting_capacity'              => $request->total_cutting_capacity,
            'image'                               => $request->image
        );
         
        if(isset($request->sections) && count($request->sections)){
            for($i=0;$i < count($request->sections);$i++){
                for($j=$i+1; $j < count($request->sections);$j++){	
                if($request->sections[$i]['name']==$request->sections[$j]['name']){
                    return response()->json(['error'=>"this Section ".$request->sections[$i]['name']." all ready exist "], 401);
                }
                }
            }
        }
       
        $createProducers = Producer::create($createDataProduces);
        if(isset($request->sections) && count($request->sections)){
             
            $this->createSectionRecord($request->sections,$createProducers->id); 
        } 

       
        if(isset($request->expedition) && count($request->expedition)){
            $this->createExpedition($request->expedition,$createProducers->id); 
        }
        if(isset($request->producer_access) && count($request->producer_access)){
            foreach($request->producer_access as $producer_access){
                $createAccessProducer = array(
                    'producer_id' => $createProducers->id,
                    'user_id'     => $producer_access['user_id']
                );
                ProducerAccess::create($createAccessProducer);
            }
        }
        if(isset($request->audit_info) && !empty($request->audit_info)){
            $creataudit_info = array(
                'producer_id'             => $createProducers->id,
                'information'             => $request->audit_info['information'],
                'is_factory_approved'     => $request->audit_info['is_factory_approved'],
                'audit_date'              => $request->audit_info['audit_date'],
                'scoring'                 => $request->audit_info['scoring'],
                'row_material'            => $request->audit_info['row_material'],
                'processing_facilities'   => $request->audit_info['processing_facilities'],
                'respect_cold_chain'      => $request->audit_info['respect_cold_chain'],
                'storage'                 => $request->audit_info['storage'],
                'traceability'            => $request->audit_info['traceability']
            );
            UserAudit::create($creataudit_info);
        }
        return response()->json($request->all(), 200);
    } 
    /**
     * Create Section for Rows & Fields
     */

    

    public function createSectionRecord($sections,$producer_id){
        if(isset($sections) && count($sections) && $producer_id){
            foreach($sections as $sectionData){
            
                $createSectionsData = array(
                    'name'        => $sectionData['name'],
                    'name_key'    => $sectionData['name_key'],
                    'type'        => 1
                );

            //$createdSections = Section::where($sections['id'],$sectionData['id'])->update($createSectionsData);
            //$createdSections = Section::where(['id'=>isset($sectionData['id'])?$sectionData['id']:null])->update($createSectionsData);
            
                if(isset($sectionData['id']) && $sectionData['id']!=NULL){
                    Section::where('id',$sectionData['id'])->update($createSectionsData);
                }
                else{
                $getSectionExist=Section::where(['name'=>$sectionData['name'],'type'=>1])->first(); 
                if(empty($getSectionExist)){
                    $createdSections = Section::create($createSectionsData);
                }
                else{
                $sectionData['id']=$getSectionExist->id;
                }
                
                }
                
            $SectionsId = ($sectionData['id']!=null)?$sectionData['id']:$createdSections->id;
           
           
           
            $fieldsidsArray = array();
            if(isset($sectionData['custom_fields']) && count($sectionData['custom_fields'])){
                if(count($sectionData['custom_fields'])){
                    foreach($sectionData['custom_fields']as $customFilds){
                        $createColumn = array(
                            'name'        => $customFilds['name'],
                            'producer_id' => $producer_id,
                            'section_id'  => $SectionsId,
                            'type'        => $customFilds['type'],
                            'item_list'   => $customFilds['item_list'],
                        );
                        $create_Fields=CustomFields::create($createColumn);
                        array_push($fieldsidsArray,$create_Fields->id);
                    }
                }
            }
            if(isset($sectionData['custom_rows']) && count($sectionData['custom_rows'])){
                if(count($sectionData['custom_rows'])){
                    foreach($sectionData['custom_rows'] as $custom_rows){
                        $ceateRow = array(
                            'producer_id' => $producer_id,
                            'section_id'  =>  $SectionsId,
                        );
                        $createcustom_rows=CustomRows::create($ceateRow);
                        if(isset($custom_rows['customdata']) && count($custom_rows['customdata'])){
                            foreach($custom_rows['customdata'] as $key=>$customdata){
                                $createCustomProducer = array(
                                    'producer_id'      => $producer_id,
                                    'custom_field_id'  => $fieldsidsArray[$key]?$fieldsidsArray[$key]:$customdata['custom_field_id'],
                                    'custom_row_id'    => $createcustom_rows->id?$createcustom_rows->id:$customdata['custom_row_id'],
                                    'value'            => $customdata['value'],
                                );
                                CustomProducerData::create($createCustomProducer);
                            }
                        }
                    }
                }
            }
            
           
           } /* end of  the Section*/
        }
    }

    /* create Expedition*/
    public function createExpedition($expedition,$producer_id){
       if(isset($expedition) && count($expedition) && $producer_id){
            foreach($expedition as $valueExp){
                $createExpedition = array(
                    'producer_id' => $producer_id,
                    'key'         => $valueExp['key'],
                    'value'       => $valueExp['value']
                );
                Expedition::create($createExpedition);
            }
        }
    }  
    

    /**
     * Get All Producers
     */
    public function getAllProducer(){

        $getAllProducerData = Producer::get();
        return response()->json($getAllProducerData, 200);
    }
    
    /**
     * Create Custom Fields
     */
    public function createcustom_fields(Request $request){
        
        $validator = Validator::make($request->all(), [
        
            'name'        => 'required|numeric|min:1|max:9999',
            'producer_id' => 'required|numeric|min:1|max:9999',
            'section_id'  => 'required|numeric|min:1|max:9999'
        ]);
        if(!empty($validator->fails())){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $createCustomField  = array(
            
            'name'        => $request->name,
            'producer_id' => $request->producer_id,
            'section_id'  => $request->section_id
        );
            $createFields = CustomFields::create($createCustomField);
            return response()->json($request->all(), 200);
    } 
    /**
     *  Custom Rows Create
     */
    public function createcustom_rows(Request $request){
        
        $validator = Validator::make($request->all(), [
            
            'producer_id' => 'required|numeric|min:1|max:9999',
            'section_id'  => 'required|numeric|min:1|max:9999'
        ]);
        if(!empty($validator->fails())){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $createRows =  CustomRows::create($request->all(), 200);
    }
    /**
     * Create Custom Producers
     */
    public function createCustomProducerData(Request $request){
    
        $validator = Validator::make($request->all(), [
        
            "producer_id"     => "required|numeric|min:1|max:9999",
            "custom_field_id" => "required|numeric|min:1|max:9999",
            "custom_row_id"   => "required|numeric|min:1|max:9999",
            "value"           => "required|string|max:255"
        ]);
        if(!empty($validator->fails())){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $createProducerData = array(
                'producer_id'     => $request->producer_id,
                'custom_field_id' => $request->custom_field_id,
                'custom_row_id'   => $request->custom_row_id,
                'value'           => $request->value,
        );
        $createDataProducer = CustomProducerData::create($createProducerData);
        return response()->json($request->all(), 200);
    }
    /**
     * Update Producers
     */
    public function updateProducer(Request $request, $row_id){
    
        $getProducerId = Producer::find($row_id);

        if(!empty($getProducerId)){
            $validator = Validator::make($request->all(), [
            
                'name'                                => 'required|string|max:255',
                'country_id'                          => 'required|numeric|min:1|max:9999',
                'city_id'                             => 'required|numeric|min:1|max:9999',
                'code'                                => 'required|string|max:255',   
                'alpha_code'                          => 'required|string|max:255',
                'address'                             => 'required|string|max:255',
                'leader_id'                           => 'required|numeric|min:1|max:9999',
                'producer_type'                       => 'required|numeric|min:1|max:9999',
                'fao_fishing_zone'                    => 'required|string|max:255',
                'total_capacity_of_storage_reception' => 'required|string|max:255',
                'total_grading_capacity'              => 'required|string|max:255',
                'total_wr_processing_capacity'        => 'required|numeric|min:1|max:9999',
                'total_cutting_capacity'              => 'required|numeric|min:1|max:9999',
                'image'                               => 'required',
                'sections'                            => 'required|array',
                'expedition'                          => 'required|array',
                'audit_info'                           => 'required|array',
                'producer_access'                      => 'required|array'
            ]); 
            if($validator->fails()){
                return response()->json(['error' => $validator->errors()], 401);
            }
            if(isset($request->sections) && count($request->sections)){
                $validatorSections = Validator::make($request->all(), [
                    'sections.*.name' => 'required|string|max:255',
                    'sections.*.name_key' => 'required|string|max:255',
                    'sections.*.custom_fields'   => 'required|array',
                    'sections.*.custom_fields.*.type'   => 'required|numeric',
                    'sections.*.custom_rows'   => 'required|array',
                    'sections.*.custom_fields.*.name'       => 'required',
                   // 'sections.*.custom_fields.*.section_id' => 'required',
                   // 'sections.*.custom_rows.*.section_id'   => 'required',
                    'sections.*.custom_rows.*.customdata'   => 'required|array',
                    'sections.*.custom_rows.*.customdata.*.value'  => 'required'
                ]);
                if(!empty($validatorSections->fails())){
                    return response()->json(['error'=>$validatorSections->errors()], 401);
                }
            }
            
            if(isset($request->expedition) && count($request->expedition)){
                $validatorExp = Validator::make($request->all(), [
                    'expedition.*.key'   => 'required',
                    'expedition.*.value' => 'required'
                ]);
                if(!empty($validatorExp->fails())){
                    return response()->json(['error'=>$validatorExp->errors()], 401);
                }
            }
            if(isset($request->audit_info) && !empty($request->audit_info)){
                $validatoraudit_info = Validator::make($request->all(), [
    
                    'audit_info.information'           => 'required',
                    'audit_info.is_factory_approved'   => 'required|numeric|min:0|max:2',
                    'audit_info.audit_date'            => 'required|date_format:Y-m-d',
                    'audit_info.scoring'               => 'required',
                    'audit_info.row_material'          => 'required',
                    'audit_info.processing_facilities' => 'required',
                    'audit_info.respect_cold_chain'    => 'required',
                    'audit_info.storage'               => 'required',
                    'audit_info.traceability'          => 'required'
                ]);
                if(!empty($validatoraudit_info->fails())){
                    return response()->json(['error'=>$validatoraudit_info->errors()], 401);
                }
            }
            if(isset($request->producer_access) && count($request->producer_access)){
                $validatorproducer_access = validator::make($request->all(), [
                    'producer_access.*.user_id' => 'required|numeric|min:1'
                ]);
                if(!empty($validatorproducer_access->fails())){
                    return response()->json(['error'=>$validatorproducer_access->errors()], 401);
                }
            }
            $updateProduces = array(
                'name'                                => $request->name,
                'country_id'                          => $request->country_id,
                'city_id'                             => $request->city_id,
                'code'                                => $request->code,
                'alpha_code'                          => $request->alpha_code,
                'address'                             => $request->address,
                'leader_id'                           => $request->leader_id,
                'producer_type'                       => $request->producer_type,
                'fao_fishing_zone'                    => $request->fao_fishing_zone,
                'total_capacity_of_storage_reception' => $request->total_capacity_of_storage_reception,
                'total_grading_capacity'              => $request->total_grading_capacity,
                'total_wr_processing_capacity'        => $request->total_wr_processing_capacity,
                'total_cutting_capacity'              => $request->total_cutting_capacity,
                'image'                               => $request->image
            );
            
            if(empty($getProducerId)){
                return response()->json(['error'=>'Producer Id not found!'], 401);
            }
            $getProducerName = Producer::where('name', $request->name)->first();
            if(!empty($getProducerName) &&  $getProducerId->name != $getProducerName['name']){
                return response()->json(['error'=>'Producer Name Already Exist!'], 401);
            }
            $updateProducesData = Producer::where('id', $row_id)->update($updateProduces);
           
            if(isset($request->expedition) && count($request->expedition)){
                $this->updateExpedition($request->expedition); 
            }
            if(isset($request->producer_access) && count($request->producer_access)){
                foreach($request->producer_access as $producer_access){
                    $createAccessProducer = array(
                        'user_id'     => $producer_access['user_id']
                    );
                    ProducerAccess::updateOrCreate(['id'=>isset($producer_access['id'])?$producer_access['id']:null],$createAccessProducer);
                }
            }
            if(isset($request->audit_info) && !empty($request->audit_info)){
                $creataudit_info = array(
                    'information'             => $request->audit_info['information'],
                    'is_factory_approved'     => $request->audit_info['is_factory_approved'],
                    'audit_date'              => $request->audit_info['audit_date'],
                    'scoring'                 => $request->audit_info['scoring'],
                    'row_material'            => $request->audit_info['row_material'],
                    'processing_facilities'   => $request->audit_info['processing_facilities'],
                    'respect_cold_chain'      => $request->audit_info['respect_cold_chain'],
                    'storage'                 => $request->audit_info['storage'],
                    'traceability'            => $request->audit_info['traceability']
                );
                UserAudit::updateOrCreate(['id'=>isset($request->audit_info['id'])?$request->audit_info['id']:null],$creataudit_info);
            }
            return response()->json($request->all(), 200);
        } 
        else {
            return response()->json(['error'=>'Producer Id not found!']);
        }
    }

    public function updateSectionRecord($sectionData){
        if(isset($sectionData) && count($sectionData)){
          $fieldsidsArray=array();
            if(isset($sectionData['custom_fields']) && count($sectionData['custom_fields'])){
                if(count($sectionData['custom_fields'])){
                    foreach($sectionData['custom_fields']as $customFilds){
                        $createColumn = array(
                            'name'        => $customFilds['name'],
                            'section_id'  => $customFilds['section_id'],
                            'type'        => $customFilds['type'],
                            'item_list'   => $customFilds['item_list']
                        );
                        $create_Fields=CustomFields::updateOrCreate(['id'=>isset($customFilds['id'])?$customFilds['id']:null],$createColumn);
                        array_push($fieldsidsArray,$customFilds['id']?$customFilds['id']:$create_Fields->id);
                    }
                }
            }
            if(isset($sectionData['custom_rows']) && count($sectionData['custom_rows'])){
                if(count($sectionData['custom_rows'])){
                    foreach($sectionData['custom_rows'] as $custom_rows){
                        $ceateRow = array(
                           'section_id'=>  $custom_rows['section_id'],
                        );
                        $createcustom_rows=CustomRows::updateOrCreate(['id'=>isset($custom_rows['id'])?$custom_rows['id']:null],$ceateRow);
                        if(isset($custom_rows['customdata']) && count($custom_rows['customdata'])){
                            foreach($custom_rows['customdata'] as $key=>$customdata){
                                $createCustomProducer = array(
                                    'custom_field_id'  => $fieldsidsArray[$key]?$fieldsidsArray[$key]:$customdata['custom_field_id'],
                                    'custom_row_id'    => $createcustom_rows->id?$createcustom_rows->id:$customdata['custom_row_id'],
                                    'value'            => $customdata['value']
                                );
                                CustomProducerData::updateOrCreate(['id'=>isset($customdata['id'])?$customdata['id']:null],$createCustomProducer);
                            }
                        }
                    }
                }
            }
        }
    }
    /* update The Expecdation  */
    public function updateExpedition($expedition){
       if(isset($expedition) && count($expedition)){
            foreach($expedition as $valueExp){
                $createExpedition = array(
                    'key'         => $valueExp['key'],
                    'value'       => $valueExp['value']
                );
                Expedition::updateOrCreate(['id'=>isset($valueExp['id'])?$valueExp['id']:null],$createExpedition);
            }
        }
    }  
  /* Get  The All  Cities */
  public  function  getAllCities(){
    $getAllCities=City::get(); 
    return response()->json($getAllCities, 200);
  }




}
