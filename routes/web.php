<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionCaseController;
use App\Http\Controllers\UserQuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MFAController;

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
})->middleware(['auth:admin', 'verified'])->name('admin_dashboard');

Route::get('/mfa/admin_login', [MFAController::class, 'admin_login'])->name('mfa.admin_login');
Route::post('/mfa/admin_login', [MFAController::class, 'verify_admin_login'])->name('mfa.verify_admin_login');
Route::get('/mfa/admin_regist', [MFAController::class, 'admin_regist'])->name('mfa.admin_regist');
Route::post('/mfa/admin_regist', [MFAController::class, 'update_admin_regist'])->name('mfa.update_admin_regist');

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
        Route::delete('/my_question/del/{id}', 'destroy')->name('userquestion.destroy');
        Route::delete('/my_question/c_del/{id}', 'destroy_c')->name('userquestion.destroy_c');
    });
});

Route::middleware(['auth:admin','mfa'])->group(function () {
    Route::controller(QuestionController::class)->group(function () {
        Route::get('/question', 'index')->name('question.index');
        Route::post('/question', 'index')->name('question.index');
        Route::get('/question/edit/{id}', 'edit')->name('question.edit');
        Route::put('/question/edit/{id}', 'update')->name('question.update');
        Route::get('/question/add', 'create')->name('question.create');
        Route::post('/question/add', 'store')->name('question.store');
        Route::delete('/question/del/{id}', 'destroy')->name('question.destroy');
    });
    Route::controller(QuestionCaseController::class)->group(function () {
        Route::get('/question_case', 'index')->name('question_case.index');
        Route::get('/question_case/edit/{id}', 'edit')->name('question_case.edit');
        Route::get('/question_case/c_edit/{id}', 'edit_c')->name('question_case.edit_c');
        Route::put('/question_case/edit/{id}', 'update')->name('question_case.update');
        Route::put('/question_case/c_edit/{id}', 'update_c')->name('question_case.update_c');
        Route::get('/question_case/add', 'create')->name('question_case.create');
        Route::post('/question_case/add', 'store')->name('question_case.store');
        Route::get('/question_case/c_add/{id}', 'create_c')->name('question_case.create_c');
        Route::post('/question_case/c_add/{id}', 'store_c')->name('question_case.store_c');
        Route::delete('/question/del/{id}', 'destroy')->name('question_case.destroy');
        Route::delete('/question/c_del/{id}', 'destroy_c')->name('question_case.destroy_c');
    });
    Route::controller(ImportController::class)->group(function () {
        Route::get('/import', 'index')->name('import.index');
        Route::get('/import/all_import', 'all_import')->name('import.all_import');
        Route::put('/import/all_import_csv', 'all_import_csv')->name('import.all_import_csv');
        Route::get('/import/explain_import', 'explain_import')->name('import.explain_import');
        Route::put('/import/explain_import_csv', 'explain_import_csv')->name('import.explain_import_csv');
        Route::get('/import/topic_import', 'topic_import')->name('import.topic_import');
        Route::put('/import/topic_import_csv', 'topic_import_csv')->name('import.topic_import_csv');
        Route::get('/import/modify_import', 'modify_import')->name('import.modify_import');
        Route::put('/import/modify_import', 'modify_import_csv')->name('import.modify_import_csv');
        Route::get('/import/question_update_from_bk', 'question_update_from_bk')->name('import.question_update_from_bk');
        Route::get('/import/import', 'import')->name('import.import');
        Route::put('/import/import_csv', 'import_csv')->name('import.import_csv');
    });
    Route::controller(ExportController::class)->group(function () {
        Route::get('/export', 'index')->name('export.index');
        Route::get('/export/csv', 'csv')->name('export.csv');
        Route::get('/export/csv_learning', 'csv_learning')->name('export.csv_learning');
        Route::get('/export/csv_explanation', 'csv_explanation')->name('export.csv_explanation');
        Route::get('/export/csv_topic', 'csv_topic')->name('export.csv_topic');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::put('/category/update/{id}', 'update')->name('category.update');
        Route::get('/category/p_edit/{id}', 'edit_p')->name('category.edit_p');
        Route::put('/category/p_update/{id}', 'update_p')->name('category.update_p');
        Route::get('/category/s_edit/{id}', 'edit_s')->name('category.edit_s');
        Route::put('/category/s_update/{id}', 'update_s')->name('category.update_s');
        Route::get('/category/add', 'create')->name('category.create');
        Route::post('/category/add', 'store')->name('category.store');
        Route::get('/category/p_add', 'create_p')->name('category.create_p');
        Route::post('/category/p_add', 'store_p')->name('category.store_p');
        Route::get('/category/s_add', 'create_s')->name('category.create_s');
        Route::post('/category/s_add', 'store_s')->name('category.store_s');
        Route::delete('/category/del/{id}', 'destroy')->name('category.destroy');
        Route::delete('/category/p_del/{id}', 'destroy_p')->name('category.destroy_p');
        Route::delete('/category/s_del/{id}', 'destroy_s')->name('category.destroy_s');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/admin_index', 'admin_index')->name('user.admin_index');
        Route::get('/add', 'create')->name('user.create');
        Route::post('/add', 'store')->name('user.store');
        Route::get('/user/edit/{id}', 'edit')->name('user.edit');
        Route::put('/user/update/{id}', 'update')->name('user.update');
        Route::get('/user/admin_edit/{id}', 'admin_edit')->name('user.admin_edit');
        Route::put('/user/admin_update/{id}', 'update')->name('user.admin_update');
        Route::get('/user/invite', 'invite')->name('user.invite');
        Route::post('/user/send_invite', 'send_invite')->name('user.send_invite');
        Route::get('/user/admin_invite', 'admin_invite')->name('user.admin_invite');
        Route::post('/user/send_admin_invite', 'send_admin_invite')->name('user.send_admin_invite');
        Route::get('/user/admin_regist/{token}', 'admin_regist')->name('user.admin_regist');
        Route::get('/user/regist/{token}', 'user_regist')->name('user.regist');
    });
});


require __DIR__ . '/auth.php';
