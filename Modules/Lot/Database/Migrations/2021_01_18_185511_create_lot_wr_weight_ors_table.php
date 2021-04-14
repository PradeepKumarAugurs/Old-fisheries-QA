<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotWrWeightOrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_wr_weight_ors', function (Blueprint $table) {
            $table->id();
            $table->string('lot_number')->nullable();
            $table->date('production_date')->nullable();
            $table->enum('type',['1','2','3','4'])->default('1')->comment('1 => fresh, 2 => descripancies, 3 => other species , 4 => foreign matter '); 
            $table->string('weight')->nullable();
            $table->text('discription')->nullable();
            $table->enum('other_lots',['0','1'])->default('0')->comment('0 => no , 1=>  yes ');
            $table->enum('gradding_method',['0','1','2'])->default('0')->comment('0 => none,1=>machanical , 2=> manual ');
            $table->string('gradding_lots')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();    
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();    
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();    
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('lot_wr_weight_ors');
    }
}
