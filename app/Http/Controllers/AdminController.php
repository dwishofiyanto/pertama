<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin;
use Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       // $admin = DB::table('admin')->get();
       $admin = Admin::all();
      //return Admin::all();
    return view('welcome',['admin' => $admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil_admin()
    {
        $admin = Admin::all();
        // return Admin::all();
      return view('tampil_tabel_admin',['admin' => $admin]);
//return response()->json(['status'=>0]);
    }
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      
        $validator = Validator::make($request->all(),[
            'nama'=>'required|max:255',
            'alamat'=>'required',
        ]);
      
        if($validator->fails())
        {
         return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else
        {
            $admin = new Admin();

        $admin->nama = $request->nama;
        $admin->alamat = $request->alamat;

        $admin->save();
        if($admin)
        {
            return response()->json(['status'=>1, 'msg'=>'data berhasil disimpan', 'isi_status' => 'success']);
        }
        else
        {
            return response()->json(['status'=>1, 'msg'=>'gagaal disimpan']);
        }
           // return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        
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
        $data = DB::table('admin')->where('id', $id)->first();
        echo json_encode($data);
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
        $validator = Validator::make($request->all(),[
            'nama'=>'required|max:255',
            'alamat'=>'required',
        ]);
      
        if($validator->fails())
        {
         return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else
        {
            $query = Admin::where('id', $id)
            ->update([
                'nama'=> $request->nama,
                'alamat'=> $request->alamat
            ]);
            if($query)
            {
                return response()->json(['status'=>1, 'msg'=>'data berhasil ubah', 'isi_status' => 'success']);
            }
            else
            {
                return response()->json(['status'=>1, 'msg'=>'tidak ada data yg di ubah']);
            }
        }
        
        
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
        Admin::destroy($id);
        return response()->json(['status'=>1, 'msg'=>'data berhasil hapus', 'isi_status' => 'success']);
        //
    }
}
