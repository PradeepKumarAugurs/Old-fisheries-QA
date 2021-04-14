<?php

namespace Modules\Lot\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
class LotDatabaseSeeder extends Seeder
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
        DB::table('units')->insert([
            ['title' => 'Block','description' => null],
            ['title' => 'Carton','description' => null],
            ['title' => 'Tote','description' => null],
            ['title' => 'Bag','description' => null],
            ['title' => 'Other','description' => null]
        ]);

        DB::table('zones')->insert([
            ['country_id'=>'1','title' => 'Choshi','description' => 'Choshi'],
            ['country_id'=>'1','title' => 'Ishinomaki','description' => 'Ishinomaki'],
            ['country_id'=>'1','title' => 'Hasaki','description' => 'Hasaki'],
            ['country_id'=>'1','title' => 'Fukuoka','description' => 'Fukuoka'],
            ['country_id'=>'1','title' => 'Onahama','description' => 'Onahama'],
            ['country_id'=>'1','title' => 'Sakaiminato','description' => 'Sakaiminato'],
            ['country_id'=>'1','title' => 'Fukushima','description' => 'Fukushima'],
            ['country_id'=>'2','title' => 'Xinshun','description' => 'Xinshun'],
            ['country_id'=>'2','title' => 'Zhoushan','description' => 'Zhoushan'],
            ['country_id'=>'2','title' => 'Ningbo','description' => 'Ningbo'],
            ['country_id'=>'2','title' => 'Rongsheng','description' => 'Rongsheng'],
            ['country_id'=>'2','title' => 'Dongshan','description' => 'Dongshan'],
            ['country_id'=>'3','title' => 'Vladivostok','description' => 'Vladivostok'],
            ['country_id'=>'4','title' => 'Scheveningen','description' => 'Scheveningen'],
            ['country_id'=>'5','title' => 'Monterrey','description' => 'Monterrey'],
            ['country_id'=>'5','title' => 'NewBedford','description' => 'NewBedford'],
            ['country_id'=>'5','title' => 'Astoria','description' => 'Astoria'],
            ['country_id'=>'5','title' => 'Westport','description' => 'Westport'],
            ['country_id'=>'5','title' => 'Gloucester','description' => 'Gloucester'],
            ['country_id'=>'6','title' => 'Guaymas','description' => 'Guaymas'],
            ['country_id'=>'6','title' => 'Ensenada','description' => 'Ensenada'],
            ['country_id'=>'6','title' => 'SanCarlos','description' => 'SanCarlos'],
            ['country_id'=>'6','title' => 'StaRosalia','description' => 'StaRosalia'],
            ['country_id'=>'6','title' => 'BahiaTortugas','description' => 'BahiaTortugas'],
            ['country_id'=>'7','title' => 'Agadir','description' => 'Agadir'],
            ['country_id'=>'7','title' => 'Dakhla','description' => 'Dakhla'],  
            ['country_id'=>'7','title' => 'Laayoune','description' => 'Laayoune'],
            ['country_id'=>'7','title' => 'Boujdour','description' => 'Boujdour'],
            ['country_id'=>'7','title' => 'Tantan','description' => 'Tantan'],
            ['country_id'=>'8','title' => 'Nouhadibouh','description' => 'Nouhadibouh'],
        ]);

        DB::table('master_parasites')->insert([
            ['parasite_name' => 'Anisakis','parasite_image'=>'anisakis.jpg','description' => 'Anisakis']
        ]);
        

        DB::table('types')->insert([
            ['title'=>'WR', 'description'=> 'WR'],
            ['title'=>'HG', 'description'=> 'HG'],
            ['title'=>'HGT', 'description'=> 'HGT'],
            ['title'=>'HG-T', 'description'=> 'HG-T']
        ]);

        DB::table('qualities')->insert([
            ['title'=>'P', 'description'=>'P'],
            ['title'=>'A', 'description'=>'A'],
            ['title'=>'B', 'description'=>'B'],
            ['title'=>'C', 'description'=>'C'],
            ['title'=>'Other', 'description'=>'Other']
        ]);
        
    }
}
