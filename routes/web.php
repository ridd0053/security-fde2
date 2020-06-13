<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/', 'index');


Route::get('/contact', 'ContactController@create')->name('contact');
Route::post('/contact', 'ContactController@store');

Auth::routes(['verify' => true]);



Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController');
});



Route::namespace('Post')->prefix('post')->middleware('can:create-posts')->group(function(){
    Route::get('/aanmaken', 'PostController@create');
    Route::post('', 'PostController@store');
    
});
Route::namespace('Post')->middleware('can:edit-posts')->group(function(){
    Route::get('/post/wijzig/{post}', 'PostController@edit');
    Route::patch('/post/wijzigen/{post}', 'PostController@update');
    
});
Route::namespace('Post')->middleware('can:see-posts')->group(function(){
    Route::get('/post', 'PostController@index');
    Route::get('/post/{post}', 'PostController@show');
    
    
});
Route::namespace('Post')->middleware('can:delete-posts')->group(function(){
     Route::delete('/post/{post}', 'PostController@destroy')->name('post.destroy');
    
});

Route::middleware('can:manage-account')->group(function(){
    Route::get('/profiel', 'HomeController@index')->name('home');
    Route::patch('/profiel', 'HomeController@update')->name('update');
    Route::post('/profiel', 'HomeController@updateAvatar')->name('updateAvatar');
    Route::post('/wachtwoord', 'HomeController@changePassword')->name('changePassword');
    Route::delete('/profiel', 'HomeController@destroy')->name('destroyAccount');
});

 



