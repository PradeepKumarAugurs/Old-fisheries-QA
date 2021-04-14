<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth; 
use Modules\AccountManagement\Entities\ReferenceSupplier;
use Validator;
class SupplierController extends Controller
{
    
    public function  deletesupplier(Request $request){
        if($request->id){
             $user = Auth::user();
            if($user->role=='1'){
                $referenceSupplier=ReferenceSupplier::destroy($request->id);
                if($referenceSupplier){
                    return response()->json(['success' =>'supplier deleted'], 200); 
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
            'supplier_id' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $ReferenceSupplier = ReferenceSupplier::find($id);
        $ReferenceSupplier->update($request->all());
        return response()->json(['success' =>'Supplier updated successfully'], 200);
    }

}
