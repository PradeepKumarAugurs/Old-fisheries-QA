<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Awobaz\Compoships\Compoships;

class AffiliationsCountry extends Model
{
    use HasFactory, Compoships;

    protected $fillable = ['user_id','country_id','is_checked'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\AffiliationsCountryFactory::new();
    }
    
    public function producers(){
		return $this->hasMany(AffiliationsProducer::class,['user_id','country_id'],['user_id','country_id']);
	}
}
