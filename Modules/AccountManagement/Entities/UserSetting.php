<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class userSetting extends Model
{
    use HasFactory;

    protected $fillable = ['producer_id','wr_fish_online_qc','cut_fish_online_qc'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\UserSettingFactory::new();
    }
}
