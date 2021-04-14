<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAccess extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','access_id','access_right','is_validated'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\UserAccessFactory::new();
    }
     
    public function access(){
        return $this->belongsTo('Modules\AccountManagement\Entities\MasterAccess', 'access_id', 'id');
    }
    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }

}
