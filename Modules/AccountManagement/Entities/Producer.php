<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AccountManagement\Entities\Country;
use Modules\AccountManagement\Entities\City;
use Modules\AccountManagement\Entities\UploadFile;
use Modules\AccountManagement\Entities\ProducerAccess;
use Modules\AccountManagement\Entities\Expedition;
use Modules\AccountManagement\Entities\UserAudit;
use Modules\AccountManagement\Entities\SpecificationSopSetting;
use Modules\AccountManagement\Entities\AcceptableSpecy;
use Modules\AccountManagement\Entities\FreshFish;
use Modules\AccountManagement\Entities\SardinesSpecs;
use Modules\AccountManagement\Entities\ChemicalCriteria;
use Modules\AccountManagement\Entities\HeavyMetal;
use Modules\AccountManagement\Entities\MicrobiologicalCriteria;
use Modules\AccountManagement\Entities\SpecType;
use Modules\AccountManagement\Entities\SopFile;
use Modules\AccountManagement\Entities\ColdChainStandard;
use Modules\Auth\Entities\User;

class Producer extends Model
{
    use HasFactory;

    protected $fillable = ['name','country_id','city_id','code','alpha_code','address','leader_id','producer_type','fao_fishing_zone','total_capacity_of_storage_reception','total_grading_capacity','total_wr_processing_capacity','total_cutting_capacity','image',
    'total_batch_freezing_capacity','total_continuouse_freezing_capacity','total_storage_capacity'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\ProducerFactory::new();
    }
    
    /**
     * Web Producers Relationship
     */
    public function countries(){
        return $this->hasOne(Country::class, 'id','country_id');
    }
    
    public function citys(){
        return $this->hasOne(City::class, 'id','city_id');
    }
    public function profileImage(){
        return $this->hasOne(UploadFile::class,'id', 'image');
    }
    public function leaderDetails(){
        return $this->hasOne(User::class,'id', 'leader_id');
    }

    public function producer_access(){
        return $this->hasMany(ProducerAccess::class,'producer_id','id');
    }
    public function expedition(){
        return $this->hasMany(Expedition::class,'producer_id','id');
    }

    public function audit_info(){
        return $this->hasOne(UserAudit::class,'producer_id','id');
    }

    /**
     * Create Relationship in Producers
     */
    public function user_settings(){
        return $this->hasOne('Modules\AccountManagement\Entities\UserSetting','producer_id','id');
	}
	public function discrepancies(){
        return $this->hasMany('Modules\AccountManagement\Entities\UserDiscrepancy','producer_id','id');
	}
	public function requestedItems(){
        return $this->hasOne('Modules\AccountManagement\Entities\RequestedItem','producer_id','id');
	}
	public function customization_settings(){
        return $this->hasOne('Modules\AccountManagement\Entities\CustomizationSetting','producer_id','id');
	}
    
    public function getImage(){
        return $this->hasOne(UploadFile::class,'id','image');
    }
    
    public function coldChainStandard(){
        return $this->hasMany('Modules\AccountManagement\Entities\ColdChainStandard','producer_id','id');
    }

    /**
     * Create Relationship For Sop Specifications
     */
    public function sop_settings(){
        return $this->hasOne(specificationSopSetting::class,'producer_id','id');
	}
	
	public function acceptable_species(){
        return $this->hasMany(acceptableSpecy::class,'producer_id','id');
	}
	public function fresh_fish_test(){
        return $this->hasMany(freshFish::class,'producer_id','id');
	}
	public function length_width_specification(){
        return $this->hasMany(SpecType::class,'producer_id','id');
	}
    
	public function chemical_criterias(){
        return $this->hasMany(chemicalCriteria::class,'producer_id','id');
	}
	public function heavy_metals(){
        return $this->hasMany(heavyMetal::class,'producer_id','id');
	}
	public function microbiological_criterias(){
        return $this->hasMany(microbiologicalCriteria::class,'producer_id','id');
	}

	public function sop_files(){
        return $this->hasMany(SopFile::class,'producer_id','id');
	}

    
}
