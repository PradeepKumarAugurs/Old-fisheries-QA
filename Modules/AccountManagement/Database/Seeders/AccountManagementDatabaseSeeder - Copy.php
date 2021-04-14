<?php

namespace Modules\AccountManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class AccountManagementDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('master_accesses')->insert([
            ['title'=>'Production & Quality','title_key'=>'productionQuality','parent_id' => '0','description' => 'Production & Quality'],
            ['title'=>'Export QC Database','title_key'=>'exportQcDatabase','parent_id' => '1','description' => 'Export QC Database'],
            ['title'=>'Raw Material','title_key'=>'rawMaterial','parent_id' => '1','description' => 'Raw Material'],
            ['title'=>'New Fish Arrival','title_key'=>'newFishArrival','parent_id' => '3','description' => 'New Fish Arrival'],
            ['title'=>'Fishing','title_key'=>'fishing','parent_id' => '4','description' => 'Fishing'],
            ['title'=>'Unloading','title_key'=>'unloading','parent_id' => '4','description' => 'Unloading'],
            ['title'=>'Transport','title_key'=>'transport','parent_id' => '4','description' => 'Transport'],
            ['title'=>'Parasitism','title_key'=>'parasitism','parent_id' => '4','description' => 'Parasitism'],
            ['title'=>'Organoleptic/feed/resistance','title_key'=>'organolepticFeedResistance','parent_id' => '4','description' => 'Organoleptic Feed Resistance'],
            ['title'=>'Raw Material Distribution','title_key'=>'rawMaterialDistribution','parent_id' => '4','description' => 'Raw Material Distribution'],
            ['title'=>'List Of Arrival','title_key'=>'listOfArrival','parent_id' => '3','description' => 'List Of Arrival'],
            ['title'=>'New Lot','title_key'=>'newLot','parent_id' => '1','description' => 'New Lot'],
            ['title'=>'Lot Info','title_key'=>'lotInfo','parent_id' => '12','description' => 'Lot Info'],
            ['title'=>'Online Qc','title_key'=>'onlineQc','parent_id' => '12','description' => 'Online Qc'],
            ['title'=>'Finish Product Distribution','title_key'=>'finishProductDistribution','parent_id' => '12','description' => 'Finish Product Distribution'],
            ['title'=>'Lab Analysis','title_key'=>'labAnalysis','parent_id' => '12','description' => 'Lab Analysis'],
            ['title'=>'Cold Chain','title_key'=>'coldChain','parent_id' => '12','description' => 'Cold Chain'],
            ['title'=>'Thawing Inspection','title_key'=>'thawingInspection','parent_id' => '12','description' => 'Thawing Inspection'],
            ['title'=>'Spot Inspection','title_key'=>'spotInspection','parent_id' => '1','description' => 'Spot Inspection'],
            ['title'=>'Lot Consultation','title_key'=>'lotConsultation','parent_id' => '1','description' => 'Lot Consultation'],
            ['title'=>'Edit','title_key'=>'edit','parent_id' => '20','description' => 'Edit'],
            ['title'=>'Qc Report Access','title_key'=>'qcReportAccess','parent_id' => '20','description' => 'Qc Report Access'],
            ['title'=>'Export Qc Lot Report','title_key'=>'exportQcLotReport','parent_id' => '22','description' => 'Export Qc Lot Report'],
            ['title'=>'Lot Status','title_key'=>'lotStatus','parent_id' => '20','description' => 'Lot Status'],
            ['title'=>'Size Allocation','title_key'=>'sizeAllocation','parent_id' => '24','description' => 'Size Allocation'],
            ['title'=>'Select The Status','title_key'=>'selectTheStatus','parent_id' => '24','description' => 'Select The Status'],
            ['title'=>'Select The Priority','title_key'=>'selectThePriority','parent_id' => '24','description' => 'Select The Priority'],
            ['title'=>'Export Non-Conformance Database','title_key'=>'exportNonConformanceDatabase','parent_id' => '24','description' => 'Export Non-Conformance Database'],
            ['title'=>'Scars','title_key'=>'scars','parent_id' => '1','description' => 'Scars'],
            ['title'=>'Export Scars Report','title_key'=>'exportScarsReport','parent_id' => '29','description' => 'Export Scars Report'],
            ['title'=>'Export Scars Database','title_key'=>'exportScarsDatabase','parent_id' => '29','description' => 'Export Scars Database'],
            ['title'=>'Specification & Sop`s','title_key'=>'specificationSop','parent_id' => '1','description' => 'Specification & Sop`s'],
            ['title'=>'Inventory & Shipment','title_key'=>'inventoryShipment','parent_id' => '0','description' => 'Inventory & Shipment'],
            ['title'=>'Inventory Management','title_key'=>'inventoryManagement','parent_id' => '33','description' => 'Inventory Management'],
            ['title'=>'Shipment Preparation','title_key'=>'shipmentPreparation','parent_id' => '33','description' => 'Shipment Preparation'],
            ['title'=>'Container Loading Inspection','title_key'=>'containerLoadingInspection','parent_id' => '33','description' => 'Container Loading Inspection'],
            
    ]); 
        DB::table('countries')->insert([
            ["sortname"=>"JP","name"=>"Japan","continent"=>"Asia", "name_key"=>"japan","phonecode"=>81],
            ["sortname"=>"CN","name"=>"China","continent"=>"Asia", "name_key"=>"china","phonecode"=>86],
            ["sortname"=>"RU","name"=>"Russia","continent"=>"Asia", "name_key"=>"russia","phonecode"=>70],
            ["sortname"=>"RU","name"=>"Russia","continent"=>"Europe", "name_key"=>"russia","phonecode"=>70],
            ["sortname"=>"NL","name"=>"Netherlands The", "continent"=>"Europe", "name_key"=>"netherlandsThe","phonecode"=>31],
            ["sortname"=>"US","name"=>"United States","continent"=>"America","name_key"=>"unitedStates","phonecode"=>1],
            ["sortname"=>"MX","name"=>"Mexico","continent"=>"America","name_key"=>"mexico","phonecode"=>52],
            ["sortname"=>"MA","name"=>"Morocco","continent"=>"Africa","name_key"=>"morocco","phonecode"=>212], 
            ["sortname"=>"MR","name"=>"Mauritania","continent"=>"Africa","name_key"=>"mauritania","phonecode"=>222],
            ["sortname"=>"RS","name"=>"Serbia","continent"=>"Africa","name_key"=>"serbia","phonecode"=>381],
            ["sortname"=>"NA","name"=>"Namibia","continent"=>"Africa","name_key"=>"namibia","phonecode"=>264],
            ["sortname"=>"EC","name"=>"Ecuador","continent"=>"America","name_key"=>"ecuador","phonecode"=>593],
            ["sortname"=>"CL","name"=>"Chile","continent"=>"America","name_key"=>"chile","phonecode"=>56],
            ["sortname"=>"PE","name"=>"Peru","continent"=>"America","name_key"=>"peru","phonecode"=>51],
            ["sortname"=>"AR","name"=>"Argentina","continent"=>"America","name_key"=>"argentina","phonecode"=>54],
            ["sortname"=>"TW","name"=>"Taiwan","continent"=>"Asia","name_key"=>"taiwan","phonecode"=>886],
            ["sortname"=>"KR","name"=>"Korea South","continent"=>"Asia","name_key"=>"koreaSouth","phonecode"=>82],
        ]);
        DB::table('producers')->insert([
            ['name'=> 'Del Mar Industrial', 'country_id'=> '7', 'city_id'=> '1', 'code'=> '3216', 'alpha_code'=> 'DMI', 'address'=> '', 'producer_type'=> '', 'fao_fishing_zone'=> 'South Baja pacific']
           
        ]);
        DB::table('sections')->insert([
            ['name' => 'Fishing','name_key' => 'fishing'],
            ['name' => 'Unloading','name_key' => 'Unloading'],
            ['name' => 'Transport','name_key' => 'Transport'],
            ['name' => 'Reception','name_key' => 'Reception'],
            ['name' => 'Production','name_key' => 'Production'],
            ['name' => 'Freezing','name_key' => 'Freezing'],
            ['name' => 'Storage','name_key' => 'Storage']
        ]);

        DB::table('master_discrepancies')->insert([
            ['discrepancies'=>'Mechanical Damage','discrepancy_key'=>'mechanicalDamage','rejection_value'=>'100','border_value'=>'5','unit'=>'%','type'=>'1','image'=>'1.png'],
            ['discrepancies'=>'Broken Belly','discrepancy_key'=>'brokenBelly','rejection_value'=>'100','border_value'=>'3','unit'=>'%','type'=>'1','image'=>'2.png'],
            ['discrepancies'=>'Slightly Broken Belly','discrepancy_key'=>'slightlyBrokenBelly','rejection_value'=>'40','border_value'=>'5','unit'=>'%','type'=>'1','image'=>'3.png'],
            ['discrepancies'=>'Soft','discrepancy_key'=>'soft','rejection_value'=>'100','border_value'=>'3','unit'=>'%','type'=>'1','image'=>'4.png'],
            ['discrepancies'=>'Other Species','discrepancy_key'=>'otherSpecies','rejection_value'=>'100','border_value'=>'3','unit'=>'%','type'=>'1','image'=>'5.png'],
            ['discrepancies'=>'Light Damage','discrepancy_key'=>'iightDamage','rejection_value'=>'0','border_value'=>'3','unit'=>'%','type'=>'1','image'=>'6.png'],
            ['discrepancies'=>'Guts','discrepancy_key'=>'guts','rejection_value'=>'10','border_value'=>'5','unit'=>'%','type'=>'1','image'=>'7.png'],
            ['discrepancies'=>'Guts Weight','discrepancy_key'=>'gutsWeight','rejection_value'=>'15','border_value'=>'3','unit'=>'g','type'=>'1','image'=>'8.png'],

            ['discrepancies'=>'Mechanical Damage','discrepancy_key'=>'mechanicalDamage','rejection_value'=>'100','border_value'=>'5','unit'=>'%','type'=>'2','image'=>'1.png'],
            ['discrepancies'=>'Broken Belly','discrepancy_key'=>'brokenBelly','rejection_value'=>'100','border_value'=>'3','unit'=>'%','type'=>'2','image'=>'2.png'],
            ['discrepancies'=>'Slightly Broken Belly','discrepancy_key'=>'slightlyBrokenBelly','rejection_value'=>'40','border_value'=>'5','unit'=>'%','type'=>'2','image'=>'3.png'],
            ['discrepancies'=>'Soft','discrepancy_key'=>'soft','rejection_value'=>'100','border_value'=>'3','unit'=>'%','type'=>'2','image'=>'4.png'],
            ['discrepancies'=>'Other Species','discrepancy_key'=>'otherSpecies','rejection_value'=>'100','border_value'=>'3','unit'=>'%','type'=>'2','image'=>'5.png'],
            ['discrepancies'=>'Light Damage','discrepancy_key'=>'iightDamage','rejection_value'=>'0','border_value'=>'3','unit'=>'%','type'=>'2','image'=>'6.png'],
            ['discrepancies'=>'Guts','discrepancy_key'=>'guts','rejection_value'=>'10','border_value'=>'5','unit'=>'%','type'=>'2','image'=>'7.png'],
            ['discrepancies'=>'Guts Weight','discrepancy_key'=>'gutsWeight','rejection_value'=>'15','border_value'=>'3','unit'=>'g','type'=>'2','image'=>'8.png']

        ]);

        DB::table('master_specs')->insert([
            ['cut_type'=>'Tall','min_cut_length'=>'10','max_cut_length'=>'11','min_cut_weight'=>'45','max_cut_weight'=>'100'],
            ['cut_type'=>'Jitney','min_cut_length'=>'7.5','max_cut_length'=>'8.75','min_cut_weight'=>'30','max_cut_weight'=>'50'],
            ['cut_type'=>'Buffet','min_cut_length'=>'6.5','max_cut_length'=>'7.25','min_cut_weight'=>'34','max_cut_weight'=>'80'],
            ['cut_type'=>'Tower','min_cut_length'=>'7.0','max_cut_length'=>'9.50','min_cut_weight'=>'40','max_cut_weight'=>'120'],
            ['cut_type'=>'s/0','min_cut_length'=>'8.25','max_cut_length'=>'12.50','min_cut_weight'=>'35','max_cut_weight'=>'70'],
            ['cut_type'=>'B/O','min_cut_length'=>'9.0','max_cut_length'=>'13.50','min_cut_weight'=>'52','max_cut_weight'=>'80'],
            ['cut_type'=>'1/4 cub','min_cut_length'=>'7.0','max_cut_length'=>'8.75','min_cut_weight'=>'15','max_cut_weight'=>'50']
        ]);
        
        // DB::table('spec_types')->insert([
        //     ['name'=>'SARDINES SPECS','type'=>'1','checked'=>1],
        //     ['name'=>'MACKEREL SPECS','type'=>'1','checked'=>1]
        // ]);

        DB::table('master_accept_species')->insert([
            ['scientific_name'=>'Sardinops Melanosticus','common_name'=>'Japanese Pilchard'],
            ['scientific_name'=>'Sardina Pilchardus','common_name'=>'European Pilchard'],
            ['scientific_name'=>'Sardinops Occellatus','common_name'=>'Southern African Pilchard'],
            ['scientific_name'=>'Sardinops Sagax','common_name'=>'Pacific Sardine']
        ]);

        DB::table('upload_files')->insert([
            ['file'=>'hgCut.png','location'=>'/var/www/FisheriesQA/storage/app/documents/','type'=>'cutFish'],
            ['file'=>'hgtCut.png','location'=>'/var/www/FisheriesQA/storage/app/documents/','type'=>'cutFish']
        ]);

        DB::table('cities')->insert([
            ["name_key"=>"sanCarlos", "country_id"=>"7", "name"=>"San Carlos"], 
            ["name_key"=>"sanCarlos", "country_id"=>"7", "name"=>"San Carlos"], 
            ["name_key"=>"guaymas", "country_id"=>"7", "name"=>"Guaymas"], 
            ["name_key"=>"bahiaTortugas", "country_id"=>"7", "name"=>"Bahia Tortugas"], 
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"],
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"],
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"],
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"],
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"],
            ["name_key"=>"boujdour", "country_id"=>"8", "name"=>"Boujdour"], 
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"],
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"]
            ]);

    }
}
