<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\Entities\User;
use Awobaz\Compoships\Compoships;
use Modules\AccountManagement\Entities\ReferenceProducer;
class ReferenceSupplier extends Model
{
    use HasFactory,Compoships;

    protected $fillable = ['user_id','reference_country_id','supplier_id'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\ReferenceSupplierFactory::new();
    }
    public function producers(){
        return $this->hasMany(ReferenceProducer::class,['reference_supplier_id','reference_country_id', 'user_id'], ['supplier_id','reference_country_id', 'user_id']);
    }
    public function suppliers(){
        return $this->hasOne(User::class,'id','supplier_id');
    }



}
