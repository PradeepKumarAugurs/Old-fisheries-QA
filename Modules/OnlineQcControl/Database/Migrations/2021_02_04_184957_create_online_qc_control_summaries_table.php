<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineQcControlSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_qc_control_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('lot_number')->nullable();
            $table->string('production_date')->nullable();
            $table->string('total_invoiced_weight')->nullable();
            $table->string('total_net_weight')->nullable();
            $table->string('total_temp')->nullable();
            $table->string('total_soft')->nullable();
            $table->string('total_tail')->nullable();
            $table->string('guts_pcs')->nullable();
            $table->string('guts_weight_grm')->nullable();
            $table->string('total_pieces')->nullable();
            $table->string('total_broken_belly')->nullable();
            $table->string('hd')->nullable();
            $table->string('ld')->nullable();
            $table->string('sbb')->nullable();
            $table->string('bb')->nullable();
            $table->string('os')->nullable();
            $table->string('inspected_by')->nullable();
            $table->string('verified_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('online_qc_control_summaries')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('online_qc_control_summaries')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('online_qc_control_summaries')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('online_qc_control_summaries');
    }
}
