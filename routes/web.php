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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/concept/{id}/questions/',[\App\Http\Controllers\QuestionController::class,'show'])->name('show.concept.questions');

});

Route::post("simple-excel/import", [\App\Http\Controllers\ImportController::class,'import'])->name('excel.import');
Route::post("simple-excel/importCours", [\App\Http\Controllers\ImportController::class,'importCours'])->name('excel.importCours');

require __DIR__.'/auth.php';
