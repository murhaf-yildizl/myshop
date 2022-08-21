<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CountryController extends Controller
{

  public function get_countries()
  {
      $countryList=Country::All();

     return view("countries",compact('countryList'));
  }


  public function select_state(Request $req)
  {
    $id=$req->input('country_id');
     $stateList=State::where('country_id',$id)->get();
    return $stateList;
     // code...
  }

  public function select_city(Request $req)
  {
    $id=$req->input('state_id');
     $cityList=City::where('state_id',$id)->get();
    return $cityList;
     // code...
  }
    //
}
