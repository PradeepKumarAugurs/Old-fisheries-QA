<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('master_specs');
        Schema::create('master_specs', function (Blueprint $table) {
            $table->id();
            $table->string('cut_type')->nullable();
            $table->string('letter')->nullable();
            $table->string('min_cut_length')->nullable();
            $table->string('max_cut_length')->nullable();
            $table->string('min_cut_weight')->nullable();
            $table->string('max_cut_weight')->nullable();
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
        Schema::dropIfExists('master_specs');
    }
}
