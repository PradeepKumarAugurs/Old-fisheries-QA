<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class heavyMetal extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','name','name_key','mark','max_limit_ppm'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\HeavyMetalFactory::new();
    }
}
