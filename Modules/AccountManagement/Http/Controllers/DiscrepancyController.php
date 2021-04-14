<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth; 
use Modules\AccountManagement\Entities\UserDiscrepancy;
use Modules\AccountManagement\Entities\MasterDiscrepancy;
use Validator;
class DiscrepancyController extends Controller
{
   
    public function  deleteUserDiscrepancy(Request $request){
        if($request->id){
             $user = Auth::user();
            if($user->role=='1'){ 
                $userDiscrepancy=UserDiscrepancy::destroy($request->id);
                if($userDiscrepancy){
                    return response()->json(['success' =>'user discrepancy deleted'], 200); 
                }
                else{
                    return response()->json(['error'=>"somthing went wrong , try  again"], 401); 
                }
            }
            else{
                return response()->json(['error'=>"you are not authorized to this action"], 401); 
            }

        }
        
    }

    public function  deleteMasterDiscrepancy(Request $request){
        if($request->id){
             $user = Auth::user();
            if($user->role=='1'){
                // $masterDiscrepancy=MasterDiscrepancy::destroy($request->id);
                $masterDiscrepancy=MasterDiscrepancy::find(1)->delete();
                if($masterDiscrepancy){
                    return response()->json(['success' =>'master discrepancy deleted'], 200); 
                }
                else{
                    return response()->json(['error'=>"somthing went wrong , try  again"], 401); 
                }
            }
            else{
                return response()->json(['error'=>"you are not authorized to this action"], 401); 
            }

        }
        
    }
  

    /* user discrepancy update */
    public function updateUserDiscrepancy(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'discrepancy_id' => 'required',
            'rejection_offset_value' => 'required',
            'border_offset_value' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $userDiscrepancy = UserDiscrepancy::find($id);
        $userDiscrepancy->update($request->all());
        return response()->json(['success' =>'Discrepancy updated successfully'], 200);
    }

    /* Master discrepancy update */
    public function updateMasterDiscrepancy(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            'discrepancies' => 'required',
            'discrepancy_key' => 'required',
            'rejection_value' => 'required',
            'border_value' => 'required',
            'unit' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $masterDiscrepancy = MasterDiscrepancy::find($id);
        $masterDiscrepancy->update($request->all());
        return response()->json(['success' =>'Discrepancy updated successfully'], 200);
    }



}
