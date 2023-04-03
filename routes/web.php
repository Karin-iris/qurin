<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionDraftController;
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

Route::get('/admin_dashboard', function () {
    return view('admin_dashboard');
})->middleware('auth:admin')->name('admin_dashboard');


Route::middleware('auth:admin')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::put('/category/update/{id}', 'update')->name('category.update');
        Route::get('/category/p_edit/{id}', 'edit')->name('category.edit_p');
        Route::put('/category/p_update/{id}', 'update')->name('category.update_p');
        Route::get('/category/s_edit/{id}', 'edit')->name('category.edit_s');
        Route::put('/category/s_update/{id}', 'update')->name('category.update_s');
        Route::get('/category/add', 'create')->name('category.create');
        Route::post('/category/add', 'store')->name('category.store');
        Route::get('/category/p_add', 'create_p')->name('category.create_p');
        Route::post('/category/p_add', 'store_p')->name('category.store_p');
        Route::get('/category/s_add', 'create_s')->name('category.create_s');
        Route::post('/category/s_add', 'store_s')->name('category.store_s');
        Route::delete('/category', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

});
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

});

require __DIR__ . '/auth.php';
