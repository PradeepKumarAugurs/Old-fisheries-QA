<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_audits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producer_id')->nullable();
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade')->onUpdate('cascade');
            $table->text('information')->nullable();
            $table->enum('is_factory_approved', ['0', '1','2'])->default('1')->comment('0=>No,1=>yes,2=>N\A');
            $table->date('audit_date')->nullable();
            $table->string('scoring')->nullable();
            $table->string('row_material')->nullable();
            $table->string('processing_facilities')->nullable();
            $table->string('respect_cold_chain')->nullable();
            $table->string('storage')->nullable();
            $table->string('traceability')->nullable();
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
        Schema::dropIfExists('user_audits');
    }
}
