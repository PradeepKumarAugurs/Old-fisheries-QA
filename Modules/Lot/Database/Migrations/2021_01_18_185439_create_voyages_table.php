<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('arrival_id')->nullable();    
            $table->foreign('arrival_id')->references('id')->on('fish_arrivals')->onDelete('cascade')->onUpdate('cascade');
            $table->string('truck_id')->nullable();
            $table->string('hatch_id')->nullable(); 
            // $table->unsignedBigInteger('hatch_id')->nullable();  // relate to  fish hatches table (ID) 
            // $table->foreign('hatch_id')->references('id')->on('fishing_hatches')->onDelete('cascade')->onUpdate('cascade');
            $table->string('port_departure_time')->nullable();
            $table->string('truck_image')->nullable();
            $table->string('plant_arrival_time')->nullable();
            $table->string('production_which_from')->nullable();
            $table->string('factory_arrival_time')->nullable();
            $table->string('transportation_time')->nullable();
            $table->string('added_ice')->nullable();
            $table->string('add_water')->nullable();
            $table->string('type_of_recipient')->nullable();
            $table->string('recipient_image')->nullable();
            $table->string('weight_bundle')->nullable();
            $table->string('number_of_bundles')->nullable();
            $table->string('net_weight')->nullable();
            $table->string('gross_weight')->nullable();
            $table->enum('climate_controle',['0','1'])->default('0')->comment(' 0 => no ,  1 => yes ');
            $table->text('comment')->nullable();
            
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
        Schema::dropIfExists('voyages');
    }
}
