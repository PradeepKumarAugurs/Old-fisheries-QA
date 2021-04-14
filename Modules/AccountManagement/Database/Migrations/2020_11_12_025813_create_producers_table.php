<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            //$table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('city_id')->nullable();
           // $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->string('code')->nullable();
            $table->string('alpha_code')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('leader_id')->nullable();
            //$table->string('producer_type')->nullable();
            $table->enum('producer_type',['1','2'])->default('1')->comment('1=>Landbase,2=>Onboarding Processing');
            $table->string('fao_fishing_zone')->nullable();
            $table->string('total_capacity_of_storage_reception')->nullable();
            $table->string('total_grading_capacity')->nullable();
            $table->string('total_wr_processing_capacity')->nullable();
            $table->string('total_cutting_capacity')->nullable();
            $table->string('total_batch_freezing_capacity')->nullable();
            $table->string('total_continuouse_freezing_capacity')->nullable();
            $table->string('total_storage_capacity')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('producers');
    }
}
