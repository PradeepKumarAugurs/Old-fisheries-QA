<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVesselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessels', function (Blueprint $table) {
            $table->id();
            $table->string('vessel_name')->nullable();
            $table->string('vessel_registration')->nullable();
            $table->string('unique_indentification')->nullable();
            $table->string('public_registry_hyperlink')->nullable();
            $table->string('vessel_flag')->nullable();
            $table->string('availlability_catch_coordinates')->nullable();
            $table->string('satellite_tracking_authority')->nullable();
            $table->string('transshipment_vessel_name')->nullable();
            $table->string('transshipment_unique_identification')->nullable();
            $table->string('transshipment_vessel_flag')->nullable();
            $table->string('transshipment_vessel_registration')->nullable();
            $table->string('fishery_improvement_project')->nullable();
            $table->string('fishing_authorization')->nullable();
            $table->string('hervest_certification')->nullable();
            $table->string('hervest_certification_chain_custody')->nullable();
            $table->string('transshipment_authorization')->nullable();
            $table->string('landing_authorization')->nullable();
            $table->string('human_welfare_policy_standards')->nullable();
            $table->string('existence_human_wefare_policy')->nullable();
            $table->string('fishing_gear')->nullable();
            $table->string('fish_transfer')->nullable();
            $table->string('nominal_capacity')->nullable();
            $table->string('hatches')->nullable();
            $table->string('rsw')->nullable();
            $table->string('hp_rsw')->nullable();
            $table->string('ice_trip')->nullable();
            $table->string('status')->nullable(); // status
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessels');
    }
}
