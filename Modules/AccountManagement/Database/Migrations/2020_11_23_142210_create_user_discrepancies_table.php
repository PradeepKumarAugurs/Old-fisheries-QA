<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDiscrepanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_discrepancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producer_id')->nullable();
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('discrepancy_id')->nullable();
            $table->string('rejection_offset_value')->nullable();
            $table->string('border_offset_value')->nullable();
            $table->string('rejection_value')->nullable();
            $table->string('border_value')->nullable();
            $table->enum('is_checked',['0','1'])->default('0')->comment("0 => uncheck, 1 => Checked");
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
        Schema::dropIfExists('user_discrepancies');
    }
}
