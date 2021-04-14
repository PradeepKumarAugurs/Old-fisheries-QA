<?php

namespace Modules\Lot\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Lot\Entities\Api\Voyage;
use Modules\AccountManagement\Entities\UploadFile;
class FishArrival extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','arrival_id','landing_date','unloading_place','vessel_id','sequence','fishing_date','fishing_zone',
    'ice_onboard','number_of_catches','total_fish_quantity','total_fishing_time','unloading_date','unloading_places','added_ice',
    'unloading_comment','number_of_voyages','meat_texture','freshness','scales','belly_thickness','belly_strength','fat_content','fat_content_percentage',
    'feed','small_feed','medium_feed','large_feed','extra_large_feed','feed_comment','fat_content_image','feed_charatestic_image','reception_fish_temprature','fish_temp_image','resistance_test_small',
    'resistance_test_medium','resistance_test_large','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\Lot\Database\factories\FishArrivalFactory::new();
    }
    
    public  function originTransportation(){
        return $this->hasMany(Voyage::class,'arrival_id','id');
    }
    public function contentImages(){
        return $this->hasOne(UploadFile::class, 'id', 'fat_content_image');
    }
    public function charatesticImages(){
        return $this->hasOne(UploadFile::class, 'id','feed_charatestic_image');
    }
    public function fishTempImages(){
        return $this->hasOne(UploadFile::class, 'id','fish_temp_image');
    }
    
}
