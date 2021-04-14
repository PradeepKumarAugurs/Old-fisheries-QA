<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificationSopSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specification_sop_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producer_id')->nullable();
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade')->onUpdate('cascade');
            $table->text('production_and_storage_facilities')->nullable();
            $table->string('hgt_fish_cut',5000)->nullable();
            $table->string('hg_fish_cut',5000)->nullable();
            $table->enum('hgt_fish_cut_checkbox',['0','1'])->default('0');
            $table->enum('hg_fish_cut_checkbox',['0','1'])->default('0');
            $table->enum('sardine', ['0', '1'])->default('0');
            $table->enum('mackerel', ['0', '1'])->default('0');
            $table->string('specification_sop_file',5000)->nullable();
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
        Schema::dropIfExists('specification_sop_settings');
    }
}
