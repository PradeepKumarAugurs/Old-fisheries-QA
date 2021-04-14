<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineQcColdStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_qc_cold_storages', function (Blueprint $table) {
            $table->id();
            $table->string('lot_number')->nullable();
            $table->string('production_date')->nullable();
            $table->string('reading_date')->nullable();
            $table->string('cold_room_number')->nullable();
            $table->string('fish_temp')->nullable();
            $table->string('cold_room_temp')->nullable();
            $table->string('comment')->nullable();
            $table->string('cold_temp_image')->nullable();
            $table->string('cold_temp_images')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('online_qc_cold_storages')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('online_qc_cold_storages')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('online_qc_cold_storages')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('online_qc_cold_storages');
    }
}
