<?php

namespace Modules\OnlineQcControl\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineQcControl extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['lot_number','production_date','production_line','standard_weight','balance_reading','balance_accuracy','image','control_name','control_time','fish_temp','invoice_weight','net_weight','control_image','control_images','total_speces','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\OnlineQcControl\Database\factories\OnlineQcControlFactory::new();
    }
    
    
}
