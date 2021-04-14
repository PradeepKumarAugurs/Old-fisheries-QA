<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name','name_key','country_id'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\CityFactory::new();
    }
}
