<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionDraftController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;
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
    Route::controller(QuestionDraftController::class)->group(function () {
        Route::get('/questiondrafts/{id}', 'edit')->name('questiondraft.edit');
        Route::patch('/questiondrafts', 'update')->name('questiondraft.update');
        Route::post('/questiondrafts', 'store');
    });
    Route::controller(QuestionController::class)->group(function () {
        Route::get('/question', 'index')->name('question.index');
        Route::get('/question/edit/{id}', 'edit')->name('question.edit');
        Route::get('/question/add', 'create')->name('question.create');
        Route::delete('/question', [QuestionController::class, 'destroy'])->name('question.destroy');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::get('/category/add', 'create')->name('category.create');
        Route::delete('/category', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});

require __DIR__.'/auth.php';
