<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use DB;

class EmployeeController extends Controller
{
    // public function index(Request $request){

    //     $search = $request->input('search') ?? "";
    //     //$search = $request['search'] ?? "";
    //     if($search != ""){
    //         $employee = EmployeeModel::query()
    //         ->where('name', 'LIKE', "%{$search}%")
    //         ->orWhere('email', 'LIKE', "%{$search}%")
    //         ->paginate();
           
    //     }else{
    //         $employee = EmployeeModel::sortable()->orderBy('id','desc')->paginate(5);
    //         //$employee = EmployeeModel::orderBy('id', 'desc')->paginate(3);
    //     }
    //     $data = compact('employee', 'search');
    //     return view('backend.employee.index')->with($data);
    // }

    public function newindex(Request $request){
        return view('backend.employee.index');
    }

    //  search with ajax 
    // public function search_table(Request $request){

    //     if($request->ajax())
    //     {
    //     // $output="";
    //     $search=EmployeeModel::where('name','LIKE','%'.$request->search.'%')
    //                         //->orWhere('email','LIKE','%'.$request->search."%")                    
    //                         ->get();
    //     return response()->json($search);
       
    //     // if($search)
    //     // {
    //     // foreach ($search as $key => $searches) {
    //     // $output.='<tr>'.
    //     // '<td>'.$searches->id.'</td>'.
    //     // '<td>'.$searches->name.'</td>'.
    //     // '<td>'.$searches->email.'</td>'.
    //     // '<td>'.$searches->phone.'</td>'.
    //     // '</tr>';
    //     // }
    //     // return Response($output);
    //     //    }
    //        }
    //     }   

    public function search_table(Request $request){

            // if($request->ajax())
            //    {
                $employee = EmployeeModel::where('name','LIKE','%'.$request->search.'%')
                                    ->paginate(3);
            
                $paginationLinks = (string) $employee->links();
                $response = array(
                'employee'  =>$employee,
                'pagination' => $paginationLinks
            );
            return response()->json($response); 
       //  }
        }
    


    public function employee_table()
        {
            $employee = EmployeeModel::paginate(3);
           // $employee = EmployeeModel::sortable()->orderBy('id','asc')->paginate(3);
            // handle your pagination links in AJAX
            //$data = compact('employee');
           $paginationLinks = (string) $employee->links();
           $response = array(
            'employee'  =>$employee,
            'pagination' => $paginationLinks
         );
         return response()->json($response); 
            // return response()->json([
            //     'employee'  =>$employee,
            //     'pagination' => $paginationLinks
            // ]);
        }


    public function view_pagination(Request $request){
            $employee = EmployeeModel::paginate(3);
            // handle your pagination links in AJAX
            $paginationLinks = (string) $employee->links();
            $response = array(
                'employee'  =>$employee,
                'pagination' => $paginationLinks
            );
            return response()->json($response); 
           
        }    

    // public function employee_table(){
    //     $employee = EmployeeModel::all();
    //     return response()->json($employee);
    // }

    public function view_sorting(Request $request)
    {
        $sort_by = $request->get('column_name');
        $sort_type = $request->get('order_type');
        $employee =  EmployeeModel::orderBy($sort_by, $sort_type)->paginate(3);
     
       
        $paginationLinks = (string) $employee->links();
        $response = array(
         'employee'  =>$employee,
         'pagination' => $paginationLinks
      );
      return response()->json($response); 
           
    }

    // public function employee_view(Request $request){
    //     $employee =  EmployeeModel::find($request->id);
    //     // echo "<pre>";
    //     // return print_r($employee);
    //     return response()->json($employee);
    // } 

    public function view($id){
        $employee =  EmployeeModel::find($id);
        // echo "<pre>";
        // return print_r($employee);
        if($employee){
            return response()->json([
                'status' => 200,
                'employee' => $employee,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'employee not found',
            ]);
        }
    }

    // public function edit($edit)
    // {
    //     $employee = EmployeeModel::find($edit);
    //     $data     = compact('employee');
    //     return view('backend.employee.edit')->with($data);
    // }

    // public function update(Request $request, $id){

    //     $employee = EmployeeModel::find($id);
    //     $employee->name = $request->name;
    //     $employee->email = $request->email;
    //     $employee->phone = $request->phone;
    //     $employee->save();
    //     return redirect('employee');

    // }

    public function update(Request $request, $id){
        $update = [
            'name' => $request->name,
            'email'=> $request->email,
            'phone' => $request->phone,
        ];
        $edit = EmployeeModel::where('id', $request->id)->update($update);
        if($edit){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Record updated succesfully!'
            ];
            return $response;
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Record updated failed!'
            ];
            return $response;
        }
    } 

    public function delete_employee(Request $request){
       // $delete = EmployeeModel::delete($request->id);
        $delete = EmployeeModel::where('id', $request->id)->delete();
        if($delete){
            $response = [
                'status' => 'ok',
                'success'=> true,
                'message' => 'Record deleted successfully'
            ];
            return $response;
        }else{
            $response = [
                'status' => 'ok',
                'success' => false,
                'message' => 'Record Delete failed'
            ];
            return $response;
        }
    }

    public function employee_add(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:5',
        ]);
        
        $employee  = new EmployeeModel;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();
        return response([
            'status' => 'ok',
            'success' => false,
            'message' => 'Insert record'
        ]);
    } 

    public function view_data(Request $request){

        $view = EmployeeModel::find($request->id);
        return response()->json($view);
      }






 // function related to jquery datatable plugin

    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $customers = EmployeeModel::all();
    //         return datatables()->of($customers)
    //             ->addColumn('action', function ($row) {
    //                 $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
    //                 $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
    //                 return $html;
    //             })->toJson();
    //     }

    //     return view('backend.curl.datatable');
    // }

    public function curl_api(Request $request)
    {
        if($request->ajax()) {
            //$customers = EmployeeModel::all();

            $url = "https://reqres.in/api/users";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);

            $response = json_decode($result, true);
            curl_close($ch);
        }
          return response()->json($response);
        //return response()->json($response);
       
    }


    public function index(Request $request)
    {
        if($request->ajax()) {
            $url = "https://reqres.in/api/users?page=2";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
          
            $response = json_decode($result, true);

            $responseData = $response['data'];
            
            curl_close($ch);
         
            return datatables()->of($responseData)
                ->addColumn('action', function ($row) {
                    $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
                    $html .= '<button data-rowid="' . $row['id'] . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
                    return $html;
                })->toJson();
            }
        return view('backend.curl.datatable');
    }

}
  
    



