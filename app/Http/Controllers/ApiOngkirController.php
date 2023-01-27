<?php

namespace App\Http\Controllers;

use App\Models\M_Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\M_Kota;
use App\Models\M_Provinsi;

class ApiOngkirController extends Controller
{
    //
    public function index(Request $request)
    {
      if($request->city_origin &&  $request->city_destination && $request->weight && $request->courier )
      {
        $origin = $request->city_origin;
        $destination = $request->city_destination;
        $weight = $request->weight;
        $kurir = $request->courier;
        $response = Http::withHeaders([
            'key' => '55141331fb83d21610023cb1eb91e773'
        ])->post('https://api.rajaongkir.com/starter/cost',[
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $kurir


        ]);
     $cek_ongkir = $response['rajaongkir']['results'][0]['costs'];
      }
      else
      {
        $origin = "";
        $destination = "";
        $weight = "";
        $kurir = "";
        $cek_ongkir= null;
      }
       
       

       $provinsi = M_Provinsi::all();
       $provinsi1 = M_Provinsi::all();
       $kurir = M_Courier::all();
       return view('v_ongkir', compact('provinsi','provinsi1','kurir','cek_ongkir'));
    }
    public function getkota($id)
    {
        $kota = M_Kota::where('province_id', $id)->pluck('city_name','id');
        return json_encode($kota);
    }
}
