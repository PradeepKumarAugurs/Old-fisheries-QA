<?php

namespace Modules\Lot\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class LotCutFishLength extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['lot_number','production_date','type','length','discription','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\Lot\Database\factories\LotCutFishLengthFactory::new();
    }
}
