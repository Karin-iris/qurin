<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiQuestionController;
use App\Http\Controllers\Api\ApiQuestionCaseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::controller(ApiCategoryController::class)->group(callback: function () {
    Route::get('/category/get_primaries/', 'get_primaries');
    Route::get('/category/get_secondaries/{id}', 'get_secondaries');
    Route::get('/category/get_children/{id}', 'get_children');
    Route::post('/category/upload/', 'upload');

});
Route::controller(ApiQuestionController::class)->group(callback: function () {
    Route::get('/question/get_user_summary', 'get_user_summary');
    Route::get('/question/get_secondary_category_summary', 'get_secondary_category_summary');
});

Route::controller(ApiQuestionCaseController::class)->group(callback: function () {
    Route::get('/question_case/get_question_cases', 'get_question_cases');
    Route::get('/question_case/get_question_case_questions/{id}', 'get_question_case_questions');
    Route::get('/question_case/get_question_case_with_questions/', 'get_question_case_with_questions');
});

