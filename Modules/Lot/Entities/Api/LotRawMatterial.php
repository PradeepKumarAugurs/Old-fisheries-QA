<?php

namespace Modules\Lot\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LotRawMatterial extends Model
{
    use HasFactory;

    protected $fillable = ['lot_id','fish_arrival_id'];
    
    protected static function newFactory()
    {
        return \Modules\Lot\Database\factories\LotRawMatterialFactory::new();
    }
}
