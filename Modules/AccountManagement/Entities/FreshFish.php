<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class freshFish extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','focus','quality_parameter','target'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\FreshFishFactory::new();
    }
}
