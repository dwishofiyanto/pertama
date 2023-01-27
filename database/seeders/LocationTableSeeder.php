<?php

namespace Database\Seeders;

use App\Models\M_City;
use App\Models\M_Provinsi;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Foreach_;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinceRow) {
            M_Provinsi::create([
                'province_id' => $provinceRow['province_id'],
                'title' => $provinceRow['province']
                
             ] );
        }

        $daftarKota = RajaOngkir::kota()->dariProvinsi($provinceRow['province_id'])->get();
        foreach ($daftarKota as $cityRow) {
            M_City::create([
                'province_id' => $provinceRow['province_id'],
                'city_id' => $cityRow['city_id'],
                'title' => $cityRow['city_name']
                
             ] );
        }

    }
}
