<?php

namespace Modules\OnlineQcControl\Entities\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Histamine extends Model
{
    use HasFactory;

    protected $fillable = ['lot_number','production_date','histamine_reception','hista_after_freezing','comment','fat_content_measure','fat_content_comment','addition_fields'];
    
    protected static function newFactory()
    {
        return \Modules\OnlineQcControl\Database\factories\HistamineFactory::new();
    }
}
