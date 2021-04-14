<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ColdChainStandard extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','section_id','title','target_value','border_value'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\ColdChainStandardFactory::new();
    }
}
