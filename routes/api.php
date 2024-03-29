<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiQuestionController;
use App\Http\Controllers\Api\ApiQuestionCaseController;
use App\Http\Controllers\Api\ApiExaminationController;
use App\Http\Controllers\Api\ApiSectionController;
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
    Route::get('/category/get_gpt/{id}', 'get_gpt');
    Route::get('/category/get_gpt2/{id}', 'get_gpt2');
    Route::post('/category/upload/', 'upload');

});
Route::controller(ApiQuestionController::class)->group(callback: function () {
    Route::get('/question/paginate','paginate');
    Route::get('/question/get_user_summary', 'get_user_summary');
    Route::get('/question/get_secondary_category_summary', 'get_secondary_category_summary');
    Route::get('/question/get_searched_data_by_id', 'get_searched_data_by_id');
});

Route::controller(ApiExaminationController::class)->group(callback: function () {
    Route::get('/examination/paginate', 'paginate');
    Route::get('/examination/get_data','get_data');
    Route::get('/examination/get_gpt/{examinationId}/{categoryId}','get_gpt');
});
Route::controller(ApiSectionController::class)->group(callback: function () {
    Route::get('/section/paginate','paginate');
    Route::get('/section/get_data','get_data');

});

