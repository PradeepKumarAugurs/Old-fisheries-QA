<?php

namespace Modules\OnlineQcControl\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OnlineQcControl\Entities\Api\OnlineQcControlSummary;
use Modules\OnlineQcControl\Entities\Api\OnlineQcControl;
use Modules\OnlineQcControl\Entities\Api\Histamine;
use Modules\OnlineQcControl\Entities\Api\OnlineQcTunnel;
use Modules\OnlineQcControl\Entities\Api\OnlineQcFreezingOperation;
use Modules\OnlineQcControl\Entities\Api\OnlineQcFrequencyTempReading;
use Modules\Lot\Entities\Api\LotInfo;
use Modules\OnlineQcControl\Entities\Api\OnlineQcColdStorage;
use Modules\OnlineQcControl\Entities\Api\OnlineQcThowingBlock;
use Modules\OnlineQcControl\Entities\Api\OnlineQcParasiteInspection;
use Modules\OnlineQcControl\Entities\Api\OnlineQcBlockDiscrepancy;
use Illuminate\Validation\Rule;
use Validator;

class OnlineQcControlController extends Controller    
{
/**
 *  create Online Qc Summary List
 */

    public function createQcSummaryList(Request $request){

        $validator = validator::make($request->all(), [

        'lot_number'            => 'required|string|max:255',
        'production_date'       => 'required|date_format:Y-m-d',
        'total_invoiced_weight' => 'required|numeric|min:1|max:9999',
        'total_net_weight'      => 'required|numeric|min:1|max:9999',
        'total_temp'            => 'required|numeric|min:1|max:9999',
        'total_soft'            => 'required|numeric|min:1|max:9999',
        'total_tail'            => 'required|numeric|min:1|max:9999',
        'guts_pcs'              => 'required|numeric|min:1|max:9999',
        'guts_weight_grm'       => 'required|numeric|min:1|max:9999',
        'total_pieces'          => 'required|numeric|min:1|max:9999',
        'total_broken_belly'    => 'required|numeric|min:1|max:9999',
        'hd'                    => 'required',
        'ld'                    => 'required',
        'sbb'                   => 'required',
        'bb'                    => 'required',
        'os'                    => 'required',
        'inspected_by'          => 'required|numeric',
        'verified_by'           => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $createsummary = OnlineQcControlSummary::create($request->all());
        if(!empty($createsummary)){
            return response()->json($request->all(), 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!'], 401);
        }
    }
    
    /**
     *  Create & Update Control Lot
     */
    public function createUpdateQcControl(Request $request){
        
        $validator = validator::make($request->all(), [
        
            'lot_number'      => 'required|string|max:255',
            'production_date' => 'required|date_format:Y-m-d',
            'lotControl'      => 'required|array',
        ]);
        if($validator->fails()){    
            return response()->json(['error' => $validator->errors()], 401);
        }
        $validator2 = validator::make($request->all(), [

            'lotControl.*.production_line' => 'required|numeric|min:1|max:99999',
            'lotControl.*.standard_weight' => 'required|numeric|min:1|max:99999',
            'lotControl.*.balance_reading' => 'required|numeric|min:1|max:99999',
            'lotControl.*.balance_accuracy'=> 'required|numeric|min:1|max:99999',
            'lotControl.*.control_name'    => 'required|string|max:255',
            'lotControl.*.control_time'    => 'required|date_format:h:i a',
            'lotControl.*.fish_temp'       => 'required|numeric|min:1|max:99999',
            'lotControl.*.invoice_weight'  => 'required|numeric|min:1|max:99999',
            'lotControl.*.net_weight'      => 'required|numeric|min:1|max:99999',
            'lotControl.*.total_speces'    => 'required|numeric|min:1|max:99999',
            'lotControl.*.control_image'   => 'required|numeric|min:1|max:99999',
            'lotControl.*.control_images'  => 'required|numeric|min:1|max:99999',
            'lotControl.*.image'           => 'required|numeric|min:1|max:99999'
        ]);
        if(!empty($validator2->fails())){
            return response()->json(['error'=>$validator2->errors()], 401);
        }
        
        $update = array(
            'lot_number'      => $request->lot_number,
            'production_date' => $request->production_date
        );
        if(count($request->lotControl)){
            foreach($request->lotControl as $lotControl){
                $lotControl['lot_number']      = $request->lot_number;
                $lotControl['production_date'] = $request->production_date;
                $createControl = OnlineQcControl::updateOrCreate(['id'=>isset($lotControl['id'])?$lotControl['id']:null],$lotControl);
            }
            //$updatedata = LotInfo::where('id',$request->row_id)->update($update);
            return response()->json($request->all(), 200);
        }
        else{
                return response()->json(['error'=>'Lot number does not Exit!'], 401);
            }
    }
    /**
     *  Get All Data Qc Summary List
     */
    public function getAllSummaryList(Request $request, $user_id){
        
        $getUserId = LotInfo::find($user_id);
        if(!empty($getUserId)){

            $getAllControl = OnlineQcControlSummary::where('id',$user_id)->get();
            return response()->json($getAllControl, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!'], 401);
        }
    }
    /**
     * Get All Data Control Lot
     */
    public function getAllLotControl(Request $request,$row_id){
        
        $getLotInfo = LotInfo::find($row_id);
        if(!empty($getLotInfo)){
            $getAllControl = LotInfo::select('id','lot_number','production_date')->where('id',$row_id)->with('controls')->get();
            return response()->json($getAllControl, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!'], 401);
        }
    } 
    /**
     * Create And Update Histamine 
     */
    public function createUpdateHistamine(Request $request){
    
        $validator = validator::make($request->all(), [

            'lot_number'      => 'required|string|max:255',
            'production_date' => 'required|date_format:Y-m-d',
            'histamine'       => 'required|array'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $validator2 = validator::make($request->all(), [

            'histamine.*.histamine_reception'  => 'required|numeric|min:1|max:99999',
            'histamine.*.hista_after_freezing' => 'required|numeric|min:1|max:99999',
            'histamine.*.comment'              => 'required|string|max:255',
            'histamine.*.fat_content_measure'  => 'required',
            'histamine.*.fat_content_comment'  => 'required',
            'histamine.*.addition_fields'      => 'required'
        ]);
        if(!empty($validator2->fails())){
            return response()->json(['success'=>$validator2->errors()], 200);
        }
        $update = array(
                
            'lot_number'      => $request->lot_number,
            'production_date' => $request->production_date
        );
        if(count($request->histamine)){
            foreach($request->histamine as $histamine){
                $histamine['lot_number']       = $request->lot_number;
                $histamine['production_date']  = $request->production_date;
                Histamine::updateOrCreate(['id'=>isset($histamine['id'])?$histamine['id']:null],$histamine);
            }
           // $updateHistamine = LotInfo::where('id',$request->user_id)->update($update);
            return response()->json($request->all(), 200);
        }
        else{
                return response()->json(['error'=>'Lot number not found!'], 401);
        }
    }
    /**
    *  Get All Data Histamine
    */
    public function getAllHistamine(Request $request, $row_id){

        $getLotInfo = LotInfo::find($row_id);
        if(!empty($getLotInfo)){
            
            $getHistamine = LotInfo::select('id','lot_number','production_date')->where('id',$row_id)->with('histamines')->first();
            return response()->json($getHistamine, 200);
        }
        else{
            return response()->json(['error'=>'Lot Number not found!'], 401);
        }
    }

    /**
    *   Create & Update Freezing Operation
    */
    public function updateFreezingOperation(Request $request, $row_id){
        $getLotInfo = LotInfo::find($row_id);
        if(!empty($getLotInfo)){
            $validator = validator::make($request->all(), [
                'lot_number'          => 'required|string|max:255',
                'production_date'     => 'required|date_format:Y-m-d',
                'freezing_technique'  => 'required|numeric|min:1|max:99999',
                'technology'          => 'string|max:255',
                'freezing_time'       => 'date_format:h:i a',
                'quantity_hour'       => 'date_format:h:i a',
                'comment'             => 'string|max:255',
                'tunnel'              => 'array',
                'frequencyReadings'   => 'array'
            ]);
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()], 401);
            }
            if(($getLotInfo->lot_number != $request->lot_number) && ($getLotInfo->production_date != $request->production_date)){
                return rsponse()->json(['error'=>'Lot Number And Production Date Does Not Exist!'], 401);
            }
            $updateFreezingOperation = array(
                'lot_number'          => $request->lot_number,
                'production_date'     => $request->production_date,
                'freezing_technique'  => $request->freezing_technique,
                'technology'          => $request->technology,
                'freezing_time'       => $request->freezing_time,
                'quantity_hour'       => $request->quantity_hour,
                'comment'             => $request->comment
            );
            $updateFreezingOperation=OnlineQcFreezingOperation::updateOrCreate(['id'=>isset($request->id)?$request->id:null], $updateFreezingOperation);
            if(isset($request->id) && $request->id!=""){
                $freezing_id=$request->id;
            }
            else{
                $freezing_id=$updateFreezingOperation->id;
            }
            if($request->freezing_technique == 1){
                if(isset($request->tunnel) && count($request->tunnel)){
                $validator2 = validator::make($request->all(), [
                    'tunnel.*.start_time'      => 'required|date_format:h:i a',
                    'tunnel.*.stop_time'       => 'required|date_format:h:i a',
                    'tunnel.*.freezing_time'   => 'required|date_format:h:i a',
                    'tunnel.*.total_load'      => 'required|string|max:255',
                    'tunnel.*.temp_max'        => 'required|numeric|min:1|max:99999',
                    'tunnel.*.comment'         => 'required|string|max:255',
                    'tunnel.*.image'           => 'required|numeric|min:1|max:99999'
                ]);
                if(!empty($validator2->fails())){
                    return response()->json(['error'=>$validator2->errors()], 401);
                }
                    foreach($request->tunnel as $tannel){
                        $tannel['lot_number']      = $request->lot_number;
                        $tannel['production_date'] = $request->production_date;
                        $tannel['freezing_id']     = $freezing_id;
                        OnlineQcTunnel::updateOrCreate(['id'=>isset($tannel['id'])?$tannel['id']:null], $tannel);
                    }
                }
            }
            if($request->freezing_technique == 2){
                if(isset($request->frequencyReadings) && count($request->frequencyReadings)){
                    $validator3 = validator::make($request->all(), [
                        'frequencyReadings.*.reading'      => 'required|string|max:255',
                        'frequencyReadings.*.reading_time' => 'required|date_format:h:i a',
                        'frequencyReadings.*.reading_temp' => 'required|numeric|min:1|max:999999',
                        'frequencyReadings.*.comment'      => 'required|string|max:255',
                        'frequencyReadings.*.image'        => 'required|numeric|min:1|max:999999'
                    ]);
                    if(!empty($validator3->fails())){
                        return response()->json(['error'=>$validator3->errors()], 401);
                    }
                    foreach($request->frequencyReadings as $frequencyReadings){
                        $frequencyReadings['lot_number']      = $request->lot_number;
                        $frequencyReadings['production_date'] = $request->production_date;
                        $frequencyReadings['freezing_id']     = $freezing_id;
                        OnlineQcFrequencyTempReading::updateOrCreate(['id'=>isset($frequencyReadings['id'])?$frequencyReadings['id']:null], $frequencyReadings);
                    }
                }
            }
            return response()->json($request->all(), 200);
        }
        else{
            return response()->json(['error'=>'Lot Number not found!'], 401);
        }
    }
/**
 *  Get Data freezing Operation
 */
public function getAllFreezingOperation(Request $request, $row_id){
        $getLotInfoId = LotInfo::find($row_id);
        if(!empty($getLotInfoId)){
            $getfreezingOperation = LotInfo::select('id','lot_number','production_date')->where('id',$row_id)->with('freezingOperations')
            ->with('tunnels')->with('frequencyTempReadings')->first();
            return response()->json($getfreezingOperation, 200);
        }
        else{
            return response()->json(['error'=>'Lot Number Not Found!'], 401);
        }
}
/**
 *  Create & Update Cold Chain Storage 
 */
public function updateCreateColdStorage(Request $request,$row_id){
    
    $getLotInfoId = LotInfo::find($row_id);
    if(!empty($getLotInfoId)){
    $validator = validator::make($request->all(), [
        
        'lot_number'         => 'required|string',
        'production_date'    => 'required|date_format:Y-m-d',
        'coldStorage'        => 'required|array'
    ]);
    if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
    }
    $validator2 = validator::make($request->all(), [

        'coldStorage.*.reading_date'       => 'required|date_format:Y-m-d',
        'coldStorage.*.cold_room_number'   => 'required|numeric|min:1|max:999999',
        'coldStorage.*.fish_temp'          => 'required|numeric|min:1|max:999999',
        'coldStorage.*.cold_room_temp'     => 'required|numeric|min:1|max:999999',
        'coldStorage.*.comment'            => 'required|string|max:255',
        'coldStorage.*.cold_temp_image'    => 'required|numeric|min:1|max:999999',
        'coldStorage.*.cold_temp_images'   => 'required|numeric|min:1|max:999999'
    ]);
    if(!empty($validator2->fails())){
        return response()->json(['error'=>$validator2->errors()], 401);
    }
    $update = array(

        'reading_date'     => $request->reading_date,
        'cold_room_number' => $request->cold_room_number,
        'fish_temp'        => $request->fish_temp,
        'cold_room_temp'   => $request->cold_room_temp,
        'comment'          => $request->comment,
        'cold_temp_image'  => $request->cold_temp_image,
        'cold_temp_images' => $request->cold_temp_images,
    );
    if(($getLotInfoId->lot_number != $request->lot_number) || ($getLotInfoId->production_date != $request->production_date)){
        return response()->json(['error'=>'Lot number And Production date does not exits!'], 401);
    }
    if(count($request->coldStorage)){
        foreach($request->coldStorage as $coldStorage){
                $coldStorage['lot_number']       = $request->lot_number;
                $coldStorage['production_date']  = $request->production_date;
                OnlineQcColdStorage::updateOrCreate(['id'=>isset($coldStorage['id'])?$coldStorage['id']:null],$coldStorage);
        }
    }
        return response()->json($request->all(), 200);
    } 
    else{
        return response()->json(['error'=>'Lot number not found!'], 401);
    }
}
/**
 * Get All Cold Chain Storage
 */
public function getAllClodStorage(Request $request,$row_id){
    
    $getLotInfoId = LotInfo::find($row_id); 
    if(!empty($getLotInfoId)){
        
        $getColdStorage = LotInfo::select('id','lot_number','production_date')->where('id',$row_id)->with('coldStorages')->first();
        return response()->json($getColdStorage, 200);
    }
    else{
        return response()->json(['error'=>'Lot Number Not Found!']);
    }
}
/**
 * Create & Update Thowing Block Inspection
 */
public function updateThawingBlockInspection(Request $request,$row_id){
    
    $getLotInfo = LotInfo::find($row_id);
    if(!empty($getLotInfo)){
        
        $validator = validator::make($request->all(), [
        
            'lot_number'                => 'required|string|max:255',
            'production_date'           => 'required|date_format:Y-m-d',
            'invoiced_weight'           => 'required|numeric|min:1|max:999999',
            'frozen_weight'             => 'required|numeric|min:1|max:999999',
            'total_pieces'              => 'required|numeric|min:1|max:999999',
            'good_fish_image'           => 'required|numeric|min:1|max:999999',
            'discrepancies_image'       => 'required|numeric|min:1|max:999999',
            'total_descepancies_weight' => 'required|numeric|min:1|max:999999',
            'net_thowing_weight'        => 'required|numeric|min:1|max:999999',
            'comment'                   => 'required|string|max:255',
            'thowing_image'             => 'required|numeric|min:1|max:999999',
            'prevalance'                => 'required|numeric|min:1|max:999999',
            'intencesity'               => 'required|numeric|min:1|max:999999',
            'guts'                      => 'required|numeric|min:1|max:999999',
            'anus'                      => 'required|numeric|min:1|max:999999',
            'other'                     => 'required|numeric|min:1|max:999999',
            'signature_image'           => 'required|numeric|min:1|max:999999',
            'blockDiscrepancies'        => 'required|array',
            'parasiteInspection'        => 'required|array'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        if(($getLotInfo->lot_number != $request->lot_number) && ($getLotInfo->production_date != $request->production_date)){
            return response()->json(['error'=>'Lot number and Production date does not Exits!']);
        }
        $updateThawing = array(
            'lot_number'                => $request->lot_number,
            'production_date'           => $request->production_date,
            'invoiced_weight'           => $request->invoiced_weight,
            'frozen_weight'             => $request->frozen_weight,
            'total_pieces'              => $request->total_pieces,
            'good_fish_image'           => $request->good_fish_image,
            'discrepancies_image'       => $request->discrepancies_image,
            'total_descepancies_weight' => $request->total_descepancies_weight,
            'net_thowing_weight'        => $request->net_thowing_weight,
            'comment'                   => $request->comment,
            'thowing_image'             => $request->thowing_image,
            'prevalance'                => $request->prevalance,
            'intencesity'               => $request->intencesity,
            'guts'                      => $request->guts,
            'anus'                      => $request->anus,
            'other'                     => $request->other,
            'signature_image'           => $request->signature_image
        );
            OnlineQcThowingBlock::updateOrCreate(['id' =>isset($request->id)?$request->id:null],$updateThawing);
        $validator2 = validator::make($request->all(), [
            
            'blockDiscrepancies.*.user_id'                =>  'required|numeric|min:1|max:999999',
            'blockDiscrepancies.*.block_id'               =>  'required|numeric|min:1|max:999999',
            'blockDiscrepancies.*.user_discr_id'          =>  'required|numeric|min:1|max:999999',
            'blockDiscrepancies.*.discrepancy_id'         =>  'required|numeric|min:1|max:999999',
            'blockDiscrepancies.*.rejection_offset_value' =>  'required|string|max:255',
            'blockDiscrepancies.*.border_offset_value'    =>  'required|string|max:255',
            'blockDiscrepancies.*.discrepancies_weight'   =>  'required|numeric|min:1|max:999999'
        ]);
        if(!empty($validator2->fails())){
            return response()->json(['error'=>$validator2->errors()], 401);
        }
        if(count($request->blockDiscrepancies)){
            foreach($request->blockDiscrepancies as $blockDiscrepancies){
                $blockDiscrepancies['lot_number']      = $request->lot_number;
                $blockDiscrepancies['production_date'] = $request->production_date; 
                OnlineQcBlockDiscrepancy::updateOrCreate(['id'=>isset($blockDiscrepancies['id'])?$blockDiscrepancies['id']:null],$blockDiscrepancies);
            }
        }
        $validator3 = validator::make($request->all(), [ 
            'parasiteInspection.*.block_id'           => 'required|numeric|min:1|max:999999',
            'parasiteInspection.*.sample'             => 'required|numeric|min:1|max:999999',
            'parasiteInspection.*.counting_parasites' => 'required|numeric|min:1|max:999999',
            'parasiteInspection.*.image'              => 'required|numeric|min:1|max:999999'
        ]);
        if(!empty($validator3->fails())){
            return response()->json(['error'=>$validator3->errors()], 401);
        }
        if(count($request->parasiteInspection)){
            foreach($request->parasiteInspection as $parasiteInspection){
                $parasiteInspection['lot_number']      = $request->lot_number;
                $parasiteInspection['production_date'] = $request->production_date; 
                OnlineQcParasiteInspection::updateOrCreate(['id'=>isset($parasiteInspection['id'])?$parasiteInspection['id']:null],$parasiteInspection);
            }
        }
            return response()->json($request->all(),200);
    }
    else{
            return response()->json(['error'=>'Lot Number not Found!']);
    }
}
/**
 * Get All Thawing Block Inspections
 */
    public function getThawingBlock(Request $request, $row_id){
        
        $getLotInfoId = LotInfo::find($row_id); 
        if(!empty($getLotInfoId)){
            
            $getThawingBlock = LotInfo::select('id','lot_number','production_date')->where('id',$row_id)->with('thawignBlocks')
            ->with('getGoodFishImages','getDiscrepanciesImages','getThowingImages','getSignatureImages')
            ->with('blockDiscrepancies')->with('parasiteInspections','getParasiteImages')->first(); 
            return response()->json($getThawingBlock, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!'], 401);
        }
    }
    

}
