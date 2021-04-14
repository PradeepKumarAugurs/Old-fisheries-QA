<?php

namespace Modules\Lot\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class UnloadingHatch extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['fishing_hatch_id','arrival_id','hatch_id','start_time','end_time','fish_teprature','created_by','updated_by','deleted_by','deleted_at'];
    protected $table = 'unloading_hatches';
    
    protected static function newFactory()
    {
        return \Modules\Lot\Database\factories\UnloadingHatchFactory::new();
    }
    
    
    
}
