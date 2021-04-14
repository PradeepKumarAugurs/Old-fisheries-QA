<?php

namespace Modules\AccountManagement\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AccountManagement\Entities\SpecType;
use DB,Validator,Response;
class ProducerController extends Controller
{
    /**
     * get Wr Fish Descripancies 
    */
    public  function getWrFishDescripancies(Request $request){
        // echo 'getWrFishDescripancies '.$request->row_id;
        $data['discrepancies'] = DB::select("SELECT D.id,D.producer_id,M.id as discrepancy_id,M.discrepancies,M.discrepancy_key,
            (CASE WHEN D.is_checked  IS NULL THEN 0 ELSE D.is_checked END) as is_checked,
            (CASE WHEN D.rejection_value  IS NULL THEN M.rejection_value ELSE D.rejection_value END) as rejection_value,
            (CASE WHEN D.border_value IS NULL THEN M.border_value ELSE D.border_value END) as border_value
            ,M.unit,M.type,D.rejection_offset_value,D.border_offset_value, D.created_at,D.updated_at as new_id FROM `master_discrepancies` M left join (select * FROM user_discrepancies WHERE producer_id = $request->row_id) D on M.id = D.discrepancy_id WHERE M.type='1'");
        // print_r($discrepancies);
        // print_r($data['discrepancies']); die;   
        $data['mode']  = 'getWrFishDescripancies';
        $allDishtml = view('ajax')->with($data);
        return $allDishtml;
    }

    /**
     * get Cut Fish Descripancies
    */
    public  function getCutFishDescripancies(Request $request){
        // echo 'getCutFishDescripancies '.$request->row_id;
        $data['discrepancies'] = DB::select("SELECT D.id,D.producer_id,M.id as discrepancy_id,M.discrepancies,M.discrepancy_key,
            (CASE WHEN D.is_checked  IS NULL THEN 0 ELSE D.is_checked END) as is_checked,
            (CASE WHEN D.rejection_value  IS NULL THEN M.rejection_value ELSE D.rejection_value END) as rejection_value,
            (CASE WHEN D.border_value IS NULL THEN M.border_value ELSE D.border_value END) as border_value
            ,M.unit,M.type,D.rejection_offset_value,D.border_offset_value, D.created_at,D.updated_at as new_id FROM `master_discrepancies` M left join (select * FROM user_discrepancies WHERE producer_id = $request->row_id) D on M.id = D.discrepancy_id WHERE M.type='2'");
        // print_r($discrepancies);
        $data['mode']  = 'getCutFishDescripancies';
        $allDishtml = view('ajax')->with($data);
        return $allDishtml;
    }

    /**
     * Create Spec  type Like  As  Mackrel ,  Sardine Spec Etc.
    */
    public  function  saveSpecType(Request $request){
        // print_r($request->all());
        $validator = Validator::make($request->all(),[
            'producer_id'=> 'required|numeric',
            'name'  => 'required|unique:spec_types'
        ]);
        if($validator->fails()){
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
                'message' => ''
            ), 422); // 422 being the HTTP code for an invalid request.
        }
        $createSpecArray = array(
            'producer_id' => $request->producer_id,
            'name' => $request->name,
            'type' =>1,
            'checked' => 1
        );
        $createSpec = SpecType::create($createSpecArray);

        $allSpectype = SpecType::where('producer_id',$request->producer_id)->get();

        return Response::json(array(
            'success' => true,
            'errors' => '',
            'message' => 'Spec '.$request->name.' Created',
            'count' => count($allSpectype)-1,
            'createdData' => $createSpec
        ), 200);
    }

    /** 
     * Get  Length Width Species 
     * 
     * */
    public  function  getLengthWidthSpecies(Request $request){
        // print_r($request->all()); 
        $data['specCount'] = $request->specCount;
        $data['specTypeId'] = $request->SpecTypeId;
         $data['allUserSpec'] = DB::select("SELECT US.id,US.producer_id,US.spec_type,MS.id as spec_id ,(CASE WHEN US.is_checked IS NULL THEN 0 ELSE US.is_checked END ) as `is_checked`,MS.cut_type,MS.letter,MS.min_cut_length,MS.max_cut_length,MS.min_cut_weight,MS.max_cut_weight,US.min_cut_length_offset,US.max_cut_length_offset,US.min_cut_weight_offset,US.max_cut_weight_offset FROM `master_specs` MS left join (select * FROM user_specifications WHERE user_specifications.spec_type=$request->SpecTypeId and user_specifications.producer_id=$request->row_id ) US on MS.id =US.spec_id");
        // print_r($data['allUserSpec']); die; 
        $data['mode']  = 'getLengthWidthSpecies';
        $allDishtml = view('ajax')->with($data);
        // $allDishtml = "Hi Pradeep";
        return $allDishtml;
    }
}
