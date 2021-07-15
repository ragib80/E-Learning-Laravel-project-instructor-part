<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',['uses'=>'LoginController@index'])->name('login.index'); 

Route::post('/login','LoginController@verify');

Route::get('/logout', 'LogoutController@index');

Route::get('/home','HomeController@index');

Route::get('/registration','RegistrationController@index')->name('registration.index');
Route::post('/registration','RegistrationController@verify');


Route::get('/files','NoteController@index');
Route::post('/files','NoteController@uploadfile');
//Route::get('/files/{id}','NoteController@show');
Route::get('/files/view','NoteController@view');
Route::get('/files/download/{file}','NoteController@download');
Route::get('/files/{id}','NoteController@show');

Route::get('/profile','ProfileController@index');

Route::get('/dashboard','DashBoardController@index')->middleware('sess');

Route::get('/courses/list','CourseController@index')->name('course.index');

Route::get('/courses/details/{c_id}', 'CourseController@details'); 

Route::get('/courses/edit/{c_id}', 'CourseController@edit')->name('course.edit');;
Route::post('/courses/edit/{c_id}', 'CourseController@update');

Route::get('/courses/delete/{c_id}', 'CourseController@delete')->name('course.delete');
Route::post('/courses/delete/{c_id}', 'CourseController@destroy');
Route::get('/courses/list/download_course_data', 'CourseController@course')->name('course.all');

Route::get('/courses/create','CourseController@create');
Route::post('/courses/create','CourseController@insert');


Route::get('/student','StudentController@index');
Route::get('/student/details/{s_id}', 'StudentController@details'); 
Route::get('/student/list/download_course_data', 'StudentController@dwonload')->name('student.all');
//Route::get('/student/search', 'StudentController@search')->name('student.search'); 
//Route::get('/student/search/action', 'StudentController@action')->name('student_search.action');  
Route::get('/student/search', 'StudentController@searchStudent')->name('student.search');


Route::get('/search', 'CourseController@search');
Route::post('/search', 'CourseController@searching'); 


//exam
Route::resource('quizes','QuizController');

Route::get('/quizes/delete/{{id}}','QuizController@delete');
Route::get('/quizes/addquestion/{id}','QuizController@AddQuestion');

Route::resource('questions','QuestionController');

