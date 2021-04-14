<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecType extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','name','type','checked'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\SpecTypeFactory::new();
    }

    public function data(){
        return $this->hasMany('Modules\AccountManagement\Entities\UserSpecification','spec_type','id');
    }
    
    

}
