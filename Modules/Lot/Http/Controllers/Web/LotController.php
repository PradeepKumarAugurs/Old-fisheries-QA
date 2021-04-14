<?php

namespace Modules\Lot\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lot\Entities\Api\FishArrival;
use Modules\Lot\Entities\Api\UnloadingHatch;
use Modules\AccountManagement\Entities\Section;
use Modules\AccountManagement\Entities\CustomFields;
use Modules\AccountManagement\Entities\CustomRows;
use Modules\AccountManagement\Entities\CustomProducerData;
use Modules\AccountManagement\Entities\City;
use Modules\AccountManagement\Entities\Vessel;
use Modules\Lot\Entities\Api\Zone;
use Modules\Lot\Entities\Api\Voyage;
use Modules\OnlineQcControl\Entities\Api\OnlineQcThowingBlock;
use Modules\OnlineQcControl\Entities\Api\Histamine;
use Modules\OnlineQcControl\Entities\Api\OnlineQcColdStorage;
use Modules\OnlineQcControl\Entities\Api\OnlineQcControl;
use Modules\Lot\Entities\Api\LotWrWeightFinishProduct;
use Modules\AccountManagement\Entities\Producer;
use Modules\Lot\Entities\Api\Type;
use Modules\Lot\Entities\Api\Quality;
use Modules\Lot\Entities\Api\Unit;
use Modules\Lot\Entities\Api\LotInfo;
use Modules\Lot\Entities\Api\MasterParasite;
use Session;
use Validator;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function lotInformation(Request $request)
    {  
        $data['producer_list'] = Producer::get();
		$data['type'] = Type::get();
		$data['quality'] = Quality::get();
		$data['unit'] = Unit::get();
        return view('lot::index')->with($data);
    }
    /**
     * Create Lot Controller
     */
    public function createRawMaterial(Request $request){

        $data['getVesselList'] = Vessel::get();
        $data['getZonelList'] = Zone::get();
        $data['getCitylList'] = City::get();
        $data['tab']  = 'tab_1';
        return view('lot::createMaterial')->with($data);
    }
    
    public function rawMaterialArrival(Request $request){
        
        $data['FishArrivalList'] = FishArrival::get();
        return view('lot::fishArrivalMaterial')->with($data);
    }

    /**
     * Create New Fish Records
     */
    public function createFishingInfo(Request $request){
        
        $validator = $request->validate([
            'landing_date'       => 'required|date_format:Y-m-d',
            'unloading_place'    => 'required|numeric|min:1',
            'vessel_id'          => 'required|numeric|min:1',
            'sequence'           => 'required|numeric|min:1',
            'fishing_date'       => 'required|date_format:Y-m-d',
            'fishing_zone'       => 'required|numeric|min:1',
            'ice_onboard'        => 'required|string',
            'number_of_catches'  => 'required|numeric|min:1',
            'total_fish_quantity'=> 'required|numeric|min:1',
            'total_fishing_time' => 'required|numeric|min:1',
            'sections'                           => 'required|array',
            'sections.*.custom_fields'           => 'required|array',
            'sections.*.custom_fields.name'      => 'required|array',
            'sections.*.custom_fields.name.*'    => 'required',
            'sections.*.custom_fields.type'      => 'required|array',
            'sections.*.custom_fields.type.*'    => 'required',
            'sections.*.custom_fields.item_list' => 'array',
            'sections.*.custom_rows.customdata.*.value'  => 'required|array',
        ]);
        $dataOfFishingArrival = [
            'arrival_id'        => isset($request->arrival_id)?$request->arrival_id:strtotime(date('Y-m-d H:i:s')).'AFOULK#',
            'landing_date'      => $request->landing_date,
            'unloading_place'   => $request->unloading_place,
            'vessel_id'         => $request->vessel_id,
            'sequence'          => $request->sequence,
            'fishing_date'      => $request->fishing_date,
            'fishing_zone'      => $request->fishing_zone,
            'ice_onboard'       => $request->ice_onboard,               
            'number_of_catches' => $request->number_of_catches,
            'total_fish_quantity'=> $request->total_fish_quantity,
            'total_fishing_time'=> $request->total_fishing_time
        ];

        $createFishArrivals = FishArrival::create($dataOfFishingArrival);
       
        if(isset($request->sections) && count($request->sections)){
            $this->createSectionRecord($request->sections,$createFishArrivals->id); 
        } 
        //Session::flash('success', 'Created Fishing Info Successfully!');
        //return view('lot::createMaterial');
            $data['arrival_id'] = $createFishArrivals->id;
            $data['tab'] = 'tab_2';
            return redirect('lot/createRawMaterial')->withInput()->with($data);

    }
    /**
     *  Create Unloading Info 
     */
    
    public function createUnloadingInfo(Request $request){
       
        $getFishArrival = FishArrival::find($request->arrival_id);
       
        if(!empty($getFishArrival)){ 
        $validator = $request->validate([
           'unloading_places'                   => 'required|string|max:255',
           'unloading_date'                     => 'required|date_format:Y-m-d',
           'added_ice'                          => 'required|string|max:255',
           'unloading_comment'                  => 'required|string|max:255',
           'sections'                           => 'required|array',
           'sections.*.custom_fields'           => 'required|array',
           'sections.*.custom_fields.name'      => 'required|array',
           'sections.*.custom_fields.name.*'    => 'required',
           'sections.*.custom_fields.type'      => 'required|array',
           'sections.*.custom_fields.type.*'    => 'required',
           'sections.*.custom_fields.item_list' => 'array',
           'sections.*.custom_rows.customdata.*.value'  => 'required|array'
           //'fishing_hatch'                             => 'required|array'                        
        ]);
        
        /*$validator2 = $request->validate([

            'fishing_hatch.*.hatch_id'=> 'required|numeric|min:1',
            'fishing_hatch.*.start_time'=> 'required|numeric|min:1',
            'fishing_hatch.*.end_time'=>  'required|numeric|min:1',
            'fishing_hatch.*.fish_teprature'=> 'required|numeric|min:1'
        ]);*/
       
        $update = array(
           'unloading_places'=> $request->unloading_places,
           'unloading_date'=> $request->unloading_date,
           'added_ice'=> $request->added_ice,
           'unloading_comment'=> $request->unloading_comment
        );
       
        //$update['updated_by'] = request()->user()->id;
        $fishArrivalId = $request->arrival_id;
        $updateFishArrival = FishArrival::where('id',$fishArrivalId)->update($update);
       
        /*if(isset($request->fishing_hatch) && count($request->fishing_hatch)){
            if(count($request->fishing_hatch)){
                foreach($request->fishing_hatch as $fishing_hatch){
                    $createUnloadinHatches = array(

                        'arrival_id'=> $updateFishArrival['arrival_id'],
                        'fishing_hatch_id'=> $request->fishing_hatch_id,
                        'hatch_id'=> $fishing_hatch['hatch_id'],
                        'start_time'=> $fishing_hatch['start_time'],
                        'end_time'=> $fishing_hatch['end_time'],
                        'fish_teprature'=> $fishing_hatch['fish_teprature']
                    );
                    UnloadingHatch::create($createUnloadinHatches);
                }
            }
        }*/
        
        if(isset($request->sections) && count($request->sections)){
           $this->createSectionRecord($request->sections,$fishArrivalId);
        }
        $getFishArrival = FishArrival::select('unloading_places','unloading_date','added_ice','unloading_comment')->find($fishArrivalId); 
        if(!empty($getFishArrival)){
           $getFishArrival->sections = Section::
           with(['custom_fields'=>function($query) use ($fishArrivalId){
                 $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$fishArrivalId]);
           }])
           ->with(['custom_rows'=>function($query) use ($fishArrivalId){
                 $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$fishArrivalId])
                 ->with('customdata');
           }])->where('type',3)->get();
        }
            $data['arrival_id'] = $getFishArrival['id'];
            $data['tab'] = 'tab_3';
            return redirect('lot/createRawMaterial')->withInput()->with($data);
        }
        else{
            return redirect('lot/createRawMaterial');
        }
    }
 
  /**
   * Create sections and row, Columns  */  
  public function createSectionRecord($sections,$arrival_id){
    if(isset($sections) && count($sections) && $arrival_id){
        foreach($sections as $sectionData){
        $createSectionsData = array(
            'name'       => $sectionData['name'],
            'name_key'   => $sectionData['name_key'],
            'type'       => 1
        ); 
         if(isset($sectionData['id']) && $sectionData['id']!=NULL){
            $createdSection=Section::where('id',$sectionData['id'])->update($createSectionsData);
            $SectionsId = $sectionData['id'];
         }
         else{
            $getSectionExist=Section::where(['name'=>$sectionData['name'],'type'=>1])->first(); 
            if(empty($getSectionExist)){
                $createdSections = Section::create($createSectionsData);
                $SectionsId = $createdSections->id;
            }
            else{
                $SectionsId = $getSectionExist->id;
            }
        }
        //$SectionsId = ($sectionData['id']!=null)?$sectionData['id']:$createdSections->id;

        $fieldsidsArray = array();
        if(isset($sectionData['custom_fields']) && count($sectionData['custom_fields'])){
            if(count($sectionData['custom_fields'])){
                
                if(isset($sectionData['custom_fields']['name']) && count($sectionData['custom_fields']['name'])){
                    foreach($sectionData['custom_fields']['name'] as $key2=>$customFieldsName){
                        $createColumn = array(
                            'name'       => $customFieldsName,
                            'arrival_id'=> $arrival_id,
                            'section_id' => $SectionsId,
                            'type'       => $sectionData['custom_fields']['type'][$key2],
                            'item_list'  => $sectionData['custom_fields']['item_list'][$key2]
                        );
                        $create_Fields=CustomFields::create($createColumn);
                        array_push($fieldsidsArray,$create_Fields->id);
                    }
                }
            }
        }
        if(isset($sectionData['custom_rows']) && count($sectionData['custom_rows'])){
            if(count($sectionData['custom_rows'])){
                if(isset($sectionData['custom_rows']['customdata']) && count($sectionData['custom_rows']['customdata'])){
                    foreach($sectionData['custom_rows']['customdata'] as $custom_rows){
                        $ceateRow = array(
                            'arrival_id'=>  $arrival_id,
                            'section_id' =>  $SectionsId
                        );
                        $createcustom_rows=CustomRows::create($ceateRow);
                        if(isset($custom_rows['value']) && count($custom_rows['value'])){
                            foreach($custom_rows['value'] as $key=>$customdata){
                                $createCustomProducer = array(
                                    'arrival_id'     => $arrival_id,
                                    'custom_field_id' => $fieldsidsArray[$key]?$fieldsidsArray[$key]:$customdata['custom_field_id'],
                                    'custom_row_id'   => $createcustom_rows->id?$createcustom_rows->id:$customdata['custom_row_id'],
                                    'value'           => $customdata?$customdata:0
                                );
                                CustomProducerData::create($createCustomProducer);
                            }
                        }
                    }
                }
            }
        }
       } /* end of  the Section*/
    }
}
    public function  createNewFieldsNewRowsSections($allSections,$fishArrivalId){
      if(!empty($allSections)){
        foreach($allSections as $sectionData){
            $createSectionsData = array(
                'name'       => $sectionData['name'],
                'name_key'   => $sectionData['name_key'],
                'type'       => $sectionData['type']
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
                            'name'       => $customFilds['name'],
                            'producer_id'=> NULL,
                            'arrival_id' => $fishArrivalId,
                            'section_id' => $SectionsId,
                            'type'       => $customFilds['type'],
                            'item_list'  => $customFilds['item_list']
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
                            'producer_id'=> NULL,
                            'arrival_id' => $fishArrivalId,
                            'section_id' =>  $SectionsId,
                        );
                        $createcustom_rows = CustomRows::updateOrCreate(['id'=> isset($custom_rows['id'])?$custom_rows['id']:NULL],$ceateRow);
                        $createcustomRowsId = isset($custom_rows['id'])?$custom_rows['id']:$createcustom_rows->id;
                        if(isset($custom_rows['customdata']) && count($custom_rows['customdata'])){
                            foreach($custom_rows['customdata'] as $key=>$customdata){
                                $createCustomProducer = array(
                                    'producer_id'     => NULL,
                                    'arrival_id'      => $fishArrivalId,
                                    'custom_field_id' => $fieldsidsArray[$key]?$fieldsidsArray[$key]:$customdata['custom_field_id'],
                                    'custom_row_id'   => $createcustomRowsId?$createcustomRowsId:$customdata['custom_row_id'],
                                    'value'           => $customdata['value'],
                                );
                                CustomProducerData::updateOrCreate(['id'=> isset($customdata['id'])?$customdata['id']:NULL],$createCustomProducer);
                            }
                        }
                    }
                }
            }

        }
      }
    }
    /**
     * Create Transport Record
     */
    public function getTransportationInfo(Request $request, $row_id){
        $getVoyagesId = FishArrival::find($row_id);
        if(!empty($getVoyagesId)){
            $getVoyagesInfo = FishArrival::select('number_of_voyages')->find($row_id);
            $result = FishArrival::with(['originTransportation'=>function($query){
                $query->select('*')->with(['truckImageDetails','recipientImageDetails']);
            }])->find($row_id);
            $getVoyagesInfo->originTransportation=$result->originTransportation;
            return response()->json($getVoyagesInfo, 200);
        }
        else{
            return response()->json(['error'=>'fishing arrival not found!'], 401);  
        }   
    }

    public function createTransportInfo(Request $request){
        
        $getFishArrival = FishArrival::find($request->arrival_id);
        if(!empty($getFishArrival)){
           
            $validator = $request->validate([
            'number_of_voyages'=> 'required',
            'truck_id'=> 'required|numeric',
            'port_departure_time'=> 'required|numeric',    
            'transportation_time'=> 'required|numeric', 
            'added_ice'=> 'required|string',
            'add_water'=> 'required|string',
            'type_of_recipient'=> 'required|string',
            'weight_bundle'=> 'required|string',
            'net_weight'=> 'required|numeric',
            'gross_weight'=> 'required|numeric',
            'climate_controle'=> 'required',
            'number_of_bundles'=> 'required',
            'factory_arrival_time'=> 'required',
            'production_which_from'=> 'required',
            'comment'=> 'required|string',
            'truck_image'=> 'required',
            'recipient_image'=> 'required'
            ]);
            $getArrivalId = $request->arrival_id;
            $update = array(
                'arrival_id'       => $getArrivalId,
                'number_of_voyages'=> $request->number_of_voyages
            );
            if(!empty($request->all())){
                $createTransportation = array(
                   // 'arrival_id'         => $getArrivalId->id,
                    'truck_id'           => $request->truck_id,
                    'port_departure_time'=>  $request->port_departure_time,
                    'transportation_time'=> $request->transportation_time,
                    'added_ice'          => $request->added_ice,
                    'add_water'          => $request->add_water,
                    'type_of_recipient'  => $request->type_of_recipient,
                    'weight_bundle'      => $request->weight_bundle,
                    'net_weight'         => $request->net_weight,
                    'gross_weight'       => $request->gross_weight,
                    'climate_controle'   => $request->climate_controle,
                    'number_of_bundles'  => $request->number_of_bundles,
                    'factory_arrival_time'=> $request->factory_arrival_time,
                    'production_which_from'=> $request->production_which_from,
                    'comment'              => $request->comment,
                    'truck_image'          => $request->truck_image,
                    'recipient_image'      => $request->recipient_image
                );
                Voyage::create($createTransportation);
            }
            $updateVoyageInfo = FishArrival::where('id',$getArrivalId)->update($update);
            
            $getVoyagesInfo = FishArrival::select('number_of_voyages')->find($getArrivalId);
            $result = FishArrival::with(['originTransportation'=>function($query){
                        $query->select('*')->with(['truckImageDetails','recipientImageDetails']);
            }])->find($getArrivalId);
            $getVoyagesInfo['originTransportation'] = $result['originTransportation'];
            $data['arrival_id'] = $getVoyagesInfo['id'];
            $data['tab'] = 'tab_4';
            Session::flash('success', 'Created Transportation Successfully!');
            return redirect('lot/createRawMaterial')->withInput()->with($data);
        }
        else{
            Session::flash('error', 'Not Created Transportation!');
            return redirect('lot/createRawMaterial');
        }    
    }
/**
 * 
 * Create Parasites Records
 */
public function updateParasitismInfo(Request $request){ 
    $getFishArrival = FishArrival::select('id')->find($request->row_id);
    if(!empty($getFishArrival)){
        $validator = Validator::make($request->all(),[
            'lotParasites'                                => 'required|array|max:1',
            'lotParasites.*.parasite_id'                  => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo'                 => 'required|array',
            'lotParasites.*.parasiteInfo.*.guts'          => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo.*.meat'          => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo.*.anus'          => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo.*.other'         => 'required|numeric|min:0',
            'lotParasites.*.parasiteInfo.*.total_parasite'=> 'required|numeric|min:0',
            'lotParasites.*.prevalence'                   => 'required|numeric|min:0',
            'lotParasites.*.average'                      => 'required|numeric|min:0',
            'lotParasites.*.std'                          => 'required|numeric|min:0',
            'lotParasites.*.min'                          => 'required|numeric|min:0',
            'lotParasites.*.max'                          => 'required|numeric|min:0',
        ]);
        if($validator->fails()){
            return response()->json(['error'=> $validator->errors()], 401);
        }
        if(isset($request->lotParasites) && count($request->lotParasites)){
            foreach ($request->lotParasites as $key => $lotParasite) {
                $createParasitesArray = array(
                    'arrival_id' => $request->row_id,
                    'parasite_id'=> $lotParasite['parasite_id'], 
                    'prevalence' => $lotParasite['prevalence'], 
                    'average'    => $lotParasite['average'], 
                    'std'        => $lotParasite['std'], 
                    'min'        => $lotParasite['min'], 
                    'max'        => $lotParasite['max']
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
                            'arrival_id'      => $request->row_id,
                            'lot_parasite_id' => $createdParasite->id,
                            'guts'            => $parasiteLocation['guts'], 
                            'meat'            => $parasiteLocation['meat'], 
                            'anus'            => $parasiteLocation['anus'], 
                            'other'           => $parasiteLocation['other'], 
                            'total_parasite'  => $parasiteLocation['total_parasite']
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
 * Create New Records Organoleptic 
 */
    public  function createOrganolepticResistance(Request $request){

        $FishArrivalId = FishArrival::find($request->row_id);
       if(!empty($FishArrivalId)) {    // to  Check  Exist lot into database
            $validator = $request->validate([
                'meat_texture'               => 'required',
                'freshness'                  => 'required',
                'scales'                     => 'required',
                'belly_thickness'            => 'required',
                'belly_strength'             => 'required',
                'fat_content'                => 'required',
                'fat_content_image'          => 'required',
                'fat_content_percentage'     => 'required',
                'feed_charatestic_image'     => 'required',
                'small_feed'                 => 'required',
                'medium_feed'                => 'required',
                'large_feed'                 => 'required',
                'extra_large_feed'           => 'required',
                'feed_comment'               => 'required',
                'fish_temp_image'            => 'required',
                'resistance_test_small'      => 'required',
                'resistance_test_medium'     => 'required',
                'resistance_test_large'      => 'required'
            ]);
            
            $createOrganolepticResistance = array(
                'meat_texture'               => $request->meat_texture,
                'freshness'                  => $request->freshness,
                'scales'                     => $request->scales,
                'belly_thickness'            => $request->belly_thickness,
                'belly_strength'             => $request->belly_strength,
                'fat_content'                => $request->fat_content,
                'fat_content_image'          => $request->fat_content_image,
                'fat_content_percentage'     => $request->fat_content_percentage,
                'feed'                       => $request->feed,
                'feed_charatestic_image'     => $request->feed_charatestic_image,
                'small_feed'                 => $request->small_feed,
                'medium_feed'                => $request->medium_feed,
                'large_feed'                 => $request->large_feed,
                'extra_large_feed'           => $request->extra_large_feed,
                'feed_comment'               => $request->feed_comment,
                'reception_fish_temprature'  => $request->reception_fish_temprature,
                'fish_temp_image'            => $request->fish_temp_image,
                'resistance_test_small'      => $request->resistance_test_small,
                'resistance_test_medium'     => $request->resistance_test_medium,
                'resistance_test_large'      => $request->resistance_test_large
            );
            FishArrival::where('id',$request->row_id)->update($createOrganolepticResistance);
            $data = implode(" ",$createOrganolepticResistance);
            Session::flash('success', 'Created Organoleptic Resistance Successfully!');
            return view('lot::createMaterial');
        }
        else{
            Session::flash('error', 'Organoleptic Resistance not Created!');
            return view('lot::createMaterial');
        }
    }
    /**
     *  Update Organoleptic 
    */

    public function updateMaterial(Request $request){

        $data['FishArrival_List'] = FishArrival::where('id', $request->row_id)->first();
        return view('lot::updateMaterial')->with($data);
    }

    public function createWeight(Request $request){
        
        $validator = $request->validate([

              'lot_number'           => 'required',
              'production_date'      => 'required',
              'wr_weight_or'          => 'required|array'

        ]);

        $validator2 = $request->validate([

            'wr_weight_or.*.type'        => 'required',
            'wr_weight_or.*.weight'      => 'required'
        ]);
        
        if(count($request->wr_weight_or)){
            foreach($request->wr_weight_or as $wr_weigth){
                $wr_weigth['lot_number']=$request->lot_number;
                $wr_weigth['production_date']=$request->production_date;
                LotWrWeightOr::updateOrCreate(['id'=>isset($wr_weigth['id'])?$wr_weigth['id']:null],$wr_weigth);
            }
        }
        if(!empty($request)){
            $createLotInfo = LotInfo::create($request->all());
            Session::flash('success','LotInfo Created Successfully!');
            return view('lot::createMaterial');
        }
        else{
            Session::flash('error','LotInfo Not Created Successfully!');
            return view('lot::createMaterial');
        }
    }
/**
 *  Online Qc list
 */
    public function onlineQcList(Request $request){

        $data['Online_qc_list'] = OnlineQcControl::get();
        return view('lot::onlineqcList')->with($data);
    }
/**
 *  Finish Product List
 */
    public function finishProductList(Request $request){
        
        $data['finish_list'] = LotWrWeightFinishProduct::get();
        return view('lot::finishproduct')->with($data);
    }
/**
 *  Lab Analysis
 */
    public function labAnalysisList(Request $request){

        $data['lab_lists'] = Histamine::get();
        return view('lot::lab_analysisList')->with($data);
    }
/**
 *  Cold Chain
 */
    public function coldChain(Request $request){

        $data['cold_list'] = OnlineQcColdStorage::get();
        return view('lot::lab_analysisList')->with($data);
    }
/**
 *  Thawing Inspection
 */
    public function thawingInspection(Request $request){

        $data['ThawingList'] = OnlineQcThowingBlock::get();
        return view('lot::lab_analysisList')->with($data);
    }

    /**
     * Cold Chain List
     */
    public function coldChainList(Request $request){
        
        $data['Online_qc_list'] = OnlineQcControl::get();
        $data['finish_list'] = LotWrWeightFinishProduct::get();
        $data['lab_lists'] = Histamine::get();
        $data['cold_list'] = OnlineQcColdStorage::get();
        $data['ThawingList'] = OnlineQcThowingBlock::get();
        $data['FishArrivalList'] = FishArrival::get();
        return view('lot::cold_chain')->with($data);
    }

    /**
     *  Lot Info Created 
     */
    public function createLotInfo(Request $request){
        
        $validator = $request->validate([
            'lot_number'         => 'required|string|unique:lot_infos|max:255',
            'production_date'    => 'required|date_format:Y-m-d',
            'producer_id'        => 'required|numeric|min:1|max:9999999',
            'plant_location'     => 'required|string',
           // 'product'            => 'required',
            'type'               => 'required|numeric|min:1|max:9999999',
            'size'               => 'required|numeric',
            'quality'            => 'required|numeric|min:1|max:9999999',
            'unit_id'            => 'required|numeric|min:1|max:9999999',
            'weight'             => 'required|numeric',
            'number_of_unit'     => 'required|numeric',
            'total_quantity'     => 'required|numeric',
            'lot_comments'       => 'required'
        ]);
       
        $recordCreated = array(
            'lot_number'       => $request->lot_number,
            'production_date'  => $request->production_date,
            'producer_id'      =>$request->producer_id,
            'plant_location'   =>$request->plant_location,
          //  'product'          =>$request->product,
            'type'             =>$request->type,
            'size'             =>$request->size,
            'quality'          =>$request->quality,
            'unit_id'          =>$request->unit_id,
            'weight'           =>$request->weight,
            'number_of_unit'   =>$request->number_of_unit,
            'total_quantity'   =>$request->total_quantity,
            'lot_comments'     =>$request->lot_comments
        );
            $create = LotInfo::create($recordCreated);
            Session::flash('success', 'Created Lot Info Successfully!');
            return view('lot::index');
    }
    
    /**
     *  Update Organoleptic Resistance
     */
    public function updateOrganolepticResistance(Request $request,$row_id){
       
        $getFishArrival = FishArrival::find($row_id);
        if(!empty($getFishArrival)) {    
        $validator = $request->validate([
            'meat_texture'               => 'required|numeric|min:1|max:5',
            'freshness'                  => 'required|numeric|min:1|max:5',
            'scales'                     => 'required|numeric|min:1|max:5',
            'belly_thickness'            => 'required|numeric|min:1|max:5',
            'belly_strength'             => 'required|numeric|min:1|max:5',
            'fat_content'                => 'required|numeric|min:1|max:5',
            'fat_content_image'          => 'required|numeric|min:1',
            'fat_content_percentage'     => 'required|numeric|min:1',
            'feed_charatestic_image'     => 'required|numeric|min:1',
            'small_feed'                 => 'required|numeric|min:1',
            'medium_feed'                => 'required|numeric|min:1',
            'large_feed'                 => 'required|numeric|min:1',
            'extra_large_feed'           => 'required|numeric|min:1',
            'feed_comment'               => 'required|string|max:255',
            'fish_temp_image'            => 'required|numeric|min:1',
            'resistance_test_small'      => 'required|array|min:1',
            'resistance_test_medium'     => 'required|array|min:1',
            'resistance_test_large'      => 'required|array|min:1'
        ]);
        
        $updateOrganolepticResistance = array(
            'meat_texture'               => $request->meat_texture,
            'freshness'                  => $request->freshness,
            'scales'                     => $request->scales,
            'belly_thickness'            => $request->belly_thickness,
            'belly_strength'             => $request->belly_strength,
            'fat_content'                => $request->fat_content,
            'fat_content_image'          => $request->fat_content_image,
            'fat_content_percentage'     => $request->fat_content_percentage,
            'feed'                       => $request->feed,
            'feed_charatestic_image'     => $request->feed_charatestic_image,
            'small_feed'                 => $request->small_feed,
            'medium_feed'                => $request->medium_feed,
            'large_feed'                 => $request->large_feed,
            'extra_large_feed'           => $request->extra_large_feed,
            'feed_comment'               => $request->feed_comment,
            'reception_fish_temprature'  => $request->reception_fish_temprature,
            'fish_temp_image'            => $request->fish_temp_image,
            'resistance_test_small'      => json_encode($request->resistance_test_small),
            'resistance_test_medium'     => json_encode($request->resistance_test_medium),
            'resistance_test_large'      => json_encode($request->resistance_test_large)
        );
        $getFishArrival->update($updateOrganolepticResistance);
            Session::flash('success', 'Updated FishArrival & Parasite Successfully!');
            return redirect('lot/createMaterial')->with($getFishArrival);
        }
        else{
            Session::flash('error', 'FishArrival & Parasite not updated!');
            return view('lot/createMaterial')->with($getFishArrival);
        }
    }
    /**
     *  Update Lot Info Records
     */
    public function updateLotInfo(Request $request, $row_id){

        $validator = validator::make($request->all(), [
        'lot_number'=> 'required|string|max:255',
        'production_date'=> 'required|date_format:Y-m-d',
        'producer_id'=> 'required|numeric|min:1|max:9999999',
        'plant_location'=> 'required|string',
        'product'=> 'required|numeric|min:1|max:9999999',
        'type'=> 'required|numeric|min:1|max:9999999',
        'size'=> 'required|numeric',
        'quality'=> 'required|numeric|min:1|max:9999999',
        'unit_id'=> 'required|numeric|min:1|max:9999999',
        'weight'=> 'required|numeric',
        'number_of_unit'=> 'required|numeric',
        'total_quantity'=> 'required|numeric',
        'lot_comment'  => 'required'
        ]);
        $recordUpdated = LotInfo::find($row_id);
        if(!empty($recordUpdated)){
            if(($recordUpdated->lot_number==$request->lot_number) && ($recordUpdated->production_date==$request->production_date)){
               // $recordUpdated->update($request->all());  
                return response()->json($request->all(), 200);
            }
            else{
                Session::flash('error','Lot Number Not Found!');
                return redirect('lot/createMaterial');
            }
        }
        else{
            Session::flash('error','Lot Number And Production date does not match!');
            return redirect('lot/createMaterial');
        }
        $updateLotInfo = array(
            
            'lot_number'     => $request->lot_number,
            'production_date'=> $request->production_date,
            'producer_id'   => $request->producer_id,
            'plant_location'=> $request->plant_location,
            'product'       => $request->product,
            'type'          => $request->type,
            'size'          => $request->size,
            'quality'       => $request->quality,
            'unit_id'       => $request->unit_id,
            'weight'        => $request->weight,
            'number_of_unit'=> $request->number_of_unit,
            'total_quantity'=> $request->total_quantity,
            'lot_comment'   => $request->lot_comment
        ); 
        $updateRecord = LotInfo::where('id',$row_id)->update($updateLotInfo);
        Session::flash('error', 'Lot Info Updated Successfully!');
        return redirect('lot/createMaterial');
    }
 /**
  * Create Lan Analysis
  */
    public function createLabAnalysis(Request $request){
         
        $validate = $request->validate([

            'histamine_reception'=> 'required|string|max:255',
            'hista_after_freezing'=> 'required|string|max:255',
            'comment'=> 'required|string|max:255', 
            'fat_content_measure'=> 'required|string|max:255',
            'fat_content_comment'=> 'required|string|max:255',
            //'addition_fields'=> 'required|string|max:255'
        ]);
       
        $LotInfoDetail = LotInfo::select('lot_number','production_date')->find($request->row_id);
        
        if(!empty($LotInfoDetail->lot_number) && !empty($LotInfoDetail->production_date)){
            echo 'Lot NumberAnd Production Date does not match!';
        }
        else{
        $createHistamine = array(
            'lot_number'=> $LotInfoDetail['lot_number'],
            'production_date'=> $LotInfoDetail['production_date'],
            'histamine_reception'=> $request->histamine_reception,
            'hista_after_freezing'=> $request->hista_after_freezing,
            'comment'=> $request->comment,
            'fat_content_measure'=> $request->fat_content_measure,
            'fat_content_comment'=> $request->fat_content_comment,
            'addition_fields'=> $LotInfoDetail
        );
            $createHistamine = Histamine::create($createHistamine);
            Session::flash('success', 'Histamine created Successfully!');
            $data['tab'] = 'tab_6';
            return redirect('lot/index')->with($data);
        }
    } 
    /**
     *  Create Readings Cold Chain Storage
     */
    public function createColdChainStorage(Request $request){
     
        $validate = $request->validate([

            'reading_date'=> 'required|date_format:Y-m-d',
            'cold_room_number'=> 'required|string|max:255',
            'fish_temp'=> 'required|numeric|min:1|max:9999999', 
            'cold_room_temp'=> 'required|numeric|min:1|max:9999999',
            'comment'=> 'required|string|max:255',
            'cold_temp_image'=> 'required',
            'cold_temp_images'=> 'required'
        ]);
        $getLotData = LotInfo::select('lot_number','production_date')->find($request->row_id);
        if(!empty($getLotData->lot_number) && !empty($getLotData->production_date)){
            echo 'Lot NumberAnd Production Date does not match!';
        }
        else{
            $createColdchain = array(
                'lot_number'=> $getLotData['lot_number'], 
                'production_date'=>$getLotData['production_date'], 
                'reading_date'=> $request->reading_date,
                'cold_room_number'=>$request->cold_room_number, 
                'fish_temp'=>$request->fish_temp, 
                'cold_room_temp'=>$request->cold_room_temp, 
                'comment'=>$request->comment, 
                'cold_temp_image'=>$request->cold_temp_image, 
                'cold_temp_images'=>$request->cold_temp_images
            );
            $createStorage = OnlineQcColdStorage::create($createColdchain); 
            Session::flash('success', 'Cold Chain Storage created Successfully!');
            $data['tab'] = 'tab_8';
            return redirect('lot/index')->with($data);
        }
    }

    
    public function addParasiteData(Request $request){

        if(!empty($request->all())){
        $validate = $request->validate([
            'parasite_name'  => 'required',
            'parasite_image' => 'required',
            'description' => 'required'
        ]);
        $createprasite  = array(
            'parasite_name'  =>$request->parasite_name,
            'parasite_image' => $request->parasite_image,
            'description' => $request->description
        );
        $create_parasite = MasterParasite::create($createprasite);
        Session::flash('success','Parasite Craeted SuccessFully!');
        $data['tab'] = 'tab_6';
        //return redirect('lot/createMaterial')->with($data);
       }
        else{
            Session::flash('success','Not Created Parasite!');
           // return redirect('lot/createMaterial');
        }
    }
    


}
