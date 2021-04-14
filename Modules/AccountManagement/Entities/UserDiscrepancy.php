<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class userDiscrepancy extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','discrepancy_id','discrepancies','discrepancy_key','rejection_value','rejection_offset_value','border_value','border_offset_value','unit','is_checked'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\UserDiscrepancyFactory::new();
    }

    // public function user(){
    //     return $this->belongsTo('Modules\Auth\Entities\User','user_id','id');
    // }
}
