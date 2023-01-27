<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\M_Kota;

class KotaSeeder extends Seeder
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
        ])->get('https://api.rajaongkir.com/starter/city');
        $provinsi =  $response['rajaongkir']['results'];
        foreach ($provinsi as $provinsi) {
            $data_provinsi[] = [
                'id' => $provinsi['city_id'],
                'province_id' => $provinsi['province_id'],
                'type' => $provinsi['type'],
                'city_name' => $provinsi['city_name'],
                'postal_code' => $provinsi['postal_code'],
            ];
        }
        M_Kota::insert($data_provinsi);
    }
}
