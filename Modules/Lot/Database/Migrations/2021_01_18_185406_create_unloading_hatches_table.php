<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnloadingHatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unloading_hatches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('arrival_id')->nullable();    
            $table->foreign('arrival_id')->references('id')->on('fish_arrivals')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('fishing_hatch_id')->nullable();   // relate to  fish hatches table (ID) 
            $table->foreign('fishing_hatch_id')->references('id')->on('fishing_hatches')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('hatch_id')->nullable();      
            $table->string('start_time')->nullable(); 
            $table->string('end_time')->nullable(); 
            $table->string('fish_teprature')->nullable(); 

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
        Schema::dropIfExists('unloading_hatches');
    }
}
