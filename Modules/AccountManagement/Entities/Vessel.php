<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vessel extends Model
{
    use HasFactory;

    protected $fillable = ['vessel_name','vessel_registration','unique_indentification','public_registry_hyperlink','vessel_flag','availlability_catch_coordinates','satellite_tracking_authority','transshipment_vessel_name','transshipment_unique_identification','transshipment_vessel_flag','transshipment_vessel_registration','fishery_improvement_project','fishing_authorization','hervest_certification','hervest_certification_chain_custody','transshipment_authorization','landing_authorization','human_welfare_policy_standards','existence_human_wefare_policy','fishing_gear','fish_transfer','nominal_capacity','hatches','rsw','hp_rsw','ice_trip','status'];
    
    protected static function newFactory()
    {
        return \Modules\AccountManagement\Database\factories\VesselFactory::new();
    }
}
