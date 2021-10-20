<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getMemberData', 'HomeController@getMemberData');
Route::post('/memberDelete', 'HomeController@memberDelete');
Route::post('/memberAdd', 'HomeController@memberAdd');
Route::post('/GetMemberDetails', 'HomeController@GetMemberDetails');
Route::post('/MemberDetailUpdate', 'HomeController@MemberDetailUpdate');


//books
Route::get('/books', 'BooksController@index')->name('books');
Route::get('/getBookData', 'BooksController@getBookData');
Route::post('/bookDelete', 'BooksController@bookDelete');
Route::post('/bookAdd', 'BooksController@bookAdd');
Route::post('/GetBookDetails', 'BooksController@GetBookDetails');
Route::post('/BookDetailUpdate', 'BooksController@BookDetailUpdate');

//addIssue

Route::get('/issue/{id}', 'IssueController@Issue');
Route::get('/getMemberData/{id}', 'IssueController@getMemberData');
Route::get('/getLentData/{user}', 'IssueController@getLentData');
Route::post('/issueAdd', 'IssueController@issueAdd');
