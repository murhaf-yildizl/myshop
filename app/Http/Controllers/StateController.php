<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StateController extends Controller
{

  public function getstates($id)
  {
    $stateList=State::find($id);
    $count1=Country::find($id);
    return view('showcountries',compact('count1','stateList'));
  }
    //
}
