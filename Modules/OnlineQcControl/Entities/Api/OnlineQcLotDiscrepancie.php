<?php

namespace Modules\OnlineQcControl\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineQcLotDiscrepancie extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['lot_number','production_date','user_id','block_id','user_discr_id','discrepancy_id','rejection_offset_value','border_offset_value','discrepancies_weight','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\OnlineQcControl\Database\factories\OnlineQcLotDiscrepancieFactory::new();
    }
}
