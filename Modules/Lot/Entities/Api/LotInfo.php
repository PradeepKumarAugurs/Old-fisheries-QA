<?php

namespace Modules\Lot\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Lot\Entities\Api\FishingHatch;
use Modules\Lot\Entities\Api\Voyage;
use Modules\Lot\Entities\Api\LotWrWeightOr;
use Modules\Lot\Entities\Api\LotCutFishLength;
use Modules\Lot\Entities\Api\LotCutFishWeight;
use Modules\Lot\Entities\Api\LotWrWeightFinishProduct;
use Modules\Lot\Entities\Api\LotParasite;
use Modules\Lot\Entities\Api\UnloadingHatch;
use Modules\AccountManagement\Entities\UploadFile;
use Modules\AccountManagement\Entities\Country;
use Modules\AccountManagement\Entities\ReferenceCountry;
use Modules\OnlineQcControl\Entities\Api\OnlineQcFreezingOperation;
use Modules\OnlineQcControl\Entities\Api\OnlineQcTunnel;
use Modules\OnlineQcControl\Entities\Api\OnlineQcFrequencyTempReading;
use Modules\OnlineQcControl\Entities\Api\Histamine;
use Modules\OnlineQcControl\Entities\Api\OnlineQcColdStorage;
use Modules\OnlineQcControl\Entities\Api\OnlineQcControl;
use Modules\OnlineQcControl\Entities\Api\OnlineQcThowingBlock;
use Modules\OnlineQcControl\Entities\Api\OnlineQcBlockDiscrepancy;
use Modules\OnlineQcControl\Entities\Api\OnlineQcParasiteInspection;
use Modules\SpotInspection\Entities\Api\FrozenWeightControl;
use Illuminate\Database\Eloquent\SoftDeletes;
class LotInfo extends Model  
{
    use HasFactory,SoftDeletes;
    
  
    protected $fillable = ['country_id','lot_number','production_date','supplier_id','producer_id','plant_location','product','type',
    'size','cut_size_type','quality','unit_id','weight','number_of_unit','total_quantity','fishing_technique','boat','fishing_date',
    'fishing_zone','ice_onboard','number_of_catches','total_fish_quantity','total_fishing_time','unloading_place','unloading_date', 'unloading_start_time','unloading_end_time','added_ice','unloading_image','unloading_comment','number_of_voyages','meat_texture',
    'freshness','scales','belly_thickness','belly_strength','fat_content','fat_content_percentage','feed','small_feed','medium_feed',
    'large_feed','extra_large_feed','feed_comment','reception_fish_temprature','resistance_test','created_by','updated_by','deleted_by','deleted_at'
    ];
    /**
     *  Lot One to many relation
     */
    public function fishingHatches(){
        return $this->hasMany(FishingHatch::class,'lot_number','lot_number');
    }
    
    public function voyages(){
        return $this->hasMany(Voyage::class,'lot_number','lot_number');
    }

    public function unloadingHatches(){
        return $this->hasMany(UnloadingHatch::class,'lot_number','lot_number');
    }
    
    public function lotWrWeightOrs(){
        return $this->hasMany(LotWrWeightOr::class,'lot_number','lot_number');
    }

    public function lotCutFishLengths(){
        return $this->hasMany(LotCutFishLength::class,'lot_number','lot_number');
    }

    public function lotCutFishWeights(){
        return $this->hasMany(LotCutFishWeight::class,'lot_number','lot_number');
    }

    public function lotWrWeightFinishProducts(){
        return $this->hasMany(LotWrWeightFinishProduct::class,'lot_number','lot_number');
    }
    
    public function lotFishReceptions(){
        return $this->hasMany(LotParasite::class,'lot_number','lot_number');
    }
    public function contentImages(){
        return $this->hasOne(UploadFile::class, 'id','fat_content_image');
    }
    public function charatesticImages(){
        return $this->hasOne(UploadFile::class, 'id','feed_charatestic_image');
    }
    public function fishTempImages(){
        return $this->hasOne(UploadFile::class, 'id','fish_temp_image');
    }
    // Lot One to One relation
    public function getlotUploadFiles(){
        return $this->hasOne(UploadFile::class,'id','unloading_image');
    }
    
    protected static function newFactory()
    {
        return \Modules\Lot\Database\factories\LotInfoFactory::new();
    }
    /**
     * Online Qc Freezing Operation 
     */
    
    public function freezingOperations(){
        return $this->hasMany(OnlineQcFreezingOperation::class,'lot_number','lot_number');
    }
    public function tunnels(){
        return $this->hasMany(OnlineQcTunnel::class,'lot_number','lot_number');
    }
    public function frequencyTempReadings(){
        return $this->hasMany(OnlineQcFrequencyTempReading::class,'lot_number','lot_number');
    }
    /**
     *  online Qc Histamine relations
     */
    public function histamines(){
        return $this->hasMany(Histamine::class, 'lot_number','lot_number');
    }
    
    /**
     * Online Qc Cold Storage
     */
    public function coldStorages(){
        return $this->hasMany(OnlineQcColdStorage::class,'lot_number','lot_number');
    }
    
    /**
     * Online Qc Control
     */
    public function controls(){
        return $this->hasMany(OnlineQcControl::class, 'lot_number','lot_number');
    }
    
    /**
     * Online Qc Thowing Block
     */
    public function thawignBlocks(){
        return $this->hasMany(OnlineQcThowingBlock::class, 'lot_number','lot_number');
    }
    public function blockDiscrepancies(){
        return $this->hasMany(OnlineQcBlockDiscrepancy::class, 'lot_number','lot_number');
    }
    public function parasiteInspections(){
        return $this->hasMany(OnlineQcParasiteInspection::class, 'lot_number','lot_number');
    }
    /**
     * Get files Online Qc Thawing Block Inspection
     */
    public function getGoodFishImages(){
        return $this->hasOne(UploadFile::class, 'id','good_fish_image');
    }
    public function  getDiscrepanciesImages(){
        return $this->hasOne(UploadFile::class, 'id','discrepancies_image');
    }
    public function getThowingImages(){
        return $this->hasOne(UploadFile::class, 'id','thowing_image');
    }
    public function getSignatureImages(){
        return $this->hasOne(UploadFile::class, 'id','signature_image');
    }
    public function getParasiteImages(){
        return $this->hasOne(UploadFile::class, 'id','image');
    }
    /**
     * Forzen Weight Control
     */
    public function frozenWeights(){
        return $this->hasOne(FrozenWeightControl::class, 'lot_number','lot_number');
    }
    

}
