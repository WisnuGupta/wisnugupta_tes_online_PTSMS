<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_barang')->insert(  
        [
            'kode_barang' => 'B21',
            'nama_barang'=>'Buku',
            'harga_barang'=>'15.000',
        ]);
          
            // foreach($barang as $key => $value){
            //    Barang::create($value);
    }
}
