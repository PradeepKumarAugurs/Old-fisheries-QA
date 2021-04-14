<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class masterDiscrepancy extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['producer_id','discrepancies','discrepancy_key','rejection_value','border_value','unit','type','image'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\MasterDiscrepancyFactory::new();
    }
}
