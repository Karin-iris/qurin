<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionDraftController;
use App\Http\Controllers\UserQuestionController;
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
})->middleware(['auth:admin','verified'])->name('admin_dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::controller(UserQuestionController::class)->group(function () {
        Route::get('/my_question', 'index')->name('userquestion.index');
        Route::get('/my_question/edit/{id}', 'edit')->name('userquestion.edit');
        Route::get('/my_question/c_edit/{id}', 'edit_c')->name('userquestion.edit_c');
        Route::put('/my_question/edit/{id}', 'update')->name('userquestion.update');
        Route::put('/my_question/c_edit/{id}', 'update_c')->name('userquestion.update_c');
        Route::get('/my_question/add', 'create')->name('userquestion.create');
        Route::get('/my_question/c_add', 'create_c')->name('userquestion.create_c');
        Route::post('/my_question/add', 'store')->name('userquestion.store');
        Route::post('/my_question/c_add', 'store_c')->name('userquestion.store_c');
        Route::delete('/my_question', 'destroy')->name('userquestion.destroy');
        Route::delete('/my_question/c_del', 'destroy_c')->name('userquestion.destroy_c');
    });
});

Route::middleware('auth:admin')->group(function () {
    Route::controller(QuestionController::class)->group(function () {
        Route::get('/question', 'index')->name('question.index');
        Route::get('/question/edit/{id}', 'edit')->name('question.edit');
        Route::get('/question/c_edit/{id}', 'edit_c')->name('question.edit_c');
        Route::put('/question/edit/{id}', 'update')->name('question.update');
        Route::put('/question/c_edit/{id}', 'update_c')->name('question.update_c');
        Route::get('/question/add', 'create')->name('question.create');
        Route::post('/question/add', 'store')->name('question.store');
        Route::get('/question/c_add', 'create_c')->name('question.create_c');
        Route::post('/question/add', 'store')->name('question.store');
        Route::post('/question/c_add', 'store_c')->name('question.store_c');

        Route::delete('/question/del', 'destroy')->name('question.destroy');
        Route::delete('/question/c_del', 'destroy')->name('question.destroy_c');
    });
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


require __DIR__ . '/auth.php';
