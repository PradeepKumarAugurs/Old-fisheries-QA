<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AccountManagement\Entities\Producer;
use Modules\AccountManagement\Entities\City;
class Country extends Model
{
    use HasFactory;

    protected $fillable = ['sortname','name','name_key','phonecode'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\CountryFactory::new();
    }

    public  function producers(){
        return $this->hasMany(Producer::class,'country_id','id'); 
    }
    public  function cities(){
        return $this->hasMany(City::class,'country_id','id'); 
    }


}
