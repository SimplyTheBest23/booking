<?php

namespace Svityaz\Http\Controllers;

use Illuminate\Http\Request;
use Svityaz\Models\cities;
use Svityaz\Models\hotelTypes;

class HomeController extends Controller
{
    public function index(){
        $cities = cities::all();
        $hotel_types = hotelTypes::all();
        return view('welcome', ['cities' => $cities,'htypes'=>$hotel_types]);
    }
    
}
