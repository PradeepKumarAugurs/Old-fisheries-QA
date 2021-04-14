<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expedition extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','key','value'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\ExpeditionFactory::new();
    }
}
