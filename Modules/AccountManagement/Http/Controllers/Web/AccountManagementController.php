<?php

namespace Modules\AccountManagement\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\AccountManagement\Entities\Country;
use Modules\AccountManagement\Entities\UserAudit;
use Modules\AccountManagement\Entities\ReferenceCountry;
use Modules\AccountManagement\Entities\Producer;
use Modules\AccountManagement\Entities\City;
use Modules\AccountManagement\Entities\Vessel;
use Modules\AccountManagement\Entities\ProducerAccess;
use Modules\AccountManagement\Entities\CustomFields;
use Modules\AccountManagement\Entities\CustomRows;
use Modules\AccountManagement\Entities\CustomProducerData;
use Modules\AccountManagement\Entities\Expedition;
use Modules\AccountManagement\Entities\MasterAccess;
use Modules\AccountManagement\Entities\MasterAcceptSpecies;
use Modules\AccountManagement\Entities\SpecType;
use Modules\AccountManagement\Http\Controllers\VesselController;
use Modules\Lot\Entities\Api\LotInfo;
use Modules\AccountManagement\Entities\Section;
use Modules\AccountManagement\Entities\AffiliationsCountry;
use Modules\AccountManagement\Entities\AffiliationsProducer;
use Modules\AccountManagement\Entities\UserAccess;
use Modules\AccountManagement\Entities\UploadFile;
use Modules\AccountManagement\Entities\UserSetting;
use Modules\AccountManagement\Entities\UserDiscrepancy;
use Modules\AccountManagement\Entities\ColdChainStandard;
use Modules\AccountManagement\Entities\CustomizationSetting;
use Modules\AccountManagement\Entities\AcceptableSpecy;
use Modules\AccountManagement\Entities\FreshFish;
use Modules\AccountManagement\Entities\UserSpecification;
use Modules\AccountManagement\Entities\ChemicalCriteria;
use Modules\AccountManagement\Entities\HeavyMetal;
use Modules\AccountManagement\Entities\MicrobiologicalCriteria;
use Modules\AccountManagement\Entities\SpecificationSopSetting;
use Modules\AccountManagement\Entities\RequestedItem;
use Validator,DB;
use Session,Response;
class AccountManagementController extends Controller
{

    

    /**
     *   User Profile
    */
    public function users(Request $request){
        $data['getUserList'] = User::where('role','!=',1)->get(); 
        return view('accountmanagement::users')->with($data);
        
    }  
    /**
      * Get Affliations Country  and Producers data
     */
    public  function getAffiliationsData(){
        $producersCountry=Producer::distinct()->get(['country_id']);
        $producersCountryList=$producersCountry->implode('country_id', ', ');
        $producersCountryList=explode(',',$producersCountryList);
        return Country::whereIn('id',$producersCountryList)->get(); 
    }

    /**
     * Create New user 
    */
    
    public  function createUser(){
        $data['getUserList']   = $this->getAffiliationsData(); 
        $data['master_access'] = MasterAccess::with('parent')->with('children')->get();
        // $data['master_access'] = MasterAccess::tree2(1);
        // print_r($data['master_access']->toArray());die;   
        return view('accountmanagement::createUser')->with($data);
    }
    
    public function saveUser(Request $request){ 
        $validator = $request->validate([
            'username'       => 'required|unique:users',
            'user_image'     => 'image|mimes:jpeg,png,jpg,gif,svg',
            'company'        => 'required',
            'email'          => 'required|unique:users',
            'role'           => 'required',
            'position'       => 'required',
            'identification' => 'required',
            'mobile_no'      => 'required',
            'affiliations'   => 'array',
            // 'affiliations.*.country_id'                       => 'required',
            // 'affiliations.*.is_checked'                       => 'required',
            // 'affiliations.*.producers'                        => 'required|array',
            // 'affiliations.*.producers.*.producer_id'          => 'required',
            // 'affiliations.*.producers.*.is_checked'           => 'required',
            // 'affiliations.*.producers.*.access_is_checked'    => 'required'
        ]);
        // print_r($request->all()); die();  
        $createUserData=array(
            'username'       => $request->username,
            'name'           => $request->username,
            'company'        => $request->company,
            'email'          => $request->email,
            'mobile_no'      => $request->mobile_no,
            'role'           => $request->role,
            'position'       => $request->position,
            'identification' => $request->identification,
            // 'user_image'     => $request->user_image,
            'password'       => bcrypt('12345678*')
        ); 
        if($request->user_image){
            $imageName = time().'.'.$request->user_image->extension();
            $request->user_image->move(public_path('userImages'),$imageName);
            $createImageFile = UploadFile::create([
                'user_id' => NULL,
                'file' => $imageName,
                'location' => public_path('userImages'),
                'type' => 'user profile'
                ]); 
            $createUserData['user_image'] = $createImageFile->id;
        }
        $created_user = User::create($createUserData); 

        if(isset($request->affiliations) && count($request->affiliations)){
            foreach($request->affiliations as $affiliations){
               
                $affiliations_countries = array(
                    'user_id'    => $created_user->id,
                    'country_id' => $affiliations['country_id'],
                    'is_checked' => (isset($affiliations['is_checked']))?'1':'0'
                );  
                AffiliationsCountry::create($affiliations_countries);
                if(isset($affiliations['producers']) && count($affiliations['producers'])){
                    foreach($affiliations['producers'] as $producers){
                        // print_r($producers); die; 
                        $affiliations_producers = array(
                            'user_id'             => $created_user->id,
                            'country_id'          => $affiliations['country_id'],
                            'producer_id'         => $producers['producer_id'],
                            'is_checked'          => (isset($producers['is_checked']))?'1':'0',
                            'access_is_checked'   => (isset($producers['access_is_checked']))?'1':'0'
                        );
                        AffiliationsProducer::create($affiliations_producers);
                    }
                }
            }
        }
        $data=['success'=>'User '.ucfirst($request->username).' Created Successfully','user_id' => $created_user->id];
        return redirect('accountmanagement/createUser')->with($data)->withInput();
    }
    /**
     * Update Access for  New Users OR Created Users 
    */
    public function updateAccess_copy(Request $request){
        $validator = $request->validate([ 'user_id' => 'required',
        ],['first create a new user .']);
        $userId=$request->user_id;
        if(count($request->access)){
                    foreach($request->access as $key => $row){
                    
                    if(isset($row['id']) && $row['id']!=NULL){  
                        $getAccess=UserAccess::where(['user_id'=> $userId,'id'=> $row['id'],'access_id'=>$row['access_id']])->get();
                        if($getAccess->count()){ 
                            $updateData=UserAccess::where(['user_id' => $userId,
                            'id' => $row['id'],'access_id'=>$row['access_id']])->update([
                                'access_right' => isset($row['access_right'])?'1':'0',
                                'is_validated' => isset($row['is_validated'])?'1':'0'
                            ]);
                        }
                        else{ 
                            return response()->json(['error'=>'id :'.$row['id'].' not found !'], 401);  
                        }
                    }
                    else{  
                        $getAccess=UserAccess::where(['user_id'=> $userId,'access_id'=>$row['access_id']])->get();
                        if($getAccess->count()){ 
                            $updateData=UserAccess::where(['user_id' => $userId,
                                'access_id'    => $row['access_id']])->update([
                                'access_right' => isset($row['access_right'])?'1':'0',
                                'is_validated' => isset($row['is_validated'])?'1':'0'
                            ]);
                        }
                        else{  
                            $insertData=UserAccess::insert([
                                'user_id'      => $userId,
                                'access_id'    => $row['access_id'],
                                'access_right' => isset($row['access_right'])?'1':'0',
                                'is_validated' => isset($row['is_validated'])?'1':'0'
                            ]);
                        }
                    }
                    }
            $data=['success'=>'User Created Successfully'];
            return redirect('accountmanagement/createUser')->with($data);
        }
        else{
            $data=['error'=>'somthing went wrong!'];
            return redirect('accountmanagement/createUser')->with($data);
        }
    }
    public function updateAccess(Request $request){
        $validator = $request->validate([
            'user_id' => 'required',
        ],['first create a new user .']);
        $userId=$request->user_id; // print_r($request->all());  die; 
        if(count($request->access)){
                foreach($request->access as $key => $row){
                    
                    if(isset($row['id']) && $row['id']!=NULL){  
                        $getAccess=UserAccess::where(['user_id'=> $userId,'id'=> $row['id'],'access_id'=>$row['access_id']])->get();
                        if($getAccess->count()){ 
                            $updateData=UserAccess::where(['user_id' => $userId,
                            'id' => $row['id'],'access_id'=>$row['access_id']])->update([
                                'access_right' => isset($row['access_right'])?'1':'0',
                                'is_validated' => isset($row['is_validated'])?'1':'0'
                            ]);
                        }
                    }
                    else{  
                        $getAccess=UserAccess::where(['user_id'=> $userId,'access_id'=>$row['access_id']])->get();
                        if($getAccess->count()){ 
                            $updateData=UserAccess::where(['user_id' => $userId,
                                'access_id'    => $row['access_id']])->update([
                                'access_right' => isset($row['access_right'])?'1':'0',
                                'is_validated' => isset($row['is_validated'])?'1':'0'
                            ]);
                        }
                        else{  
                            $insertData=UserAccess::insert([
                                'user_id'      => $userId,
                                'access_id'    => $row['access_id'],
                                'access_right' => isset($row['access_right'])?'1':'0',
                                'is_validated' => isset($row['is_validated'])?'1':'0'
                            ]);
                        }
                    }
                }
            $data=['success'=>'Access of  users has been updated.'];
            return redirect('accountmanagement/users')->with($data);
        }
        else{
            $data=['error'=>'somthing went wrong!'];
            return redirect('accountmanagement/createUser')->with($data);
        }
    }
    /**
     * Edit  Users 
    */
    public  function editUser(Request $request){
        //print_r($request->user_id); die;
        $data['getUserList']   = $this->getAffiliationsData();
        $data['allUserAffiliationCountries'] = AffiliationsCountry::where('user_id',$request->user_id)->get(); 
        $data['allUserAffiliationProducers'] = AffiliationsProducer::where('user_id',$request->user_id)->get(); 
        $data['master_access'] = MasterAccess::with('parent')->with('children')->get();
        $data['user_access'] = UserAccess::where('user_id',$request->user_id)->get(); 
        $data['userDetail'] = User::find($request->user_id); 
        return view('accountmanagement::editUser')->with($data);    
    }
    
    /**
    *  
    */
    public  function updateUser(Request $request){
        $validate = $request->validate([
            'username'        => 'required',
            'user_image'      => 'image|mimes:jpg,jpeg,gif,png,svg',
            'company'         => 'required',
            'email'           => 'required',
            'role'            => 'required',
            'position'        => 'required',
            'identification'  => 'required',
            'mobile_no'       => 'required',
            'affiliations'    => 'array',
        ]);
        $updateProfile = array(
            'username'       => $request->username,
            'name'           => $request->username,
            'company'        => $request->company,
            'email'          => $request->email,
            'role'           => $request->role,
            'position'       => $request->position,
            'identification' => $request->identification,
            'mobile_no'      => $request->mobile_no
        );
        if($request->user_image){
            $imageName = time().'.'.$request->user_image->extension();
            $request->user_image->move(public_path('userImages'),$imageName);
            $createImageFile=UploadFile::create([
                'user_id' => NULL,
                'file' => $imageName,
                'location' => public_path('userImages'),
                'type' => 'user profile'
            ]); 
            $updateProfile['user_image'] = $createImageFile->id;
        }
        $updateUserProfile = User::where('id',$request->user_id)->update($updateProfile);
        // print_r($request->affiliations);  die;   
        if(isset($request->affiliations) && count($request->affiliations)){
            foreach($request->affiliations as $affiliations){

                $updateAffiliationsCountries = array(
                    'user_id'    => $request->user_id,
                    'country_id' => $affiliations['country_id'],
                    'is_checked' => (isset($affiliations['is_checked']))?'1':'0'
                );
                // echo $affiliations['id']; die; 
                // print_r($updateAffiliationsCountries);die;  
                if(isset($affiliations['id']) && $affiliations['id']!=NULL){ //die("update"); 
                    AffiliationsCountry::where('id',$affiliations['id'])->update($updateAffiliationsCountries);
                } 
                else{  //die("create");
                    AffiliationsCountry::create($updateAffiliationsCountries);
                }
                if(isset($affiliations['producers']) && count($affiliations['producers'])){
                    foreach($affiliations['producers'] as $producers){
                        $updateAffiliationsProducers = array(
                            'user_id'             => $request->user_id,
                            'country_id'          => $affiliations['country_id'],
                            'producer_id'         => $producers['producer_id'],
                            'is_checked'          => (isset($producers['is_checked']))?'1':'0',
                            'access_is_checked'   => (isset($producers['access_is_checked']))?'1':'0'
                        );
                        if(isset($producers['id']) && $producers['id']!=NULL){
                            AffiliationsProducer::where('id',$producers['id'])->update($updateAffiliationsProducers);
                        }
                        else{
                            AffiliationsProducer::create($updateAffiliationsProducers);
                        }
                    }
                }
            }
        }
        $data=['success'=>'user '.ucfirst($request->username).' profile has been updated.'];
        return redirect('accountmanagement/users')->with($data);
    }
   
    /**
     *  Producer Profile
     */
    public function producers(){
        $data['getProducersList'] = Producer::with('countries')->with('citys')->get();
        
        return view('accountmanagement::producer')->with($data);
    }
    
    public function getAllVessel(){
        $data['getVesselList'] = Vessel::get();
        return view('accountmanagement::vessel')->with($data);
    }
   
    /**
     *  Create Producer 
     */
    public function createProducer(Request $request){ 
        // print_r($request->all());die;  
        $validator = $request->validate([
            'name'                                => 'required|string', //  unique:producers
            'country'                             => 'required|numeric|min:1',
            'city'                                => 'required|numeric|min:1',
            'code'                                => 'required|string|max:255',   
            'alpha_code'                          => 'required|string|max:255',
            'address'                             => 'required|string|max:255',
            'leader_id'                           => 'required|numeric|min:1',
            'producer_type'                       => 'required|numeric|min:1',
            'fao_fishing_zone'                    => 'required|string|max:255',
            // 'total_capacity_of_storage_reception' => 'required|string|max:255',
            // 'total_grading_capacity'              => 'required|string|max:255',
            // 'total_wr_processing_capacity'        => 'required|string|max:255',
            // 'total_cutting_capacity'              => 'required|numeric|min:1',
            // 'total_batch_freezing_capacity'       => 'required|numeric|min:1',
            // 'total_continuouse_freezing_capacity' => 'required|numeric|min:1',
            // 'total_storage_capacity'              => 'required|numeric|min:1',
            'image'                               => 'required',
            'sections'                            => 'required|array',

            'sections.*.custom_fields'            => 'required|array',
            'sections.*.custom_fields.name'       => 'required|array',
            'sections.*.custom_fields.name.*'     => 'required',
            'sections.*.custom_fields.type'       => 'required|array',
            'sections.*.custom_fields.type.*'     => 'required',
            'sections.*.custom_fields.item_list'  => 'array',

            'sections.*.custom_rows.customdata.*.value'   => 'required|array',
            // 'sections.*.custom_rows.customdata.*.value.*' => 'required',

            'expedition'                          => 'required|array',
            'expedition.key'                      => 'required|array',
            'expedition.key.*'                    => 'required',
            'expedition.value'                    => 'required|array',
            'expedition.value.*'                  => 'required',

            'auditInfo'                           => 'required|array',
            'auditInfo.is_factory_approved'       => 'required',
            'auditInfo.audit_date'                => 'required',
            'auditInfo.scoring'                   => 'required',
            'auditInfo.row_material'              => 'required',
            'auditInfo.processing_facilities'     => 'required',
            'auditInfo.respect_cold_chain'        => 'required',
            'auditInfo.storage'                   => 'required',
            'auditInfo.traceability'              => 'required',

            'producerAccess'                      => 'required|array',
            'producerAccess.user_id.*'            => 'required'
        ]);
        // print_r($request->all()); die; 

        $createDataProduces = array(
            'name'                                => $request->name,
            'country_id'                          => $request->country,
            'city_id'                             => $request->city,
            'code'                                => $request->code,
            'alpha_code'                          => $request->alpha_code,
            'address'                             => $request->address,
            'leader_id'                           => $request->leader_id,
            'producer_type'                       => $request->producer_type,
            'fao_fishing_zone'                    => $request->fao_fishing_zone,
            'total_capacity_of_storage_reception' => $request->total_capacity_of_storage_reception,
            'total_grading_capacity'              => $request->total_grading_capacity,
            'total_wr_processing_capacity'        => $request->total_wr_processing_capacity,
            'total_cutting_capacity'              => $request->total_cutting_capacity,
            'total_batch_freezing_capacity'       => $request->total_batch_freezing_capacity,
            'total_continuouse_freezing_capacity' => $request->total_continuouse_freezing_capacity,
            'total_storage_capacity'              => $request->total_storage_capacity
            // 'image'                               => $request->image
        );
        if($request->image){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('userImages'),$imageName);
            $createImageFile=UploadFile::create([
                'user_id' => NULL,
                'file' => $imageName,
                'location' => public_path('userImages'),
                'type' => 'producer profile'
            ]); 
            $createDataProduces['image'] = $createImageFile->id;
        }
        $createProducers = Producer::create($createDataProduces);

        if(isset($request->sections) && count($request->sections)){
            $this->createSectionRecord($request->sections,$createProducers->id); 
        } 
        
        if(isset($request->expedition) && count($request->expedition)){
            $this->createExpedition($request->expedition,$createProducers->id); 
        }
        if(isset($request->producerAccess) && count($request->producerAccess)){
            foreach($request->producerAccess['user_id'] as $producerAccess){
                $createAccessProducer = array(
                    'producer_id' => $createProducers->id,
                    'user_id'     => $producerAccess
                );
                ProducerAccess::create($createAccessProducer);
            }
        }
        if(isset($request->auditInfo) && !empty($request->auditInfo)){
            $creatAuditInfo = array(
                'producer_id'             => $createProducers->id,
                // 'information'             => $request->auditInfo['information'],
                'is_factory_approved'     => $request->auditInfo['is_factory_approved'],
                'audit_date'              => $request->auditInfo['audit_date'],
                'scoring'                 => $request->auditInfo['scoring'],
                'row_material'            => $request->auditInfo['row_material'],
                'processing_facilities'   => $request->auditInfo['processing_facilities'],
                'respect_cold_chain'      => $request->auditInfo['respect_cold_chain'],
                'storage'                 => $request->auditInfo['storage'],
                'traceability'            => $request->auditInfo['traceability']
            );
            UserAudit::create($creatAuditInfo);
        }
        // return response()->json($request->all(), 200);
        $getProducer = Producer::select('id','image','name')->with('profileImage')->find($createProducers->id);
        $data=['success'=>'Producer '.ucfirst($request->name).' Profile has been Created.','tab'=>'tab_2','producerDetails'=>$getProducer];
        return redirect('accountmanagement/addProducer')->with($data)->withInput();
    }
    /* create Expedition*/
    public function createExpedition($expedition,$producer_id){

        if(isset($expedition->key) && count($expedition->key) && $producer_id){
             foreach($expedition->key as $key=>$valueExp){
                 $createExpedition = array(
                     'producer_id' => $producer_id,
                     'key'         => $valueExp,
                     'value'       => $$expedition->value[$key]
                 );
                 Expedition::create($createExpedition);
             }
         }
     } 

    /**
     * Create Section for Rows & Fields
     */
    public function createSectionRecord($sections,$producer_id){
        if(isset($sections) && count($sections) && $producer_id){
            foreach($sections as $sectionData){
            $createSectionsData = array(
                'name'        => $sectionData['name'],
                'name_key'    => $sectionData['name_key'],
                'type'        => 1
            ); 
            //$createdSections = Section::where($sections['id'],$sectionData['id'])->update($createSectionsData);
            //$createdSections = Section::where(['id'=>isset($sectionData['id'])?$sectionData['id']:null])->update($createSectionsData);
            
             if(isset($sectionData['id']) && $sectionData['id']!=NULL){
                Section::where('id',$sectionData['id'])->update($createSectionsData);
                $SectionsId = $sectionData['id'];
             }
             else{
                $getSectionExist=Section::where(['name'=>$sectionData['name'],'type'=>1])->first(); 
                if(empty($getSectionExist)){
                    $createdSections = Section::create($createSectionsData);
                    $SectionsId = $createdSections->id;
                }
                else{
                // $sectionData['id']=$getSectionExist->id;
                $SectionsId = $getSectionExist->id;
                }
            }
            // $SectionsId = ($sectionData['id']!=null)?$sectionData['id']:$createdSections->id;
            $fieldsidsArray = array();
            if(isset($sectionData['custom_fields']) && count($sectionData['custom_fields'])){
                if(count($sectionData['custom_fields'])){
                    
                    if(isset($sectionData['custom_fields']['name']) && count($sectionData['custom_fields']['name'])){
                        foreach($sectionData['custom_fields']['name'] as $key2=>$customFieldsName){
                            $createColumn = array(
                                'name'        => $customFieldsName,
                                'producer_id' => $producer_id,
                                'section_id'  => $SectionsId,
                                'type'        => $sectionData['custom_fields']['type'][$key2],
                                'item_list'   => $sectionData['custom_fields']['item_list'][$key2]
                            );
                            $create_Fields=CustomFields::create($createColumn);
                            array_push($fieldsidsArray,$create_Fields->id);
                        }
                    }
                }
            }
            if(isset($sectionData['custom_rows']) && count($sectionData['custom_rows'])){
                if(count($sectionData['custom_rows'])){
                    if(isset($sectionData['custom_rows']['customdata']) && count($sectionData['custom_rows']['customdata'])){
                        
                     if(isset($sectionData['custom_rows']['customdata'][0]['value']) && count($sectionData['custom_rows']['customdata'][0]['value'])){
                        $rowsIdsArray = array(); $rowCount = count($sectionData['custom_rows']['customdata'][0]['value']); 
                        
                        foreach($sectionData['custom_fields']['name'] as $RowKey=>$customFieldsName){
                            
                            if(isset($sectionData['custom_rows']['customdata'][0]['value']) && count($sectionData['custom_rows']['customdata'][0]['value'])){
                                
                                $i =0;
                                foreach($sectionData['custom_rows']['customdata'][$RowKey]['value'] as $key => $customdata){
                                    if(isset($rowsIdsArray) && (count($rowsIdsArray) == $rowCount ) ){
                                        // echo $rowCount; 
                                        // echo  $key; 
                                        // print_r($rowsIdsArray);
                                        // echo $rowsIdsArray[$i]; 
                                        // die; 
                                        if(isset($rowsIdsArray[$i]) && ($rowsIdsArray[$i]!="" || $rowsIdsArray[$i]!='NULL') ){
                                            $createdRowId =  $rowsIdsArray[$i]; 
                                        }
                                        else{
                                            $createdRowId = NULL;
                                        }
                                    }else{
                                        $ceateRow = array(
                                            'producer_id' =>  $producer_id,
                                            'section_id'  =>  $SectionsId
                                        );
                                        $createcustom_rows=CustomRows::create($ceateRow);
                                        array_push($rowsIdsArray,$createcustom_rows->id);
                                        $createdRowId = $createcustom_rows->id;
                                    }

                                    $createCustomProducer = array(
                                        'producer_id'      => $producer_id,
                                        'custom_field_id'  => $fieldsidsArray[$RowKey]?$fieldsidsArray[$RowKey]:$customdata['custom_field_id'],
                                        'custom_row_id'    => $createdRowId?$createdRowId:null,
                                        'value'            => $customdata?$customdata:0
                                    );
                                    CustomProducerData::create($createCustomProducer);
                                    $i++;
                                }
                            }
                        }
                     } 

                    }
                }
            }
            
           
           } /* end of  the Section*/
        }
    }
    /**
     * create Spot Inspection
     */
    public function createSpotInspection(){
        return view('accountmanagement::createSpotInspection');
    }

    public function createSop(){
        return view('accountmanagement::createsop');
    }

    public function createHistamine(){
        return view('accountmanagement::createHistamine');
    }
    public function createComment(){
        return view('accountmanagement::comment');
    }

 
    /**
     *  Create Vessel Record
     */
    public function createVesselRecord(Request $request){
        
        $validation = $request->validate([
        
            'vessel_name'                         => 'required|unique:vessels',
            'vessel_registration'                 => 'required|unique:vessels',
            'unique_indentification'              => 'required|unique:vessels',
            'public_registry_hyperlink'           => 'required',
            'vessel_flag'                         => 'required',
            'availlability_catch_coordinates'     => 'required',
            'satellite_tracking_authority'        => 'required',
            'transshipment_vessel_name'           => 'required',
            'transshipment_unique_identification' => 'required',
            'transshipment_vessel_flag'           => 'required',
            'transshipment_vessel_registration'   => 'required',
            'fishery_improvement_project'         => 'required',
            'fishing_authorization'               => 'required',
            'hervest_certification'               => 'required',
            'hervest_certification_chain_custody' => 'required',
            'transshipment_authorization'         => 'required',
            'landing_authorization'               => 'required',
            'human_welfare_policy_standards'      => 'required',
            'existence_human_wefare_policy'       => 'required',
            'fishing_gear'                        => 'required',
            'fish_transfer'                       => 'required',
            'nominal_capacity'                    => 'required',
            'hatches'                             => 'required',
            'rsw'                                 => 'required',
            'hp_rsw'                              => 'required',
            'ice_trip'                            => 'required'
        ]);
    
        $createVessel = array(
        
            'vessel_name'                         =>  $request->vessel_name,
            'vessel_registration'                 =>  $request->vessel_registration,
            'unique_indentification'              =>  $request->unique_indentification,
            'public_registry_hyperlink'           =>  $request->public_registry_hyperlink,
            'vessel_flag'                         =>  $request->vessel_flag,
            'availlability_catch_coordinates'     =>  $request->availlability_catch_coordinates,
            'satellite_tracking_authority'        =>  $request->satellite_tracking_authority,
            'transshipment_vessel_name'           =>  $request->transshipment_vessel_name,
            'transshipment_unique_identification' =>  $request->transshipment_unique_identification,
            'transshipment_vessel_flag'           =>  $request->transshipment_vessel_flag,
            'transshipment_vessel_registration'   =>  $request->transshipment_vessel_registration,
            'fishery_improvement_project'         =>  $request->fishery_improvement_project,
            'fishing_authorization'               =>  $request->fishing_authorization,
            'hervest_certification'               =>  $request->hervest_certification,
            'hervest_certification_chain_custody' =>  $request->hervest_certification_chain_custody,
            'transshipment_authorization'         =>  $request->transshipment_authorization,
            'landing_authorization'               =>  $request->landing_authorization,
            'human_welfare_policy_standards'      =>  $request->human_welfare_policy_standards,
            'existence_human_wefare_policy'       =>  $request->existence_human_wefare_policy,
            'fishing_gear'                        =>  $request->fishing_gear,
            'fish_transfer'                       =>  $request->fish_transfer,
            'nominal_capacity'                    =>  $request->nominal_capacity,
            'hatches'                             =>  $request->hatches,
            'rsw'                                 =>  $request->rsw,
            'hp_rsw'                              =>  $request->hp_rsw,
            'ice_trip'                            =>  $request->ice_trip
        );
        if($request->status){
            $createVessel['status'] =  $request->status; 
        }
            $createVesselRecord = Vessel::create($createVessel);
            Session::flash('success', 'Created Vessels Successfully!');
            return redirect('accountmanagement/createVessele');
        }
        /**
         * update Vessels
         *
         */
        public function updateVesselRecord(Request $request){

            $getId = Vessel::find($request->user_id);
            if(!empty($getId)){
            $validation = $request->validate([
            
                'vessel_name'                         => 'required',
                'vessel_registration'                 => 'required',
                'unique_indentification'              => 'required',
                'public_registry_hyperlink'           => 'required',
                'vessel_flag'                         => 'required',
                'availlability_catch_coordinates'     => 'required',
                'satellite_tracking_authority'        => 'required',
                'transshipment_vessel_name'           => 'required',
                'transshipment_unique_identification' => 'required',
                'transshipment_vessel_flag'           => 'required',
                'transshipment_vessel_registration'   => 'required',
                'fishery_improvement_project'         => 'required',
                'fishing_authorization'               => 'required',
                'hervest_certification'               => 'required',
                'hervest_certification_chain_custody' => 'required',
                'transshipment_authorization'         => 'required',
                'landing_authorization'               => 'required',
                'human_welfare_policy_standards'      => 'required',
                'existence_human_wefare_policy'       => 'required',
                'fishing_gear'                        => 'required',
                'fish_transfer'                       => 'required',
                'nominal_capacity'                    => 'required',
                'hatches'                             => 'required',
                'rsw'                                 => 'required',
                'hp_rsw'                              => 'required',
                'ice_trip'                            => 'required'
            ]);
            $updateVessel = array(
            
                'vessel_name'                         =>  $request->vessel_name,
                'vessel_registration'                 =>  $request->vessel_registration,
                'unique_indentification'              =>  $request->unique_indentification,
                'public_registry_hyperlink'           =>  $request->public_registry_hyperlink,
                'vessel_flag'                         =>  $request->vessel_flag,
                'availlability_catch_coordinates'     =>  $request->availlability_catch_coordinates,
                'satellite_tracking_authority'        =>  $request->satellite_tracking_authority,
                'transshipment_vessel_name'           =>  $request->transshipment_vessel_name,
                'transshipment_unique_identification' =>  $request->transshipment_unique_identification,
                'transshipment_vessel_flag'           =>  $request->transshipment_vessel_flag,
                'transshipment_vessel_registration'   =>  $request->transshipment_vessel_registration,
                'fishery_improvement_project'         =>  $request->fishery_improvement_project,
                'fishing_authorization'               =>  $request->fishing_authorization,
                'hervest_certification'               =>  $request->hervest_certification,
                'hervest_certification_chain_custody' =>  $request->hervest_certification_chain_custody,
                'transshipment_authorization'         =>  $request->transshipment_authorization,
                'landing_authorization'               =>  $request->landing_authorization,
                'human_welfare_policy_standards'      =>  $request->human_welfare_policy_standards,
                'existence_human_wefare_policy'       =>  $request->existence_human_wefare_policy,
                'fishing_gear'                        =>  $request->fishing_gear,
                'fish_transfer'                       =>  $request->fish_transfer,
                'nominal_capacity'                    =>  $request->nominal_capacity,
                'hatches'                             =>  $request->hatches,
                'rsw'                                 =>  $request->rsw,
                'hp_rsw'                              =>  $request->hp_rsw,
                'ice_trip'                            =>  $request->ice_trip
            );
            if($request->status){
                $updateVessel['status'] =  $request->status; 
            }
            $getIdVessel = Vessel::where('id',$request->user_id)->first();
            if(empty($getIdVessel)){
                return response()->json(['error'=>"Vessel Id not found !."], 401);
            }

            $getUserData = Vessel::where('vessel_name',$request->vessel_name)->first();
            $getUser = Vessel::where('vessel_registration',$request->vessel_registration)->first();
            $getUnique = Vessel::where('unique_indentification',$request->unique_indentification)->first();
                if(!empty($getUserData) && $getIdVessel->vessel_name != $getUserData->vessel_name)
                    {
                        return response()->json(['error'=>'This Vessel Name already exists'], 401);
                    }
                if(!empty($getUser) && $getIdVessel->vessel_registration != $getUser->vessel_registration)
                    {
                        return response()->json(['error'=>'This Vessel Registration already exists'], 401);
                    }
                if(!empty($getUnique) && $getIdVessel->unique_indentification != $getUnique->unique_indentification)
                    {
                        return response()->json(['error'=>'This Vessel Unique Indentification already exists'], 401);
                    } 
                $updatedVesselRecord = Vessel::where('id',$request->user_id)->update($updateVessel);
                Session::flash('success', 'Updated Vessels Successfully!');
                return redirect('accountmanagement/getAllVessel');
        }
    }
    
    public function updateVessels(Request $request){

        $data['vesselData'] = Vessel::where('id',$request->user_id)->first();
        
        return view('accountmanagement::updateVessel')->with($data);
    }           

    public function createVessele(){
        return view('accountmanagement::createVessel');
    }
    /**
     * Create lot information
     */
    public function createLotInfoRecord(Request $request){
            
        $validator = $request->validate([
            'lot_number'          => 'required|string|unique:lot_infos|max:255',
            'production_date'     => 'required|date_format:Y-m-d',
            'country_id'          => 'required|numeric|min:1999',
            'supplier_id'         => 'required|numeric|min:1999',
            'producer_id'         => 'required|numeric|min:1999',
            'plant_location'      => 'required|string',
            'product'             => 'required|numeric|min:1999',
            'type'                => 'required|numeric|min:1999',
            'size'                => 'required|numeric',
            'cut_size_type'       => 'required|numeric|min:1999',
            'quality'             => 'required|numeric|min:1999',
            'Unit_id'             => 'required|numeric|min:1999',
            'weight'              => 'required|numeric',
            'number_of_unit'      => 'required|numeric',
            'total_quantity'      => 'required|numeric'
        ]);
        $recordCreated = array(
            'lot_number'        => $request->lot_number,
            'production_date'   => $request->production_date,
            'country_id'        => $request->country_id,
            'supplier_id'       =>$request->supplier_id,
            'producer_id'       =>$request->producer_id,
            'plant_location'    =>$request->plant_location,
            'product'           =>$request->product,
            'type'              =>$request->type,
            'size'              =>$request->size,
            'cut_size_type'     =>$request->cut_size_type,
            'quality'           =>$request->quality,
            'unit_id'           =>$request->unit_id,
            'weight'            =>$request->weight,
            'number_of_unit'    =>$request->number_of_unit,
            'total_quantity'    =>$request->total_quantity
        );
            $createRecord = LotInfo::create($recordCreated);
        
        }
        /**
         *  get Cities By CountryId 
         */
        public  function  getCitiesByCountryId(Request $request){
            if($request->countryId){
                $data['getAllCities']=City::where('country_id',$request->countryId)->get();
                $data['mode'] = 'getCitiesByCountryId';
                $allCities = view('ajax')->with($data);
                return $allCities; 
            }
        }
        /**
         * Create Raw Material 
        */
        public function createRawMaterial(Request $request){
            return view('accountmanagement::createMaterial');
        }


    public function addProducer(Request $request){
        $data['getVesselList'] = Vessel::get();
        $data['getAllProducerUser'] = User::where('role','!=',1)->get(); //  where('role',3) 
        $data['getAllCountries'] = Country::get();
        $data['getAllMasterAcceptSpecies'] = MasterAcceptSpecies::get(); 
        $data['getAllSpecTypes'] = SpecType::get(); 
        //$data['getAllCities']= City::where('country_id',$request->id)->get();
        $data['getAllCities']= City::get();
        return view('accountmanagement::addproducer')->with($data);
    }

    public  function getAllAccessChildsByAccessId(Request $request){
        echo "sff";
    }


    public function update_items($requestedItems,$producerId){  
        if(!empty($requestedItems)){ 
            $updateData=[
                'raw_wr_weight'                               => $requestedItems['raw_wr_weight'],
                'raw_wr_weight_is_checked'                    => $requestedItems['raw_wr_weight_is_checked'],
                'raw_wr_length'                               => $requestedItems['raw_wr_length'],
                'raw_wr_length_is_checked'                    => $requestedItems['raw_wr_length_is_checked'],
                'raw_cut_fish_weight'                         => $requestedItems['raw_cut_fish_weight'],
                'raw_cut_fish_weight_is_checked'              => $requestedItems['raw_cut_fish_weight_is_checked'],
                'raw_cut_fish_length'                         => $requestedItems['raw_cut_fish_length'],
                'raw_cut_fish_length_is_checked'              => $requestedItems['raw_cut_fish_length_is_checked'],
                'finished_product_wr_weight'                  => $requestedItems['finished_product_wr_weight'],
                'finished_product_wr_weight_is_checked'       => $requestedItems['finished_product_wr_weight_is_checked'],
                'finished_product_wr_length'                  => $requestedItems['finished_product_wr_length'],
                'finished_product_wr_length_is_checked'       => $requestedItems['finished_product_wr_length_is_checked'],
                'finished_product_cut_fish_weight'            => $requestedItems['finished_product_cut_fish_weight'],
                'finished_product_cut_fish_weight_is_checked' => $requestedItems['finished_product_cut_fish_weight_is_checked'],
                'finished_product_cut_fish_length'            => $requestedItems['finished_product_cut_fish_length'],
                'finished_product_cut_fish_length_is_checked' => $requestedItems['finished_product_cut_fish_length_is_checked']
            ];
            if(isset($requestedItems['id']) && $requestedItems['id']!=NULL){  
                $getitems = RequestedItem::where([ 'producer_id' => $producerId,'id' => $requestedItems['id']])->get();
                if(count($getitems)){
                    $update_req_items = RequestedItem::where([ 'producer_id' => $producerId,'id' => $requestedItems['id']])->update($updateData);
                }
            }
            else{  
                $getitems = RequestedItem::where(['producer_id' => $producerId])->get();
                if(count($getitems)){  
                    $update_req_items = RequestedItem::where(['producer_id' => $producerId])->update($requestedItems);
                }
                else{ 
                    $create_req_items = RequestedItem::Create($updateData);
                }
            }
        }
    }
    /* Update the Cutomization*/
    public  function  updateCustomization(Request $request){
        //print_r($request->all()); die();
        $validator = $request->validate([
            'row_id' => 'required',
            'discrepancies' => 'array',
            'raw_wr_weight'                               => 'required',
            'raw_wr_weight_is_checked'                    => 'required',
            'raw_wr_length'                               => 'required',
            'raw_wr_length_is_checked'                    => 'required',
            'raw_cut_fish_weight'                         => 'required',
            'raw_cut_fish_weight_is_checked'              => 'required',
            'raw_cut_fish_length'                         => 'required',
            'raw_cut_fish_length_is_checked'              => 'required',
            'finished_product_wr_weight'                  => 'required',
            'finished_product_wr_weight_is_checked'       => 'required',
            'finished_product_wr_length'                  => 'required',
            'finished_product_wr_length_is_checked'       => 'required',
            'finished_product_cut_fish_weight'            => 'required',
            'finished_product_cut_fish_weight_is_checked' => 'required',
            'finished_product_cut_fish_length'            => 'required',
            'finished_product_cut_fish_length_is_checked' => 'required'
        ]);
        if(isset($request->wr_fish_online_qc)){
            if($request->wr_fish_online_qc == 'on'){
              $userSettings['wr_fish_online_qc'] = '1'; 
            }
        }     
        else{
            $userSettings['wr_fish_online_qc'] = '0'; 
        }
        if(isset($request->cut_fish_online_qc)){
            if($request->cut_fish_online_qc == 'on'){
               $userSettings['cut_fish_online_qc'] = '1'; 
            } 
        }   
        else{
            $userSettings['cut_fish_online_qc'] = '0'; 
        }
        if($request->wr_fish_online_qc == 'on' ||  $request->cut_fish_online_qc == 'on'){
            $getUserSetting = UserSetting::where('producer_id',$request->row_id)->first();
            if(!empty($getUserSetting)){
                $getUserSetting = UserSetting::where('producer_id',$request->row_id)->update($userSettings);
            }
            else{
                $userSettings['producer_id'] = $request->row_id;
                $createUserSettings = UserSetting::create($userSettings);
            }
        }   
        if(isset($request->discrepancies) && !empty($request->discrepancies)){
            if(isset($request->discrepancies['discrepancy_id']) && !empty($request->discrepancies['discrepancy_id'])){
                foreach($request->discrepancies['discrepancy_id'] as $key => $discrepancy_id ){
                    if(isset($request->discrepancies['is_checked']) && !empty($request->discrepancies['is_checked'])){
                       if(isset($request->discrepancies['is_checked'][$key])){
                        $isChecked = '1';
                       }
                       else{
                        $isChecked = '0';
                       }
                    }
                    else{
                         $isChecked = '0';
                        } 
                        $createDiscrepancies = array(
                            'producer_id' => $request->row_id,
                            'discrepancy_id' => $request->discrepancies['discrepancy_id'][$key],
                            'rejection_offset_value'=> $request->discrepancies['rejection_offset_value'][$key],
                            'border_offset_value' => $request->discrepancies['border_offset_value'][$key],
                            'rejection_value' => $request->discrepancies['rejection_value'][$key],
                            'border_value' => $request->discrepancies['border_value'][$key],
                            'is_checked' => $isChecked
                        );
                        if(isset($request->discrepancies['id']) && !empty($request->discrepancies['id'])){
                            if(isset($request->discrepancies['id'][$key])){
                              $id = $request->discrepancies['id'][$key];
                            }
                            else{
                                $id = NULL;
                            }
                        }
                        else{ 
                            $id = NULL;
                        } 
                        if($id != NULL){
                            UserDiscrepancy::where('id', $id)->update($createDiscrepancies);
                        }
                        else{
                            UserDiscrepancy::create($createDiscrepancies);
                        }       
                    } 
                }
            }
            if(isset($request->cold_chain_standard) && !empty($request->cold_chain_standard)){  
                if(isset($request->cold_chain_standard['title']) && !empty($request->cold_chain_standard['title'])){
                    foreach($request->cold_chain_standard['title'] as $key=> $cold_chain_standard){
                        $createColdChainStandard = array(
                           'producer_id' => $request->row_id,
                           'title'      => $request->cold_chain_standard['title'][$key],
                           'target_value'  => $request->cold_chain_standard['target_value'][$key],
                           'border_value'  => $request->cold_chain_standard['border_value'][$key]
                        );  
                        if(isset($request->cold_chain_standard['id']) && !empty($request->cold_chain_standard['id'])){
                            if(isset($request->cold_chain_standard['id'][$key])){
                               $id = $request->cold_chain_standard['id'][$key];
                            }
                            else{
                                $id = NULL;
                            }
                        }
                        else{ 
                            $id = NULL;
                        } 
                        if($id != NULL){
                            ColdChainStandard::where('id', $id)->update($createColdChainStandard);
                        }
                        else{
                            ColdChainStandard::create($createColdChainStandard);
                        }
                    }
                }
            }
            $getCustomizationSettings = CustomizationSetting::where('producer_id', $request->row_id)->first();
            if(!empty($getCustomizationSettings)){
                $updatecustomizationSettings = array(
                    'temperature_ckeck_reminder_timescale' => $request->temperature_ckeck_reminder_timescale,
                    'custom_reminder_timescale_day' => $request->custom_reminder_timescale_day,
                    'minimum_temperature' => $request->minimum_temperature,
                    'other_minimum_temperature' => $request->other_minimum_temperature,
                    'continuous_freezing' => $request->continuous_freezing,
                    'other_continuous_freezing' => $request->other_continuous_freezing,
                    'weight_calibration'  => $request->weight_calibration,
                    'standard_drip_loss_value' => $request->standard_drip_loss_value,
                    'standard_guts_weight' => $request->standard_guts_weight
                );
                $updateCustomizationSettingsData = CustomizationSetting::where('producer_id', $request->row_id)->update($updatecustomizationSettings);
            }
            else{
                $getCustomizationSettings['producer_id'] = $request->row_id;
                $customizationSettings = array(
                    'producer_id' => $request->row_id,
                    'temperature_ckeck_reminder_timescale' => $request->temperature_ckeck_reminder_timescale,
                    'custom_reminder_timescale_day' => $request->custom_reminder_timescale_day,
                    'minimum_temperature' => $request->minimum_temperature,
                    'other_minimum_temperature' => $request->other_minimum_temperature,
                    'continuous_freezing' => $request->continuous_freezing,
                    'other_continuous_freezing' => $request->other_continuous_freezing,
                    'weight_calibration'  => $request->weight_calibration,
                    'standard_drip_loss_value' => $request->standard_drip_loss_value,
                    'standard_guts_weight' => $request->standard_guts_weight
                );
                $createCustomizationSettings = CustomizationSetting::create($customizationSettings);
            }
            $updateData = [
               // 'producer_id'                                 => $request->row_id,
                'raw_wr_weight'                               => $request->raw_wr_weight,
                'raw_wr_weight_is_checked'                    => isset($request->raw_wr_weight_is_checked)?'1':'0',
                'raw_wr_length'                               => $request->raw_wr_length,
                'raw_wr_length_is_checked'                    => isset($request->raw_wr_length_is_checked)?'1':'0',
                'raw_cut_fish_weight'                         => $request->raw_cut_fish_weight,
                'raw_cut_fish_weight_is_checked'              => isset($request->raw_cut_fish_weight_is_checked)?'1':'0',
                'raw_cut_fish_length'                         => $request->raw_cut_fish_length,
                'raw_cut_fish_length_is_checked'              => isset($request->raw_cut_fish_length_is_checked)?'1':'0',
                'finished_product_wr_weight'                  => $request->finished_product_wr_weight,
                'finished_product_wr_weight_is_checked'       => isset($request->finished_product_wr_weight_is_checked)?'1':'0',
                'finished_product_wr_length'                  => $request->finished_product_wr_length,
                'finished_product_wr_length_is_checked'       => isset($request->finished_product_wr_length_is_checked)?'1':'0',
                'finished_product_cut_fish_weight'            => $request->finished_product_cut_fish_weight,
                'finished_product_cut_fish_weight_is_checked' => isset($request->finished_product_cut_fish_weight_is_checked)?'1':'0',
                'finished_product_cut_fish_length'            => $request->finished_product_cut_fish_length,
                'finished_product_cut_fish_length_is_checked' => isset($request->finished_product_cut_fish_length_is_checked)?'1':'0'
            ];
            if(isset($request->row_id) && $request->row_id!=NULL){  
                $getitems = RequestedItem::where('producer_id', $request->row_id)->first();
                if(!empty($getitems)){
                    $update_req_items = RequestedItem::where('producer_id',$request->row_id)->update($updateData);
                }
            }
            else{  
                $getitems = RequestedItem::where('producer_id',$request->row_id)->first();
                if(!empty($getitems)){  
                    $update_req_items = RequestedItem::where('producer_id',$request->row_id)->update($requestedItems);
                }
                else{ 
                    $create_req_items = RequestedItem::Create($updateData);
                }
            }
            $getProducer = Producer::select('id','image','name')->with('profileImage')->find($request->row_id);
            $data=['success'=>'customizationSettingdata'.ucfirst($request->name).' Customization has been Created!.','tab'=>'tab_3','customizationSettingdata'=>$getProducer];
            return redirect('accountmanagement/addProducer')->with($data)->withInput();
    } 

    /** 
     * Update the Specification 
     * */
    public  function  updateSpecificationSop(Request $request){
        print_r($request->all());        
    }

  
 
   /**
     *  Add producer
     */
    
    public function editProducers(Request $request, $row_id){

        $data['getAllCountries'] = Country::get();
        $data['getAllCities'] = City::where('country_id', $request->countryId)->get();
        $data['userAudit'] = UserAudit::where('producer_id', $row_id)->first();
        $data['userExpedition'] = Expedition::where('producer_id', $row_id)->get();
        $data['vessel'] = Vessel::get();
        $data['getProducer'] = Producer::where('id', $row_id)->first();
        $data['getAllProducerUser'] = User::where('role','!=',1)->get();  //  where('role',3) 
        
        $data['sections'] = Section::with(['custom_fields'=>function($query) use ($row_id){
            $query->select('*')->where('producer_id',$row_id);
        }])
        ->with(['custom_rows'=>function($query) use ($row_id){
            $query->select('*')->where('producer_id',$row_id)
            ->with('customdata');
        }])->get();
        $data['getVesselList'] = Vessel::get();
        $data['userSettings'] = UserSetting::where('producer_id', $row_id)->first();
        $data['discrepancy'] = $discrepancies = DB::select("SELECT D.id,D.producer_id,M.id as discrepancy_id,M.discrepancies,M.discrepancy_key,
        (CASE WHEN D.is_checked  IS NULL THEN 0 ELSE D.is_checked END) as is_checked,
        (CASE WHEN D.rejection_value  IS NULL THEN M.rejection_value ELSE D.rejection_value END) as rejection_value,
        (CASE WHEN D.border_value IS NULL THEN M.border_value ELSE D.border_value END) as border_value
        ,M.unit,M.type,D.rejection_offset_value,D.border_offset_value, D.created_at,D.updated_at as new_id FROM `master_discrepancies` M left join (select * FROM user_discrepancies WHERE producer_id = $row_id) D on M.id = D.discrepancy_id");
        $data['coldChainStandard'] = ColdChainStandard::where('producer_id', $row_id)->get();
        $data['customization'] = CustomizationSetting::where('producer_id', $row_id)->first();
        $data['requestedItem'] = RequestedItem::where('producer_id', $row_id)->first(); 
        return view('accountmanagement::updateProducer')->with($data);
    }


    public function updateProducer(Request $request){
      
    }


    
    public function createSectionRows($sections,$producer_id){
        if(isset($sections) && count($sections) && $producer_id){
            foreach($sections as $sectionData){
            
                $createSectionsData = array(
                    'name'        => $sectionData['name'],
                    'name_key'    => $sectionData['name_key'],
                    'type'        => 1
                );
                if(isset($sectionData['id']) && $sectionData['id']!=NULL){
                    Section::where('id',$sectionData['id'])->update($createSectionsData);
                }
                else{
                $getSectionExist = Section::where(['name'=>$sectionData['name'],'type'=>1])->first(); 
                if(empty($getSectionExist)){
                    $createdSections = Section::create($createSectionsData);
                }
                else{
                $sectionData['id']=$getSectionExist->id;
                }
                
                }
                $SectionsId = ($sectionData['id']!=null)?$sectionData['id']:$createdSections->id;
                if(isset($sectionData['custom_rows']) && count($sectionData['custom_rows'])){
                    if(count($sectionData['custom_rows'])){
                        foreach($sectionData['custom_rows'] as $custom_rows){
                            $ceateRow = array(
                                'producer_id' => $producer_id,
                                'section_id'  =>  $SectionsId,
                            );
                            $createcustom_rows = CustomRows::create($ceateRow);
                            if(isset($custom_rows['customdata']) && count($custom_rows['customdata'])){
                                foreach($custom_rows['customdata'] as $key=>$customdata){
                                    $createCustomProducer = array(
                                        'producer_id'      => $producer_id,
                                    //   'custom_field_id'  => $fieldsidsArray[$key]?$fieldsidsArray[$key]:$customdata['custom_field_id'],
                                        'custom_row_id'    => $createcustom_rows->id?$createcustom_rows->id:$customdata['custom_row_id'],
                                        'value'            => $customdata['value'],
                                    );
                                    CustomProducerData::create($createCustomProducer);
                                }
                            }
                        }
                    }
                }
           } /* end of  the Section*/
        }
    }
    /** create sop */
    
    public function createSopSpecification(Request $request){
       
        $validator = $request->validate([
            'production_and_storage_facilities' => 'required',
            'hgt_fish_cut_checkbox' => 'required',
            'hg_fish_cut_checkbox'   => 'required',
            'acceptable_species' => 'required|array',
            'fresh_fish_test' => 'array',
            'length_width_specification' =>  'array',
            'chemical_criterias' => 'required|array',
            'heavy_metals'   => 'array',
            'microbiological_criterias' => 'array',
            'hgt_fish_cut' =>  'required',
            'hg_fish_cut' =>   'required',
            'sop_file'    =>   'required'
        ]);
        if(isset($request->hgt_fish_cut_checkbox)){
            if($request->hgt_fish_cut_checkbox == 'on'){
                $sopSettings['hgt_fish_cut_checkbox'] = '1';
            }
            else{
                $sopSettings['hgt_fish_cut_checkbox'] = '0';
            }
        }
        if(isset($request->hg_fish_cut_checkbox)){
            if($request->hg_fish_cut_checkbox == 'on'){
                $sopSettings['hg_fish_cut_checkbox'] = '1';
            }
            else{
                $sopSettings['hg_fish_cut_checkbox'] = '0';
            }
        }
        if($request->hgt_fish_cut){
            $imageName = time().'.'.$request->hgt_fish_cut->extension();
            $request->hgt_fish_cut->move(public_path('userImages'),$imageName);
            $createImageFile = UploadFile::create([
                'user_id' => NULL,
                'file' => $imageName,
                'location' => public_path('userImages'),
                'type' => 'producer profile'
            ]); 
            $updateSopSettings['hgt_fish_cut'] = $createImageFile->id;
        }
        if($request->hg_fish_cut){
            $imageName1 = time().'.'.$request->hg_fish_cut->extension();
            $request->hg_fish_cut->move(public_path('userImages'),$imageName1);
            $createImageFile1 = UploadFile::create([
                'user_id' => NULL,
                'file' => $imageName1,
                'location' => public_path('userImages'),
                'type' => 'producer profile'
            ]); 
            $updateSopSettings['hg_fish_cut'] = $createImageFile1->id;
        }
        if($request->sop_file){
            $imageName2 = time().'.'.$request->sop_file->extension();
            $request->sop_file->move(public_path('userImages'),$imageName2);
            $createImageFile2 = UploadFile::create([
                'user_id' => NULL,
                'file' => $imageName2,
                'location' => public_path('userImages'),
                'type' => 'producer profile'
            ]); 
            $updateSopSettings['specification_sop_file'] = $createImageFile2->id;
        }
        if($request->hgt_fish_cut_checkbox == 'on' ||  $request->hg_fish_cut_checkbox == 'on'){
            $getSopSettings = SpecificationSopSetting::where('producer_id',$request->row_id)->first();
            $updateSopSettings['producer_id'] = $request->row_id;
            $updateSopSettings['production_and_storage_facilities'] = $request->production_and_storage_facilities;
            $updateSopSettings['hgt_fish_cut_checkbox'] = $sopSettings['hgt_fish_cut_checkbox'];
            $updateSopSettings['hg_fish_cut_checkbox'] = $sopSettings['hg_fish_cut_checkbox'];
            if(!empty($getSopSettings)){
                $getSopSettings = SpecificationSopSetting::where('producer_id',$request->row_id)->update($updateSopSettings);
            }
            else{

                SpecificationSopSetting::create($updateSopSettings);
            }
        }
        if(isset($request->acceptable_species) && !empty($request->acceptable_species)){
           if(isset($request->acceptable_species['acceptable_species_id']) && !empty($request->acceptable_species['acceptable_species_id'])){
                foreach($request->acceptable_species['acceptable_species_id'] as $key=> $acceptable_species_id){
                    if(isset($request->acceptable_species['is_checked']) && !empty($request->acceptable_species['is_checked'])){
                        if(isset($request->acceptable_species['is_checked'][$key])){
                            $isChecked = '1';
                        }
                        else{
                            $isChecked = '0';
                        }
                    }
                    else{
                        $isChecked = '0';
                    }
                    $createAcceptableSpecies = array(
                        'producer_id'           => $request->row_id,
                        'is_checked'            => $isChecked,
                        'acceptable_species_id' => $request->acceptable_species['acceptable_species_id'][$key],
                        'scientific_name'       => $request->acceptable_species['scientific_name'][$key],
                        'common_name'           => $request->acceptable_species['common_name'][$key]
                    );
                    if(isset($request->acceptable_species['id']) && !empty($request->acceptable_species['id'])){
                        if(isset($request->acceptable_species['id'][$key])){
                          $id = $request->acceptable_species['id'][$key];
                        }
                        else{
                            $id = NULL;
                        }
                    }
                    else{ 
                        $id = NULL;
                    } 
                    if($id != NULL){
                        AcceptableSpecy::where('id', $id)->update($createAcceptableSpecies);
                    }
                    else{
                        AcceptableSpecy::create($createAcceptableSpecies);
                    }  
                }
            }   
        }
        if(isset($request->fresh_fish_test) && !empty($request->fresh_fish_test)){
            if(isset($request->fresh_fish_test['focus']) && !empty($request->fresh_fish_test['focus'])){
                foreach($request->fresh_fish_test['focus'] as $key=> $fresh_fish_test){
                    $createfresh_fish_test = array(
                       'producer_id' => $request->row_id,
                       'focus'      => $request->fresh_fish_test['focus'][$key],
                       'quality_parameter'  => $request->fresh_fish_test['quality_parameter'][$key],
                       'target'  => $request->fresh_fish_test['target'][$key]
                    );  
                    if(isset($request->fresh_fish_test['id']) && !empty($request->fresh_fish_test['id'])){
                        if(isset($request->fresh_fish_test['id'][$key])){
                           $id = $request->fresh_fish_test['id'][$key];
                        }
                        else{
                            $id = NULL;
                        }
                    }
                    else{ 
                        $id = NULL;
                    } 
                    if($id != NULL){
                        FreshFish::where('id', $id)->update($createfresh_fish_test);
                    }
                    else{
                        FreshFish::create($createfresh_fish_test);
                    }
                }
            }
        }
        if(isset($request->length_width_specification) && count($request->length_width_specification)){
            foreach($request->length_width_specification as $lengthWidthSpecification){
                if(isset($lengthWidthSpecification['is_checked']) && count($lengthWidthSpecification['is_checked'])){
                   
                    $createSpecsType = array(
                        'producer_id' => $request->row_id,
                        'name' => isset($lengthWidthSpecification['name'][0])?$lengthWidthSpecification['name'][0]:'',
                        'type' => isset($lengthWidthSpecification['type'][0])?$lengthWidthSpecification['type'][0]:'',
                        'checked' => isset($lengthWidthSpecification['is_checked'][0])?'1':'0'
                    ); 
                    if(isset($lengthWidthSpecification['id'][0]) && $lengthWidthSpecification['id'][0]!=NULL){
                        SpecType::where('id',$lengthWidthSpecification['id'][0])->update($createSpecsType);
                        $specsTypeId = $lengthWidthSpecification['id'][0];
                    }
                    else{ 
                        $creatSpecsType = SpecType::create($createSpecsType);
                        $specsTypeId = $creatSpecsType->id;
                    } 
                    if(isset($lengthWidthSpecification['species']['spec_type'])){ 
                        if(isset($lengthWidthSpecification['species']['spec_type']) && count($lengthWidthSpecification['species']['spec_type'])){
                            foreach($lengthWidthSpecification['species']['spec_type'] as $key=> $specType){
                                $speciesArray = array(
                                    'is_checked' =>isset($lengthWidthSpecification['species']['is_checked'][$key])?'1':'0',
                                    'spec_type' => isset($lengthWidthSpecification['species']['spec_type'][$key])?$lengthWidthSpecification['species']['spec_type'][$key]:'', 
                                    'spec_id'   => isset($lengthWidthSpecification['species']['spec_id'][$key])?$lengthWidthSpecification['species']['spec_id'][$key]:$specsTypeId,
                                    'producer_id' => $request->row_id,
                                    'min_cut_length_offset' => isset($lengthWidthSpecification['species']['min_cut_length_offset'][$key])?$lengthWidthSpecification['species']['min_cut_length_offset'][$key]:'',
                                    'max_cut_length_offset' => isset($lengthWidthSpecification['species']['max_cut_length_offset'][$key])?$lengthWidthSpecification['species']['max_cut_length_offset'][$key]:'',
                                    'min_cut_weight_offset' => isset($lengthWidthSpecification['species']['min_cut_weight_offset'][$key])?$lengthWidthSpecification['species']['min_cut_weight_offset'][$key]:'',
                                    'max_cut_weight_offset' => isset($lengthWidthSpecification['species']['max_cut_weight_offset'][$key])?$lengthWidthSpecification['species']['max_cut_weight_offset'][$key]:''
                                );
                                if(isset($lengthWidthSpecification['species']['id'][$key]) && $lengthWidthSpecification['species']['id'][$key]!='NULL'){
                                    UserSpecification::where('id',$lengthWidthSpecification['species']['id'][$key])->update($speciesArray);
                                }
                                else{
                                    UserSpecification::create($speciesArray);
                                }
                            }
                        }  
                    }  
                }
            }
        
        }
        if(isset($request->chemical_criterias) && count($request->chemical_criterias)){
            if(isset($request->chemical_criterias['title']) && count($request->chemical_criterias['title'])){
                foreach($request->chemical_criterias['title'] as $key=> $chemicalCriterias){
                    $createChemicalCriteria = array(
                        'producer_id' => $request->row_id,
                        'title'       => isset($request->chemical_criterias['title'][$key])?$request->chemical_criterias['title'][$key]:'',
                        'description' => isset($request->chemical_criterias['description'][$key])?$request->chemical_criterias['description'][$key]:''
                    );
                    if(isset($request->chemical_criterias['id'][$key]) && $request->chemical_criterias['id'][$key]!='NULL'){
                        ChemicalCriteria::where('id',$request->chemical_criterias['id'][$key])->update($createChemicalCriteria);
                    }
                    else{
                        ChemicalCriteria::create($createChemicalCriteria);
                    }
                }             
            }                 
        }
        if(isset($request->heavy_metals) && count($request->heavy_metals)){
            if(isset($request->heavy_metals['name']) && count($request->heavy_metals['name'])){
                foreach($request->heavy_metals['name'] as $key=> $heavyMetals){
                    $createheavyMetals = array(
                        'producer_id' => $request->row_id,
                        'name'  => isset($request->heavy_metals['name'][$key])?$request->heavy_metals['name'][$key]:'',
                        'mark'  => isset($request->heavy_metals['mark'][$key])?$request->heavy_metals['mark'][$key]:'',
                        'max_limit_ppm'  => isset($request->heavy_metals['max_limit_ppm'][$key])?$request->heavy_metals['max_limit_ppm'][$key]:''
                    );
                    if(isset($request->heavy_metals['id'][$key]) && $request->heavy_metals['id'][$key]!='NULL'){
                        HeavyMetal::where('id',$request->heavy_metals['id'][$key])->update($createheavyMetals);
                    }
                    else{
                        HeavyMetal::create($createheavyMetals);
                    }
                }
            }
        }
        if(isset($request->microbiological_criterias) && count($request->microbiological_criterias)){
            if(isset($request->microbiological_criterias['germs']) && count($request->microbiological_criterias['germs'])){
                foreach($request->microbiological_criterias['germs'] as $key=>$microbiologicalCriterias){
                    $createMicrobiologicalCriterias = array(
                        'producer_id' => $request->row_id,
                        'germs' => isset($request->microbiological_criterias['germs'][$key])?$request->microbiological_criterias['germs'][$key]:'',
                        'n'   => isset($request->microbiological_criterias['n'][$key])?$request->microbiological_criterias['n'][$key]:'',
                        'c' => isset($request->microbiological_criterias['c'][$key])?$request->microbiological_criterias['c'][$key]:'',
                        'nm' => isset($request->microbiological_criterias['nm'][$key])?$request->microbiological_criterias['nm'][$key]:'',
                        'cm' => isset($request->microbiological_criterias['cm'][$key])?$request->microbiological_criterias['cm'][$key]:''
                    );
                    if(isset($request->microbiological_criterias['id'][$key]) && $request->microbiological_criterias['id'][$key]!='NULL'){
                        MicrobiologicalCriteria::where('id',$request->heavy_metals['id'][$key])->update($createMicrobiologicalCriterias);
                    }
                    else{
                        MicrobiologicalCriteria::create($createMicrobiologicalCriterias);
                    }
                }
            }
        }
        $data=['success'=>'Producer '.ucfirst($request->name).' has been Created!.'];
        return redirect('accountmanagement/producers')->with($data)->withInput();
    }

/**
 *  Create City 
 */
    public function createCity(Request $request){
    
        $validator = $request->validate([
            'name'    =>   'required',
            'country_id' => 'required'
        ]);
        $createCity = array(
            'name' => $request->name,
            'name_key' => $request->name,
            'country_id' => $request->country_id
        );
        $createCities = City::create($createCity);
        return Response::json(array(
            'success' => true,
            'data'   => $createCities,
            'status' => 200
        )); 
    } 
   
}
    