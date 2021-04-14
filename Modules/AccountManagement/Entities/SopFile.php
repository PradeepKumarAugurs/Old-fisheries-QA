<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AccountManagement\Entities\UploadFile;
class SopFile extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','file_id'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\SopFileFactory::new();
    }

    public function file_details(){
        return $this->belongsTo('Modules\AccountManagement\Entities\UploadFile','file_id','id');
    }
}
