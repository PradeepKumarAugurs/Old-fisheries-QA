<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AccountManagement\Entities\Producer;

class specificationSopSetting extends Model
{
    use HasFactory;
    
    protected $fillable = ['producer_id','production_and_storage_facilities','hgt_fish_cut','hg_fish_cut','hgt_fish_cut_checkbox','hg_fish_cut_checkbox','sardine','mackerel','specification_sop_file'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\SpecificationSopSettingFactory::new();
    }

    public function hgt_fish_cut_file_details(){
        return $this->belongsTo('Modules\AccountManagement\Entities\UploadFile','hgt_fish_cut','id');
    }
    public function hg_fish_cut_file_details(){
        return $this->belongsTo('Modules\AccountManagement\Entities\UploadFile','hg_fish_cut','id');
    }
}
