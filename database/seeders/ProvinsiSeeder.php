<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\M_Provinsi;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $response = Http::withHeaders([
            'key' => '55141331fb83d21610023cb1eb91e773'
        ])->get('https://api.rajaongkir.com/starter/province');
        $provinsi =  $response['rajaongkir']['results'];
        foreach ($provinsi as $provinsi) {
            $data_provinsi[] = [
                'id' => $provinsi['province_id'],
                'province' => $provinsi['province'],
            ];
        }
        M_Provinsi::insert($data_provinsi);
    }
}
