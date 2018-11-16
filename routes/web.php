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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'Admin','namespace'=>'Admin'],function(){
    Route::get('/subject/create','SubjectController@create')->name('subject.create');
    Route::post('/add/subject','SubjectController@store')->name('add.subject');
    Route::get('/stream/create','StreamController@create')->name('stream.create');
    Route::post('/add/stream','StreamController@store')->name('add.stream');
    Route::get('/year/create','YearController@create')->name('year.create');
    Route::post('/add/year','YearController@store')->name('year.store');


});
Route::group(['prefix'=>'Teacher','namespace'=>'Teacher'],function(){

});
Route::group(['prefix'=>'Clerk','namespace'=>'Clerk'],function(){
    Route::get('/student/create','StudentController@create')->name('student.create');
    Route::post('/add/student','StudentController@store')->name('student.add');
    Route::get('/guardian/create','GuardianController@create')->name('guardian.create');
    Route::post('/addguardian','GuardianController@store')->name('guardian.add');

});
