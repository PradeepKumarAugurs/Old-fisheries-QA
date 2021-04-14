<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\Entities\User;
use Awobaz\Compoships\Compoships;
class ReferenceProducer extends Model
{
    use HasFactory,Compoships;
    protected $fillable = ['user_id','reference_country_id','reference_supplier_id','producer_id'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\ReferenceProducerFactory::new();
    }

    public function producersList(){
        return $this->hasOne(User::class,'id','producer_id');
    }



}
