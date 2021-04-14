<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('access_id')->nullable();
            // $table->foreign('access_id')->references('id')->on('master_accesses')->onDelete('cascade');
            $table->enum('access_right', ['0', '1','2','3'])->default('3')->comment('0=>view,1=>edit(view),2=>delete(view,edit),3=>all');
            $table->enum('is_validated', ['0', '1','2'])->default('2')->comment('0=>true,1=>false,2=>null');
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
        Schema::dropIfExists('user_accesses');
        // $table->dropForeign(['user_id']);
        // $table->dropForeign(['access_id']);
    }
}
