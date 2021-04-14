<?php

namespace Modules\Lot\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Type extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title','description','created_by','updated_by','deleted_by','deleted_at'];
    
    protected static function newFactory()
    {
        return \Modules\Lot\Database\factories\TypeFactory::new();
    }
}
