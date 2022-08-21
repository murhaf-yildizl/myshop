<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\CityResource;


class CountryController extends Controller

{
    public function index()
    {
      return CountryResource::collection(Country::All());
    }

    public function get_states($id)
    {
      return StateResource::collection(Country::find($id)->states);
      // code...
    }

    public function get_cities($id)
    {
      return CityResource::collection(Country::find($id)->cities);
      // code...
    }
}
