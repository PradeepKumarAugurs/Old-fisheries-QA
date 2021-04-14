<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Awobaz\Compoships\Compoships;
class CustomRows extends Model
{
    use HasFactory,Compoships;

    protected $fillable = ['producer_id','arrival_id','section_id'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\CustomRowsFactory::new();
    }


    public function customdata(){
        return $this->hasMany(CustomProducerData::class,['producer_id','custom_row_id'],['producer_id','id']); 
    }


}
