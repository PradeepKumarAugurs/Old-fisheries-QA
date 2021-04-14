<?php

namespace Modules\Lot\Http\Controllers\Api;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\AccountManagement\Entities\SpecType;
use Modules\Lot\Entities\Api\LotInfo;
use Modules\Lot\Entities\Api\FishingHatch;
use Modules\Lot\Entities\Api\LotParasite;
use Modules\Lot\Entities\Api\LotWrWeightOr;
use Modules\Lot\Entities\Api\LotWrWeightFinishProduct;
use Modules\Lot\Entities\Api\LotCutFishWeight;
use Modules\Lot\Entities\Api\LotCutFishLength;
use Modules\Lot\Entities\Api\MasterParasite;
use Modules\Lot\Entities\Api\Unit;
use Modules\Lot\Entities\Api\Zone;
use Modules\AccountManagement\Entities\ReferenceCountry;
use Modules\AccountManagement\Entities\Country;
use Modules\AccountManagement\Entities\ReferenceSupplier;
use Modules\AccountManagement\Entities\ReferenceProducer;
use Modules\AccountManagement\Entities\ReferenceZone;
use Modules\Lot\Entities\Api\Type;
use Modules\Lot\Entities\Api\Quality;
use Modules\Lot\Entities\Api\LotRawMatterial;
use Modules\AccountManagement\Entities\UserSpecification;
use Validator;

class LotController extends Controller 
{

    /**
     * get  Specs for New Lot As Product Type 
    */
    public function getSpecType(Request $request, $user_id){
        $getUser=User::find($user_id);
    if(!empty($getUser)){
        $getSpecTypes=SpecType::where('user_id',$user_id)->get();
        return response()->json($getSpecTypes, 200);
    }
    else{
        return response()->json(['error'=>'User not found'], 401);  
    }
    }

    /**
     * Create Lotinfo
     */
    public function createLotGenralInfo(Request $request){
        
    $validator = validator::make($request->all(), [
        'lot_number'          => 'required|string|unique:lot_infos|max:255',
        'production_date'     => 'required|date_format:Y-m-d',
        'country_id'          => 'required|numeric|min:1|max:9999999',
        'supplier_id'         => 'required|numeric|min:1|max:9999999',
        'producer_id'         => 'required|numeric|min:1|max:9999999',
        'plant_location'      => 'required|string',
        'product'             => 'required|numeric|min:1|max:9999999',
        'type'                => 'required|numeric|min:1|max:9999999',
        'size'                => 'required|numeric',
        'cut_size_type'       => 'required|numeric|min:1|max:9999999',
        'quality'             => 'required|numeric|min:1|max:9999999',
        'unit_id'             => 'required|numeric|min:1|max:9999999',
        'weight'              => 'required|numeric',
        'number_of_unit'      => 'required|numeric',
        'total_quantity'      => 'required|numeric',
        'lotRowMaterial'      => 'required|array'
    ]);
    if ($validator->fails()) { 
        return response()->json(['error'=>$validator->errors()], 401);            
    } 

    $recordCreated = LotInfo::create([
        'lot_number'        => $request->lot_number,
        'production_date'   => $request->production_date,
        'country_id'        => $request->country_id,
        'supplier_id'=>$request->supplier_id,
        'producer_id'=>$request->producer_id,
        'plant_location'=>$request->plant_location,
        //'product'=>$request->product,
        'type'=>$request->type,
        'size'=>$request->size,
        'cut_size_type'=>$request->cut_size_type,
        'quality'=>$request->quality,
        'unit_id'=>$request->unit_id,
        'weight'=>$request->weight,
        'number_of_unit'=>$request->number_of_unit,
        'total_quantity'=>$request->total_quantity
    ]);
        return response()->json($request->all(), 200);
    }
 
    /**
     *  updat LotGenralInfo
     */
    public function  updateLotGenralInfo(Request $request, $row_id){
            $validator = validator::make($request->all(), [
            'lot_number'=> 'required|string|max:255',
            'production_date'=> 'required|date_format:Y-m-d',
            'country_id' => 'required|numeric|min:1|max:9999999',
            'supplier_id'=> 'required|numeric|min:1|max:9999999',
            'producer_id'=> 'required|numeric|min:1|max:9999999',
            'plant_location'=> 'required|string',
            'product'=> 'required|numeric|min:1|max:9999999',
            'type'=> 'required|numeric|min:1|max:9999999',
            'size'=> 'required|numeric',
            'cut_size_type'=> 'required|numeric|min:1|max:9999999',
            'quality'=> 'required|numeric|min:1|max:9999999',
            'unit_id'=> 'required|numeric|min:1|max:9999999',
            'weight'=> 'required|numeric',
            'number_of_unit'=> 'required|numeric',
            'total_quantity'=> 'required|numeric'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 
        $recordUpdated = LotInfo::find($row_id);
        if(!empty($recordUpdated)){
            if(($recordUpdated->lot_number==$request->lot_number) && ($recordUpdated->production_date==$request->production_date)){
                $recordUpdated->update($request->all());  
                return response()->json($request->all(), 200);
            }
            else{
                return response()->json(['error'=>'Lot number or production date not exist!'], 401);
            }
        }
        else{
            return response()->json(['error'=>'Lot number not found!'], 401);
        }
    }
/**
 * Get data LotInfo 
 */
    public function getLotGenralInfo(Request $request){

        $getLotInfo = LotInfo::find($request->row_id);
        if(!empty($getLotInfo)){
            $getdetail = LotInfo::select('id','lot_number','production_date','country_id','supplier_id','producer_id','plant_location','product','type','size','cut_size_type','quality','unit_id','weight','number_of_unit','total_quantity')
            ->where('id', $request->row_id)->first();
            return response()->json($getdetail, 200);
        } else {
            return response()->json(['error'=>'Lot number not found!'], 401);
        }

    }

    /**
     * get Fishing hatches
     */

    public function getLotFishingInfo(Request $request, $row_id){
        $getLotFishingId = LotInfo::find($row_id);
            if(!empty($getLotFishingId)){
                $getdata = LotInfo::select('id','lot_number','production_date','fishing_technique','boat','fishing_date','fishing_zone','ice_onboard','number_of_catches','total_fish_quantity','total_fishing_time')
                ->where('id', $row_id)->with('fishingHatches')->first();
                return response()->json($getdata, 200);
            }
            else{
                return response()->json(['error'=>'Lot number not found!'], 401);
            }
    }
/**
 *  Get LotWrWeightOr
 */
    public function getLotWrWeightOr(Request $request, $user_id){

        $getLotInfoId = LotInfo::find($user_id);
        if(!empty($getLotInfoId)){
            $getLotInfoData = LotInfo::select('id','lot_number','production_date')->where('id',$user_id)->with('lotWrWeightOrs')->first();
            return response()->json($getLotInfoData, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!'], 401);
        }
    }
    
    /**
     *  Get lotCutFishLength
     */
    public function getlotCutFishLength(Request $request, $user_id){
        $getinfoId = LotInfo::find($user_id);
        if(!empty($getinfoId)){
            $getCutLength = LotInfo::select('id','lot_number','production_date')->where('id', $user_id)->with('lotCutFishLengths')->first();
            return response()->json($getCutLength, 200);
        }
        else{
            return response()->json(['error'=>'User number not found!'], 401);
        }  
    }
    
    /**
     *  Get Cut Fish Weight
     */

    public function getlotCutFishWeight(Request $request, $user_id){
        $getInfoId1 = LotInfo::find($user_id);
        if(!empty($getInfoId1)){
            $getCutWeight = LotInfo::select('id','lot_number','production_date')->where('id', $user_id)->with('lotCutFishWeights')->first();
            return response()->json($getCutWeight, 200);
        }
        else{
            return response()->json(['error'=>'User number not found!'], 401);
        }
    }

    /**
     *  Get WR weight – Finish product 
     */

    public function getLotWrWeightFinishProduct(Request $request, $user_id){

        $getInfoId6 = LotInfo::find($user_id);
        if(!empty($getInfoId6)){
            $getFinishProduct = LotInfo::select('id','lot_number','production_date')->where('id', $user_id)->with('lotWrWeightFinishProducts')->first();
            return response()->json($getFinishProduct, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!'], 401);
        }
    }

    /**
     *  Get Data Fish Reception
     */

    /*public function getLotFishReception(Request $request,$row_id){
    
    $getInfoId7 = LotInfo::find($row_id);
    if(!empty($getInfoId7)){
        $getFishReceptionInfo = LotInfo::select('lot_number','production_date')->where('id',$row_id)->with('lotFishReceptions')->first();
        return response()->json($getFishReceptionInfo, 200);
    }
    else{
        return response()->json(['error'=>'Lot no. not found!'], 401);
    }

    }*/


    /**
     * update Lot Fishing Info 
    */
    public  function  updateLotFishingInfo(Request $request,$row_id){
        $getLotInfo=LotInfo::find($row_id);
        if(!empty($getLotInfo)) {   
            
            $validator = Validator::make($request->all(), [
                'lot_number'           => 'required|string|max:255',
                'production_date'      => 'required|date_format:Y-m-d',
                'fishing_technique'    => 'required|numeric|min:1|max:99999',
                'boat'                 => 'required|string|max:255',
                'fishing_date'         => 'required|date_format:Y-m-d',
                'fishing_zone'         => 'required|numeric|min:1|max:99999',
                'ice_onboard'          => 'required|string|max:255',
                'number_of_catches'    => 'required|numeric|min:1|max:99999',
                'total_fish_quantity'  => 'required|numeric|min:1|max:99999',
                'total_fishing_time'   => 'required|numeric|min:1|max:99999',
                'fishing_hatches'      => 'required |array'
            ]);
            if($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
            $validator2 = Validator::make($request->all(), [
                'fishing_hatches.*.hatch_id'       => 'required|string|max:255', 
                'fishing_hatches.*.quantity'       => 'required|numeric|min:1|max:99999',
                'fishing_hatches.*.hour'           => 'required|numeric|min:1|max:99999',
                'fishing_hatches.*.fish_teprature' => 'required|numeric|min:1|max:99999'
            ]);
            if ($validator2->fails()) {
                return response()->json(['error'=>$validator2->errors()], 401);      
            }

            $update=array(
                'lot_number' => $request->lot_number,
                'production_date' => $request->production_date,
                'fishing_technique' => $request->fishing_technique,
                'boat' => $request->boat,
                'fishing_date' =>  $request->fishing_date,
                'fishing_zone' => $request->fishing_zone,
                'ice_onboard' => $request->ice_onboard,
                'number_of_catches' => $request->number_of_catches,
                'total_fish_quantity' => $request->total_fish_quantity,
                'total_fishing_time' => $request->total_fishing_time
            );
            if($getLotInfo->lot_number!=$request->lot_number || $getLotInfo->production_date!=$request->production_date  ){
                return response()->json(['error'=>'lot number or production date does not matched '], 401);  
            }
            if(count($request->fishing_hatches)){
                foreach($request->fishing_hatches as $catches){
                    $catches['lot_number']=$request->lot_number;
                    $catches['production_date']=$request->production_date;
                    if(isset($catches['id']) && $catches['id']!=null){
                        $catches['updated_by']=$request->user()->id;
                    }
                    else{
                        $catches['created_by']=$request->user()->id;
                    }
                    //  if records is present then its updated other wise new record  created here 
                    FishingHatch::updateOrCreate(['id'=>isset($catches['id'])?$catches['id']:null],$catches);
                }
            }
            $updateLot=LotInfo::where('id',$row_id)->update($update); 
            return response()->json($request->all(), 200);
        } else {
            return response()->json(['error'=>'lot number not found'], 401);    
        }
    }


    /**
     * update Lot  fish Reception  
    */
    public function updateLotFishReception(Request $request,$row_id){
        $getLotInfo = LotInfo::find($row_id);
        if(!empty($getLotInfo)) {    // to  Check  Exist lot into database
            $validator = Validator::make($request->all(), [
                'lot_number'            => 'required|string|max:255',
                'production_date'       => 'required|date_format:Y-m-d',
                'meat_texture'          => 'required|numeric|min:1|max:5',
                'freshness'             => 'required|numeric|min:1|max:5',
                'scales'                => 'required|numeric|min:1|max:5',
                'belly_thickness'       => 'required|numeric|min:1|max:5',
                'belly_strength'        => 'required|numeric|min:1|max:5',
                'fat_content'           => 'required|numeric|min:1|max:5',
                'fat_content_image'     => 'required|numeric|min:1',
                'fat_content_percentage'=> 'required|numeric|min:1|max:99999',
                'feed'                  => 'required|string|max:255',
                'feed_charatestic_image'=> 'required|numeric|min:1|max:99999',
                'small_feed'            => 'required|numeric|min:1|max:99999',
                'medium_feed'           => 'required|numeric|min:1|max:99999',
                'large_feed'            => 'required|numeric|min:1|max:99999',
                'extra_large_feed'      => 'required|numeric|min:1|max:99999',
                'feed_comment'          => 'required|string|max:255',
                'reception_fish_temprature' => 'required|numeric|min:1|max:99999',
                'fish_temp_image'       => 'required|numeric|min:1|max:99999',
                'resistance_test'       => 'required|numeric|min:1|max:99999',
                'lot_parasites'         => 'required|array'
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);           
            } 
            $validator2 = Validator::make($request->all(), [
                'lot_parasites.*.parasite_id'       => 'required|numeric',
                'lot_parasites.*.parasites_value'   => 'required|array'
            ]);
            if ($validator2->fails()) {
                return response()->json(['error'=>$validator2->errors()], 401);      
            }

            $update=array(
                'meat_texture'          => $request->meat_texture,
                'freshness'             => $request->freshness,
                'scales'                => $request->scales,
                'belly_thickness'       => $request->belly_thickness,
                'belly_strength'        => $request->belly_strength,
                'fat_content'           => $request->fat_content,
                'fat_content_percentage'=> $request->fat_content_percentage,
                'feed'                  => $request->feed,
                'small_feed'            => $request->small_feed,
                'medium_feed'           => $request->medium_feed,
                'large_feed'            => $request->large_feed,
                'extra_large_feed'      => $request->extra_large_feed,
                'feed_comment'          => $request->feed_comment,
                'reception_fish_temprature' => $request->reception_fish_temprature,
                'resistance_test'       => $request->resistance_test,
                'fat_content_image'     => $request->fat_content_image,
                'feed_charatestic_image' => $request->feed_charatestic_image,
                'fish_temp_image'       => $request->fish_temp_image
            );
            if($getLotInfo->lot_number!=$request->lot_number || $getLotInfo->production_date!=$request->production_date  ){
                return response()->json(['error'=>'lot number or production date are not matched '], 401);  
            }

            if(count($request->lot_parasites)){
                foreach($request->lot_parasites as $parasites){
                    $parasites['lot_number']      = $request->lot_number;
                    $parasites['production_date'] = $request->production_date;
                    //  if records is present then its updated other wise new record  created here 
                    $parasites['parasites_value']=json_encode($parasites['parasites_value']);
                    LotParasite::updateOrCreate(['id'=>isset($parasites['id'])?$parasites['id']:null],$parasites);
                }
            }
            $updateLot = LotInfo::where('id',$row_id)->update($update); 
            return response()->json($request->all(), 200);
        }
        else{
            return response()->json(['error'=>'lot number not found!'], 401);    
        }

    }

    /**
     * update Lot  Length Width Distribution  
    */

    public  function  updateLotWrOr(Request $request,$row_id){ 
        $getLotInfo = LotInfo::find($row_id);
        if(!empty($getLotInfo)) {    
            $validator = Validator::make($request->all(), [
                'lot_number'            => 'required|string',
                'production_date'       => 'required|date_format:Y-m-d',
                'wr_weight_or'          => 'required|array'
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);           
            } 
            
            $validator2 = Validator::make($request->all(), [
                'wr_weight_or.*.type'         => 'required|numeric|min:1|max:4',
                'wr_weight_or.*.weight'       => 'required|numeric'
            ]);
            if ($validator2->fails()) { 
                return response()->json(['error' => $validator2->errors()], 401);           
            } 
            if($getLotInfo->lot_number!=$request->lot_number || $getLotInfo->production_date!=$request->production_date  ){
                return response()->json(['error'=>'lot number or production date are not matched '], 401);  
            }
            if(count($request->wr_weight_or)){
                foreach($request->wr_weight_or as $wr_weigth){
                    $wr_weigth['lot_number']=$request->lot_number;
                    $wr_weigth['production_date']=$request->production_date;
                    //  if records is present then its updated other wise new record  created here  
                    LotWrWeightOr::updateOrCreate(['id'=>isset($wr_weigth['id'])?$wr_weigth['id']:null],$wr_weigth);
                }
            }
            return response()->json($request->all(), 200);
        } else {
            return response()->json(['error'=>'Lot number not found!'], 401);    
        }
    }


    /**
     * update Lot  WR Finish  Product ( Length Width Distribution  )
    */

    public  function  updateLotWrFinishProduct(Request $request,$row_id){
        $getLotInfo=LotInfo::find($row_id);
        if(!empty($getLotInfo)) {    
            $validator = Validator::make($request->all(), [
                'lot_number'            => 'required|string',
                'production_date'       => 'required|date_format:Y-m-d',
                'wr_finish_product'     => 'required|array'
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);           
            } 

            $validator2 = Validator::make($request->all(), [
                'wr_finish_product.*.type'         => 'required|numeric|min:1|max:4',
                'wr_finish_product.*.weight'       => 'required||numeric',
            ]);
            if ($validator2->fails()) { 
                return response()->json(['error' => $validator2->errors()], 401);           
            } 
            if($getLotInfo->lot_number!=$request->lot_number || $getLotInfo->production_date!=$request->production_date  ){
                return response()->json(['error'=>'lot number or production date are not matched '], 401);  
            }

            if(count($request->wr_finish_product)){
                foreach($request->wr_finish_product as $finish_product){
                    $finish_product['lot_number']      = $request->lot_number;
                    $finish_product['production_date'] = $request->production_date;
                    //  if records is present then its updated other wise new record  created here  
                    LotWrWeightFinishProduct::updateOrCreate(['id'=>isset($finish_product['id'])?$finish_product['id']:null],$finish_product);
                }
            }
            return response()->json($request->all(), 200);
        } else {
            return response()->json(['error'=>'Lot number not found!'], 401);    
        }
    }


    /**
     * Update Lot Cut Fish  ( Lot  Length width Distribution  ) 
    */

    public  function  updateLotCutFishWeight(Request $request,$row_id){
        $getLotInfo=LotInfo::find($row_id);
        if(!empty($getLotInfo)) {    
            $validator = Validator::make($request->all(), [
                'lot_number'            => 'required|string|max:255',
                'production_date'       => 'required|date_format:Y-m-d',
                'lot_cut_fish_weight'   => 'required|array'
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);           
            } 

            $validator2 = Validator::make($request->all(), [
                'lot_cut_fish_weight.*.type'         => 'required|numeric|min:1|max:4',
                'lot_cut_fish_weight.*.weight'       => 'required||numeric',
            ]);
            if ($validator2->fails()) { 
                return response()->json(['error' => $validator2->errors()], 401);           
            } 
            if($getLotInfo->lot_number!=$request->lot_number || $getLotInfo->production_date!=$request->production_date  ){
                return response()->json(['error'=>'lot number or production date are not matched '], 401);  
            }
            if(count($request->lot_cut_fish_weight)){
                foreach($request->lot_cut_fish_weight as $cut_fish_weight){
                    $cut_fish_weight['lot_number']      = $request->lot_number;
                    $cut_fish_weight['production_date'] = $request->production_date;
                    //  if records is present then its updated other wise new record  created here 
                    LotCutFishWeight::updateOrCreate(['id'=>isset($cut_fish_weight['id'])?$cut_fish_weight['id']:null],$cut_fish_weight);
                }
            }
            return response()->json($request->all(), 200);
        } 
        else {
            return response()->json(['error'=>'Lot number not found!'], 401);    
        }
    }

    /**
     * update cut fish length 
    */

    public  function  updateLotCutFishlength(Request $request,$row_id){
        $getLotInfo=LotInfo::find($row_id);
        if(!empty($getLotInfo)) {    
            $validator = Validator::make($request->all(), [
                'lot_number'            => 'required|string',
                'production_date'       => 'required|date_format:Y-m-d',
                'lot_cut_fish_length'   => 'required|array'
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);           
            } 

            $validator2 = Validator::make($request->all(), [
                'lot_cut_fish_length.*.type'         => 'required|numeric|min:1|max:2',
                'lot_cut_fish_length.*.length'       => 'required||numeric',
            ]);
            if ($validator2->fails()) { 
                return response()->json(['error' => $validator2->errors()], 401);           
            } 
            if($getLotInfo->lot_number!=$request->lot_number || $getLotInfo->production_date!=$request->production_date  ){
                return response()->json(['error'=>'lot number or production date are not matched '], 401);  
            }
            if(count($request->lot_cut_fish_length)){
                foreach($request->lot_cut_fish_length as $cut_fish_length){
                    $cut_fish_length['lot_number']      = $request->lot_number;
                    $cut_fish_length['production_date'] = $request->production_date;
                    //  if records is present then its updated other wise new record  created here 
                    LotCutFishLength::updateOrCreate(['id'=>isset($cut_fish_length['id'])?$cut_fish_length['id']:null],$cut_fish_length);
                }
            }
            return response()->json($request->all(), 200);
        } 
        else {
            return response()->json(['error'=>'Lot number not found!'], 401);    
        }
    }
/**
 *  Get all Data Fish Reception Master Parasites
 */
    
    public function getFishReceptionAllMaterParasites(Request $request){
        $getAllParasites = MasterParasite::get();
        if(!empty($getAllParasites)){
            return response()->json( $getAllParasites, 200);
        }
        else{
            return response()->json(['error'=>'Data Not found!'], 401);
        }
    }
    /**
     * Get Countries Api
     */
    public function getLotCountiresInfo(Request $request,$getUserId){
        // $getUserId = $request->user()->id;
        if($getUserId){
             $getCountryDetail = ReferenceCountry::where('user_id',$getUserId)->with('countries')->get();
             return response()->json($getCountryDetail, 200);
        }
        else{
            return response()->json(['error'=>'User Id not found!'], 401);
        }
    }

    /**
     *  Get Supplier Details 
     */
    public function getLotSupplierInfo(Request $request,$getuserId,$reference_country_id){
    if($getuserId){
        $referenceSupplier = ReferenceSupplier::where('user_id',$getuserId)->where('reference_country_id',$reference_country_id)
        ->with('suppliers')->get();
        return response()->json($referenceSupplier, 200);
    }
    else{  
        return response()->json(['error'=>'User not found!'], 401);
    }

    }

    /**
     *  Get Producer Details 
     */

    public function getLotProducerInfo(Request $request,$getuserId, $reference_country_id, $supplier_id){
        //$getuserId = $request->user()->id;
        if($getuserId){
            $getRecords = ReferenceProducer::where('user_id',$getuserId)->where('reference_country_id',$reference_country_id)->where('reference_supplier_id',$supplier_id)->with('producersList')->get();
            if(count($getRecords)){
            return response()->json($getRecords, 200);
            }
            else{
                return response()->json(['error'=>'Record not found!'], 401);
            }
        }
        else{
            return response()->json(['error'=>'User Id not found!'], 401);
        }
    }
    /**
     *  Create Country Zone 
     */
    public function getCountryList(Request $request,$reference_country_id){
        $getLoginId = $request->user()->id;
        if(!empty($getLoginId)){
            $getRefrenceZones = ReferenceZone::where('user_id',$getLoginId)->where('reference_country_id',$reference_country_id)->with('zones')->get();
            return response()->json($getRefrenceZones, 200);
        }
        else{
            return response()->json(['error'=>'User Id not found!'], 401);
        }
    }

    /**
     *  create All type 
     */
    public function getAllTypes(Request $request){

    $getAllTypes = Type::get();

    if(!empty($getAllTypes)){
        return response()->json($getAllTypes, 200);
    }
    else{
        return response()->json(['error'=>'Record not found!'], 401);
    }

    }

    /**
     *  create All Quality
     */
    public function getAllQuality(){

        $getAllQaulity = Quality::get();
        if(!empty($getAllQaulity)){
            return response()->json($getAllQaulity, 200);
        }
        else{
            return response()->json(['error'=>'Record not found!'], 401);
        }
    }
    
    /**
     *  Create Cut Size Type 
     */
    public function getAllCutSizeTypes(Request $request){

        // $getLoginId = $request->user()->id;
        $getLoginId = $request->user_id;
        if($getLoginId){
            $getCutSizeType = UserSpecification::where('user_id',$getLoginId)->where('spec_type',$request->spec_type)
            ->where('is_checked','1')
            ->with('specTypes')->get();
            return response()->json($getCutSizeType, 200);
        }
        else{
            return response()->json(['error'=>'Record not found!'], 401);
        }

    }
    
    /**
     *  Get All Fish Parasites Data
     */
    public function getFishReceptionParasites(Request $request, $row_id){
    
            $getLoginId6 = LotInfo::find($row_id);
            //$getLoginId6 = $request->user()->id;
        if(!empty($getLoginId6)){
        
            $getLotInfoData = LotInfo::select('id','lot_number','production_date','meat_texture','freshness','scales','belly_thickness','belly_strength','fat_content','fat_content_percentage','feed','small_feed','medium_feed','large_feed','extra_large_feed','feed_comment','reception_fish_temprature','resistance_test')
            ->where('id',$getLoginId6)->where('lot_number',$request->lot_number)->with('lotMasterParasites')->get();
            return response()->json($getLotInfoData, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not Found!'], 401);
        } 
    }
    

    /**
     *  Get Data Fish Reception files
     */

    public function getLotFishReception(Request $request,$row_id){
    
        $getInfoId7 = LotInfo::find($row_id);
        if(!empty($getInfoId7)){
            $getFishReceptionInfo = LotInfo::select('id','lot_number','production_date','meat_texture','freshness','scales','belly_thickness','belly_strength','fat_content','fat_content_percentage','fat_content_image','feed','small_feed','medium_feed','large_feed','extra_large_feed','feed_comment','feed_charatestic_image','reception_fish_temprature','resistance_test','fish_temp_image')
            ->where('id',$row_id)->with('lotFishReceptions')->with('contentImages')->with('charatesticImages')->with('fishTempImages')->first();
            return response()->json($getFishReceptionInfo, 200);
        }
        else{
            return response()->json(['error'=>'Lot number not found!'], 401);
        }
    
    }

    /**
     * Get All  Units 
    */
    public  function  getAllUnits(){
        $getAllUnits = Unit::get();
        if(!empty($getAllUnits)){
            return response()->json($getAllUnits, 200);
        }
        else{
            return response()->json(['error'=>'Record not found!'], 401);
        }
    }

    /**
     * Get All  Zones
    */
    public function getAllZones(){
        $getAllZones = Zone::get();
        if(!empty($getAllZones)){
            return response()->json($getAllZones, 200);
        }
        else{
            return response()->json(['error'=>'Record not found!'], 401);
        }
    }

    /**
     * Get All Lot 
    */
    public  function  getAllLots(){
        $getAllLotInfos = LotInfo::get();
        if(!empty($getAllLotInfos)){
            return response()->json($getAllLotInfos, 200);
        }
        else{
            return response()->json(['error'=>'Record not found!'], 401);
        }
    }


       
    /**
     *  Create New  lot Info
     */
    public function createLotRawMaterial(Request $request){

        $validator = validator::make($request->all(), [

            'lot_id'        => 'required',
            'fish_arrivals' => 'required|array'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        if(isset($request->fish_arrivals) && count($request->fish_arrivals)){
            if(count($request->fish_arrivals)){
                foreach($request->fish_arrivals as $fish_arrivals){
                    $createLotRaw = array(
                        'lot_id'         => $request->lot_id,
                        'fish_arrival_id'=> $fish_arrivals
                    );
                    LotRawMatterial::create($createLotRaw);
                }
            }
        }
        return response()->json($request->all(), 200);        
    }
    /**
     * Update LotRaw Matterials
     */
    public function updateLotRawMaterial(Request $request, $row_id){

        $getLotRawId = LotRawMatterial::find($row_id);
        if(!empty($getLotRawId)){
            $validator = validator::make($request->all(), [

                'lot_id'        => 'required',
                'fish_arrivals' => 'required|array'
            ]);
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()], 401);
            }
            if(isset($request->fish_arrivals) && count($request->fish_arrivals)){
                if(count($request->fish_arrivals)){
                    foreach($request->fish_arrivals as $fish_arrivals){
                        $updateLotRawMatterial = array(
                            'lot_id'         => $request->lot_id,
                            'fish_arrival_id'=> $fish_arrivals
                        );
                        LotRawMatterial::where('id',$row_id)->update($updateLotRawMatterial);
                    }
                }
            }
        }
    }
    /**
     * Get All Lot Raw material 
     */
    public function getAllLotRawMatterial(Request $request){
      
        $getAllLotRaw = LotRawMatterial::get();
        if(!empty($getAllLotRaw)){
            return response()->json($getAllLotRaw, 200);
        }
        else{
            return response()->json(['error'=>'Lot id not Found!']);
        }
    }
    
    /**
     * Get Data With conditions
     */
    public function getLotRawMaterial(Request $request){
    
        $getLotId = LotRawMatterial::find($request->row_id);
        if(!empty($getLotId)){
            $getLotRaw = LotRawMatterial::where('id',$request->row_id)->get();
            return response()->json($getLotRaw, 200);
        }
        else{
            return response()->json(['error'=>'Lot id not Found!']);
        }
    }


}
