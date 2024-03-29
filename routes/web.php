<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserSectionController;
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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::controller(UserQuestionController::class)->group(function () {
        Route::get('/my_question', 'index')->name('userquestion.index');
        Route::get('/my_question/edit/{id}', 'edit')->name('userquestion.edit');
        Route::put('/my_question/edit/{id}', 'update')->name('userquestion.update');
        Route::get('/my_question/add', 'create')->name('userquestion.create');
        Route::post('/my_question/add', 'store')->name('userquestion.store');
        Route::delete('/my_question/del/{id}', 'destroy')->name('userquestion.destroy');
    });
    Route::controller(UserSectionController::class)->group(function () {
        Route::get('/my_section', 'index')->name('usersection.index');
        Route::get('/my_section/edit/{id}', 'edit')->name('usersection.edit');
        Route::put('/my_section/edit/{id}', 'update')->name('usersection.update');
        Route::get('/my_section/add', 'create')->name('usersection.create');
        Route::post('/my_section/add', 'store')->name('usersection.store');
        Route::delete('/my_section/del/{id}', 'destroy')->name('usersection.destroy');
    });
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin_profile', [ProfileController::class, 'admin_edit'])->name('profile.admin_edit');
    Route::patch('/admin_profile', [ProfileController::class, 'admin_update'])->name('profile.admin_update');
    Route::delete('/admin_profile', [ProfileController::class, 'admin_destroy'])->name('profile.admin_destroy');
    Route::get('/mfa/admin_login', [MFAController::class, 'admin_login'])->name('mfa.admin_login');
    Route::post('/mfa/admin_login', [MFAController::class, 'verify_admin_login'])->name('mfa.verify_admin_login');
    Route::get('/mfa/admin_register/{id}', [MFAController::class, 'admin_register'])->name('mfa.admin_register');
    Route::post('/mfa/admin_register/{id}', [MFAController::class, 'update_admin_register'])->name('mfa.update_admin_register');
    Route::get('/mfa/admin_erase/{id}', [MFAController::class, 'admin_erase'])->name('mfa.admin_erase');
    Route::post('/mfa/admin_erase/{id}', [MFAController::class, 'update_admin_erase'])->name('mfa.update_admin_erase');
    Route::get('/mfa/show_admin_login', [MFAController::class, 'admin_login'])->name('mfa.showVerifyForm');
});

Route::middleware(['auth:admin', 'mfa'])->group(function () {
    Route::controller(ExaminationController::class)->group(function () {
        Route::get('/examination', 'index')->name('examination.index');
        Route::post('/examination', 'index')->name('examination.index');
        Route::get('/examination/edit/{id}', 'edit')->name('examination.edit');
        Route::put('/examination/edit/{id}', 'update')->name('examination.update');
        Route::get('/examination/add', 'create')->name('examination.create');
        Route::post('/examination/add', 'store')->name('examination.store');
        Route::get('/examination/show/{id}', 'show')->name('examination.show');
        Route::delete('/examination/del/{id}', 'destroy')->name('examination.destroy');
    });
    Route::controller(SectionController::class)->group(function () {
        Route::get('/section', 'index')->name('section.index');
        Route::post('/section', 'index')->name('section.index');
        Route::get('/section/edit/{id}', 'edit')->name('section.edit');
        Route::put('/section/edit/{id}', 'update')->name('section.update');
        Route::get('/section/add', 'create')->name('section.create');
        Route::post('/section/add', 'store')->name('section.store');
        Route::delete('/section/del/{id}', 'destroy')->name('section.destroy');
    });
    Route::controller(QuestionController::class)->group(function () {
        Route::get('/question', 'index')->name('question.index');
        Route::post('/question', 'index')->name('question.index');
        Route::get('/question/edit/{id}', 'edit')->name('question.edit');
        Route::put('/question/edit/{id}', 'update')->name('question.update');
        Route::get('/question/add', 'create')->name('question.create');
        Route::post('/question/add', 'store')->name('question.store');
        Route::get('/question/summary', 'summary')->name('question.summary');
        Route::delete('/question/del/{id}', 'destroy')->name('question.destroy');
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
        Route::get('/import/import_raw', 'import_raw')->name('import.import_raw');
        Route::put('/import/import_raw_csv', 'import_raw_csv')->name('import.import_raw_csv');
        Route::get('/import/import_result', 'import_result')->name('import.import_result');
        Route::put('/import/import_result_csv', 'import_result_csv')->name('import.import_result_csv');
    });
    Route::controller(ExportController::class)->group(function () {
        Route::get('/export', 'index')->name('export.index');
        Route::get('/export/csv_swiz', 'csv_swiz')->name('export.csv_swiz');
        Route::get('/export/csv_pros', 'csv_pros')->name('export.csv_pros');
        Route::get('/export/csv_raw', 'csv_raw')->name('export.csv_raw');
        Route::get('/export/csv_learning', 'csv_learning')->name('export.csv_learning');
        Route::get('/export/csv_explanation', 'csv_explanation')->name('export.csv_explanation');
        Route::get('/export/csv_topic', 'csv_topic')->name('export.csv_topic');
        Route::get('/export/results', 'results')->name('export.results');
        Route::get('/export/csv_result/{id}', 'csv_result')->name('export.csv_result');
        Route::get('/export/csv_raw_result/{id}', 'csv_raw_result')->name('export.csv_raw_result');
        Route::get('/export/q_index/{resultId}', 'index_q')->name('export.index_q');
        Route::get('/export/q_edit/{resultId}/{id}', 'edit_q')->name('export.edit_q');
        Route::put('/export/q_update/{resultId}/{id}', 'update_q')->name('export.update_q');
        Route::get('/export/a_index/{resultId}', 'index_a')->name('export.index_a');
        Route::get('/export/a_edit/{resultId}/{id}', 'edit_a')->name('export.edit_a');
        Route::put('/export/a_update/{resultId}/{id}', 'update_a')->name('export.update_a');
    });
    Route::controller(ResultController::class)->group(function () {
        Route::get('/result/a_q_index/{resultId}', 'index_a_q')->name('result.index_a_q');
        Route::get('/result/a_s_index/{resultId}', 'index_a_s')->name('result.index_a_s');
        Route::get('/result/q_index', 'index_q')->name('result.index_q');
        Route::get('/result/q_view/{questionId}', 'view_q')->name('result.view_q');
        Route::get('/result/s_index', 'index_s')->name('result.index_s');
        Route::get('/result/s_view/{studentId}', 'view_s')->name('result.view_s');
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
        Route::put('/user/admin_update/{id}', 'admin_update')->name('user.admin_update');
        Route::get('/user/invite', 'invite')->name('user.invite');
        Route::post('/user/send_invite', 'send_invite')->name('user.send_invite');
        Route::get('/user/admin_invite', 'admin_invite')->name('user.admin_invite');
        Route::post('/user/send_admin_invite', 'send_admin_invite')->name('user.send_admin_invite');
        Route::get('/user/admin_register/{token}', 'admin_register')->name('user.admin_register');
        Route::post('/user/admin_register/{token}', 'store_admin_register')->name('user.store_admin_register');
        Route::get('/user/register/{token}', 'user_register')->name('user.register');
        Route::post('/user/store_register/{token}', 'store_user_register')->name('user.store_register');
        Route::get('/user/admin_config_edit/', 'admin_config_edit')->name('user.admin_config_edit');
    });
});


require __DIR__ . '/auth.php';
