<?php

namespace Modules\Lot\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class FishingHatch extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['arrival_id','hatch_id','quantity','hour','fish_teprature','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\Lot\Database\factories\FishingHatchFactory::new();
    }
}
