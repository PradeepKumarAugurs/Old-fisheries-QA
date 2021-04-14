<?php

namespace Modules\Lot\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Lot\Entities\Api\FishingHatch;
use Modules\AccountManagement\Entities\UploadFile;
use Illuminate\Database\Eloquent\SoftDeletes;
class Voyage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['arrival_id','truck_id','hatch_id','port_departure_time','plant_arrival_time','transportation_time',
    'added_ice','add_water','type_of_recipient','weight_bundle','net_weight','gross_weight','number_of_bundles','production_which_from','factory_arrival_time','number_of_bundles','climate_controle','comment','truck_image',
    'recipient_image','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\Lot\Database\factories\VoyageFactory::new();
    }

    public  function truckImageDetails(){
        return $this->hasMany(UploadFile::class,'id','truck_image');
    }

    public  function recipientImageDetails(){
        return $this->hasMany(UploadFile::class,'id','recipient_image');
    }

}
