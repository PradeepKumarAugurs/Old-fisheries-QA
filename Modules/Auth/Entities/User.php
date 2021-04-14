<?php

namespace Modules\Auth\Entities;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\AccountManagement\Entities\UserAudit;
use Modules\AccountManagement\Entities\CompanyInfo;
use Modules\AccountManagement\Entities\UploadFile;
use Modules\AccountManagement\Entities\AffiliationsCountry;
use Modules\AccountManagement\Entities\AffiliationsProducer;
use Modules\AccountManagement\Entities\Producer;


class User extends Authenticatable
{

	use HasApiTokens, Notifiable;
	
    /**
	* The attributes that are mass assignable.
	*
	* @var array  
	*/
	protected $fillable = [
	'name', 'email', 'password','username','guid','mobile_no','position','identification','type','role','company','production_capacity','storage_capacity','boat_contract','boat_owner','boat_contract_capacity','boat_owner_capacity','is_leader','leader_id','logo','phone_no','country_code'
	,'user_image'];
	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
	'password', 'remember_token',
	];

	public static  function  update_by_condition($updated_data,$condition_array){
        return User::where($condition_array)->update($updated_data);
	}

	public  static function getUser($user_id){
		return User::where('id',$user_id)->first();
	}

	public function audits(){
        return $this->hasOne(UserAudit::class);
	}

	public function company_infos(){
		return $this->hasMany(CompanyInfo::class,'user_id','id');
	}

	public  function logo_files(){
		return $this->hasOne(UploadFile::class,'id','logo');
	}
    
	/**
	 * Get user relations
	 */
    public function affiliations(){
		return $this->hasMany(AffiliationsCountry::class, 'user_id','user_id');
	}
    
	public function profileImage(){
		return $this->hasOne(UploadFile::class, 'id','user_image');
	}
    
	

}
