<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\CalculerController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FullCalenderController;

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
    return view('auth.login');
});


Route::resource('mission', MissionController::class);
Route::get('mission_export',[MissionController::class, 'get_mission_data'])->name('mission.export');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::post('/dashboard',[FullCalenderController::class,'store']);;



require __DIR__.'/auth.php';
