<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\AccountManagement\Entities\ReferenceCountry;
use Modules\AccountManagement\Entities\ReferenceZone;
use Modules\AccountManagement\Entities\ReferenceSupplier;
use Modules\AccountManagement\Entities\ReferenceProducer;
use Modules\AccountManagement\Entities\UserAccess;
use Modules\AccountManagement\Entities\Country;
use Modules\AccountManagement\Entities\UserAudit;
use Modules\AccountManagement\Entities\CompanyInfo;
use Modules\Auth\Entities\CompanyPosition;
use Modules\AccountManagement\Entities\AffiliationsCountry;
use Modules\AccountManagement\Entities\AffiliationsProducer;
use Modules\AccountManagement\Entities\Producer;
use Illuminate\Support\Facades\Storage;
use Modules\AccountManagement\Entities\MasterAccess;
use Validator,DB;
class AccountManagementController extends Controller
{

    
   
    /**
     * @OA\Get(
     *   path="/accountmanagement/getBasicInfo/{user_id}",
     *   summary="Get User Basic Info",
     *   description="Account Management Basic Info",
     *   operationId="userBasicInfo",
     *   tags={"AccountManagement"},
     *   security={{"bearerAuth":{}}}, 
     *   @OA\Parameter(
     *     description="ID of user to  return",
     *     in="path",
     *     name="user_id",
     *     required=true,
     *     @OA\Schema(type="number",format="1")
     *   ),
     *   @OA\Response(
     *      response=201,
     *      description="Success",
     *      @OA\JsonContent(
     *       @OA\Property(property="error",type="string",example="")
     *      )    
     *   )
     *   
     * )
    */
    public  function getBasicInfo(Request $request){ 

        $result=User::select('id','username','is_leader','role','type','email','country_code','mobile_no','logo')
        ->where('id',$request->user_id)->first();
        // 'company','country_code','type','production_capacity','storage_capacity','boat_contract','boat_owner','boat_contract_capacity','boat_owner_capacity','role','logo' 
        if(!empty($result)){
            return $result; 
        }
        else{
            return response()->json(['error'=>'user not found!'], 401);
        }
         
    }

    /**
     * @OA\Post(
     *  path="/accountmanagement/updateBasicInfo/",
     *  summary="Update user Basic Info",
     *  description="update user basic info",
     *  operationId="updateBasicInfo",
     *  tags={"AccountManagement"},
     *  security={{"bearerAuth":{}}},
     *  @OA\RequestBody(
     *    required=true,
     *    description="pass user details",
     *    @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 allOf={
     *                         @OA\Schema(ref="#components/schemas/item"),
     *                         @OA\Schema(
     *                         required={"company","production_capacity","storage_capacity","boat_contract","boat_owner",
     *                         "role","user_id","type","boat_contract_capacity","boat_owner_capacity"},
     *                         @OA\Property(description="Logo", property="logo", type="string", format="binary"),
     *                         @OA\Property(description="Company",property="company",type="string",format="string",example="Amazone"),
    *                          @OA\Property(description="Production Capacity",property="production_capacity",type="string",format="string",example="34"),
    *                          @OA\Property(description="Storage Capacity",property="storage_capacity",type="string",format="string",example="34"),
    *                          @OA\Property(description="Boat Contract",property="boat_contract",type="string",format="string",example="1"),
    *                          @OA\Property(description="Boat Owner",property="boat_owner",type="string",format="string",example="1"),
    *                          @OA\Property(description="Role",property="role",type="string",format="string",example="1"),
    *                          @OA\Property(description="User Id",property="user_id",type="string",format="string",example="1"),
    *                          @OA\Property(description="Type",property="type",type="string",format="string",example="1"),
    *                          @OA\Property(description="Boat Contract Capacity",property="boat_contract_capacity",type="string",format="string",example="12"),
    *                          @OA\Property(description="Boat Owner Capacity",property="boat_owner_capacity",type="string",format="string",example="12")
     *                     )
     *                 }
     *             )
     *     ),
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Bad request response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message",type="string",
     *         example={
     *           "error": {
     *                  "company": {
     *                       "The company field is required."
     *                   },
     *                   "production_capacity": {
     *                       "The production capacity field is required."
     *                   },
     *                   "storage_capacity": {
     *                       "The storage capacity field is required."
     *                   },
     *                   "boat_contract": {
     *                       "The boat contract field is required."
     *                   },
     *                   "boat_owner": {
     *                       "The boat owner field is required."
     *                   },
     *                   "role": {
     *                       "The role field is required."
     *                   },
     *                   "user_id": {
     *                       "The user id field is required."
     *                   },
     *                   "type": {
     *                       "The type field is required."
     *                   },
     *                   "boat_contract_capacity": {
     *                       "The boat contract capacity field is required."
     *                   },
     *                   "boat_owner_capacity": {
     *                       "The boat owner capacity field is required."
     *                   }
     *               }
     *           }
     *       )
     *    )
     *  )
     * )
    */
    
    public  function  updateBasicInfo(Request $request){ 
        $validator = Validator::make($request->all(), [
            // 'logo'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id'     => 'required|numeric|min:1|max:99990',
            'username'    => 'required|string|min:2|max:255',
            'is_leader'   => 'required|numeric|min:0|max:1',
            'role'        => 'required|numeric|min:1|max:7',
            'type'        => 'required|numeric|min:1|max:2',
            // 'email'       => 'required|email',
            // 'country_code'=> 'required|string|min:2|max:2',
            // 'mobile_no'   => 'required|string|min:10|max:20'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        

         if($request->user_id!=""){
            $updated_data=array(
                'username'     => $request->username,
                'is_leader'    => $request->is_leader,
                'role'         => $request->role,
                'type'         => $request->type,
                // 'email'        => $request->email,
                // 'country_code' => $request->country_code,
                // 'mobile_no'    => $request->mobile_no
            );
            if($request->is_leader=='1'){
                $updated_data['leader_id']=$request->user_id;
            }
            
            $result=User::update_by_condition($updated_data,array('id'=>$request->user_id));
            return response()->json($updated_data, 200);
         }
         else{
            return response()->json(['error'=>'user is required'], 401); 
         }
    }
   /**
     * @OA\Get(
     *   path="/accountmanagement/getGeneralInfo/{user_id}",
     *   summary="Get User General Info",
     *   description="Account Management General Info",
     *   operationId="userGeneralInfo",
     *   tags={"AccountManagement"},
     *   security={{"bearerAuth":{}}}, 
     *   @OA\Parameter(
     *     description="ID of user to  return",
     *     in="path",
     *     name="user_id",
     *     required=true,
     *     @OA\Schema(type="number",format="1")
     *   ),
     *   @OA\Response(
     *      response=201,
     *      description="Success",
     *      @OA\JsonContent(
     *       @OA\Property(property="error",type="string",example="")
     *      )    
     *   )
     *   
     * )
    */

    public  function getGeneralInfo(Request $request){
        
        $result=User::select('id as user_id','role','username','company','logo','is_leader','leader_id','production_capacity','storage_capacity','boat_contract','boat_owner','boat_contract_capacity','boat_owner_capacity')
        ->where('id',$request->user_id)->first();
        if(!empty($result)){
            if(isset($result) && $result->leader_id!=Null){
                $leaderuser=User::getUser($result->leader_id);
                $result->leader_username=$leaderuser->username;
                $result->leader_mobile_no=$leaderuser->mobile_no;
                $result->leader_email=$leaderuser->email;
            }
            else{
                $result->leader_username='';
                $result->leader_mobile_no='';
                $result->leader_email='';
            }
            $getUserDetails=User::with(['audits','company_infos','logo_files'])->find($request->user_id);
            $result->audits=$getUserDetails->audits;
            $result->company_infos=$getUserDetails->company_infos;
            $result->logo_files=$getUserDetails->logo_files;

            $referenceCountry=ReferenceCountry::select('id','user_id','country_id')
            ->where('user_id',$request->user_id)
            ->with('zones')->with('country')
            ->with(['suppliers'=>function($query){
                $query->select('*')->with('producers');
            }])
            ->get();
            $result->categorization=$referenceCountry;
          
            return response()->json($result, 200);
        }else{
            return response()->json(['error'=>'user not found'], 401); 
        }
         
    }

    /*  Update  Genral Info */
    Public function updateGeneralInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'                 => 'required|numeric|min:1|max:999999',
            'company'                 => 'required|string',
            'is_leader'               => 'required|numeric|min:0|max:1',
            'leader_id'               => 'required|numeric|min:1|max:999999',
            'production_capacity'     => 'required|numeric|min:0|max:99999',
            'storage_capacity'        => 'required|numeric|min:0|max:99999',
            'boat_contract'           => 'required|numeric|min:0|max:1',
            'boat_owner'              => 'required|numeric|min:0|max:1',
            'boat_contract_capacity'  => 'required|numeric|min:0|max:99999',
            'boat_owner_capacity'     => 'required|numeric|min:0|max:99999',
            'categorization'          => 'required|array',
            'audits'                  => 'required|array',
            'company_infos'           => 'array'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 
        $getUser=User::find($request->user_id);
        if(!empty($getUser)){ 
            $user_id=$request->user_id;
            if(count($request->categorization)){
                $validator2 = Validator::make($request->all(), [
                    'categorization.*.country_id'                                    => 'required|numeric|min:1|max:99999',
                    'categorization.*.zones'                                         => 'array',
                    'categorization.*.suppliers'                                     => 'array',
                    'categorization.*.suppliers.*.reference_country_id'              => 'required|numeric|min:1|max:99999',
                    'categorization.*.suppliers.*.supplier_id'                       => 'required|numeric|min:1|max:99999',
                    'categorization.*.suppliers.*.producers'                         => 'array',
                    'categorization.*.suppliers.*.producers.*.reference_country_id'  => 'required|numeric|min:1|max:99999',
                    'categorization.*.suppliers.*.producers.*.reference_supplier_id' => 'numeric|min:1|max:99999',
                    'categorization.*.suppliers.*.producers.*.producer_id'           => 'required|numeric|min:1|max:99999'
                ]);
                if ($validator2->fails()) { 
                    // return response()->json(['error'=>$validator2->errors()], 401);     
                    return response()->json(['error'=>array('categorizationColumn'=>true)], 401); 
                } 
            } 
            if(count($request->audits)){
                $validator3 = Validator::make($request->all(), [
                    //'audits.user_id'                      => 'required|numeric|min:1|max:999999',
                    'audits.information'                  => 'required|string|min:1|max:99999',
                    'audits.is_factory_approved'          => 'required|numeric|min:0|max:2',
                    'audits.audit_date'                   => 'required|date_format:Y-m-d',
                    'audits.scoring'                      => 'required|numeric|min:0|max:255'
                ]);
                if ($validator3->fails()) { 
                    return response()->json(['error'=>$validator3->errors()], 401);            
                } 
            }
            if(isset($request->company_infos) && count($request->company_infos)){
                $validator_company_infos = Validator::make($request->all(), [
                    //'company_infos.*.user_id'                      => 'required|numeric|min:1|max:999999',
                    'company_infos.*.title'                        => 'required|string|max:99999',
                    'company_infos.*.value'                        => 'required|string|max:99999'
                ]);
                if ($validator_company_infos->fails()) { 
                    return response()->json(['error'=>$validator_company_infos->errors()], 401);            
                } 
            }

            
            $updated_data=array(
                'company'                 => $request->company,
                'is_leader'               => $request->is_leader,
                'leader_id'               => $request->leader_id,
                'production_capacity'     => $request->production_capacity,
                'storage_capacity'        => $request->storage_capacity,
                'boat_contract'           => $request->boat_contract,
                'boat_owner'              => $request->boat_owner,
                'boat_contract_capacity'  => $request->boat_contract_capacity,
                'boat_owner_capacity'     => $request->boat_owner_capacity,
            );
            if(!empty($request->logo)){
                if(isset($request->logo) && $request->logo!=""){
                    $validator_company_logo = Validator::make($request->all(), [
                        'logo'                        => 'required|numeric|min:1'
                    ]);
                    if ($validator_company_logo->fails()) { 
                        return response()->json(['error'=>$validator_company_logo->errors()], 401);            
                    } 
                }
                $updated_data['logo']=$request->logo;
            }
            $result=User::update_by_condition($updated_data,array('id'=>$user_id));
            if(isset($request->audits) && !empty($request->audits)){  
                $this->updateAudits($request->audits,$user_id);
            }
            if(isset($request->company_infos) && count($request->company_infos)){  
                $this->updateCompanyInfos($request->company_infos,$user_id);
            }
            if(count($request->categorization)){
                 foreach($request->categorization as $row){
                 
                    if(isset($row['id']) && $row['id']!=null){   
                        $ReferenceCountry=ReferenceCountry::where(['user_id'=>$user_id,'id'=>$row['id']])->get(); 
                        if($ReferenceCountry->count()){ 
                            $referenceCountryId=$row['country_id']; 
                            $inreference=ReferenceCountry::where('id',$row['id'])->update(array('user_id'=>$user_id,'country_id'=>$row['country_id']));
                        }
                        else{ 
                            // $inreference=ReferenceCountry::insert(array('user_id'=>$row['user_id'],'country_id'=>$row['country_id']));
                        }

                    }
                    else{  
                          
                            $inreference=ReferenceCountry::create(array('user_id'=>$user_id,'country_id'=>$row['country_id'])); 
                            $referenceCountryId=$row['country_id'];   
                       
                    }
                    /* check zone And Save its */
                    if(count($row['zones'])){
                        foreach($row['zones'] as $row_zone){
                               if(isset($row_zone['id']) && $row_zone['id']!=NULL){
                                    $ReferenceZones=ReferenceZone::where(['user_id'=>$user_id,'id'=>$row_zone['id']])->get(); 
                                    if($ReferenceZones->count()){
                                        $inreference=ReferenceZone::where('id',$row_zone['id'])->update(array(
                                            'user_id'=>$user_id,
                                            'reference_country_id'=>$row_zone['reference_country_id'],
                                            'zone_id' => $row_zone['zone_id'],
                                            'title' => $row_zone['title'],
                                            'zonekey' => $row_zone['zonekey']
                                        ));
                                    }
                                    else{
                                        // $inreference=ReferenceZone::insert(array(
                                        //     'user_id'=>$user_id,
                                        //     'reference_country_id'=>$row_zone['reference_country_id'],
                                        //     'zone_id' => $row_zone['zone_id'],
                                        //     'title' => $row_zone['title'],
                                        //     'zonekey' => $row_zone['zonekey']
                                        // ));
                                    }
                               }
                               else{
                                    $inreference=ReferenceZone::create(array(
                                        'user_id'=>$user_id,
                                        'reference_country_id'=>$referenceCountryId,
                                        'zone_id' => $row_zone['zone_id'],
                                        'title' => $row_zone['title'],
                                        'zonekey' => $row_zone['zonekey']
                                    ));
                               }

                        }
                    }
                    /*  Check  Supplier  And  Save its */
                    if(count($row['suppliers'])){
                        foreach($row['suppliers'] as $row_supplier){
                            
                               if(isset($row_supplier['id']) && $row_supplier['id']!=NULL){
                                $ReferenceSupplier=ReferenceSupplier::where([
                                    'user_id'=>$user_id,
                                    'id'=>$row_supplier['id']])->get(); 
                                
                                 if($ReferenceSupplier->count()){  
                                     $referenceSupplierId=$row_supplier['supplier_id'];
                                     $inreference=ReferenceSupplier::where([
                                        'user_id'=>$user_id,
                                        'id'=>$row_supplier['id']])->update(array(
                                         'user_id'=>$user_id,
                                         'reference_country_id'=>$row_supplier['reference_country_id'],
                                         'supplier_id' => $row_supplier['supplier_id']
                                     ));
                                 }
                                 else{
                                    // $inreference=ReferenceSupplier::insert(array(
                                    //     'user_id'=>$user_id,
                                    //     'reference_country_id'=>$row_supplier['reference_country_id'],
                                    //     'supplier_id' => $row_supplier['supplier_id']
                                    // ));
                                 }
                               }
                               else
                               {
                                    $inreference=ReferenceSupplier::create(array(
                                        'user_id'=>$user_id,
                                        'reference_country_id'=>$referenceCountryId,
                                        'supplier_id' => $row_supplier['supplier_id']
                                    ));
                                    $referenceSupplierId=$row_supplier['supplier_id'];
                               }
                               

                                
                                /* check zone And Save its */
                                if(isset($row_supplier['producers']) && count($row_supplier['producers'])){ 
                                    foreach($row_supplier['producers'] as $row_producer){
                                        
                                        if(isset($row_producer['id']) && $row_producer['id']!=NULL){ 
                                            $ReferenceProducer=ReferenceProducer::where([
                                                'user_id'=>$user_id,
                                                'id'=>$row_producer['id']
                                                ])->get(); 
                                                
                                                if($ReferenceProducer->count()){
                                                    $referenceProducerId=$row_producer['id'];
                                                   
                                                    $update_reference=ReferenceProducer::where([
                                                        'user_id'=>$user_id,
                                                        'id'=>$row_producer['id']
                                                        ])->update(array(
                                                        'user_id'=>$user_id,
                                                        'reference_country_id'=>$row_producer['reference_country_id'],
                                                        'reference_supplier_id' => $row_producer['reference_supplier_id'],
                                                        'producer_id' => $row_producer['producer_id']
                                                    ));
                                                }
                                                else{
                                                    // $insert_reference=ReferenceProducer::insert(array(
                                                    //     'user_id'=>$user_id,
                                                    //     'reference_country_id'=>$row_producer['reference_country_id'],
                                                    //     'reference_supplier_id' => $row_producer['reference_supplier_id'],
                                                    //     'producer_id' => $row_producer['producer_id']
                                                    // ));
                                                }
                                        }
                                        else{ 
                                            $insert_reference=ReferenceProducer::create(array(
                                                'user_id'=>$user_id,
                                                'reference_country_id'=>$referenceCountryId,
                                                'reference_supplier_id' => $referenceSupplierId,
                                                'producer_id' => $row_producer['producer_id']
                                            ));
                                            $referenceProducerId=$insert_reference->id;
                                        }
                                        
                                    }
                                } /*  end of  the save Producers */
                        }
                    }
                }
            }
            
            return response()->json($request->all(), 200);
         }
         else{
            return response()->json(['error'=>'user not found! '], 401); 
         }

    }

    /* update the Audit Information */
    public  function  updateAudits($audits,$userId){  
        if(count($audits) && $userId){ 
            $getUserAudit=UserAudit::where('user_id',$userId)->get();
            
                if(count($getUserAudit)){  
                $updateAudit=UserAudit::where('user_id',$userId)->update([
                    "user_id" => $userId,
                    "information" => isset($audits['information'])?$audits['information']:null,
                    "is_factory_approved" => isset($audits['is_factory_approved'])?$audits['is_factory_approved']:2,
                    "audit_date" => isset($audits['audit_date'])?$audits['audit_date']:null,
                    "scoring" => isset($audits['scoring'])?$audits['scoring']:null
                ]); 
                }
                else{ 
                    $updateAudit=UserAudit::create([
                        "user_id" => $userId,
                        "information" => isset($audits['information'])?$audits['information']:null,
                        "is_factory_approved" => isset($audits['is_factory_approved'])?$audits['is_factory_approved']:2,
                        "audit_date" => isset($audits['audit_date'])?$audits['audit_date']:null,
                        "scoring" => isset($audits['scoring'])?$audits['scoring']:null
                    ]); 
                }
            }
    }
    
    
    /**
     * upadte the Company infos 
    */
    public  function  updateCompanyInfos($companyInfos,$userId){
        if(count($companyInfos)){ 
            foreach($companyInfos as $info){ 
                $info['user_id']=$userId;
                CompanyInfo::updateOrCreate(['id'=>isset($info['id'])?$info['id']:null],$info);
            } 
        }
    }

    /* get  all  country */
    public  function all_countries(Request $request){
        return response()->json(Country::get(), 200); 
    }
    

    /*  get  All Access */
    public  function getAccess(Request $request){
        
        $result=UserAccess::with(['user'=>function($query){
            $query->select('id','username');}])->with('access')->get();
        return response()->json($result, 200); 
    }


    /* get  All  Suppliers*/
    public  function  suppliers(){
            $allSuppliers=User::where('role',2)->get();
            return response()->json($allSuppliers, 200); 
    }
    /*  end of all suppliers */


    /* get  All  producers*/
    public  function  producers(){
        $allProducers=User::where('role',3)->get();
        return response()->json($allProducers, 200);
    }

   /* update Access */
    public function updateAccess(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 
        $userId=$request->user_id;
    
    if(count($request->access)){
                foreach($request->access as $key => $row){
                // if($row['is_validated'] >= 3 || $row['is_validated'] < 0   || $row['access_right'] >= 4 ||  $row['access_right'] < 0 ){
                //     return response()->json(['error'=>'access_right or  is_validated value are invalid'], 401);   
                // }
                
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
                        return redirect()->back()->with(["error"=>'id :'.$row["id"].' not found !']);
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
            return redirect()->back()->with(["success"=>'User Created Success']);
    }
    else{
        return redirect()->back()->with(["error"=>'somthing went wrong!']);
    }
   }
   /*  End of  update Acccess */


   /*  get leader */
    public function getLeader(Request $request){
        $getAllLeader= User::select('id','username','email','mobile_no')->where('leader_id','!=',null)->get(); 
        return response()->json($getAllLeader, 200);
    }
    
    public  function getAllPositions(Request $request){
    $allPositions=CompanyPosition::get();
    return response()->json($allPositions, 200);
    }

    public function createUser(Request $request){
        $validator = Validator::make($request->all(), [
            'username'                 => 'required|string|unique:users',
            'company'                  => 'required|string',
            'email'                    => 'required|email|unique:users',
            'mobile_no'                => 'required|numeric|min:10',
            'role'                     => 'required|numeric|min:1|max:5',
            'position'                 => 'required|numeric|min:1|max:3',
            'identification'           => 'required|string',
            'user_image'               => 'required',
            'affiliations'             => 'required|array'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 
        if(isset($request->affiliations) && count($request->affiliations)){
            $validatorAffiliations = Validator::make($request->all(), [
                'affiliations.*.country_id'                       => 'required|numeric|min:1',
                'affiliations.*.is_checked'                       => 'required|numeric|min:0',
                'affiliations.*.producers'                        => 'required|array',
                'affiliations.*.producers.*.producer_id'          => 'required|numeric|min:1',
                'affiliations.*.producers.*.is_checked'           => 'required|numeric|min:0',
                'affiliations.*.producers.*.access_is_checked'    => 'required|numeric|min:0'
            ]);
            if ($validatorAffiliations->fails()) { 
                return response()->json(['error'=>$validatorAffiliations->errors()], 401);            
            } 
        }
        $createUserData=array(
            'username' => $request->username,
            'company'  => $request->company,
            'email'    => $request->email,
            'mobile_no' => $request->mobile_no,
            'role'      => $request->role,
            'position'  => $request->position,
            'identification' => $request->identification,
            'user_image' => $request->user_image,
            'password' => bcrypt('12345678*')
        );
        $created_user=User::create($createUserData); 
        if(isset($request->affiliations) && count($request->affiliations)){
            foreach($request->affiliations as $affiliations){
                $affiliations_countries=array('user_id' => $created_user->id,'country_id' => $affiliations['country_id'],'is_checked' => $affiliations['is_checked']); 
                AffiliationsCountry::updateOrCreate(['id' => isset($affiliations['id'])?$affiliations['id']:null],$affiliations_countries); 
                
                if(isset($affiliations['producers']) && count($affiliations['producers'])){
                    foreach($affiliations['producers'] as $producers){
                        $affiliations_producers=array(
                            'user_id'             => $created_user->id,
                            'country_id'          => $affiliations['country_id'],
                            'producer_id'         => $producers['producer_id'],
                            'is_checked'          => $producers['is_checked'],
                            'access_is_checked'   => $producers['access_is_checked']
                        ); 
                        AffiliationsProducer::updateOrCreate(['id' => isset($producers['id'])?$producers['id']:null],$affiliations_producers); 
                    }
                }
            }
        }
        return response()->json($request->all(), 200);
    }
/**
 *  Get User 
 */
public function getUser(Request $request, $row_id){
    $getUserId = User::find($row_id);
    if(!empty($getUserId)){
        $getAllLeader= User::select('id as user_id','username','email','mobile_no','role','company','position','identification','user_image')->where('role','!=',1)->where('id',$row_id)
        ->with('profileImage')->with(['affiliations'=>function($query){
            $query->select('*')->with('producers');
        }])->first(); 
        return response()->json($getAllLeader, 200);
    }
    else{
        return response()->json(['error'=>'User not found!']);
    }
}   
/**
 * Update User Profile
 */
public function updateUser(Request $request, $row_id){
        $validator = Validator::make($request->all(), [
            'username'                 => 'required|string|max:255',
            'company'                  => 'required|string',
            'email'                    => 'required|email',
            'mobile_no'                => 'required|numeric|min:10',
            'role'                     => 'required|numeric|min:1|max:5',
            'position'                 => 'required|numeric|min:1|max:3',
            'identification'           => 'required|string',
            'user_image'               => 'required',
            'affiliations'             => 'required|array'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 
        if(isset($request->affiliations) && count($request->affiliations)){
            $validatorAffiliations = Validator::make($request->all(), [
                'affiliations.*.country_id'                       => 'required|numeric|min:1',
                'affiliations.*.is_checked'                       => 'required|numeric|min:0',
                'affiliations.*.producers'                        => 'required|array',
                'affiliations.*.producers.*.producer_id'          => 'required|numeric|min:1',
                'affiliations.*.producers.*.is_checked'           => 'required|numeric|min:0',
                'affiliations.*.producers.*.access_is_checked'    => 'required|numeric|min:0'
            ]);
            if ($validatorAffiliations->fails()) { 
                return response()->json(['error'=>$validatorAffiliations->errors()], 401);            
            } 
        }
        $updateUserData=array(
            'username'  => $request->username,
            'company'   => $request->company,
            'email'     => $request->email,
            'mobile_no' => $request->mobile_no,
            'role'      => $request->role,
            'position'  => $request->position,
            'identification' => $request->identification,
            'user_image' => $request->user_image
        );
        $getIDUser=User::where('id',$row_id)->first();
        if(empty($getIDUser)){
            return response()->json(['error'=>"user not found !."], 401);
        }
        $getUserData = User::where('email',$request->email)->first();
        
        if(!empty($getUserData) && $getIDUser->email!=$getUserData->email){
            return response()->json(['error'=>'This email already exists'], 401);
        }

        $update_user = User::where('id',$row_id)->update($updateUserData);

        if(isset($request->affiliations) && count($request->affiliations)){
            foreach($request->affiliations as $affiliations){
                $affiliations_countries=array('user_id' => $row_id,'country_id' => $affiliations['country_id'],'is_checked' => $affiliations['is_checked']); 
                AffiliationsCountry::updateOrCreate(['id' => isset($affiliations['id'])?$affiliations['id']:null],$affiliations_countries); 
                
                if(isset($affiliations['producers']) && count($affiliations['producers'])){
                    foreach($affiliations['producers'] as $producers){
                        $affiliations_producers=array(
                            'user_id'             => $row_id,
                            'country_id'          => $affiliations['country_id'],
                            'producer_id'         => $producers['producer_id'],
                            'is_checked'          => $producers['is_checked'],
                            'access_is_checked'   => $producers['access_is_checked']
                        ); 
                        AffiliationsProducer::updateOrCreate(['id' => isset($producers['id'])?$producers['id']:null],$affiliations_producers); 
                    }
                }
            }
        }
        return response()->json($request->all(), 200);
}
/**
 * Get Profile
 */
    public  function  getUserProfile(Request $request){ 
        $getProfile=User::select('id as user_id','email','username','role','type','company')->find(request()->user()->id);
        return response()->json($getProfile);
    }


    public function  getAllUser(){
        $getAllLeader= User::select('id as user_id','username','role','position','company')->where('role','!=',1)->get(); 
        return response()->json($getAllLeader, 200);
    }


    /**
     * Get  All Producer 
    */

    public  function  getAllProducers(Request $request){ 
        $getAllProducer=Producer::get(); 
        return response()->json($getAllProducer);
    }
    
    /**
     * Update Profile
     */
    public function updateProfile(Request $request, $row_id){
    
        $getUserId = User::find($row_id);
        if(!empty($getUserId)){
            $validator = validator::make($request->all(), [
            'username'       => 'required|string|max:255',
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|max:255',
            'mobile_no'      => 'required|numeric|min:1',
            'position'       => 'required|numeric|min:1|max:99999',
            'identification' => 'required|numeric|min:1|max:99999',
            'type'           => 'required|numeric|min:1|max:99999',
            'role'           => 'required|numeric|min:1|max:99999',
            'company'        => 'required|numeric|min:1|max:99999'
            ]);
            if(!empty($validator->fails())){
                return response()->json(['error'=>$validator->errors()], 401);
            }
        $updateUser = array(
        
            'username' => $request->username,
            'name'     => $request->name,
            'email'    => $request->email,
            'mobile_no'=> $request->mobile_no,
            'position' => $request->position,
            'identification' => $request->identification,
            'type'     => $request->type,
            'role'     => $request->role,
            'company'  => $request->company
        );
        $upadteUserProfile = User::where('id',$row_id)->update($updateUser);
        return response()->json($request->all(), 200);
        }
        else{
            return response()->json(['error'=>'User not found!']);
        }
    }
    /**
     * Update User Data
     */
    public function updateUserData(Request $request){
        
        $validator = validator::make($request->all(), [

            'username' => 'required|string|max:255',
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|max:255',
            'mobile_na' => 'required|numeric|min:1|max:9999',   
            'position' => 'required|numeric|min:1|max:9999',
            'identification' => 'required|numeric|min:1|max:9999',
            'type'    => 'requied|numeric|min:1|max:9999',
            'role'    => 'required|numeric|min:1|max:9999',
            'company' => 'required|numeric|min:1|max:9999'
        ]);
        if(!empty($validator->fails())){
        
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $update = array(
        'username' => $request->username,
        'name'     => $request->name,
        'email'    => $request->email,
        'mobile_no'=> $request->mobile_no,
        'position' => $request->position,
        'identification' => $request->identification,
        'type'     => $request->type,
        'role'     => $request->role,
        'company'  => $request->company
        );
        
        return response()->json($request->all(), 200);
    }

    /**
     * Get Producers With Countries 
     */
    public function getAffiliationsData(Request $request){
        $getCountryId = Producer::distinct()->get(['country_id']);
        $data = $getCountryId->implode('country_id',',' );
        $getAllCountry = Country::whereIn('id', explode(',', $data))->with('producers')->get();
        return response()->json($getAllCountry, 200);
    }   
    
    public function getAccessAllData(){
            
        $getData =  UserAccess::get();
        return response()->json($getData, 200);
    }

    public function accessData(){

        $getdata = MasterAccess::with('parent')->with('children')->get();
        return response()->json($getdata, 200);
    }
    
}
