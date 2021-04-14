<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterSpec extends Model
{
    use HasFactory;

    protected $fillable = ['cut_type','letter','min_cut_length','max_cut_length','min_cut_weight','max_cut_weight'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\MasterSpecFactory::new();
    }

    
}
