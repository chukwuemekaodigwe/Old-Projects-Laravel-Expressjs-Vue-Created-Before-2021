<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
/**
 * STATIC PAGES
 */

Route::get('/about', 'HomeController@about');

Route::get('/privacy', function () {
    return view('static.privacy');
});

Route::get('/terms', function () {
    return view('static.terms');
});

/**
 * DYNAMIC PAGES
 *
 */

Route::auth();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/quiz', 'QuizController@index');
Route::get('/quiz/testrun', 'QuizController@test_quiz');
Route::get('/testimonies', 'TestimonyController@index');
Route::get('/blogs/categories/{category}', 'BlogController@by_category');
Route::get('/blogs/{blog}', 'BlogController@single');
Route::get('/blogs/{category}/{blog}', 'BlogController@single');
Route::get('/blogs/', 'BlogController@recent');


Route::get('/contact', 'SupportController@index');
Route::post('/contact', 'SupportController@forward');
Route::post('/comments/store', 'CommentController@store');
Route::post('/students/new', 'StudentController@store');

Route::group(['prefix' => 'dash'], function () {

    Route::get('/', 'DashController@index');

    Route::post('/quotes/add', 'QuoteController@store');
    Route::get('/quotes/all', 'QuoteController@index');
    Route::get('/quotes/add', 'QuoteController@add_quote');
    Route::get('/quotes/{quote}/reuse', 'QuoteController@reuse');
    Route::delete('/quotes/{quote}', 'QuoteController@destroy');

    Route::post('/announcement/add', 'UpdController@store');
    Route::get('/announcement/all', 'UpdController@index');
    Route::get('/announcement/add', 'UpdController@add');
    Route::delete('/announcement/{announcement}', 'UpdController@destroy');
    Route::get('/announcement/{announcement}/edit', 'UpdController@edit');
    Route::patch('/announcement/{announcement}', 'UpdController@update');

    Route::post('/blogs/add', 'BlogController@store');
    Route::post('/blogs/search', 'BlogController@search');
    Route::get('/blogs/all', 'BlogController@index');
    Route::get('/blogs/add', 'BlogController@add');
    Route::get('/blogs/{blog}/edit', 'BlogController@edit');
    Route::put('/blogs/{blog}/', 'BlogController@update');
    Route::get('/blogs/drafts', 'BlogController@drafts');
    Route::delete('/blogs/{blog}/', 'BlogController@destroy');

    Route::post('/categories/store', 'CategoryController@store');
    Route::get('/categories/index', 'CategoryController@index');
    Route::get('/categories/create', 'CategoryController@create');
    Route::delete('/categories/{category}', 'CategoryController@destroy');

    Route::get('/comments/unread', 'CommentController@index');
    Route::get('/comments/read', 'CommentController@read');
    Route::get('/comments/read/all', 'CommentController@markAsRead');
    Route::get('/comments/unread/all', 'CommentController@markAsUnread');
    Route::patch('/comments/{comment}', 'CommentController@update');
    Route::delete('/comments/{comment}', 'CommentController@destroy');

    Route::post('/students/add', 'StudentController@store');
    Route::get('/students/all/{date?}', 'StudentController@index')->name('students');
    Route::get('/students/add', 'StudentController@add')->name('addStudent');
    Route::get('/students/pending', 'StudentController@pending');
    Route::get('/students/acc_code', function () {
        return view('admin/access_codes');
    });
    Route::post('/students/acc_code', 'StudentController@code');
    Route::post('/students/upd', 'StudentController@update');
    Route::get('/students/edit/{student}', 'StudentController@edit');
    Route::post('/students/edit/{student}', 'StudentController@update');
    Route::get('/students/{student}', 'StudentController@show')->name('showStudent');

    Route::get('/users/all', 'UserController@index');
    Route::get('/users/add', 'UserController@add');
    Route::get('/users/{user}/edit', 'UserController@edit');
    Route::patch('/users/{user}', 'UserController@update');
    Route::delete('/users/{user}', 'UserController@destroy');

    Route::get('/testimonies/new', 'TestimonyController@add');
    Route::post('/testimonies/store', 'TestimonyController@store');
    Route::get('/testimonies/view/gallery', 'TestimonyController@gallery');
    Route::get('/testimonies/view/slide', 'TestimonyController@slide');
    Route::get('/testimonies/view/event', 'TestimonyController@event');
    Route::get('/testimonies/{testimony}/edit', 'TestimonyController@edit');
    Route::patch('/testimonies/{testimony}', 'TestimonyController@update');
    Route::delete('/testimonies/{testimony}', 'TestimonyController@destroy');

    Route::get('/{user}/profile/', 'UserController@edit');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
