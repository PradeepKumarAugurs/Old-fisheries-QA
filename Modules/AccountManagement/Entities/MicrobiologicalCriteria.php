<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class microbiologicalCriteria extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','germs','n','c','nm','cm'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\MicrobiologicalCriteriaFactory::new();
    }
}
