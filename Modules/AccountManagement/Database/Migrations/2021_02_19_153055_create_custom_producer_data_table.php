<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomProducerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_producer_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producer_id')->nullable();
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('arrival_id')->nullable();
            $table->unsignedBigInteger('custom_field_id')->nullable();
            $table->foreign('custom_field_id')->references('id')->on('custom_fields')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('custom_row_id')->nullable();
            $table->foreign('custom_row_id')->references('id')->on('custom_rows')->onDelete('cascade')->onUpdate('cascade');
            $table->string('value')->nullable();
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
        Schema::dropIfExists('custom_producer_data');
    }
}
