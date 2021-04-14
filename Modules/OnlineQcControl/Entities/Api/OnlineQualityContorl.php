<?php

namespace Modules\OnlineQcControl\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineQualityContorl extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['lot_number','production_date','invoiced_weight','net_weight','temp','soft','tail','guts_pcs','guts_weight_grm','total_piceces','broken_belly','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\OnlineQcControl\Database\factories\OnlineQualityContorlFactory::new();
    }
}
