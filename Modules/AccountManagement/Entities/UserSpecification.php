<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AccountManagement\Entities\MasterSpec;

class UserSpecification extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','spec_type','spec_id','is_checked','min_cut_length_offset','max_cut_length_offset','min_cut_weight_offset','max_cut_weight_offset'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\UserSpecificationFactory::new();
    }

    public function spec(){
        return $this->hasOne('Modules\AccountManagement\Entities\MasterSpec','id','spec_id');
    }
    
    public function specTypes(){
        return $this->hasOne(MasterSpec::class, 'id','spec_id');
    }


}
