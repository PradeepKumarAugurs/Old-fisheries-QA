<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomFields extends Model
{
    use HasFactory;

    protected $fillable = ['name','producer_id','arrival_id','section_id','type','item_list'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\CustomFieldsFactory::new();
    }

}
