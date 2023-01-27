<?php

namespace App\Http\Controllers;

use App\Models\M_Keranjang;
use Illuminate\Http\Request;
use DB;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjang1 = M_Keranjang::all();
       
        foreach ($keranjang1 as $keranjang1) {
            $barang = DB::table('barang')->where('id', $keranjang1->id_barang)->first();
            foreach ($barang as $barang1) {
                $stok = $barang->stok;
                if($stok< $keranjang1->jumlah)
                {
                   
                    $subtotal =  $stok * $barang->harga;
                    $query = M_Keranjang::where('id_barang', $keranjang1->id_barang)
                    ->update([
                        'jumlah'=> $stok,
                        'harga'=> $barang->harga,
                        'sub_total'=> $subtotal
                    ]);
                }
                else
                {
                    $subtotal =  $stok * $barang->harga;
                    $query = M_Keranjang::where('id_barang', $keranjang1->id_barang)
                    ->update([
                        'jumlah'=> $stok,
                        'harga'=> $barang->harga,
                        'sub_total'=> $subtotal
                    ]);
                }
            }
        }
        $keranjang = M_Keranjang::all();
        return view('v_keranjang',['keranjang' => $keranjang]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
