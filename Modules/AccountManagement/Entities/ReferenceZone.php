<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Lot\Entities\Api\Zone;
use Awobaz\Compoships\Compoships;
class ReferenceZone extends Model
{
    use HasFactory,Compoships;

    protected $fillable = ['user_id','reference_country_id','zone_id','title','zonekey'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\ReferenceZoneFactory::new();
    }

    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User','user_id','id');
    }

    public function zones(){
        return $this->hasOne(Zone::class,'id','zone_id');
    }


}
