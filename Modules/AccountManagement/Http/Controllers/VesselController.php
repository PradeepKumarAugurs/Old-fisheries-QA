<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AccountManagement\Entities\Vessel;
use Validator;
use Session;

class VesselController extends Controller
{
    /**
     * Create Vessels
     */
    public function createVessel(Request $request){
    
        $validation = validator::make($request->all(), [
        
            'vessel_name'                         => 'required|unique:vessels',
            'vessel_registration'                 => 'required|unique:vessels',
            'unique_indentification'              => 'required|unique:vessels',
            'public_registry_hyperlink'           => 'required',
            'vessel_flag'                         => 'required',
            'availlability_catch_coordinates'     => 'required',
            'satellite_tracking_authority'        => 'required',
            'transshipment_vessel_name'           => 'required',
            'transshipment_unique_identification' => 'required',
            'transshipment_vessel_flag'           => 'required',
            'transshipment_vessel_registration'   => 'required',
            'fishery_improvement_project'         => 'required',
            'fishing_authorization'               => 'required',
            'hervest_certification'               => 'required',
            'hervest_certification_chain_custody' => 'required',
            'transshipment_authorization'         => 'required',
            'landing_authorization'               => 'required',
            'human_welfare_policy_standards'      => 'required',
            'existence_human_wefare_policy'       => 'required',
            'fishing_gear'                        => 'required',
            'fish_transfer'                       => 'required',
            'nominal_capacity'                    => 'required',
            'hatches'                             => 'required',
            'rsw'                                 => 'required',
            'hp_rsw'                              => 'required',
            'ice_trip'                            => 'required'
        ]);
        if($validation->fails()){
            return response()->json(['error'=>$validation->errors()], 401);
        }
        $createVessel = array(
        
            'vessel_name'                         =>  $request->vessel_name,
            'vessel_registration'                 =>  $request->vessel_registration,
            'unique_indentification'              =>  $request->unique_indentification,
            'public_registry_hyperlink'           =>  $request->public_registry_hyperlink,
            'vessel_flag'                         =>  $request->vessel_flag,
            'availlability_catch_coordinates'     =>  $request->availlability_catch_coordinates,
            'satellite_tracking_authority'        =>  $request->satellite_tracking_authority,
            'transshipment_vessel_name'           =>  $request->transshipment_vessel_name,
            'transshipment_unique_identification' =>  $request->transshipment_unique_identification,
            'transshipment_vessel_flag'           =>  $request->transshipment_vessel_flag,
            'transshipment_vessel_registration'   =>  $request->transshipment_vessel_registration,
            'fishery_improvement_project'         =>  $request->fishery_improvement_project,
            'fishing_authorization'               =>  $request->fishing_authorization,
            'hervest_certification'               =>  $request->hervest_certification,
            'hervest_certification_chain_custody' =>  $request->hervest_certification_chain_custody,
            'transshipment_authorization'         =>  $request->transshipment_authorization,
            'landing_authorization'               =>  $request->landing_authorization,
            'human_welfare_policy_standards'      =>  $request->human_welfare_policy_standards,
            'existence_human_wefare_policy'       =>  $request->existence_human_wefare_policy,
            'fishing_gear'                        =>  $request->fishing_gear,
            'fish_transfer'                       =>  $request->fish_transfer,
            'nominal_capacity'                    =>  $request->nominal_capacity,
            'hatches'                             =>  $request->hatches,
            'rsw'                                 =>  $request->rsw,
            'hp_rsw'                              =>  $request->hp_rsw,
            'ice_trip'                            =>  $request->ice_trip
        );
            $createVesselRecord = Vessel::create($createVessel);
            return response()->json($request->all(), 200);
        }
        
        /**
     * Update Vessels
     */
    public function updateVessel(Request $request, $row_id ){
    
        $getId = Vessel::find($row_id);
        if(!empty($getId)){
        $validation = validator::make($request->all(), [
        
            'vessel_name'                         => 'required',
            'vessel_registration'                 => 'required',
            'unique_indentification'              => 'required',
            'public_registry_hyperlink'           => 'required',
            'vessel_flag'                         => 'required',
            'availlability_catch_coordinates'     => 'required',
            'satellite_tracking_authority'        => 'required',
            'transshipment_vessel_name'           => 'required',
            'transshipment_unique_identification' => 'required',
            'transshipment_vessel_flag'           => 'required',
            'transshipment_vessel_registration'   => 'required',
            'fishery_improvement_project'         => 'required',
            'fishing_authorization'               => 'required',
            'hervest_certification'               => 'required',
            'hervest_certification_chain_custody' => 'required',
            'transshipment_authorization'         => 'required',
            'landing_authorization'               => 'required',
            'human_welfare_policy_standards'      => 'required',
            'existence_human_wefare_policy'       => 'required',
            'fishing_gear'                        => 'required',
            'fish_transfer'                       => 'required',
            'nominal_capacity'                    => 'required',
            'hatches'                             => 'required',
            'rsw'                                 => 'required',
            'hp_rsw'                              => 'required',
            'ice_trip'                            => 'required'
        ]);
        if($validation->fails()){
            return response()->json(['error'=>$validation->errors()], 401);
        }
        $updateVessel = array(
        
            'vessel_name'                         =>  $request->vessel_name,
            'vessel_registration'                 =>  $request->vessel_registration,
            'unique_indentification'              =>  $request->unique_indentification,
            'public_registry_hyperlink'           =>  $request->public_registry_hyperlink,
            'vessel_flag'                         =>  $request->vessel_flag,
            'availlability_catch_coordinates'     =>  $request->availlability_catch_coordinates,
            'satellite_tracking_authority'        =>  $request->satellite_tracking_authority,
            'transshipment_vessel_name'           =>  $request->transshipment_vessel_name,
            'transshipment_unique_identification' =>  $request->transshipment_unique_identification,
            'transshipment_vessel_flag'           =>  $request->transshipment_vessel_flag,
            'transshipment_vessel_registration'   =>  $request->transshipment_vessel_registration,
            'fishery_improvement_project'         =>  $request->fishery_improvement_project,
            'fishing_authorization'               =>  $request->fishing_authorization,
            'hervest_certification'               =>  $request->hervest_certification,
            'hervest_certification_chain_custody' =>  $request->hervest_certification_chain_custody,
            'transshipment_authorization'         =>  $request->transshipment_authorization,
            'landing_authorization'               =>  $request->landing_authorization,
            'human_welfare_policy_standards'      =>  $request->human_welfare_policy_standards,
            'existence_human_wefare_policy'       =>  $request->existence_human_wefare_policy,
            'fishing_gear'                        =>  $request->fishing_gear,
            'fish_transfer'                       =>  $request->fish_transfer,
            'nominal_capacity'                    =>  $request->nominal_capacity,
            'hatches'                             =>  $request->hatches,
            'rsw'                                 =>  $request->rsw,
            'hp_rsw'                              =>  $request->hp_rsw,
            'ice_trip'                            =>  $request->ice_trip
        );
        $getIdVessel = Vessel::where('id',$row_id)->first();
        if(empty($getIdVessel)){
            return response()->json(['error'=>"Vessel Id not found !."], 401);
        }

        $getUserData = Vessel::where('vessel_name',$request->vessel_name)->first();
        $getUser = Vessel::where('vessel_registration',$request->vessel_registration)->first();
        $getUnique = Vessel::where('unique_indentification',$request->unique_indentification)->first();
            if(!empty($getUserData) && $getIdVessel->vessel_name != $getUserData->vessel_name)
                {
                    return response()->json(['error'=>'This Vessel Name already exists'], 401);
                }
            if(!empty($getUser) && $getIdVessel->vessel_registration != $getUser->vessel_registration)
                {
                    return response()->json(['error'=>'This Vessel Registration already exists'], 401);
                }
            if(!empty($getUnique) && $getIdVessel->unique_indentification != $getUnique->unique_indentification)
                {
                    return response()->json(['error'=>'This Vessel Unique Indentification already exists'], 401);
                } 
            $updatedVesselRecord = Vessel::where('id',$row_id)->update($updateVessel);
            return response()->json($request->all(), 200);
    }
}
    
    /**
     * Get vessels
     */
    public function getAllvessels(Request $request, $user_id){
        
        $getId = Vessel::find($user_id);
        if(!empty($getId)){
            
            $getvessels = Vessel::where('id', $user_id)->first();
            return response()->json($getvessels, 200);
        }
        else{
            return response()->json(['error'=>'User Id Not Found!']);
        }
    }
    /**
     * Get All vessels
     */
        public function getVessels(Request $request){
        $getvessels = Vessel::select('id','vessel_name','vessel_flag','nominal_capacity')->get();
        return response()->json($getvessels, 200);
    }
   

    

}
