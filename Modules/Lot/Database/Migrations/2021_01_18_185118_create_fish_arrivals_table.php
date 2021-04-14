<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFishArrivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('fish_arrivals');
        Schema::create('fish_arrivals', function (Blueprint $table) {
            $table->id();

            $table->string('arrival_id')->nullable();
            $table->date('landing_date')->nullable(); 
            $table->string('unloading_place')->nullable();     //  connected to the master table  Zones
            $table->unsignedBigInteger('vessel_id')->nullable();     //  connected to the master table  Vessels
            $table->unsignedBigInteger('sequence')->nullable();
            $table->date('fishing_date')->nullable();
            $table->unsignedBigInteger('fishing_zone')->nullable();  //  connected to the master table  Zones
            $table->string('ice_onboard')->nullable();
            
            $table->integer('number_of_catches')->nullable(); 
            $table->integer('total_fish_quantity')->nullable();
            $table->integer('total_fishing_time')->nullable();     //  hours only  
            $table->date('unloading_date')->nullable();
            $table->date('unloading_places')->nullable();
            $table->string('added_ice')->nullable();
            $table->string('unloading_comment')->nullable();
            $table->integer('number_of_voyages')->nullable();

            $table->string('meat_texture')->nullable();
            $table->string('freshness')->nullable();
            $table->string('scales')->nullable();
            $table->string('belly_thickness')->nullable();  
            $table->string('belly_strength')->nullable();
            $table->string('fat_content')->nullable();
            $table->string('fat_content_image')->nullable();
            $table->string('fat_content_percentage')->nullable();       
            $table->string('feed')->nullable();       
            $table->integer('small_feed')->nullable();       
            $table->integer('medium_feed')->nullable();       
            $table->integer('large_feed')->nullable();       
            $table->integer('extra_large_feed')->nullable();       
            $table->text('feed_comment')->nullable();    
            $table->string('feed_charatestic_image')->nullable();

            $table->string('reception_fish_temprature')->nullable();     
            $table->string('fish_temp_image')->nullable(); 

            $table->string('resistance_test_small')->nullable(); 
            $table->string('resistance_test_medium')->nullable(); 
            $table->string('resistance_test_large')->nullable(); 

            $table->unsignedBigInteger('created_by')->nullable();    
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();    
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();    
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('fish_arrivals');
    }
}
