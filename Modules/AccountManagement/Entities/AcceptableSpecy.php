<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class acceptableSpecy extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','acceptable_species_id','scientific_name','common_name'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\AcceptableSpecyFactory::new();
    }
}
