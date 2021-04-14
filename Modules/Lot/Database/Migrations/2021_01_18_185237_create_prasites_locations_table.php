<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrasitesLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prasites_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('arrival_id')->nullable();    
            $table->foreign('arrival_id')->references('id')->on('fish_arrivals')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('lot_parasite_id')->nullable();    
            $table->foreign('lot_parasite_id')->references('id')->on('lot_parasites')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('guts')->nullable();
            $table->integer('meat')->nullable();
            $table->integer('anus')->nullable();
            $table->integer('other')->nullable();
            $table->integer('total_parasite')->nullable();
            
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
        Schema::dropIfExists('prasites_locations');
    }
}
