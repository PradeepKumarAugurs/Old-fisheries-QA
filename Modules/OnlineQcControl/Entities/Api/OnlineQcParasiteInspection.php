<?php

namespace Modules\OnlineQcControl\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineQcParasiteInspection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['lot_number','production_date','block_id','sample','counting_parasites','image','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\OnlineQcControl\Database\factories\OnlineQcParasiteInspectionFactory::new();
    }
}
