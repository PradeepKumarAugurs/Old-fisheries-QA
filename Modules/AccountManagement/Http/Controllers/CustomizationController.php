<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\AccountManagement\Entities\ReferenceCountry;
use Modules\AccountManagement\Entities\UserSetting;
use Modules\AccountManagement\Entities\UserDiscrepancy;
use Modules\AccountManagement\Entities\MasterDiscrepancy;
use Modules\AccountManagement\Entities\RequestedItem;
use Modules\AccountManagement\Entities\CustomizationSetting;
use Modules\AccountManagement\Entities\Producer;
use Modules\AccountManagement\Entities\ColdChainStandard;
use Validator,DB,File;

class CustomizationController extends Controller
{
    public function  getCustomization(Request $request){
        $result = Producer::select('id','name')->find($request->producer_id); 
        if(!empty($result) ){
            $getRalationdata = Producer::with(['user_settings','requestedItems','customization_settings','getImage','coldChainStandard'])->find($request->producer_id); 
            $result->user_settings = $getRalationdata->user_settings;
            $result->requestedItems = $getRalationdata->requestedItems;
            $result->customization_settings = $getRalationdata->customization_settings;
            $discrepancies = DB::select("SELECT D.id,D.producer_id,M.id as discrepancy_id,M.discrepancies,M.discrepancy_key,
            (CASE WHEN D.is_checked  IS NULL THEN 0 ELSE D.is_checked END) as is_checked,
            (CASE WHEN D.rejection_value  IS NULL THEN M.rejection_value ELSE D.rejection_value END) as rejection_value,
            (CASE WHEN D.border_value IS NULL THEN M.border_value ELSE D.border_value END) as border_value
            ,M.unit,M.type,D.rejection_offset_value,D.border_offset_value, D.created_at,D.updated_at as new_id FROM `master_discrepancies` M left join (select * FROM user_discrepancies WHERE producer_id = $request->producer_id) D on M.id = D.discrepancy_id");
            $result->discrepancies = $discrepancies; 
            $result->coldChainStandard = $getRalationdata->coldChainStandard;
            $result->getImage = $getRalationdata->getImage;
            return response()->json($result, 200);
        }
        else{
            return response()->json(['error'=>"User not exist!"], 401); 
        }
    }

    /* Update the Cutomization*/
    public  function  updateCustomization(Request $request){
        $validator = Validator::make($request->all(), [
            'producer_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $producerId = $request->producer_id;
        if($request->producer_id !=""){
                if(!empty($request->user_settings)){
                
                    $getUserSetting = UserSetting::where('producer_id',$producerId )->get(); 
                    if($getUserSetting->count()){
                       
                        $update_usersetting = UserSetting::where([
                            'producer_id' => $producerId,
                            'id'          => $getUserSetting[0]->id 
                        ])->update([
                            'wr_fish_online_qc' => $request->user_settings['wr_fish_online_qc'],
                            'cut_fish_online_qc' => $request->user_settings['cut_fish_online_qc'] 
                        ]); 
                    }
                    else{
                       $create_usersetting = UserSetting::create([
                            'producer_id'       => $producerId,
                            'wr_fish_online_qc' => $request->user_settings['wr_fish_online_qc'],
                            'cut_fish_online_qc' => $request->user_settings['cut_fish_online_qc'] 
                       ]);
                    }
                }
                if(!empty($request->cold_chain_standard) && count($request->cold_chain_standard)){
                    foreach($request->cold_chain_standard as $cold_chain_standard){
                        if($cold_chain_standard['id'] !=null){
                            $getColdChain = ColdChainStandard::where('producer_id',$producerId)->get();
                            if(isset($getColdChain) && count($getColdChain)){
                                $update_coldChain = ColdChainStandard::where([
                                    'producer_id' => $producerId,
                                    'id'          => $getColdChain[0]->id 
                                ])->update([
                                    'section_id'   => $cold_chain_standard['section_id'],
                                    'title'        => $cold_chain_standard['title'],
                                    'target_value' => $cold_chain_standard['target_value'], 
                                    'border_value' => $cold_chain_standard['border_value'] 
                                ]);
                            }
                        }
                        else{
                            $getcold = ColdChainStandard::where([
                                'producer_id' =>$producerId, 
                                'section_id'  => $cold_chain_standard[0]->section_id
                                ])->get();
                            if(isset($getcold) && count($getcold)){
                                $update_coldChain = ColdChainStandard::where([
                                    'producer_id' => $producerId,
                                    'section_id'  => $cold_chain_standard['section_id']
                                ])->update([
                                    'section_id'   => $cold_chain_standard['section_id'],
                                    'title'        => $cold_chain_standard['title'],
                                    'target_value' => $cold_chain_standard['target_value'], 
                                    'border_value' => $cold_chain_standard['border_value'] 
                                ]);
                            }
                            else{
                                $create_coldChain = ColdChainStandard::create([
                                    'producer_id'       => $producerId,
                                    'section_id'        => $cold_chain_standard['section_id'],
                                    'title'             => $cold_chain_standard['title'],
                                    'target_value'      => $cold_chain_standard['target_value'], 
                                    'border_value'      => $cold_chain_standard['border_value'] 
                                ]);
                            }
                        }
                    }
                }
                if(isset($request->discrepancies) && count($request->discrepancies)){
                    foreach($request->discrepancies as $discrepancies){
                        if($discrepancies['id']!=null){  
                            $getDisc = UserDiscrepancy::where([
                                'producer_id'    => $producerId,
                                'id'             => $discrepancies['id'],
                                'discrepancy_id' => $discrepancies['discrepancy_id']
                            ])->get();
                            if(isset($getDisc) && count($getDisc)){ 
                                $update_discrepancy = UserDiscrepancy::where([
                                    'producer_id'    => $producerId,
                                    'id'             => $discrepancies['id'],
                                    'discrepancy_id' => $discrepancies['discrepancy_id']
                                ])->update([
                                    'discrepancy_id'         => $discrepancies['discrepancy_id'],
                                    'rejection_offset_value' => $discrepancies['rejection_offset_value'],
                                    'border_offset_value'    => $discrepancies['border_offset_value'],
                                    'rejection_value'        => $discrepancies['rejection_value'],
                                    'border_value'           => $discrepancies['border_value'],
                                    'is_checked'             => $discrepancies['is_checked']
                                ]);
                            }
                        }
                        else{      
                            $getDis=UserDiscrepancy::where([
                                'producer_id'    => $producerId,
                                'discrepancy_id' => $discrepancies['discrepancy_id']
                            ])->get();
                            if(isset($getDis) && count($getDis)){ //die("update ");
                                $update_discrepancy=UserDiscrepancy::where([
                                    'producer_id'     => $producerId,
                                    'discrepancy_id'  => $discrepancies['discrepancy_id']
                                ])->update([
                                    'rejection_offset_value' => $discrepancies['rejection_offset_value'],
                                    'border_offset_value'    => $discrepancies['border_offset_value'],
                                    'rejection_value'        => $discrepancies['rejection_value'],
                                    'border_value'           => $discrepancies['border_value'],
                                    'is_checked'             => $discrepancies['is_checked']
                                ]);
                            }
                            else{ //die("insert ");
                                $create_discrepancy=UserDiscrepancy::create([
                                    'producer_id'            => $producerId,
                                    'discrepancy_id'         => $discrepancies['discrepancy_id'],
                                    'rejection_offset_value' => $discrepancies['rejection_offset_value'],
                                    'border_offset_value'    => $discrepancies['border_offset_value'],
                                    'rejection_value'        => $discrepancies['rejection_value'],
                                    'border_value'           => $discrepancies['border_value'],
                                    'is_checked'             => $discrepancies['is_checked']
                                ]); 
                            }
                        }
                   }
                } /*  END OF UPDATE DISCRIPANCIES */
                if(!empty($request->requestedItems)){
                    $this->update_items($request->requestedItems,$producerId);
                }
                if(!empty($request->customization_settings)){
                    $this->update_customization_settings($request->customization_settings,$producerId);
                }
            }
        else{
            return response()->json(['error'=>"User Id is required!"], 401);  
        }
        $result = Producer::select('id','name')
            ->where('id',$request->producer_id)
            ->with('user_settings')
            // ->with('discrepancies')
            ->with('requestedItems')
            ->with('customization_settings')
            ->with('coldChainStandard')
            ->first(); 
            $discrepancies = DB::select("SELECT D.id,D.producer_id,M.id as discrepancy_id,M.discrepancies,M.discrepancy_key,
            (CASE WHEN D.is_checked  IS NULL THEN 0 ELSE D.is_checked END) as is_checked,
            (CASE WHEN D.rejection_value  IS NULL THEN M.rejection_value ELSE D.rejection_value END) as rejection_value,
            (CASE WHEN D.border_value IS NULL THEN M.border_value ELSE D.border_value END) as border_value
            ,M.unit,M.type,D.rejection_offset_value,D.border_offset_value, D.created_at,D.updated_at as new_id FROM `master_discrepancies` M left join (select * FROM user_discrepancies WHERE producer_id = $request->producer_id) D on M.id = D.discrepancy_id");
            $result->discrepancies = $discrepancies;
            return response()->json($result, 200);
    } /* end  of the  update  customization*/

   /* update Requested  items*/
    public function update_items($requestedItems,$producerId){  
        if(!empty($requestedItems)){ 
            $updateData=[
                'raw_wr_weight'                               => $requestedItems['raw_wr_weight'],
                'raw_wr_weight_is_checked'                    => $requestedItems['raw_wr_weight_is_checked'],
                'raw_wr_length'                               => $requestedItems['raw_wr_length'],
                'raw_wr_length_is_checked'                    => $requestedItems['raw_wr_length_is_checked'],
                'raw_cut_fish_weight'                         => $requestedItems['raw_cut_fish_weight'],
                'raw_cut_fish_weight_is_checked'              => $requestedItems['raw_cut_fish_weight_is_checked'],
                'raw_cut_fish_length'                         => $requestedItems['raw_cut_fish_length'],
                'raw_cut_fish_length_is_checked'              => $requestedItems['raw_cut_fish_length_is_checked'],
                'finished_product_wr_weight'                  => $requestedItems['finished_product_wr_weight'],
                'finished_product_wr_weight_is_checked'       => $requestedItems['finished_product_wr_weight_is_checked'],
                'finished_product_wr_length'                  => $requestedItems['finished_product_wr_length'],
                'finished_product_wr_length_is_checked'       => $requestedItems['finished_product_wr_length_is_checked'],
                'finished_product_cut_fish_weight'            => $requestedItems['finished_product_cut_fish_weight'],
                'finished_product_cut_fish_weight_is_checked' => $requestedItems['finished_product_cut_fish_weight_is_checked'],
                'finished_product_cut_fish_length'            => $requestedItems['finished_product_cut_fish_length'],
                'finished_product_cut_fish_length_is_checked' => $requestedItems['finished_product_cut_fish_length_is_checked']
            ];
            if(isset($requestedItems['id']) && $requestedItems['id']!=NULL){  
                $getitems=RequestedItem::where([ 'producer_id' => $producerId,'id' => $requestedItems['id']])->get();
                if(count($getitems)){
                    $update_req_items=RequestedItem::where([ 'producer_id' => $producerId,'id' => $requestedItems['id']])->update($updateData);
                }
            }
            else{  
                $getitems=RequestedItem::where(['producer_id' => $producerId])->get();
                if(count($getitems)){  
                    $update_req_items=RequestedItem::where(['producer_id' => $producerId])->update($requestedItems);
                }
                else{ 
                    $create_req_items=RequestedItem::Create($updateData);
                }
            }
        }
    }

    
   /*  End of  the Requested  Items  */
   /* update Cutomization settings */
    public  function update_customization_settings($customization_settings, $producerId){
        if(!empty($customization_settings)){
            $get_customizationSetting=CustomizationSetting::where([
                'producer_id' => $producerId
            ])->get();
            if($customization_settings['id']!=NULL){
                
                if(count($get_customizationSetting)){
                    $update_customizationSetting=CustomizationSetting::where([
                        'producer_id' => $producerId
                    ])->update([
                        'producer_id' => $producerId,
                        'temperature_ckeck_reminder_timescale' => $customization_settings['temperature_ckeck_reminder_timescale'],
                        'custom_reminder_timescale_day' => $customization_settings['custom_reminder_timescale_day'],
                        'minimum_temperature' => $customization_settings['minimum_temperature'],
                        'other_minimum_temperature' => $customization_settings['other_minimum_temperature'],
                        'continuous_freezing' => $customization_settings['continuous_freezing'],
                        'other_continuous_freezing' => $customization_settings['other_continuous_freezing'],
                        'length_width_detribution' => $customization_settings['length_width_detribution'],
                        'weight_calibration'       => $customization_settings['weight_calibration'],
                        'control_frequency'        => $customization_settings['control_frequency'],
                        'standard_drip_loss_value' => $customization_settings['standard_drip_loss_value'],
                        'standard_guts_weight'     => $customization_settings['standard_guts_weight']
                    ]);
                }
            }
            else{  
                if(!count($get_customizationSetting)){  
                    $create_cutomization_setting=CustomizationSetting::create([
                        'producer_id' => $producerId,
                        'temperature_ckeck_reminder_timescale' => $customization_settings['temperature_ckeck_reminder_timescale'],
                        'custom_reminder_timescale_day' => $customization_settings['custom_reminder_timescale_day'],
                        'minimum_temperature' => $customization_settings['minimum_temperature'],
                        'other_minimum_temperature' => $customization_settings['other_minimum_temperature'],
                        'continuous_freezing' => $customization_settings['continuous_freezing'],
                        'other_continuous_freezing' => $customization_settings['other_continuous_freezing'],
                        'length_width_detribution' => $customization_settings['length_width_detribution'],
                        'weight_calibration'       => $customization_settings['weight_calibration'],
                        'control_frequency'        => $customization_settings['control_frequency'],
                        'standard_drip_loss_value' => $customization_settings['standard_drip_loss_value'],
                        'standard_guts_weight'     => $customization_settings['standard_guts_weight']
                    ]);
                }
                else{  //die("oiu"); 
                    $update_customizationSetting=CustomizationSetting::where([
                        'producer_id' => $producerId
                    ])->update([
                        'producer_id' => $producerId,
                        'temperature_ckeck_reminder_timescale' => $customization_settings['temperature_ckeck_reminder_timescale'],
                        'custom_reminder_timescale_day' => $customization_settings['custom_reminder_timescale_day'],
                        'minimum_temperature' => $customization_settings['minimum_temperature'],
                        'other_minimum_temperature' => $customization_settings['other_minimum_temperature'],
                        'continuous_freezing' => $customization_settings['continuous_freezing'],
                        'other_continuous_freezing' => $customization_settings['other_continuous_freezing'],
                        'length_width_detribution' => $customization_settings['length_width_detribution'],
                        'weight_calibration'       => $customization_settings['weight_calibration'],
                        'control_frequency'        => $customization_settings['control_frequency'],
                        'standard_drip_loss_value' => $customization_settings['standard_drip_loss_value'],
                        'standard_guts_weight'     => $customization_settings['standard_guts_weight']
                    ]);
                }
            }
        }  
    }
   /*  End  of  cutomization settings */
   public function  getdiscrepancies(Request $request){
      $allDesc=MasterDiscrepancy::get();
      return response()->json($allDesc, 200); 
   }
    /*  save saveDiscrepancy */
    public  function  saveDiscrepancy(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,jpeg,png', //Remove space from 'picture'
            'discrepancies' => 'required|unique:master_discrepancies',
            // 'discrepancy_key' => 'required',
            'type'           => 'required|string|min:1|max:3',
            'rejection_value' => 'required',
            'border_value' => 'required',
            'unit' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 
        $input=$request->all();
        if($request->file()) {  
            $uploaded_img = $request->file('image')->store('discrepancies');
            $file_name=substr($uploaded_img,14,200);
            $input['image'] = $file_name;
        }  
        $create = MasterDiscrepancy::create($input);
        return response()->json($create, 200);
    }


}
