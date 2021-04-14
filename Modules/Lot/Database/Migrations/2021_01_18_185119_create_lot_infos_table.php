<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_infos', function (Blueprint $table) {
            $table->id();
            $table->string('lot_number')->nullable();
            $table->date('production_date')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();    //  connected to  table users
            $table->foreign('supplier_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('producer_id')->nullable();   //  connected to  table users
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('plant_location')->nullable();
            $table->unsignedBigInteger('product')->nullable();
            $table->foreign('product')->references('id')->on('spec_types')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('type')->nullable();
            $table->foreign('type')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('size')->nullable();
            $table->unsignedBigInteger('cut_size_type')->nullable();
            $table->foreign('cut_size_type')->references('id')->on('master_specs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('quality')->nullable();
            $table->foreign('quality')->references('id')->on('qualities')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('unit_id')->nullable();    //  connected to  master  table  unit 
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->string('weight')->nullable();
            $table->string('number_of_unit')->nullable();
            $table->string('total_quantity')->nullable();
            $table->string('fishing_technique')->nullable();
            $table->string('boat')->nullable();
            $table->date('fishing_date')->nullable();
            $table->unsignedBigInteger('fishing_zone')->nullable();  //  connected to the master table  Zones
            $table->string('ice_onboard')->nullable(); 
            $table->integer('number_of_catches')->nullable(); 
            $table->integer('total_fish_quantity')->nullable();   
            $table->integer('total_fishing_time')->nullable();     //  hours only  
            $table->unsignedBigInteger('unloading_place')->nullable();     //  connected to the master table  Zones
            $table->date('unloading_date')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();   
            $table->string('unloading_start_time')->nullable();
            $table->string('unloading_end_time')->nullable();
            $table->string('added_ice')->nullable();
            $table->string('unloading_image',5000)->nullable();
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
            $table->string('resistance_test')->nullable(); 
            $table->string('lot_comments')->nullable();
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
        Schema::dropIfExists('lot_infos');
    }
}
