<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producer_id')->nullable();
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('spec_type')->nullable();
            $table->foreign('spec_type')->references('id')->on('spec_types')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('spec_id')->nullable();
            $table->foreign('spec_id')->references('id')->on('master_specs')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('is_checked',['0','1'])->default('0')->comment(" 0=>unchecked, 1=> checked");
            $table->string('min_cut_length_offset')->nullable();
            $table->string('max_cut_length_offset')->nullable();
            $table->string('min_cut_weight_offset')->nullable();
            $table->string('max_cut_weight_offset')->nullable();
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
        Schema::dropIfExists('user_specifications');
    }
}
