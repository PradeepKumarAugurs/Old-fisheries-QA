<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineQcThowingBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_qc_thowing_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('lot_number')->nullable();
            $table->string('production_date')->nullable();
            $table->string('invoiced_weight')->nullable();
            $table->string('frozen_weight')->nullable();
            $table->string('total_pieces')->nullable();
            $table->string('good_fish_image')->nullable();
            $table->string('discrepancies_image')->nullable();
            $table->string('total_descepancies_weight')->nullable();
            $table->string('net_thowing_weight')->nullable();
            $table->string('good_fish_weight')->nullable();
            $table->string('comment')->nullable();
            $table->string('thowing_image')->nullable();
            $table->string('prevalance')->nullable();
            $table->string('intencesity')->nullable();
            $table->string('guts')->nullable();
            $table->string('anus')->nullable();
            $table->string('other')->nullable();
            $table->string('signature_image')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('online_qc_thowing_blocks')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('online_qc_thowing_blocks')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('online_qc_thowing_blocks')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('online_qc_thowing_blocks');
    }
}
