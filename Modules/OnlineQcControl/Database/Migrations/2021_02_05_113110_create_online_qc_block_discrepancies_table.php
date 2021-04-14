<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineQcBlockDiscrepanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_qc_block_discrepancies', function (Blueprint $table) {
            $table->id();
            $table->string('lot_number')->nullable();
            $table->string('production_date')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('block_id')->nullable();
            $table->bigInteger('user_discr_id')->nullable();
            $table->bigInteger('discrepancy_id')->nullable();
            $table->string('rejection_offset_value')->nullable();
            $table->string('border_offset_value')->nullable();
            $table->string('discrepancies_weight')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('online_qc_block_discrepancies')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('online_qc_block_discrepancies')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('online_qc_block_discrepancies')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('online_qc_block_discrepancies');
    }
}
