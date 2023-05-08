<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\AuthController;

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

Auth::routes();
Route::get('/', 'App\Http\Controllers\HomePageController@index');
Route::get('/listing', 'App\Http\Controllers\ListingPageController@index');
Route::get('/category/{id}', 'App\Http\Controllers\ListingPageController@listing1');
Route::get('/author/{id}', 'App\Http\Controllers\ListingPageController@listing');
Route::get('/details/{slug}', 'App\Http\Controllers\DetailsPageController@index')->name('details');
Route::post('/comments', 'App\Http\Controllers\DetailsPageController@comment');
Route::get('auth/google', [GoogleController::class,'googlepage']);
Route::get('auth/google/callback', [GoogleController::class,'googlecallback']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', 'App\Http\Controllers\Admin\PostController@searchPost');

Route::group(['prefix'=>'back','middleware'=>'auth'],function(){
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@index');

    Route::get('/category', 'App\Http\Controllers\Admin\CategoryController@index');
    Route::get('/category/create', 'App\Http\Controllers\Admin\CategoryController@create');
    Route::get('/category/edit', 'App\Http\Controllers\Admin\CategoryController@edit');

    Route::get('/permission', 'App\Http\Controllers\Admin\PermissionController@index');
    Route::get('/permission/create', 'App\Http\Controllers\Admin\PermissionController@create');
    Route::post('/permission/store', 'App\Http\Controllers\Admin\PermissionController@store');
    Route::get('/permission/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\PermissionController@edit','as'=>'permission-edit']);
    Route::put('/permission/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\PermissionController@update','as'=>'permission-update']);
    Route::delete('/permission/delete/{id}', ['uses'=>'App\Http\Controllers\Admin\PermissionController@destroy','as'=>'permission-delete']);

    Route::get('/roles', 'App\Http\Controllers\Admin\RoleController@index');
    Route::get('/roles/create', 'App\Http\Controllers\Admin\RoleController@create');
    Route::post('/roles/store', 'App\Http\Controllers\Admin\RoleController@store');
    Route::get('/roles/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\RoleController@edit','as'=>'role-edit']);
    Route::put('/roles/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\RoleController@update','as'=>'role-update']);
    Route::delete('/roles/delete/{id}', ['uses'=>'App\Http\Controllers\Admin\RoleController@destroy','as'=>'role-delete']);

    Route::get('/author', 'App\Http\Controllers\Admin\AuthorController@index');
    Route::get('/author/create', 'App\Http\Controllers\Admin\AuthorController@create');
    Route::post('/author/store', 'App\Http\Controllers\Admin\AuthorController@store');
    Route::get('/author/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\AuthorController@edit','as'=>'author-edit']);
    Route::put('/author/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\AuthorController@update','as'=>'author-update']);
    Route::delete('/author/delete/{id}', ['uses'=>'App\Http\Controllers\Admin\AuthorController@destroy','as'=>'author-delete']);

    Route::get('/categories', ['uses'=>'App\Http\Controllers\Admin\CategoryController@index','as'=>'category-list']);
    Route::get('/categories/create', ['uses'=>'App\Http\Controllers\Admin\CategoryController@create','as'=>'category-create']);
    Route::post('/categories/store', ['uses'=>'App\Http\Controllers\Admin\CategoryController@store','as'=>'category-store']);
    Route::put('/categories/status/{id}', ['uses'=>'App\Http\Controllers\Admin\CategoryController@status','as'=>'category-status']);
    Route::get('/categories/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\CategoryController@edit','as'=>'category-edit']);
    Route::put('/categories/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\CategoryController@update','as'=>'category-update']);
    Route::delete('/categories/delete/{id}', ['uses'=>'App\Http\Controllers\Admin\CategoryController@destroy','as'=>'category-delete']);

    Route::get('/posts', ['uses'=>'App\Http\Controllers\Admin\PostController@index','as'=>'post-list']);
    Route::get('/posts/create', ['uses'=>'App\Http\Controllers\Admin\PostController@create','as'=>'post-create']);
    Route::post('/posts/store', ['uses'=>'App\Http\Controllers\Admin\PostController@store','as'=>'post-store']);
    Route::put('/posts/status/{id}', ['uses'=>'App\Http\Controllers\Admin\PostController@status','as'=>'post-status']);
    Route::put('/posts/hot/news/{id}', ['uses'=>'App\Http\Controllers\Admin\PostController@hot_news','as'=>'post-hot news']);
    Route::get('/posts/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\PostController@edit','as'=>'post-edit']);
    Route::put('/posts/edit/{id}', ['uses'=>'App\Http\Controllers\Admin\PostController@update','as'=>'post-update']);
    Route::delete('/posts/delete/{id}', ['uses'=>'App\Http\Controllers\Admin\PostController@destroy','as'=>'post-delete']);

    Route::get('/comment/{id}', ['uses'=>'App\Http\Controllers\Admin\CommentController@index','as'=>'comment-list']);
    Route::put('/comment/status/{id}', ['uses'=>'App\Http\Controllers\Admin\CommentController@status','as'=>'comment-status']);
    Route::get('/comment/reply/{id}', ['uses'=>'App\Http\Controllers\Admin\CommentController@reply','as'=>'comment-view']);
    Route::post('/comment/reply', ['uses'=>'App\Http\Controllers\Admin\CommentController@store','as'=>'comment-reply']);

    Route::get('/settings', ['uses'=>'App\Http\Controllers\Admin\SettingController@index','as'=>'setting']);
    Route::put('/settings/update', ['uses'=>'App\Http\Controllers\Admin\SettingController@update','as'=>'setting-update']);
});

Route::controller(App\Http\Controllers\Auth\AuthOtpController::class)->group(function(){
    Route::get('otp/login', 'login')->name('otp.login');
    Route::post('otp/generate', 'generate')->name('otp.generate');
    Route::get('otp/verification/{user_id}', 'verification')->name('otp.verification');
    Route::post('otp/login', 'loginWithOtp')->name('otp.getlogin');
});
