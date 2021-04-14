<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producer_id')->nullable();
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('raw_wr_weight')->default('30')->nullable();
            $table->enum('raw_wr_weight_is_checked',['0','1'])->default('0')->comment(" 0=> Uncheck , 1=> Checked ");
            $table->string('raw_wr_length')->default('30')->nullable();
            $table->enum('raw_wr_length_is_checked',['0','1'])->default('0')->comment(" 0=> Uncheck , 1=> Checked ");
            $table->string('raw_cut_fish_weight')->default('30')->nullable();
            $table->enum('raw_cut_fish_weight_is_checked',['0','1'])->default('0')->comment(" 0=> Uncheck , 1=> Checked ");
            $table->string('raw_cut_fish_length')->default('30')->nullable();
            $table->enum('raw_cut_fish_length_is_checked',['0','1'])->default('0')->comment(" 0=> Uncheck , 1=> Checked ");
            $table->string('finished_product_wr_weight')->default('30')->nullable();
            $table->enum('finished_product_wr_weight_is_checked',['0','1'])->default('0')->comment(" 0=> Uncheck , 1=> Checked ");
            $table->string('finished_product_wr_length')->default('30')->nullable();
            $table->enum('finished_product_wr_length_is_checked',['0','1'])->default('0')->comment(" 0=> Uncheck , 1=> Checked ");
            $table->string('finished_product_cut_fish_weight')->default('30')->nullable();
            $table->enum('finished_product_cut_fish_weight_is_checked',['0','1'])->default('0')->comment(" 0=> Uncheck , 1=> Checked ");
            $table->string('finished_product_cut_fish_length')->default('30')->nullable();
            $table->enum('finished_product_cut_fish_length_is_checked',['0','1'])->default('0')->comment(" 0=> Uncheck , 1=> Checked ");
            // $table->string('parasites')->default('30')->nullable();
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
        Schema::dropIfExists('requested_items');
    }
}
