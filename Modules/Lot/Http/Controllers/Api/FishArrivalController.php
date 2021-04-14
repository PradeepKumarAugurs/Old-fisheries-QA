<?php

namespace Modules\Lot\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lot\Entities\Api\FishArrival;
use Modules\AccountManagement\Entities\Section;
use Modules\AccountManagement\Entities\CustomFields;
use Modules\AccountManagement\Entities\CustomRows;
use Modules\AccountManagement\Entities\CustomProducerData;
use Modules\Lot\Entities\Api\LotParasite;
use Modules\Lot\Entities\Api\PrasitesLocation;
use Validator;
class FishArrivalController extends Controller
{
    /**
     *  To Create and Update The Fishing Information 
    */
    public  function createFishing(Request $request){
        $validator = validator::make($request->all(), [
            'landing_date'        => 'required|date_format:Y-m-d',
            'unloading_place'     => 'required|numeric|min:1',
            'vessel_id'           => 'required|numeric|min:1',
            'sequence'            => 'required|numeric|min:1',
            'fishing_date'        => 'required|date_format:Y-m-d',
            'fishing_zone'        => 'required|numeric|min:1',
            'ice_onboard'         => 'required|string',
            'number_of_catches'   => 'required|numeric|min:1',
            'total_fish_quantity' => 'required|numeric|min:1',
            'total_fishing_time'  => 'required|numeric|min:1',
        //    'unloading_date'      => 'required|date_format:Y-m-d',
        //    'added_ice'           => 'required|string',
            'sections'            => 'required|array',
            'sections.*.name'     => 'required|string',
            'sections.*.type'     => 'required|numeric|min:1',
            'sections.*.custom_fields'                      => 'array',
            'sections.*.custom_fields.*.name'               => 'string',
            'sections.*.custom_fields.*.type'               => 'numeric|min:1',
            'sections.*.custom_fields.*.item_list'          => 'string',
            'sections.*.custom_rows'                        => 'array',
            'sections.*.custom_rows.*.customdata'           => 'array',
            'sections.*.custom_rows.*.customdata.*.value'   => 'string'
        ]);
        if ($validator->fails()){ 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 
        if(isset($request->sections) && count($request->sections)){
            for($i=0;$i < count($request->sections);$i++){
                for($j=$i+1; $j < count($request->sections);$j++){	
                    if($request->sections[$i]['name']==$request->sections[$j]['name']){
                        return response()->json(['error'=>"This Section ".$request->sections[$i]['name']." all ready exist "], 401);
                    }
                }
            }
        }
        if(isset($request->id) && $request->id!=NULL ){
            $getFishArrival = FishArrival::find($request->id);
            if(empty($getFishArrival)){
                return response()->json(['error'=>"Fish arrival  not found !."], 401);
            }
        }
        $dataOfFishingArrival=[
            'arrival_id'         => isset($request->arrival_id)?$request->arrival_id:strtotime(date('Y-m-d H:i:s')).'AFOULK#',
            'landing_date'       => $request->landing_date,
            'unloading_place'    => $request->unloading_place,
            'vessel_id'          => $request->vessel_id,
            'sequence'           => $request->sequence,
            'fishing_date'       => $request->fishing_date,
            'fishing_zone'       => $request->fishing_zone,
            'ice_onboard'        => $request->ice_onboard,               
            'number_of_catches'  => $request->number_of_catches,
            'total_fish_quantity'=> $request->total_fish_quantity,
            'total_fishing_time' => $request->total_fishing_time
        ];
        if(isset($request->id) && $request->id!=NULL ){
            $dataOfFishingArrival['updated_by'] = request()->user()->id;
        }
        else{
            $dataOfFishingArrival['created_by'] =  request()->user()->id;
        }
        
        $createdFishArrival = FishArrival::updateOrCreate(['id'=>isset($request->id)?$request->id:NULL],$dataOfFishingArrival);
       
        if(isset($request->id) && $request->id != NULL ){
            $fishArrivalId = $request->id;
        }
        else{
            $fishArrivalId = $createdFishArrival->id;
        }
        if(isset($request->sections) && count($request->sections)){
            $this->createNewFieldsNewRowsSections($request->sections,$fishArrivalId);
        }
        $getFishArrival = FishArrival::find($fishArrivalId);
        if(!empty($getFishArrival)){
            $getFishArrival->sections=Section::
            with(['custom_fields'=>function($query) use ($fishArrivalId){
                $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$fishArrivalId]);
            }])
            ->with(['custom_rows'=>function($query) use ($fishArrivalId){
                $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$fishArrivalId])
                ->with('customdata');
            }])->where('type',2)->get();
        }
        return response()->json($getFishArrival, 200);
    }

    /**
     * get list o fish arrivals
     */
    public function getFishArrivalList(Request $request){

        $getFishArrival = FishArrival::get();
        if(!empty($getFishArrival)){

            return response()->json($getFishArrival, 200);
        }
        else{
            return response()->json(['error'=>'Record not Found!']);
        }
    }
    /**
     * Get Data Fish Arrivals with conditins 
     */
    public function getFishArrival(Request $request, $row_id){

        $getFishId = FishArrival::find($row_id);
        if(!empty($getFishId)){

            $getFishArrivalData = FishArrival::where('id', $row_id)->get(); 
            return response()->json($getFishArrivalData, 200);
        }
        else{
            return response()->json(['error'=>'Fish Arrival not Found!']);
        }
        
    }

   /**
    *  Create Custom Fields and Custom data 
   */
  public function  createNewFieldsNewRowsSections($allSections,$fishArrivalId){
      if(!empty($allSections)){
        foreach($allSections as $sectionData){
            $createSectionsData = array(
                'name'        => $sectionData['name'],
                'name_key'    => $sectionData['name_key'],
                'type'        => $sectionData['type']
            );
            if(isset($sectionData['id']) && $sectionData['id']!=NULL){
                Section::where('id',$sectionData['id'])->update($createSectionsData);
            }
            else{
                $getSectionExist=Section::where(['name'=>$sectionData['name'],'type'=>$sectionData['type']])->first(); 
                if(empty($getSectionExist)){
                    $createdSections = Section::create($createSectionsData);
                }
                else{
                    $sectionData['id']=$getSectionExist->id;
                }
            }
            $SectionsId = (isset($sectionData['id']) && $sectionData['id']!=null)?$sectionData['id']:$createdSections->id;
       
       
            $fieldsidsArray = array();
            if(isset($sectionData['custom_fields']) && count($sectionData['custom_fields'])){
                if(count($sectionData['custom_fields'])){
                    foreach($sectionData['custom_fields']as $customFilds){
                        $createColumn = array(
                            'name'        => $customFilds['name'],
                            'producer_id' => NULL,
                            'arrival_id'  => $fishArrivalId,
                            'section_id'  => $SectionsId,
                            'type'        => $customFilds['type'],
                            'item_list'   => $customFilds['item_list']
                        );
                        if(isset($customFilds['id']) && $customFilds['id'] != NULL ){
                            $update_Fields=CustomFields::where('id',$customFilds['id'])->update($createColumn);
                            $create_FieldsId = $customFilds['id'];
                        }
                        else{
                            $getCustomFieldsExist = CustomFields::where(['name'=>$customFilds['name'],'arrival_id'=>$fishArrivalId,'section_id'=>$SectionsId])->first();
                            if(empty($getCustomFieldsExist)){$create_Fields = CustomFields::create($createColumn); $create_FieldsId = $create_Fields->id; }
                            else{ $create_FieldsId = $getCustomFieldsExist->id;}
                        }
                        array_push($fieldsidsArray,$create_FieldsId);
                        // $create_Fields=CustomFields::create($createColumn);
                        // array_push($fieldsidsArray,$create_Fields->id);
                    }
                }
            }
            if(isset($sectionData['custom_rows']) && count($sectionData['custom_rows'])){
                if(count($sectionData['custom_rows'])){
                    foreach($sectionData['custom_rows'] as $custom_rows){
                        $ceateRow = array(
                            'producer_id' => NULL,
                            'arrival_id'  => $fishArrivalId,
                            'section_id'  =>  $SectionsId,
                        );
                        $createcustom_rows = CustomRows::updateOrCreate(['id' => isset($custom_rows['id'])?$custom_rows['id']:NULL],$ceateRow);
                        $createcustomRowsId = isset($custom_rows['id'])?$custom_rows['id']:$createcustom_rows->id;
                        if(isset($custom_rows['customdata']) && count($custom_rows['customdata'])){
                            foreach($custom_rows['customdata'] as $key=>$customdata){
                                $createCustomProducer = array(
                                    'producer_id'      => NULL,
                                    'arrival_id'       => $fishArrivalId,
                                    'custom_field_id'  => $fieldsidsArray[$key]?$fieldsidsArray[$key]:$customdata['custom_field_id'],
                                    'custom_row_id'    => $createcustomRowsId?$createcustomRowsId:$customdata['custom_row_id'],
                                    'value'            => $customdata['value'],
                                );
                                CustomProducerData::updateOrCreate(['id' => isset($customdata['id'])?$customdata['id']:NULL],$createCustomProducer);
                            }
                        }
                    }
                }
            }

        }
      }
  }

    /* get  Fishing Info  */
    public function  getFishing(Request $request){
        $getFishArrival = FishArrival::find($request->arrival_id);
        if(!empty($getFishArrival)){
            $getFishArrival->sections=Section::
            with(['custom_fields'=>function($query) use ($request){
                $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$request->arrival_id]);
            }])
            ->with(['custom_rows'=>function($query) use ($request){
                $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$request->arrival_id])
                ->with('customdata');
            }])->where('type',2)->get();
            return response()->json($getFishArrival, 200);
        }
        else{
            return response()->json(['error'=>'No Fishing Arrival Exist!.'], 401);
        }
    }


/**
 *  Update Parasitism info 
*/
public function updateParasitismInfo(Request $request){ 
    $getFishArrival = FishArrival::select('id')->find($request->row_id);
    if(!empty($getFishArrival)){
        $validator = Validator::make($request->all(),[
            'lotParasites'                                 => 'required|array|max:1',
            'lotParasites.*.parasite_id'                   => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo'                  => 'required|array',
            'lotParasites.*.parasiteInfo.*.guts'           => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo.*.meat'           => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo.*.anus'           => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo.*.other'          => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo.*.total_parasite' => 'required|numeric|min:0',
            'lotParasites.*.prevalence'                    => 'required|numeric|min:0',
            'lotParasites.*.average'                       => 'required|numeric|min:0',
            'lotParasites.*.std'                           => 'required|numeric|min:0',
            'lotParasites.*.min'                           => 'required|numeric|min:0',
            'lotParasites.*.max'                           => 'required|numeric|min:0',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        if(isset($request->lotParasites) && count($request->lotParasites)){
            foreach ($request->lotParasites as $key => $lotParasite) {
                $createParasitesArray = array(
                    'arrival_id'  => $request->row_id,
                    'parasite_id' => $lotParasite['parasite_id'], 
                    'prevalence'  => $lotParasite['prevalence'], 
                    'average'     => $lotParasite['average'], 
                    'std'         => $lotParasite['std'], 
                    'min'         => $lotParasite['min'], 
                    'max'         => $lotParasite['max']
                );
                if(isset($lotParasite['id']) && $lotParasite['id']!=NULL ){
                    $createParasitesArray['updated_by'] = request()->user()->id;
                }
                else{
                    $createParasitesArray['created_by'] =  request()->user()->id;
                }
                $createdParasite = LotParasite::updateOrCreate(['id'=>isset($lotParasite['id'])?$lotParasite['id']:NULL],$createParasitesArray);
               
                if(isset($lotParasite['parasiteInfo']) && count($lotParasite['parasiteInfo'])){
                    foreach ($lotParasite['parasiteInfo'] as $key2 => $parasiteLocation) {
                        $createParasitesLocation = array(
                            'arrival_id'       => $request->row_id,
                            'lot_parasite_id'  => $createdParasite->id,
                            'guts'             => $parasiteLocation['guts'], 
                            'meat'             => $parasiteLocation['meat'], 
                            'anus'             => $parasiteLocation['anus'], 
                            'other'            => $parasiteLocation['other'], 
                            'total_parasite'   => $parasiteLocation['total_parasite']
                        );
                        if(isset($parasiteLocation['id']) && $parasiteLocation['id']!=NULL ){
                            $createParasitesLocation['updated_by'] = request()->user()->id;
                        }
                        else{
                            $createParasitesLocation['created_by'] =  request()->user()->id;
                        }
                        $createdParasiteLocation = PrasitesLocation::updateOrCreate(['id'=>isset($parasiteLocation['id'])?$parasiteLocation['id']:NULL],$createParasitesLocation);
                       
                    }
                }
            }
        }
        $getParasitism = LotParasite::where('arrival_id',$request->row_id)->with('parasiteInfo')->get();
        $getFishArrival->lotParasites = $getParasitism;
        return response()->json($getFishArrival, 200);
    }
    else{
        return response()->json(['error'=>'No Fishing Arrival Exist!.'], 401);
    }
}

/**
 *   Get Parasitism info 
*/
public  function getParasitismInfo(Request $request){
    $getFishArrival = FishArrival::select('id')->find($request->row_id);
    if(!empty($getFishArrival)){
        $getParasitism = LotParasite::where('arrival_id',$request->row_id)->with('parasiteInfo')->get();
        $getFishArrival->lotParasites = $getParasitism;
        return response()->json($getFishArrival, 200);
    }
    else{
        return response()->json(['error'=>'No Fishing Arrival Exist!.'], 401);
    }
}

/**
 * Update the Organoleptic Resistance
 */

public  function updateOrganolepticResistance(Request $request,$row_id){

    $getFishArrival = FishArrival::select('id','meat_texture')->find($row_id);
        if(!empty($getFishArrival)) {    // to  Check  Exist lot into database
            $validator = Validator::make($request->all(), [
                'meat_texture'                => 'required|numeric|min:1|max:5',
                'freshness'                   => 'required|numeric|min:1|max:5',
                'scales'                      => 'required|numeric|min:1|max:5',
                'belly_thickness'             => 'required|numeric|min:1|max:5',
                'belly_strength'              => 'required|numeric|min:1|max:5',
                'fat_content'                 => 'required|numeric|min:1|max:5',
                'fat_content_image'           => 'required|numeric|min:1',
                'fat_content_percentage'      => 'required|numeric|min:1',
                'feed'                        => 'required|string|max:255',
                'feed_charatestic_image'      => 'required|numeric|min:1',
                'small_feed'                  => 'required|numeric|min:1',
                'medium_feed'                 => 'required|numeric|min:1',
                'large_feed'                  => 'required|numeric|min:1',
                'extra_large_feed'            => 'required|numeric|min:1',
                'feed_comment'                => 'required|string|max:255',
                'reception_fish_temprature'   => 'required|numeric|min:1',
                'fish_temp_image'             => 'required|numeric|min:1',
                'resistance_test_small'       => 'required|array|min:1',
                'resistance_test_medium'      => 'required|array|min:1',
                'resistance_test_large'       => 'required|array|min:1'
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);           
            }
            $updateOrganolepticResistance=array(
                'meat_texture'                => $request->meat_texture,
                'freshness'                   => $request->freshness,
                'scales'                      => $request->scales,
                'belly_thickness'             => $request->belly_thickness,
                'belly_strength'              => $request->belly_strength,
                'fat_content'                 => $request->fat_content,
                'fat_content_image'           => $request->fat_content_image,
                'fat_content_percentage'      => $request->fat_content_percentage,
                'feed'                        => $request->feed,
                'feed_charatestic_image'      => $request->feed_charatestic_image,
                'small_feed'                  => $request->small_feed,
                'medium_feed'                 => $request->medium_feed,
                'large_feed'                  => $request->large_feed,
                'extra_large_feed'            => $request->extra_large_feed,
                'feed_comment'                => $request->feed_comment,
                'reception_fish_temprature'   => $request->reception_fish_temprature,
                'fish_temp_image'             => $request->fish_temp_image,
                'resistance_test_small'       => json_encode($request->resistance_test_small),
                'resistance_test_medium'      => json_encode($request->resistance_test_medium),
                'resistance_test_large'       => json_encode($request->resistance_test_large)
            );
            $getFishArrival->update($updateOrganolepticResistance);
            return response()->json($getFishArrival, 200);
        }
        else{
            return response()->json(['error'=>'No Fishing Arrival Exist!.'], 401);
        }
}

 /**
  * get  Organoleptic Resistance 
 */
 public  function getOrganolepticResistance(Request $request,$row_id){
    $getFishArrival = FishArrival::select('id','meat_texture','freshness','scales','belly_thickness','belly_strength','fat_content','fat_content_percentage',
    'feed','small_feed','medium_feed','large_feed','extra_large_feed','feed_comment','fat_content_image','feed_charatestic_image','reception_fish_temprature','fish_temp_image','resistance_test_small',
    'resistance_test_medium','resistance_test_large')->with(['contentImages','charatesticImages','fishTempImages'])->find($row_id);
    if(!empty($getFishArrival)) {
        //$getdata=FishArrival::with(['contentImages'])->find($row_id);
        //$getFishArrival->contentImages = $getdata->contentImages;
        return response()->json($getFishArrival, 200);
    }
    else{
        return response()->json(['error'=>'No Fishing Arrival Exist!.'], 401);
    }
 }


 /**
  * Get  Fish Arrivals 
 */
public  function  getAllArrivals(Request $request){
    $getAllFishArrivals = FishArrival::select('id','meat_texture','freshness','scales','belly_thickness','belly_strength','fat_content','fat_content_percentage',
    'feed','small_feed','medium_feed','large_feed','extra_large_feed','feed_comment','fat_content_image','feed_charatestic_image','reception_fish_temprature','fish_temp_image','resistance_test_small',
    'resistance_test_medium','resistance_test_large')->with(['contentImages','charatesticImages','fishTempImages'])->get();
    return response()->json($getAllFishArrivals, 200);
}
    

   
}
