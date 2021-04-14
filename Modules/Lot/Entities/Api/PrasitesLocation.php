<?php

namespace Modules\Lot\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrasitesLocation extends Model
{
    use HasFactory;

    protected $fillable = ['arrival_id','lot_parasite_id','guts','meat','anus','other','total_parasite','created_by','updated_by','deleted_by'];
    
    protected static function newFactory()
    {
        return \Modules\Lot\Database\factories\PrasitesLocationFactory::new();
    }
}
