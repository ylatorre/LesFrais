<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CalculerController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\PDFgeneratorController;

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
Route::post('/dashboard',[FullCalenderController::class,'store']);

Route::get('gestionaireUser',[Controller::class, 'gestionaireUser'])->name('gestionaireUser');
Route::post('ajoutUser',[Controller::class, 'ajoutUser'])->name('ajoutUser');
Route::post('modifUser',[Controller::class, 'modifUser'])->name('modifUser');

Route::get('supuser',[Controller::class, 'supuser'])->name('supuser');

Route::post('/PDFgenerator', [PDFgeneratorController::class,'PostPDFgenerator'])->name('postPDFgenerator');
Route::get('/PDFgenerator', [PDFgeneratorController::class,'PDFgenerator'])->name('PDFgenerator');


require __DIR__.'/auth.php';
