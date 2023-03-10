<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

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
    return view('welcome');
});

Route::match(['get', 'post'],'/tambah',[ BukuController::class, "tambah" ]);
Route::get('/tambah',[ BukuController::class, "tambah" ]);
Route::post('/tambah',[ BukuController::class, "tambah" ])->name('tambahData');
Route::get('/', [ BukuController::class, "index" ]);
Route::get('datanya', [ BukuController::class, "index" ])->name('index');
Route::match(['get', 'post'],'/{id}/ubah',[ BukuController::class, "ubahData" ])->name('ubahData');
Route::get('{id}/hapus',[ BukuController::class, "hapusData" ])->name('hapusData');
