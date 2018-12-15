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
    Route::get('/subject/create','AdminController@subjectCreate')->name('subject.create');
    Route::post('/add/subject','AdminController@subjectStore')->name('add.subject');
    Route::get('/stream/create','AdminController@streamCreate')->name('stream.create');
    Route::post('/add/stream','AdminController@streamStore')->name('add.stream');
    Route::get('/year/create','AdminController@yearCreate')->name('year.create');
    Route::post('/add/year','AdminController@yearStore')->name('year.store');
    Route::get('/exam/create','AdminController@examCreate')->name('exam.create');
    Route::post('/add/exam','AdminController@examStore')->name('exam.store');
    Route::get('/class/create','AdminController@classCreate')->name('class.create');
    Route::post('/add/create','AdminController@classStore')->name('class.store');
    Route::get('/term/create','AdminController@termCreate')->name('term.create');
    Route::post('/add/term','AdminController@termStore')->name('term.store');
    Route::get('/grade/create','AdminController@grade_create')->name('grade.create');
    Route::post('/add/grade','AdminController@grade_save')->name('grade.store');
    Route::get('/subjectteacher/create','AdminController@add_subjectteacher')->name('subjectteacher.create');
    Route::post('/add/subjectteacher','AdminController@subjectteacher_save')->name('subjectteacher.store');
    Route::get('/studentsubject/create','AdminController@add_studentsubject')->name('studentsubject.create');
    Route::post('/add/studentsubject','AdminController@studentsubject_save')->name('studentsubject.store');
    Route::get('/contact/create','AdminController@addcontact')->name('contact.create');
    Route::post('/add/contact','AdminController@storecontact')->name('contact.store');
    Route::get('/result','AdminController@result')->name('result');
    Route::post('/result/save','AdminController@resultsave')->name('result.save');
    Route::get('/resultupload/create','AdminController@resultupload')->name('resultupload');
    Route::post('/resultupload/save','AdminController@resultuploadsave')->name('resultupload.save');
    Route::get('/upload/create','AdminController@upload')->name('upload.show');
    Route::post('/upload/save','AdminController@csvstore')->name('upload.save');
    Route::get('/confirm','AdminController@confirm')->name('confirm');
    Route::get('/commit/{set_name}','AdminController@commit')->name('commit');
    Route::get('/cancel/{set_name}','AdminController@cancelresult')->name('cancel');
    Route::get('/uncommitted','AdminController@uncommitted')->name('uncommitted');
    Route::get('/results/download','AdminController@downloadresults')->name('download.results');
    Route::get('/retrieve','AdminController@retrieve')->name('retrieve');
    Route::get('/stream/result','AdminController@stream_result')->name('streamresults');
    Route::post('/stream/result/save','AdminController@stream_result_save')->name('streamresults.display');

    Route::get('/class/results','AdminController@class_results')->name('class_results');
    Route::get('/overrall/grades','AdminController@overrallgrades')->name('overrallgrades');

    Route::get('/studentreport/view','AdminController@student_report')->name('student.report');
    Route::post('/studentreport','AdminController@studentreport')->name('studentreport');

    Route::post('/overrall/grades/save','AdminController@overrallgrades_save')->name('overrallgrades.store');

    Route::post('/class/results/save','AdminController@classResults')->name('class.results');
    Route::get('/studentterm/view','AdminController@termview')->name('studentterm');
    Route::post('/studentterm','AdminController@term_results')->name('studentterm.results');



});
Route::group(['prefix'=>'Teacher','namespace'=>'Teacher'],function(){

});
Route::group(['prefix'=>'Clerk','namespace'=>'Clerk'],function(){
    Route::get('/student/create','ClerkController@studentCreate')->name('student.create');
    Route::post('/add/student','ClerkController@studentStore')->name('student.add');
    Route::get('/student/upload/create','ClerkController@uploadstudent')->name('student.upload');
    Route::post('/upload/student','ClerkController@studentcsv')->name('studentcsv');
    Route::get('/guardian/create','ClerkController@guardianCreate')->name('guardian.create');
    Route::post('/addguardian','ClerkController@guardianStore')->name('guardian.add');
    Route::get('/students/export','ClerkController@exportstudents')->name('students');
    Route::post('/students/download','ClerkController@downloadstudents')->name('download.students');
    Route::get('subjectstudents','ClerkController@substudents')->name('substudents');
    Route::post('/subjectstudents/download','ClerkController@downloadsubjectstudents')->name('subjectstudents');
    Route::get('massassignment','ClerkController@massassignment')->name('mass');
    Route::post('massassignment/save','ClerkController@mass_save')->name('mass.save');
    Route::get('/group/assign','ClerkController@group_mass_assign')->name('groupAssign');
    Route::post('/group/store','ClerkController@groupassign_store')->name('groupassign.store');




});
