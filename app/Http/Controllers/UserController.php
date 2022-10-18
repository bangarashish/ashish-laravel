<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    
    public function create()
    {
        //return view(backend.users.create);
        return view('backend.users.create');
    }

    public function store(Request $request){

       
    //     $arr = array(
    //         "name"=>"ashish",
    //         "job"=> "developer",
    //     );
    //     $url = "https://reqres.in/api/users";
    //     $ch = curl_init();
    
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
    // // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     curl_exec($ch);
    //     curl_close($ch);

        $request->validate([
            
            'name' =>     'required',
            'email' =>    'required',
            'password' => 'required',
            'cpass' =>    'required'
        ]);

        // echo "<pre>";
        // print_r($request->all());

        $user = new UserModel;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = $request->password;
        $user->confirm_password = $request->cpass;
        $user->save();
        
}
}