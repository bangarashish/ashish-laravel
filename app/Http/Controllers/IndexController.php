<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
   public function index(){
    
    //return  Members::find(1)->getGroup;
    return  Members::with('getGroup')->get();
    //return  Members::all();
   }

   public function joins(){  

    return   DB::table('member')
            ->join('groups', 'member.group_id', '=', 'groups.id')
            ->select('member.*', 'groups.name', 'groups.description')
            ->get();
    
   }

}
