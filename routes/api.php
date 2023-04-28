<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;

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
    Route::get('get_subject', 'get_subject');
    Route::get('get_subjects/{id}', 'get_subjects');
    //admin
    Route::get('search_subject', 'search_subject');

    Route::post('create_subject', 'create_subject');
    Route::post('update_subject/{id}', 'update_subject');
    Route::get('delete_subject/{id}', 'delete_subject');
});

Route::controller(LearningController::class)->group(function () {

    Route::get('get_learning/{name}', 'get_learning');
    //admin
    Route::get('get_learnings', 'get_learnings');
    Route::get('search_learning', 'search_learning');
    Route::post('create_learning', 'create_learning');
    Route::post('update_learning/{id}', 'update_learning');
    Route::get('delete_learning/{id}', 'delete_learning');
});

Route::controller(ChapterController::class)->group(function () {
    Route::get('get_chaptervideos/{id}', 'get_chaptervideos');
    Route::get('get_quizzes/{name}', 'get_quizzes');
    //admin
    Route::get('get_chapters', 'get_chapters');
    Route::post('create_chapter', 'create_chapter');
    Route::post('update_chapter/{id}', 'update_chapter');
    Route::get('delete_chapter/{id}', 'delete_chapter');
    Route::get('search_chapter', 'search_chapter');


});

Route::controller(LevelController::class)->group(function ()
{
    Route::get('get_levels', 'get_levels');

    //admin
    Route::post('create_level', 'create_level');
    Route::post('update_level/{id}', 'update_level');
    Route::get('delete_level/{id}', 'delete_level');

});

Route::controller(BookController::class)->group(function(){

    Route::get('get_detail_book/{bookName}', 'get_detail_book');
    Route::get('get_books_in_level/{levelId}', 'get_books_in_level');
    Route::get('search_book', 'search_book');



    //admin
    Route::get('get_books', 'get_books');
    Route::post('create_book', 'create_book');
    Route::post('update_book/{id}', 'update_book');
    Route::get('delete_book/{id}', 'delete_book');

});

Route::controller(QuizController::class)->group(function(){
    //admin
    Route::get('get_quizzes','get_quizzes');
    Route::get('search_quiz', 'search_quiz');

    Route::post('create_quiz', 'create_quiz');
    Route::post('update_quiz/{id}', 'update_quiz');
    Route::get('delete_quiz/{id}', 'delete_quiz');

});

Route::controller(CategoryController::class)->group(function(){

    //admin
    Route::get('get_categories', 'get_categories');
    Route::post('create_category', 'create_category');
    Route::post('update_category/{id}', 'update_category');
    Route::get('delete_category/{id}', 'delete_category');
});

Route::resource('chat',ChatController::class);

Route::controller(MessageController::class)->group(function(){

    Route::get('get_messages', 'get_messages');
    Route::post('create_message', 'create_message');

});

Route::controller(UserController::class)->group(function(){

    Route::get('get_users','get_users');
    Route::get('delete_user/{id}', 'delete_user');
    Route::get('search_user', 'search_user');


});
