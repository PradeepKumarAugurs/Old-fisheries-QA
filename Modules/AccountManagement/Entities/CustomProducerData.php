<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Awobaz\Compoships\Compoships;
class CustomProducerData extends Model
{
    use HasFactory,Compoships;

    protected $fillable = ['producer_id','arrival_id','custom_field_id','custom_row_id','value'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\CustomProducerDataFactory::new();
    }
}
