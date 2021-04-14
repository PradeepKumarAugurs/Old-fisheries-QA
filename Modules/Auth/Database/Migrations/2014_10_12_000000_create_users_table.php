<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('guid')->nullable();
            $table->string('username', 250)->nullable();
            $table->string('name', 250)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('mobile_no', 250)->nullable();
            $table->string('position')->nullable();
            $table->string('identification')->nullable();
            $table->enum('type',['1', '2'])->default('2')->comment("1->'internal', 2->'external'");
            $table->enum('role',['1','2','3','4','5'])->default('5')->comment("'admin', 'supplier','producer','third party surveyor','internal user'");
            $table->enum('is_leader',['0', '1'])->default('0');
            $table->unsignedBigInteger('leader_id')->nullable();
            // $table->foreign('leader_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company', 250)->nullable();
            $table->string('production_capacity', 250)->nullable();
            $table->string('storage_capacity', 250)->nullable();
            $table->enum('boat_contract',['0', '1'])->default('0');
            $table->enum('boat_owner',['0', '1'])->default('0');
            $table->string('boat_contract_capacity')->default('0');
            $table->string('boat_owner_capacity')->default('0');
            $table->string('logo', 5000)->nullable();
            $table->string('phone_no', 250)->nullable();
            $table->string('address', 250)->nullable();
            $table->string('city', 250)->nullable();
            $table->string('state', 250)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('country_code', 3)->nullable();
            $table->string('zip', 100)->nullable();
            $table->string('device_type', 250)->nullable();
            $table->string('user_image', 250)->nullable();
            $table->string('device_id', 250)->nullable();
            $table->string('last_login', 250)->nullable();
            $table->timestamps();
        });
    }

        
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
