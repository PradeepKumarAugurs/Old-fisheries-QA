<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class chemicalCriteria extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','title','title_key','description'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\ChemicalCriteriaFactory::new();
    }
}
