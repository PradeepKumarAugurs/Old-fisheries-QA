<?php

namespace Modules\AccountManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth; 
use Modules\AccountManagement\Entities\SopFile;
use Modules\AccountManagement\Entities\UploadFile;
use File;
use Validator;

class SopFileController extends Controller
{
    
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function deleteSopFile(Request $request)    //  sop file delete according to  the File_id from the master table 
    {   
        if($request->id){
            $user = Auth::user();
            if($user->role=='1'){ 
                //$selectfile=SopFile::find($request->id); 
                
                $uploadFiles=UploadFile::find($request->id);
                $file_path = storage_path("app/documents/{$uploadFiles->file}"); 
                if(File::exists($file_path)) {  
                    File::delete($file_path);
                }
                $sopFile=UploadFile::destroy($request->id);
                //$sopFile=SopFile::destroy($request->id);
                if($sopFile){
                    return response()->json(['success' =>'sop file deleted'], 200); 
                }
                else{
                    return response()->json(['error'=>"somthing went wrong , try  again"], 401); 
                }
            }
            else{
                return response()->json(['error'=>"you are not authorized to this action"], 401); 
            }

        }
    }

    public  function  uploadFiles(Request $request){
        // print_r(count($request->file('file')));  
        //print_r(count($request->file('file')));  
        // print_r($request->type); die; 

        $validator = Validator::make($request->all(), [
            'file'     => 'required',
            'type'     => 'required',
            // 'user_id'  => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $files = $request->file('file');

        if($request->hasFile('file'))
        {
            $filedata=array();
            foreach ($files as $file) {
                $uploaded_img=$file->store('documents');
                if($uploaded_img){
                    $file_name=substr($uploaded_img,10,200);
                    $create=UploadFile::create([
                        'user_id' => $request->user_id,
                        'file' => $file_name,
                        'location' => storage_path("app/documents/"),
                        'type' => $request->type
                    ]); 
                    array_push($filedata,$create);
                }
            }
            return response()->json(['uploaded_files'=>$filedata], 200);
        }
    }
    
}
