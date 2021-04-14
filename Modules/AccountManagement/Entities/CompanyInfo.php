<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','title','value','status'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\CompanyInfoFactory::new();
    }
}
