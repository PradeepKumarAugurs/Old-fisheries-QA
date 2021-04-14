<?php

namespace Modules\SpotInspection\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lot\Entities\Api\LotInfo;
use Modules\Lot\Entities\Api\UnloadingHatch;
use Modules\Lot\Entities\Api\Voyage;
use Modules\Lot\Entities\Api\LotCutFishWeight;
use Modules\Lot\Entities\Api\LotCutFishLength;
use Modules\Lot\Entities\Api\FishingHatch;
use Modules\OnlineQcControl\Entities\Api\OnlineQcParasiteInspection;
use Modules\OnlineQcControl\Entities\Api\OnlineQcThowingBlock;
use Modules\OnlineQcControl\Entities\Api\OnlineQcBlockDiscrepancy;
use Modules\SpotInspection\Entities\Api\FrozenWeightControl;
use Illuminate\Validation\Rule;
use Validator;  

class SpotInspectionController extends Controller
{
    /***
     *  Create Spot Inspection
     */
    public function createSpotInspectionInfo(Request $request){
    
        $validator = Validator::make($request->all(), [
        
            'lot_number'        => 'required|string|max:255|unique:lot_infos',
            'production_date'   => 'required|date_format:Y-m-d',
            'supplier_id'       => 'required|numeric|min:1|max:9999',
            'producer_id'       => 'required|numeric|min:1|max:9999',
            'plant_location'    => 'required|numeric|min:1|max:9999',
            'product'           => 'required|numeric|min:1|max:9999',
            'type'              => 'required|numeric|min:1|max:9999',
            'quality'           => 'required|numeric|min:1|max:9999',
            'unit_id'           => 'required|numeric|min:1|max:9999',
            'weight'            => 'required|numeric|min:1|max:9999',
            'number_of_unit'    => 'required|numeric|min:1|max:9999',
            'total_quantity'    => 'required|numeric|min:1|max:9999',
            'boat'              => 'required|numeric|min:1|max:9999',
            'fishing_technique' => 'required|numeric|min:1|max:9999',
            'fishing_date'      => 'required|date_format:Y-m-d',
            'fishing_zone'      => 'required|numeric|min:1|max:9999',
            'fishing_time'      => 'required|date_format:h:i a',
            'unloading_place'   => 'required|numeric|min:1|max:9999',
            'unloading_date'    => 'required|date_format:Y-m-d',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
            $createNewLot = LotInfo::create($request->all());
            return response()->json($createNewLot, 200);
    }
    /**
     * Get All Spot Inspection
     * 
     */
    public function getSpotInspectionInfo(Request $request, $user_id){
        $getId = LotInfo::find($user_id);
        if(!empty($getId)){
            $getSpotInspection = LotInfo::select('id','lot_number','production_date','supplier_id','producer_id','plant_location','product','type','quality','unit_id','weight','number_of_unit','boat','fishing_technique','fishing_date','fishing_zone','unloading_place','unloading_date')
            ->where('id', $user_id)->get();
            return response()->json($getSpotInspection, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!'], 401);  
        }   
    }
    /**
     *  Create & update Quality Assessment
     */
    public function updateQualityAssessment(Request $request, $row_id){
        
            $getLotInfoId = LotInfo::find($row_id);
            if(!empty($getLotInfoId)){
            $validator = validator::make($request->all(), [
                
                'lot_number'               => 'required|string|max:255',
                'production_date'          => 'required|date_format:Y-m-d',
                'meat_texture'             => 'required|numeric|min:1|max:999999',
                'freshness'                => 'required|numeric|min:1|max:999999',
                'scales'                   => 'required|numeric|min:1|max:999999',
                'belly_thickness'          => 'required|numeric|min:1|max:999999',
                'belly_strength'           => 'required|numeric|min:1|max:999999',
                'fat_content'              => 'required|numeric|min:1|max:999999',
                'fat_content_percentage'   => 'required|numeric|min:1|max:999999',
                'fat_content_image'        => 'required|numeric|min:1|max:999999',
                'feed'                     => 'required|numeric|min:1|max:999999',
                'small_feed'               => 'required|numeric|min:1|max:999999',
                'medium_feed'              => 'required|numeric|min:1|max:999999',
                'large_feed'               => 'required|numeric|min:1|max:999999',
                'extra_large_feed'         => 'required|numeric|min:1|max:999999',
                'resistance_test'          => 'required|numeric|min:1|max:999999',
                'parasite_inspection'      => 'required|array'
            ]);
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()], 200);
            }
            $validator2 = validator::make($request->all(), [
                
                'parasite_inspection.*.sample'                   => 'required|numeric|min:1|max:999999',
                'parasite_inspection.*.counting_parasites'       => 'required|numeric|min:1|max:999999',
                'parasite_inspection.*.image'                    => 'required|numeric|min:1|max:999999'
            ]);
            if(!empty($validator2->fails())){
                return response()->json(['error'=>$validator2->errors()], 401);
            }
            $update = array(
            
                'meat_texture'            => $request->meat_texture,
                'freshness'               => $request->freshness,
                'scales'                  => $request->scales,
                'belly_thickness'         => $request->belly_thickness,
                'belly_strength'          => $request->belly_strength,
                'fat_content'             => $request->fat_content,
                'fat_content_percentage'  => $request->fat_content_percentage,
                'fat_content_image'       => $request->fat_content_image,
                'feed'                    => $request->feed,
                'small_feed'              => $request->small_feed,
                'medium_feed'             => $request->medium_feed,
                'large_feed'              => $request->large_feed,
                'extra_large_feed'        => $request->extra_large_feed,
                'resistance_test'         => $request->resistance_test
            );
            if(($getLotInfoId['lot_number'] != $request->lot_number) && ($getLotInfoId['production_date'] != $request->production_date)){
                return response()->json(['error'=>'Lot number and Production date not Exits!'], 401);
            }
            if(count($request->parasite_inspection)){
                foreach($request->parasite_inspection as $parasite_inspection){
                    $parasite_inspection['lot_number']      = $request->lot_number;
                    $parasite_inspection['production_date'] = $request->production_date;
                    OnlineQcParasiteInspection::updateOrCreate(['id'=>isset($parasite_inspection['id'])?$parasite_inspection['id']:null],$parasite_inspection);
                }
                $updateQualityAssess = LotInfo::where('id',$row_id)->update($update);
                return response()->json($request->all(), 200);
            }
        }
        else{
                return response()->json(['error'=>'Lot number not found!'], 401);
        }
    }
    /**
     *  Get All Quality Assessment
     */
    public function getQualityAssessment(Request $request, $row_id){
        
        $getLotInfo = LotInfo::find($row_id);
        if(!empty($getLotInfo)){
            
            $getParasitInspection = LotInfo::select('id','lot_number','production_date','meat_texture','freshness','scales','belly_thickness','belly_strength','fat_content','fat_content_percentage','fat_content_image','feed','small_feed','medium_feed','large_feed','extra_large_feed','resistance_test')
            ->where('id', $row_id)->with('contentImages','parasiteInspections','getParasiteImages')->first();
            return response()->json($getParasitInspection, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!']);
        }   
    }
    /**
     *  Create & Update cut fish weight 
     */
    public function updateCutFishWeight(Request $request, $row_id){
            
        $getLotInfoId = LotInfo::find($row_id);
        if(!empty($getLotInfoId)){
            $validator = validator::make($request->all(), [
            
            'lot_number'      => 'required|string|max:255',
            'production_date' => 'required|date_format:Y-m-d',
            'cutWeight'       => 'required|array'
            ]);
            if(!empty($validator->fails())){
                return response()->json(['error' => $validator->errors()], 401);
            }
            $validator2 = validator::make($request->all(), [
                
                'cutWeight.*.type'            => 'required|numeric|min:1|max:99999',
                'cutWeight.*.weight'          => 'required|numeric|min:1|max:99999',
                'cutWeight.*.discription'     => 'required|string|max:255'
            ]);
            if(!empty($validator2->fails())){
                return response()->json(['error'=>$validator2->errors()], 401);
            }
            $update = array(
                
                'lot_number'      => $request->lot_number,
                'production_date' => $request->production_date,
            );
            if(($getLotInfoId['lot_number'] != $request->lot_number) && ($getLotInfoId['production_date'] != $request->production_date)){
                return response()->json(['error'=>'Lot number and Production date does not exits!'], 401);
            }
            if(count($request->cutWeight)){
                foreach($request->cutWeight as $cutWeight){
                    $cutWeight['lot_number']      = $request->lot_number;
                    $cutWeight['production_date'] = $request->production_date;
                    LotCutFishWeight::updateOrCreate(['id'=>isset($cutWeight['id'])?$cutWeight['id']:null],$cutWeight);
                }
            }
                LotInfo::where('id',$row_id)->update($update);
                return response()->json($request->all(), 200);
        }
        else{
                return response()->json(['error'=>'Lot number not found!'], 401);
        }
        
    }
    /**
     * Get All  Cut fish weight 
     */
    public function getCutFishWeight(Request $request, $row_id){
        
        $getLotInfoId = LotInfo::find($row_id);
        if(!empty($getLotInfoId)){
            
            $getCutWeight = LotInfo::select('id','lot_number','production_date')->where('id',$row_id)->with('lotCutFishWeights')->first();
            return response()->json($getCutWeight, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!']);
        }
    }
/**
 *  Create & Update Cut Fish Length 
 */
    public function updateCutFishLength(Request $request, $row_id){
        
        $getLotInfoId = LotInfo::find($row_id);
        if(!empty($getLotInfoId)){
            
            $validator = validator::make($request->all(), [
                
                'lot_number'      => 'required|string|max:255',
                'production_date' => 'required|date_format:Y-m-d',
                'cutLength'       => 'required|array'
            ]);
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $validator2 = validator::make($request->all(), [
                
                'cutLength.*.type'            => 'required|numeric|min:1|max:99999',
                'cutLength.*.length'          => 'required|numeric|min:1|max:99999',
                'cutLength.*.discription'     => 'required|string|max:255'
            ]);
            if(!empty($validator2->fails())){
                return response()->json(['error'=>$validator2->errors()], 401);
            }
            if(($getLotInfoId['lot_number'] != $request->lot_number) && ($getLotInfoId['production_date'] != $request->production_date)){
                return response()->json(['error'=>'Lot number and Production date does not exits!'], 401);
            }
            if(count($request->cutLength)){
                foreach($request->cutLength as $cutLength){
                    $cutLength['lot_number']      = $request->lot_number;
                    $cutLength['production_date'] = $request->production_date;
                    LotCutFishLength::updateOrCreate(['id'=>isset($cutLength['id'])?$cutLength['id']:null],$cutLength);
                }
            }
                return response()->json($request->all(), 200);
        }
        else{
                return response()->json(['error'=>'Lot number not found!']);
        }
    }
    /**
     *  Get Cut Fish Length 
     */
    
    public function getCutFishLength(Request $request, $row_id){
            
        $getLotInfoId = LotInfo::find($row_id);
        if(!empty($getLotInfoId)){
            
            $getCutLength = LotInfo::select('id','lot_number','production_date')->where('id',$row_id)->with('lotCutFishLengths')->first();
            return response()->json($getCutLength, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!']);
        } 
    }
    
    
    /**
     * Create & Update Defrost Inspection
     */
    public function updateDefrostInspection(Request $request, $row_id){
        
        $getLotInfoId = LotInfo::find($row_id);
        if(!empty($getLotInfoId)){
        $validator = validator::make($request->all(), [
            
            'lot_number'           => 'required|string|max:255',
            'production_date'      => 'required|date_format:Y-m-d',
            'invoiced_weight'      => 'required|numeric|min:1|max:99999',
            'frozen_weight'        => 'required|numeric|min:1|max:99999',
            'good_fish_image'      => 'required|numeric|min:1|max:99999',
            'discrepancies_image'  => 'required|numeric|min:1|max:99999',
            'total_pieces'         => 'required|numeric|min:1|max:99999',
            'net_thowing_weight'   => 'required|numeric|min:1|max:99999',
            'good_fish_weight'     => 'required|numeric|min:1|max:99999',
            'discrepaniesBlock'    => 'required|array'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        } 
        $validator2 = validator::make($request->all(), [
            
            'discrepaniesBlock.*.lot_number'              => 'required|string|max:255',
            'discrepaniesBlock.*.production_date'         => 'required|date_format:Y-m-d',
            'discrepaniesBlock.*.user_id'                 => 'required|numeric|min:1|max:99999',
            'discrepaniesBlock.*.block_id'                => 'required|numeric|min:1|max:99999',
            'discrepaniesBlock.*.user_discr_id'           => 'required|numeric|min:1|max:99999',
            'discrepaniesBlock.*.discrepancy_id'          => 'required|numeric|min:1|max:99999',
            'discrepaniesBlock.*.rejection_offset_value'  => 'required|numeric|min:1|max:99999',
            'discrepaniesBlock.*.border_offset_value'     => 'required|numeric|min:1|max:99999',
            'discrepaniesBlock.*.discrepancies_weight'    => 'required|numeric|min:1|max:99999'
        ]);
        if(!empty($validator2->fails())){
            return response()->json(['error'=>$validator2->errors()], 401);
        }
        if($getLotInfoId['lot_number'] != $request->lot_number){
            return response()->json(['error'=>'Lot Number not matched!'], 401);
        }
        $getThrawinglot = OnlineQcThowingBlock::where('lot_number',$request->lot_number)->first();
        $update =  array(
            
            'lot_number'          => $request->lot_number,
            'production_date'     => $request->production_date,
            'invoiced_weight'     => $request->invoiced_weight,
            'frozen_weight'       => $request->frozen_weight,
            'good_fish_image'     => $request->good_fish_image,
            'discrepancies_image' => $request->discrepancies_image,
            'total_pieces'        => $request->total_pieces,
            'net_thowing_weight'  => $request->net_thowing_weight,
            'good_fish_weight'    => $request->good_fish_weight
        );
        if(!empty($getThrawinglot)){
            OnlineQcThowingBlock::where('id',$getThrawinglot->id)->update($update);
            $block_id = $getThrawinglot->id;
        }
        else{
            $getBlockId = OnlineQcThowingBlock::create($update);
            $block_id   = $getBlockId->id;
        }
        if(($getLotInfoId['lot_number'] != $request->lot_number) && ($getLotInfoId['production_date'] != $request->production_date)){
            return response()->json(['error'=>'Lot number and Production date does not exits!'], 401);
        }
        if(count($request->discrepaniesBlock)){
            foreach($request->discrepaniesBlock as $discrepaniesBlock){
                $discrepaniesBlock['lot_number']        = $request->lot_number;
                $discrepaniesBlock['production_date']   = $request->production_date;
                $discrepaniesBlock['id']                = $block_id;
                OnlineQcBlockDiscrepancy::updateOrCreate(['id'=>isset($discrepaniesBlock['id'])?$discrepaniesBlock['id']:null],$discrepaniesBlock);
            }
        }
            return response()->json($request->all(), 200);
    }
    else{ 
        return response()->json(['error'=>'Lot number not Found!'], 401);
    }
    
    }
    
    /**
     * Get All Data Defrost Inspection
     */
    public function getDefrostInspection(Request $request, $row_id){
        
        $getLotInfoId = LotInfo::find($row_id);
        if(!empty($getLotInfoId)){
            
            $getDefrost = LotInfo::select('id','lot_number','production_date')->where('id',$row_id)
            ->with(['thawignBlocks'=> function($query){ 
            $query->select('id','lot_number','production_date','invoiced_weight','frozen_weight','good_fish_image','discrepancies_image','total_pieces','net_thowing_weight','good_fish_weight'); }])
            ->with('getDiscrepanciesImages','getGoodFishImages')->with(['blockDiscrepancies'=> function($query){ $query->select('id','lot_number','production_date','user_id','block_id','user_discr_id','discrepancy_id','rejection_offset_value','border_offset_value','discrepancies_weight'); }])
            ->first();
            return response()->json($getDefrost, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!']);
        }
    }
    
    /**
     * Create & Update Weight Control
     * 
     */
    public function updateWeightControl(Request $request, $row_id){
        
        $getLotInfoId = LotInfo::find($row_id);
        if(!empty($getLotInfoId)){
            
            $validator = validator::make($request->all(), [
                
                'lot_number'      => 'required|string|max:255',
                'production_date' => 'required|date_format:Y-m-d',
                'frozenWeight'    => 'required|array'
            ]);
            if(!empty($validator->fails())){
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $validator2 = validator::make($request->all(), [
                
                'frozenWeight.*.lot_number'      => 'required|string|max:255',
                'frozenWeight.*.production_date' => 'required|date_format:Y-m-d',
                'frozenWeight.*.frozen_weight'   => 'required|array',
                'frozenWeight.*.created_by'      => 'required|numeric|min:1|max:99999',
                'frozenWeight.*.updated_by'      => 'required|numeric|min:1|max:99999'
            ]);
            if(!empty($validator2->fails())){
                return response()->json(['error'=>$validator2->errors()], 401);
            }
            $update = array(
                
                'lot_number'      => $request->lot_number,
                'production_date' => $request->production_date
            );
            if(($getLotInfoId['lot_number'] != $request->lot_number) && ($getLotInfoId['production_date'] != $request->production_date)){
                return response()->json(['error'=>'Lot number and Production date does not matched!']);
            }
            if(count($request->frozenWeight)){
                foreach($request->frozenWeight as $frozenWeight){
                    $frozenWeight['lot_number']      = $request->lot_number;
                    $frozenWeight['production_date'] = $request->production_date;
                    FrozenWeightControl::updateOrCreate(['id'=>isset($frozenWeight['id'])?$frozenWeight['id']:null],$frozenWeight);
                }
            }
            //   LotInfo::where('id',$row_id)->update($update);
                return response()->json($request->all(), 200);
        }
        else{
                return response()->json(['error'=>'Lot number not found!']);
        }
    }
    
    /**
     * Get All Weight Control
     */
    public function getWeightControl(Request $request, $row_id){
        
        $getLotInfo = LotInfo::find($row_id);
        if(!empty($getLotInfo)){
            
                $getWeihtControl = LotInfo::select('id','lot_number','production_date')->where('id',$row_id)->with('frozenWeights')->first();
                return response()->json($getWeihtControl, 200);
        }
        else{
                return response()->json(['error'=>'Lot number not found!'], 401);
        }
    }




}
