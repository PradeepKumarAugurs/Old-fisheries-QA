<?php

namespace Modules\OnlineQcControl\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineQcThowingBlock extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['lot_number','production_date','invoiced_weight','frozen_weight','total_pieces','good_fish_image','discrepancies_image','total_descepancies_weight','net_thowing_weight','good_fish_weight','comment','thowing_image','prevalance','intencesity','guts','anus','other','signature_image','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\OnlineQcControl\Database\factories\OnlineQcThowingBlockFactory::new();
    }
}
