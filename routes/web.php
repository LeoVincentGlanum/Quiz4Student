<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //CONCEPT
    Route::get('/concept', [\App\Http\Controllers\ConceptController::class, 'index'])->name('concept.index');
    Route::get('/concept/{id}/questions/',[\App\Http\Controllers\QuestionController::class,'show'])->name('show.concept.questions');
    //COURS
    Route::get('/cours', [\App\Http\Controllers\CoursController::class, 'index'])->name('cours.index');
    //Reponses
    Route::get('/reponses/{id}/{question}',[\App\Http\Controllers\QuestionController::class,'reponse'])->name('new.response');
    Route::get('/responsesView',[\App\Http\Controllers\QuestionController::class,'responsesView'])->name('responsesView');

    Route::get('/questionnaire',[\App\Http\Controllers\QuestionController::class,'questionnaire'])->name('questionnaire');


    Route::post('/multiConcept',[\App\Http\Controllers\QuestionController::class,'multiConcept'])->name('multiConcept');


    Route::get('/coursReponse',[\App\Http\Controllers\QuestionController::class,'cours'])->name('coursReponse');






});


Route::post('parameters/changeNbQuestion',[\App\Http\Controllers\ParametersController::class,'changeNbQuestions'])->name('parameters.changeNbQuestions');

Route::post("simple-excel/import", [\App\Http\Controllers\ImportController::class,'import'])->name('excel.import');
Route::post("simple-excel/importCours", [\App\Http\Controllers\ImportController::class,'importCours'])->name('excel.importCours');

require __DIR__.'/auth.php';
