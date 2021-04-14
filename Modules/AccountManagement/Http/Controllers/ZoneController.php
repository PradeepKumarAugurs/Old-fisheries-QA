<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth; 
use Modules\AccountManagement\Entities\ReferenceZone;
use Validator;
class ZoneController extends Controller
{
   
    public function  deletezone(Request $request){
        if($request->id){
             $user = Auth::user();
            if($user->role=='1'){
                $referenceZone=ReferenceZone::destroy($request->id);
                if($referenceZone){
                    return response()->json(['success' =>'zone deleted'], 200); 
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
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'reference_country_id' => 'required',
            'title' => 'required',
            'zonekey' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $ReferenceZone = ReferenceZone::find($id);
        $ReferenceZone->update($request->all());
        return response()->json(['success' =>'zone updated successfully'], 200); 
    }

   
}
