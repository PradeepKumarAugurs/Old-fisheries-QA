<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Awobaz\Compoships\Compoships;

class AffiliationsProducer extends Model
{
    use HasFactory, Compoships;

    protected $fillable = ['user_id','country_id','producer_id','is_checked','access_is_checked'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\AffiliationsProducerFactory::new();
    }
}
