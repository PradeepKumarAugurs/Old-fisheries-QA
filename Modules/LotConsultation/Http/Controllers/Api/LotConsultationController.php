<?php

namespace Modules\LotConsultation\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lot\Entities\Api\LotInfo;
use Modules\LotConsultation\Entities\Api\LotComment;
use Illuminate\Validation\Rule;
use Validator;  

class LotConsultationController extends Controller
{
    /**
     *  Create & Update Lot Comments
     */
    public function comments(Request $request, $row_id){
        
        $getLotInfoId = LotInfo::find($row_id);
        if(!empty($getLotInfoId)){
        
            $validator = validator::make($request->all(), [
            
            'lot_number'      => 'required|string|max:255',
            'production_date' => 'required|date_format:Y-m-d',
            'lot_comments'    => 'required|string|max:255'
            
            ]);
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $update = array(
                
                'lot_comments' => $request->lot_comments
            );
            if(!empty($getLotInfoId['lot_number'] != $request->lot_number) && ($getLotInfoId['production_date'] != $request->production_date)){
                return response()->json(['error'=>'Lot number and Production date not matched!']);
            }
            
            if($getLotInfoId['lot_number'] != $request->lot_number){
                
                LotInfo::create($request->all());
            }
                LotInfo::where('id',$row_id)->update($update);
                return response()->json($request->all(), 200);
        }
        else{
                return response()->json(['error'=>'Lot number not found!']);
        }
        
    }


    /**
     *  Get All LotInfo Records
     */
    public function getAllLotRecords(Request $request){
        
        $getLotRecords = LotInfo::select('id','lot_number','production_date','producer_id')->get();
        if(!empty($getLotRecords)){
            
            return response()->json($getLotRecords, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!']);
        }
    }
    
}
