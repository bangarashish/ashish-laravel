<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\{CountryModel,StateModel,CityModel};
use Illuminate\Support\Facades\DB;

class CountryStateCityController extends Controller
{
    public function view()
    {
        $countries = \DB::table('countries')->get();
        return view('backend.dropdown.select', compact('countries'));
        //print_r($countries);
    }
    public function getStates(Request $request)
    {
        $states = \DB::table('states')->where('country_id', $request->country_id)->get();
        //return response()->json($states);
        if (count($states) > 0) {
            return response()->json($states);
        }

        // $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        // return response()->json($data);

       
    }
    public function getCities(Request $request)
    {
        $cities = \DB::table('cities')->where('state_id', $request->state_id)->get();
        if (count($cities) > 0) {
            return response()->json($cities);
        }
    }
}
