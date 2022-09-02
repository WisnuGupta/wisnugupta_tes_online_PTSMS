<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KasirController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembelianController;
use App\Models\Barang;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login.view_login');
});

// Route::get('login',[LoginController::class,'index'])->name('login');
Route::controller(LoginController::class)->group(Function(){
    Route::get('login','index')->name('login');
    Route::post('login/proses','proses');
    Route::get('logout','logout');
});
Route::group(['middleware'=>['auth']],function(){
    Route::group(['middleware'=>['cekUserLogin:1']],function(){
        Route::resource('beranda',BerandaController::class);
    });
    Route::group(['middleware'=>['cekUserLogin:2']],function(){
        Route::resource('kasir',KasirController::class);
    });
});
Route::get('barang',[BarangController::class,'index'])->name('barang');
Route::post('barang/store',[BarangController::class,'store']);
Route::get('pembelian',[PembelianController::class,'index'])->name('pembelian');
Route::get('/del_barang{id}', [BarangController::class, 'delete']);
Route::match(['get', 'post'], '/edit_barang{id}', [BarangController::class,'edit']);