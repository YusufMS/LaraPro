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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('profile', 'ProfileController');
Route::get('/', 'PagesController@index')->name('indexPage');
Route::get('/about', 'PagesController@about')->name('aboutPage');
Route::get('/blog', 'PagesController@blog')->name('blogPage');
Route::get('/blog/category/{id}', 'PagesController@blogByCategory')->name('blogByCategory');
Route::get('/blog/author/{id}', 'PagesController@blogByAuthor')->name('blogByAuthor');
// Route::get('/profile', 'PagesController@profile')->name('profilePage');
Route::get('/contact', 'PagesController@contact')->name('contactPage');
Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');

Route::resource('posts', 'PostsController');
Auth::routes();

//delete if no errors occur after finishing up
Route::get('/home', function(){
    return redirect('/');
});

Route::resource('comments', 'CommentsController');

