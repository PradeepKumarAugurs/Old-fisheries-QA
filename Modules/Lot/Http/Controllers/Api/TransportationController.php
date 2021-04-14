<?php

namespace Modules\Lot\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Lot\Entities\Api\Voyage;
use Modules\Lot\Entities\Api\FishArrival;
use Modules\Lot\Entities\Api\FishingHatch;
use Validator;

class TransportationController extends Controller
{
    
/**
 *   Update & Create Transportation Api
 */
public function updateTransportationInfo(Request $request, $row_id){

    $getFishArrival = FishArrival::find($row_id);
    if(!empty($getFishArrival)){
        $validator = Validator::make($request->all(), [
        'number_of_voyages' => 'required|numeric',
        'originTransportation' => 'required|array',
        'originTransportation.*.truck_id' => 'required|string',
        'originTransportation.*.hatch_id' => 'required|string',
        'originTransportation.*.port_departure_time' => 'required|date_format:h:i a',
        'originTransportation.*.plant_arrival_time' => 'required|date_format:h:i a',    
        'originTransportation.*.transportation_time' => 'required|date_format:h:i a', 
        'originTransportation.*.added_ice' => 'required|string',
        'originTransportation.*.add_water' => 'required|string',
        'originTransportation.*.type_of_recipient' => 'required|string',
        'originTransportation.*.weight_bundle' => 'required|string',
        'originTransportation.*.net_weight' => 'required|numeric',
        'originTransportation.*.gross_weight' => 'required|numeric',
        'originTransportation.*.climate_controle' => 'required|numeric|min:0',
        'originTransportation.*.comment' => 'required|string',
        'originTransportation.*.truck_image' => 'required|numeric|min:1',
        'originTransportation.*.recipient_image' => 'required|numeric|min:1'
        ]);

        $update = array(
            'arrival_id'        => $getFishArrival->id,
            'number_of_voyages' => $request->number_of_voyages
        );
        $update['updated_by'] = request()->user()->id;

        if(count($request->originTransportation)){
            foreach($request->originTransportation as $originTransportation){
                $originTransportation['arrival_id'] = $getFishArrival->id;
                $originTransportation['created_by'] = request()->user()->id;
                $originTransportation['updated_by'] = request()->user()->id;
                Voyage::updateOrCreate(['id'=>isset($originTransportation['id'])?$originTransportation['id']:null],$originTransportation);
            }
        }
        $updateVoyageInfo = FishArrival::where('id',$row_id)->update($update);

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

/**
   * Get Transportation Info 
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



}
