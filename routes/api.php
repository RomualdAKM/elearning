<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LearningController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
    });

Route::controller(SubjectController::class)->group(function () {
    Route::get('get_subjects', 'get_subjects');
});

Route::controller(LearningController::class)->group(function () {

    Route::get('get_learning/{name}', 'get_learning');
});

Route::controller(ChapterController::class)->group(function () {
    Route::get('get_chaptervideos/{id}', 'get_chaptervideos');
    Route::get('get_quizzes/{name}', 'get_quizzes');

});

Route::controller(LevelController::class)->group(function ()
{
    Route::get('get_levels', 'get_levels');
    Route::get('get_books_in_level/{levelId}', 'get_books_in_level');
    Route::get('search_book', 'search_book');
    Route::post('create_level', 'create_level');
    Route::post('update_level/{id}', 'update_level');
    Route::get('delete_level/{id}', 'delete_level');

});

Route::controller(BookController::class)->group(function(){

    Route::get('get_detail_book/{bookName}', 'get_detail_book');



});


