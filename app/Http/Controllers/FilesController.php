<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FilesModel;

class FilesController extends Controller
{
    public function create(){
       // $test = FilesModel::all();
       // return  $test;
       return view('backend.files.create');
    }

    public function store(Request $request){
        
        $data= new FilesModel;  
        $files=$request->file('file');  
        $name=$files->getClientOriginalName(); 
        $files->move('images',$name);
        // $data->$files;    
        $data->files=$name;  
         
        $data->save();  
       return response()->json($data);
      // return redirect('view');
    }  

    public function edit(Request $request, $id){

        $data = FilesModel::find($id);

        if($request->hasFile('file')){
           
            $files = $request->file('file');
            $name=$files->getClientOriginalName(); 
            $files->move('images',$name);
            $data->files=$name; 
        }
        $data->save();
        return response()->json($data);
    }

    


//     public function edit(Request $request)
// {
//     $data = FilesModel::find($request->id);
   
//     if($request->hasFile('newfile')){
//         $path = 'images/'.$data->files;
//         if(File::exists($path)){
//             File::delete($path);
//         }
//         $files = $request->file('newfile');
//         $name=$files->getClientOriginalName(); 
//         $files->move('images',$name);
//         $data->files=$name; 
//     }
//     $data->save();
//     return response()->json($data);
// }



    public function view($id) {
        $file = FilesModel::findOrFail($id);
        return response()->json($file);
    }

    public function destroy($id) {
       // $file = FilesModel::findOrFail($id)->delete();
        $file = FilesModel::where('id', $id)->delete();
        return response()->json($file);
    }
}
