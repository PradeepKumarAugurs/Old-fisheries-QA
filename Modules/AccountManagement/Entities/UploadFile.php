<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UploadFile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','file','location','type'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\UploadFileFactory::new();
    }
}
