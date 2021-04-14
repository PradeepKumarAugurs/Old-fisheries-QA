<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        DB::table('company_positions')->insert([
            ['position'=>'Quality Manager'],
            ['position'=>'General Manager'],
            ['position'=>'Stock Manager ']
        ]);
        DB::table('users')->insert([
            'username' => 'admin','name' => 'Admin','password' => bcrypt("12345678"),'email' => 'admin@gmail.com','type' =>1, 'role' => 1,'is_leader' => 1,'leader_id' => 1
        ]);

    }
}
