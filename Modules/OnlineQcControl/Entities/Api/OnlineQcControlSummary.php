<?php

namespace Modules\OnlineQcControl\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineQcControlSummary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['lot_number','production_date','total_invoiced_weight','total_net_weight','total_temp','total_soft','total_tail','guts_pcs','guts_weight_grm','total_pieces','total_broken_belly','hd','ld','sbb','bb','os','inspected_by','verified_by','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\OnlineQcControl\Database\factories\OnlineQcControlSummaryFactory::new();
    }
    


}
