<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterDiscrepanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_discrepancies', function (Blueprint $table) {
            $table->id();
            $table->string('discrepancies')->nullable();
            $table->string('discrepancy_key')->nullable();
            $table->string('rejection_value')->nullable();
            $table->string('border_value')->nullable();
            $table->string('unit')->nullable();
            $table->binary('image')->nullable();
            $table->enum('type',['1','2','3'])->default('3')->comment('1=> WR, 2=> Cut  fish, 3=> WR And Cut  Fish');
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
        Schema::dropIfExists('master_discrepancies');
    }
}
