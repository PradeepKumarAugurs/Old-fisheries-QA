<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AccountManagement\Entities\CustomRows;
use Modules\AccountManagement\Entities\CustomFields;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name','name_key','type'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\SectionFactory::new();
    }

    public  function custom_fields(){
        return $this->hasMany(CustomFields::class,  'section_id', 'id'); 
    }

    public  function custom_rows(){
        return $this->hasMany(CustomRows::class,  'section_id', 'id'); 
    }
}
