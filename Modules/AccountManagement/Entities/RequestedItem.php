<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class requestedItem extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','wr_weight','wr_length','cut_weight','cut_length','parasites'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\RequestedItemFactory::new();
    }
}
