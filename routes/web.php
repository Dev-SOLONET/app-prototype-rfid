<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Hrd\GajiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Hrd\KaryawanController;

use App\Http\Controllers\Karyawan\JadwalController;
use App\Http\Controllers\Karyawan\AbsensiController;
use App\Http\Controllers\Karyawan\PenjualanController;
use App\Http\Controllers\Hrd\JadwalController as JadwalHrdController;
use App\Http\Controllers\Hrd\AbsensiController as AbsensiHrdController;




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

Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    
    Route::get('/', function () {
        if(auth()->user()->jabatan_id == '1'){
            return redirect()->route('hrd.dashboard.index');
        }else{
            return redirect()->route('karyawan.absensi.index');
        }
    }); 


    //HRD
        Route::group([
            'middleware' => 'role.hrd'
        ], function () {

        // Route group for hrd
            Route::group(['prefix' => 'hrd', 'as' => 'hrd.'], function () {
                Route::resource('dashboard', DashboardController::class);
                Route::resource('absensi', AbsensiHrdController::class);
                Route::resource('jadwal', JadwalHrdController::class);
                Route::resource('gaji', GajiController::class);
                Route::resource('karyawan', KaryawanController::class);
                Route::get('karyawan-profile', [KaryawanController::class, 'profile_users'])->name('karyawan.profile');
            });

        });

        //Karyawan
        Route::group([
            'middleware' => 'role.karyawan'
        ], function () {

        // Route group for karyawan
                Route::group(['prefix' => 'karyawan', 'as' => 'karyawan.'], function () {
                Route::resource('absensi', AbsensiController::class);
                Route::resource('jadwal', JadwalController::class);
                Route::resource('penjualan', PenjualanController::class);
            });

        });


});    


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


