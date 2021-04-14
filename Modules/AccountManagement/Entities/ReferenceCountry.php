<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Awobaz\Compoships\Compoships;
use Modules\AccountManagement\Entities\Country;
use Modules\AccountManagement\Entities\ReferenceProducer;
use Modules\AccountManagement\Entities\ReferenceSupplier;
class ReferenceCountry extends Model
{
    use HasFactory,Compoships;

    protected $fillable = ['user_id','country_id'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\ReferenceCountryFactory::new();
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User','user_id','id');
    }
    public function zones()
    {
        return $this->hasMany('Modules\AccountManagement\Entities\ReferenceZone', ['reference_country_id', 'user_id'], ['country_id', 'user_id']);
    }
    public function suppliers(){
        return $this->hasMany(ReferenceSupplier::class,['reference_country_id', 'user_id'], ['country_id', 'user_id']);
    }
    
    public function countries(){
        return $this->hasOne(Country::class,'id','country_id');
    }

    


}
