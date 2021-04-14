<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAudit extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','information','is_factory_approved','audit_date','scoring','row_material','processing_facilities','respect_cold_chain','storage','traceability'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\UserAuditFactory::new();
    }
}
