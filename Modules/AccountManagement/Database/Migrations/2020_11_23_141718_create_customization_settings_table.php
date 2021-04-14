<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomizationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customization_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producer_id')->nullable();
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('temperature_ckeck_reminder_timescale', ['1', '2','3','4','5','6','7'])->default('1')->comment('1=>every day,2=>every Week,3=>every 2 days,4=>Every 2 week,5=>every 4 days,6=>every 3 week,7=>other');
            $table->string('custom_reminder_timescale_day')->nullable();
            $table->enum('minimum_temperature', ['1', '2','3','4'])->default('2')->comment('1=>-23 C, 2=>-24 C,3=>25 C ,4=>other');
            $table->string('other_minimum_temperature')->nullable();
            $table->enum('continuous_freezing',['1', '2','3','4','5'])->default('3')->comment('1=>15 Min,2=>30 min,3=>45 min,4=> 1 hour,5=>other');
            $table->string('other_continuous_freezing')->nullable();
            $table->enum('length_width_detribution', ['0', '1'])->default('0');
            $table->enum('weight_calibration',['0','1'])->default('0')->comment("0 => uncheck, 1 => Checked");
            $table->enum('control_frequency',['0','1','2'])->default('0')->comment("0 => Eeach lot, 1 => Once day, 2=> First Production");
            $table->string('standard_drip_loss_value')->nullable();
            $table->string('standard_guts_weight')->nullable();
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
        Schema::dropIfExists('customization_settings');
    }
}
