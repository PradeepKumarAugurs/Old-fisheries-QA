<?php

namespace Modules\SpotInspection\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrozenWeightControl extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['lot_number','production_date','frozen_weight','created_by','updated_by'];
    
    protected static function newFactory()
    {
        return \Modules\SpotInspection\Database\factories\FrozenWeightControlFactory::new();
    }
}
