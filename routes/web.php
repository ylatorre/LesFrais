<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CalculerController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\MoisController;
use App\Http\Controllers\PDFgeneratorController;
use App\Http\Livewire\Calendar;
use FontLib\Table\Type\name;

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

Route::get('/calendrier', [Controller::class, 'displayDashboard'])->name('calendrier')->middleware(['auth']);
Route::post('/calendrier',[FullCalenderController::class,'store'])->middleware(['auth']);
Route::post('creationevenement',[Controller::class,'createEvent'])->name('createEvent')->middleware(['auth']);

Route::get('gestionaireUser',[Controller::class, 'gestionaireUser'])->name('gestionaireUser')->middleware(['auth','is.admin']);
Route::post('ajoutUser',[Controller::class, 'ajoutUser'])->name('ajoutUser')->middleware(['auth']);
Route::post('modifUser',[Controller::class, 'modifUser'])->name('modifUser')->middleware(['auth']);
// Route::post('ajouterEssence',[Controller::class, 'ajouterEssence'])->name('ajouterEssence')->middleware(['auth']);

Route::get('supuser',[Controller::class, 'supuser'])->name('supuser')->middleware(['auth']);
Route::post('activerUser',[Controller::class, 'activerUser'])->name('activerUser')->middleware(['auth']);



Route::post('/PDFgeneratorPerMonth', [PDFgeneratorController::class, 'PDFgeneratorPerMonth'])->name('PDFgeneratorPerMonth')->middleware(['auth']);
// Route::post('/PDFgenerator', [PDFgeneratorController::class,'PostPDFgenerator'])->name('postPDFgenerator')->middleware(['auth']);
Route::get('/PDFgenerator', [PDFgeneratorController::class,'PDFgenerator'])->name('PDFgenerator')->middleware(['auth']);

Route::get('userPDFgenerator/{id}', [PDFgeneratorController::class, 'userPDFgenerator'])->name('userPDFgenerator')->middleware(['auth']);

Route::post('lockMonth', [MoisController::class, 'lockMonth'])->name('lockMonth')->middleware(['auth']);
Route::post('unlockMonth', [MoisController::class, 'unlockMonth'])->name('unlockMonth')->middleware(['auth']);

Route::post('validateMonth', [MoisController::class, 'validateMonth'])->name('validateMonth')->middleware(['auth', 'is.admin']);


Route::post('gestionnaire',[Controller::class, 'gestionnairendf'])->name('gestionnairendf')->middleware(['auth','is.admin']);

// Route::get('note-de-frais',[Controller::class,'visualisationNDF'])->name('visualisationNDF')->middleware(['auth','is.admin']);
Route::post('notes-de-frais',[Controller::class,'validationNDF'])->name('validationNDF')->middleware(['auth']);

Route::post('validation',[Controller::class,'validerNDF'])->name('validerNDF')->middleware(['auth','is.admin']);
Route::post('suppression',[Controller::class,'supprimerNDF'])->name('supprimerNDF')->middleware(['auth','is.admin']);
Route::post('rejet',[Controller::class,'rejeterNDF'])->name('rejeterNDF')->middleware(['auth','is.admin']);

Route::get('Mes-notes-de-frais',[Controller::class,'mesNDF'])->name('mesNDF')->middleware(['auth']);
Route::post('visu-mes-notes-de-frais',[Controller::class,'visumesndf'])->name('visumesndf')->middleware(['auth']);

Route::post('repas',[Controller::class,'repas'])->name('repas')->middleware(['auth']);
Route::post('Suppression-event',[Controller::class,'SupprimerEvent'])->name('SupprimerEvent')->middleware(['auth']);
Route::post('Modification-event',[Controller::class,'ModifierEvent'])->name('ModifierEvent')->middleware(['auth']);

require __DIR__.'/auth.php';
