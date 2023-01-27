<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Provinsi;

use App\Models\M_Courier;
use App\Models\M_City;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class OngkirController extends Controller
{
    public function index()
    {
        
        // $couriers = M_Courier::pluck('title','code');
        // $provinsi = M_Provinsi::pluck('title','province_id');
        // $provinsi1 = M_Provinsi::pluck('title','province_id');
        return view('v_ongkir');
    }
    public function getcity($id){
        $city = M_City::where('province_id', $id)->pluck('title','city_id');
        return json_encode($city);
    }
    public function submit(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin' => $request->city_origin,
            'destination' => $request->city_destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ])->get();
       dd($cost[0]['costs'][1]['cost'][0]['value']);
      //  dd($cost);
    }
}
