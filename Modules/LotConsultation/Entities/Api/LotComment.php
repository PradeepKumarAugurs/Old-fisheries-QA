<?php

namespace Modules\LotConsultation\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LotComment extends Model
{
    use HasFactory;

    protected $fillable = ['lot_id','lot_number','production_date','lot_comments'];
    
    protected static function newFactory()
    {
        return \Modules\LotConsultation\Database\factories\LotCommentFactory::new();
    }
}
