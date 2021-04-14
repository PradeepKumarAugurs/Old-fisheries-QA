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
            ['name'=> 'Del Mar Industrial', 'country_id'=> '7', 'city_id'=> '22', 'code'=> '3216', 'alpha_code'=> 'DMIA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> ''],
            ['name'=> 'Sardinera Bahia Magdalena', 'country_id'=> '7', 'city_id'=> '22', 'code'=> '3215', 'alpha_code'=> 'SBMA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> ''],
            ['name'=> 'Sardinas de Sonora', 'country_id'=> '7', 'city_id'=> '20', 'code'=> '3221', 'alpha_code'=> 'SDSA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> ''],
            ['name'=> 'Commercializadora Bahia Tortugas', 'country_id'=> '7', 'city_id'=> '24', 'code'=> '3220', 'alpha_code'=> 'BTOA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> ''],
            ['name'=> 'Villamar', 'country_id'=> '8', 'city_id'=> '26', 'code'=> '5210', 'alpha_code'=> 'VILA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'Atlas pelagique/CCID', 'country_id'=> '8', 'city_id'=> '26', 'code'=> '5211', 'alpha_code'=> 'ATPA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'Oceamic Boujdour', 'country_id'=> '8', 'city_id'=> '28', 'code'=> '5214', 'alpha_code'=> 'OBOA', 'address'=> 'Lot H 13 ZI Boujdour', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'Oceamic Laayoune', 'country_id'=> '8', 'city_id'=> '27', 'code'=> '5213', 'alpha_code'=> 'OLAA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'CONGELADOS', 'country_id'=> '8', 'city_id'=> '26', 'code'=> '5217', 'alpha_code'=> 'CONA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'DAKORO', 'country_id'=> '8', 'city_id'=> '26', 'code'=> '5218', 'alpha_code'=> 'DAKA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'SOGSACO', 'country_id'=> '8', 'city_id'=> '27', 'code'=> '5224', 'alpha_code'=> 'SOGA', 'address'=> '237 Bd de la Mecque BP117', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'COPELIT', 'country_id'=> '8', 'city_id'=> '27', 'code'=> '5225', 'alpha_code'=> 'COPA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'Tissir Port', 'country_id'=> '8', 'city_id'=> '27', 'code'=> '5226', 'alpha_code'=> 'TISA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'COFRIGOB', 'country_id'=> '8', 'city_id'=> '27', 'code'=> '5229', 'alpha_code'=> 'COFA', 'address'=> 'BP 110 El', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'KATASAB', 'country_id'=> '8', 'city_id'=> '28', 'code'=> '5230', 'alpha_code'=> 'KATA', 'address'=> '50 ZI Al Fath', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'GOURTI POULMAR', 'country_id'=> '8', 'city_id'=> '26', 'code'=> '5231', 'alpha_code'=> 'GTPA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'FRIPECHE', 'country_id'=> '8', 'city_id'=> '26', 'code'=> '5236', 'alpha_code'=> 'FRIA', 'address'=> '', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'AFROPESCA', 'country_id'=> '8', 'city_id'=> '27', 'code'=> '5237', 'alpha_code'=> 'AFPA', 'address'=> '74 ZI Al Marsa', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'], 
            ['name'=> 'ASPAM', 'country_id'=> '8', 'city_id'=> '27', 'code'=> '5238', 'alpha_code'=> 'ASPA', 'address'=> 'ZI Laayoune Port', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'TANTAN FRIGO', 'country_id'=> '8', 'city_id'=> '26', 'code'=> '5239', 'alpha_code'=> 'TTFA', 'address'=> '8-9 El Massira II', 'producer_type'=> '1', 'fao_fishing_zone'=> '34'],
            ['name'=> 'F/V "MEKHANIK KOVTUN"', 'country_id'=> '3', 'city_id'=> '32', 'code'=> '1601', 'alpha_code'=> 'MKVB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'F/V "KAPITAN KAYZER"', 'country_id'=> '3', 'city_id'=> '32', 'code'=> '1602', 'alpha_code'=> 'KPKB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'F/V "TATIANA"', 'country_id'=> '3', 'city_id'=> '32', 'code'=> '1603', 'alpha_code'=> 'TTAB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'F/V "F/V "MAIRONIS""', 'country_id'=> '3', 'city_id'=> '32', 'code'=> '1604', 'alpha_code'=> 'MRNB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'F/V  " KUTAKHOV"', 'country_id'=> '3', 'city_id'=> '32', 'code'=> '1605', 'alpha_code'=> 'KTKB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],   
            ['name'=> 'ONAHAMA Fukushima', 'country_id'=> '1', 'city_id'=> '4', 'code'=> '1160', 'alpha_code'=> 'OAFB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'DAIKOKUYA CO.,LTD.', 'country_id'=> '1', 'city_id'=> '1', 'code'=> '1161', 'alpha_code'=> 'DKKB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'SENREI', 'country_id'=> '1', 'city_id'=> '1', 'code'=> '1162', 'alpha_code'=> 'SRIB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'YAMAGISHI REIZOU', 'country_id'=> '1', 'city_id'=> '31', 'code'=> '1163', 'alpha_code'=> 'YGRB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''], 
            ['name'=> 'SCH 24  AFRIKA', 'country_id'=> '5', 'city_id'=> '33', 'code'=> '2403', 'alpha_code'=> 'AFRB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'SCH 6 Alida H1', 'country_id'=> '5', 'city_id'=> '33', 'code'=> '2404', 'alpha_code'=> 'ALIB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'SCH 81 Carolien', 'country_id'=> '5', 'city_id'=> '33', 'code'=> '2405', 'alpha_code'=> 'CARB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'SCH 302 Willem VdeZ', 'country_id'=> '5', 'city_id'=> '33', 'code'=> '2406', 'alpha_code'=> 'WDZB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> ''],
            ['name'=> 'SCH 123  Zeeland', 'country_id'=> '5', 'city_id'=> '33', 'code'=> '2407', 'alpha_code'=> 'ZLDB', 'address'=> '', 'producer_type'=> '2', 'fao_fishing_zone'=> '']
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
            ['cut_type'=>'Tall','letter' => 'T','min_cut_length'=>'10','max_cut_length'=>'11','min_cut_weight'=>'45','max_cut_weight'=>'100'],
            ['cut_type'=>'Jitney','letter' => 'J','min_cut_length'=>'7.5','max_cut_length'=>'8.75','min_cut_weight'=>'30','max_cut_weight'=>'50'],
            ['cut_type'=>'Buffet','letter' => 'B','min_cut_length'=>'6.5','max_cut_length'=>'7.25','min_cut_weight'=>'34','max_cut_weight'=>'80'],
            ['cut_type'=>'Tower','letter' => 'W','min_cut_length'=>'7.0','max_cut_length'=>'9.50','min_cut_weight'=>'40','max_cut_weight'=>'120'],
            ['cut_type'=>'s/0','letter' => 'S','min_cut_length'=>'8.25','max_cut_length'=>'12.50','min_cut_weight'=>'35','max_cut_weight'=>'70'],
            ['cut_type'=>'B/O','letter' => 'L','min_cut_length'=>'9.0','max_cut_length'=>'13.50','min_cut_weight'=>'52','max_cut_weight'=>'80'],
            ['cut_type'=>'1/4 cub','letter' => 'C','min_cut_length'=>'7.0','max_cut_length'=>'8.75','min_cut_weight'=>'15','max_cut_weight'=>'50']
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
            ["name_key"=>"choshi", "country_id"=>"1", "name"=>"Choshi"],
            ["name_key"=>"ishinomaki", "country_id"=>"1", "name"=>"Ishinomaki"],
            ["name_key"=>"hasaki", "country_id"=>"1", "name"=>"Hasaki"],
            ["name_key"=>"fukuoka", "country_id"=>"1", "name"=>"Fukuoka"],
            ["name_key"=>"onahama", "country_id"=>"1", "name"=>"Onahama"],
            ["name_key"=>"sakaiminato", "country_id"=>"1", "name"=>"Sakaiminato"],
            ["name_key"=>"fukushima", "country_id"=>"1", "name"=>"Fukushima"],
            ["name_key"=>"xinshun", "country_id"=>"2", "name"=>"Xinshun"],
            ["name_key"=>"zhoushan", "country_id"=>"2", "name"=>"Zhoushan"],
            ["name_key"=>"ningbo", "country_id"=>"2", "name"=>"Ningbo"],
            ["name_key"=>"rongsheng", "country_id"=>"2", "name"=>"Rongsheng"],
            ["name_key"=>"dongshan", "country_id"=>"2", "name"=>"Dongshan"],
            ["name_key"=>"vladivostok", "country_id"=>"3", "name"=>"Vladivostok"],
            ["name_key"=>"scheveningen", "country_id"=>"5", "name"=>"Scheveningen"],
            ["name_key"=>"monterrey", "country_id"=>"6", "name"=>"Monterrey"],
            ["name_key"=>"new Bedford", "country_id"=>"6", "name"=>"New Bedford"],
            ["name_key"=>"astoria", "country_id"=>"6", "name"=>"Astoria"],
            ["name_key"=>"westport", "country_id"=>"6", "name"=>"Westport"],
            ["name_key"=>"gloucester", "country_id"=>"6", "name"=>"Gloucester"],
            ["name_key"=>"guaymas", "country_id"=>"7", "name"=>"Guaymas"],
            ["name_key"=>"ensenada", "country_id"=>"7", "name"=>"Ensenada"],
            ["name_key"=>"san Carlos", "country_id"=>"7", "name"=>"San Carlos"],
            ["name_key"=>"sta Rosalia", "country_id"=>"7", "name"=>"Sta Rosalia"],
            ["name_key"=>"bahia Tortugas", "country_id"=>"7", "name"=>"Bahia Tortugas"],
            ["name_key"=>"agadir", "country_id"=>"8", "name"=>"Agadir"],
            ["name_key"=>"dakhla", "country_id"=>"8", "name"=>"Dakhla"],
            ["name_key"=>"laayoune", "country_id"=>"8", "name"=>"Laayoune"],
            ["name_key"=>"boujdour", "country_id"=>"8", "name"=>"Boujdour"],
            ["name_key"=>"tantan", "country_id"=>"8", "name"=>"Tantan"],
            ["name_key"=>"nouhadibouh", "country_id"=>"9", "name"=>"Nouhadibouh"],
            ["name_key"=>"iwate", "country_id"=>"1", "name"=>"Iwate"],
            ["name_key"=>"nakhodka", "country_id"=>"3", "name"=>"Nakhodka"],
            ["name_key"=>"f/v", "country_id"=>"5", "name"=>"F/V"]
        ]);

        DB::table('user_audits')->insert([
            ['producer_id'=>'1', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'2', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'3', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'4', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'5', 'is_factory_approved'=>'1',  'row_material'=>'2', 'processing_facilities'=>'2', 'respect_cold_chain'=>'1', 'storage'=>'3', 'traceability'=>'4'],
            ['producer_id'=>'6', 'is_factory_approved'=>'2',   'row_material'=>'3', 'processing_facilities'=>'2', 'respect_cold_chain'=>'1', 'storage'=>'3', 'traceability'=>'3'],
            ['producer_id'=>'7', 'is_factory_approved'=>'1',  'row_material'=>'4', 'processing_facilities'=>'4', 'respect_cold_chain'=>'4', 'storage'=>'4', 'traceability'=>'4'],
            ['producer_id'=>'8', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],   
            ['producer_id'=>'9', 'is_factory_approved'=>'1',  'row_material'=>'2', 'processing_facilities'=>'1', 'respect_cold_chain'=>'2', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'10', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'3', 'storage'=>'3', 'traceability'=>''],
            ['producer_id'=>'11', 'is_factory_approved'=>'1',  'row_material'=>'4', 'processing_facilities'=>'4', 'respect_cold_chain'=>'4', 'storage'=>'3', 'traceability'=>'4'],
            ['producer_id'=>'12', 'is_factory_approved'=>'1',  'row_material'=>'2', 'processing_facilities'=>'2', 'respect_cold_chain'=>'2', 'storage'=>'3', 'traceability'=>'3'],
            ['producer_id'=>'13', 'is_factory_approved'=>'1',  'row_material'=>'2', 'processing_facilities'=>'2', 'respect_cold_chain'=>'2', 'storage'=>'1', 'traceability'=>'3'],
            ['producer_id'=>'14', 'is_factory_approved'=>'1',  'row_material'=>'3', 'processing_facilities'=>'3', 'respect_cold_chain'=>'4', 'storage'=>'5', 'traceability'=>'5'],
            ['producer_id'=>'15', 'is_factory_approved'=>'1',  'row_material'=>'5', 'processing_facilities'=>'4', 'respect_cold_chain'=>'4', 'storage'=>'4', 'traceability'=>'2'],
            ['producer_id'=>'16', 'is_factory_approved'=>'1',  'row_material'=>'1', 'processing_facilities'=>'2', 'respect_cold_chain'=>'2', 'storage'=>'3', 'traceability'=>'3'],
            ['producer_id'=>'17', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'3', 'respect_cold_chain'=>'4', 'storage'=>'4', 'traceability'=>'4'],
            ['producer_id'=>'18', 'is_factory_approved'=>'1',  'row_material'=>'5', 'processing_facilities'=>'4', 'respect_cold_chain'=>'4', 'storage'=>'3', 'traceability'=>'4'],
            ['producer_id'=>'19', 'is_factory_approved'=>'1',  'row_material'=>'2', 'processing_facilities'=>'2', 'respect_cold_chain'=>'2', 'storage'=>'1', 'traceability'=>'3'],
            ['producer_id'=>'20', 'is_factory_approved'=>'1',  'row_material'=>'4', 'processing_facilities'=>'5', 'respect_cold_chain'=>'5', 'storage'=>'3', 'traceability'=>'4'],
            ['producer_id'=>'21', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'22', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'23', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'24', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'25', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'26', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'27', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'28', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'29', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'30', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'31', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'32', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'33', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>''],
            ['producer_id'=>'34', 'is_factory_approved'=>'1',  'row_material'=>'', 'processing_facilities'=>'', 'respect_cold_chain'=>'', 'storage'=>'', 'traceability'=>'']
        ]);


    }

}
