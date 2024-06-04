<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;


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

//presensi


Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/absensi/create', [PresensiController::class, 'create']);
});
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin',[AuthController::class, 'proseslogin']);
});

Route::group(['middleware' => ['auth:karyawan']],function(){
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});





