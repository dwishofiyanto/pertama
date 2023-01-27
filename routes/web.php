<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiOngkirController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OngkirController;
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


Route::post('admin', [AdminController::class, 'store']);
Route::get('/admin/admin_tampil', [AdminController::class, 'tampil_admin']);
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/edit_admin/{id}', [AdminController::class, 'edit']);
Route::patch('/admin/admin/{id}', [AdminController::class, 'update']);
Route::delete('/admin/admin/{id}', [AdminController::class, 'destroy']);

Route::get('/keranjang', [KeranjangController::class, 'index']);
Route::get('/ongkir', [OngkirController::class, 'index']);
Route::get('/provinsi/{id}', [OngkirController::class, 'getcity']);
Route::post('/ongkir', [OngkirController::class, 'submit']);


Route::post('/cek_ongkir', [ApiOngkirController::class, 'index']);
Route::get('/cek_ongkir', [ApiOngkirController::class, 'index']);
Route::get('/cek_ongkir/ajax/{id}', [ApiOngkirController::class, 'getkota']);




