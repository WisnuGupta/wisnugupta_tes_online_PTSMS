<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(){
        $data=Barang::all();
        return view('barang',compact('data'));
        }

        public function store(Request $request){ 
        
            // Validator::extend('spaces', function ($attr, $value) {
            //     return preg_match("/^[a-zA-Z ]*$/", $value);
            // });
            $data = $request->validate(
                [
                    'kode_barang' => 'required|unique:tbl_barang',
                    'nama_barang' => 'required',
                    'harga_barang' => 'required'
                ],
                // [
                //     'name.spaces' => 'The name must only contain letters'
                // ]
            );
    
            $data = Barang::create([
                'kode_barang' => $data['kode_barang'], 'nama_barang' => $data['nama_barang'], 'harga_barang' =>  $data['harga_barang']]);
            if ($data->save()) {
                return redirect()->back()->with('status', 'Insert Success');
            } else {
                return redirect()->back()->with('filed', 'Insert Filed');
            }
        }
        public function edit(Request $request, $id = null)
        {
            //melakukan validasi data
            if ($request->isMethod('post')) {
                $data = $request->validate(
                    [
                        'kode_barang' => 'required',
                        'nama_barang' => 'required',
                        'harga_barang' => 'required'
                    ],
                    // [
                    //     'name.spaces' => 'The name must only contain letters'
                    // ]
                );
                Barang::where(['id' => $id])->update([
                    'kode_barang' => $data['kode_barang'], 'nama_barang' => $data['nama_barang'], 'harga_barang' =>  $data['harga_barang']]);
                return redirect()->back()->with('status', 'Updated Success');
            } else {
                return redirect()->back()->with('filed', 'Update Filed');
            }
        }
        public function delete($id = null)
        {
            //fungsi eloquent untuk menghapus data
            Barang::where(['id' => $id])->delete();
            return redirect()->back()->with('status', 'Deleted Success');
        }
}
