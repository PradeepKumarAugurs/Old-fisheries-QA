<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customizationSetting extends Model
{
    use HasFactory; 
    protected $fillable = ['producer_id','temperature_ckeck_reminder_timescale','custom_reminder_timescale_day',
    'minimum_temperature','other_minimum_temperature','continuous_freezing','other_continuous_freezing','length_width_detribution','weight_calibration','control_frequency','standard_drip_loss_value','standard_guts_weight'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\CustomizationSettingFactory::new();
    }
}
