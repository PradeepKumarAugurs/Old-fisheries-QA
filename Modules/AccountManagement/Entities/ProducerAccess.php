<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProducerAccess extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','user_id'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\ProducerAccessFactory::new();
    }
}
