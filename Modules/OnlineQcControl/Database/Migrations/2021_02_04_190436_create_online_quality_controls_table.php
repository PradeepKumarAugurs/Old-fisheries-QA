<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineQualityControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_quality_controls', function (Blueprint $table) {
            $table->id();
            $table->string('lot_number')->nullable();
            $table->string('production_date')->nullable();
            $table->string('invoiced_weight')->nullable();
            $table->string('net_weight')->nullable();
            $table->string('temp')->nullable(); 
            $table->string('soft')->nullable();
            $table->string('tail')->nullable();
            $table->string('guts_pcs')->nullable();
            $table->string('guts_weight_grm')->nullable();
            $table->string('total_piceces')->nullable();
            $table->string('broken_belly')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('online_quality_controls')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('online_quality_controls')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('online_quality_controls')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('online_quality_controls');
    }
}
