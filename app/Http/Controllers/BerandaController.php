<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index(){
    $data=DB::table('tbl_barang')->paginate();
    return view('beranda',compact('data'));
    }
}
