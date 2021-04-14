<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyPosition extends Model
{
    use HasFactory;

    protected $fillable = ['position','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\Auth\Database\factories\CompanyPositionFactory::new();
    }
}
