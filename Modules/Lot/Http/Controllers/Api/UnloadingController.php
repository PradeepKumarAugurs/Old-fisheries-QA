<?php

namespace Modules\Lot\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lot\Entities\Api\LotInfo;
use Modules\Lot\Entities\Api\FishArrival;
use Modules\AccountManagement\Entities\Section;
use Modules\AccountManagement\Entities\CustomFields;
use Modules\AccountManagement\Entities\CustomRows;
use Modules\AccountManagement\Entities\CustomProducerData;

use Modules\Lot\Entities\Api\UnloadingHatch;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Storage;
use File;
use Modules\AccountManagement\Entities\UploadFile;

use Modules\Lot\Http\Controllers\Api\FishArrivalController;

class UnloadingController extends FishArrivalController
{
   /**
   * Create And Update  Unloading Info 
   */

   public function  updateUnloadingInfo(Request $request, $row_id){
      $getFishArrival = FishArrival::find($row_id);
      if(!empty($getFishArrival)){ 
      $validator = validator::make($request->all(), [
         'unloading_place'                               => 'required|string|max:255',
         'unloading_date'                                => 'required|date_format:Y-m-d',
         'added_ice'                                     => 'required|string|max:255',
         'unloading_comment'                             => 'required|string|max:255',
         'sections'                                      => 'required|array',
         'sections.*.name'                               => 'required|string',
         'sections.*.type'                               => 'required|numeric|min:1',
         'sections.*.custom_fields'                      => 'array',
         'sections.*.custom_fields.*.name'               => 'string',
         'sections.*.custom_fields.*.type'               => 'numeric|min:1',
         'sections.*.custom_fields.*.item_list'          => 'string',
         'sections.*.custom_rows'                        => 'array',
         'sections.*.custom_rows.*.customdata'           => 'array',
         'sections.*.custom_rows.*.customdata.*.value'   => 'string'
      ]);
      if($validator->fails()){
         return response()->json(['error'=>$validator->errors()], 401);
      } 
      
      $update = array(
         'unloading_place' => $request->unloading_place,
         'unloading_date' => $request->unloading_date,
         'added_ice' => $request->added_ice,
         'unloading_comment' => $request->unloading_comment
      );
      $update['updated_by'] = request()->user()->id;
      $fishArrivalId=$request->row_id;
      $updateFishArrival = FishArrival::where('id',$fishArrivalId)->update($update);
      if(isset($request->sections) && count($request->sections)){
         $this->createNewFieldsNewRowsSections($request->sections,$fishArrivalId);
      }
      $getFishArrival = FishArrival::select('unloading_place','unloading_date','added_ice','unloading_comment')->find($fishArrivalId); 
      if(!empty($getFishArrival)){
         $getFishArrival->sections=Section::
         with(['custom_fields'=>function($query) use ($fishArrivalId){
               $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$fishArrivalId]);
         }])
         ->with(['custom_rows'=>function($query) use ($fishArrivalId){
               $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$fishArrivalId])
               ->with('customdata');
         }])->where('type',3)->get();
      }
      return response()->json($getFishArrival, 200);
      
   }
   else{
      return response()->json(['error'=>'fishing arrival not found!'], 401);
   }
}

   /**
   * Get  Unloading Info 
   */

public function getUnloadingInfo(Request $request, $fishArrivalId){

      $getFishArrival = FishArrival::select('unloading_place','unloading_date','added_ice','unloading_comment')->find($fishArrivalId); 
      if(!empty($getFishArrival)){
            $getFishArrival->sections=Section::
            with(['custom_fields'=>function($query) use ($fishArrivalId){
                $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$fishArrivalId]);
            }])
            ->with(['custom_rows'=>function($query) use ($fishArrivalId){
                $query->select('*')->where(['producer_id'=>NULL,'arrival_id'=>$fishArrivalId])
                ->with('customdata');
            }])->where('type',3)->get();
        
         return response()->json($getFishArrival, 200);
      }
      else{
         return response()->json(['error'=>'fishing arrival not found!'] , 401);
      }
}



}
