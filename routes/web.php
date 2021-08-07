<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;
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
    return view('auth.register');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('student', 'StudentController', ['except' => ['destroy']]);
Route::get('student/{id}/destroy','StudentController@destroy')->name('student.destroy');
Route::resource('grade', 'GradeController', ['except' => ['destroy']]);
Route::get('grade/{id}/destroy','GradeController@destroy')->name('grade.destroy');
Route::get('/export-excel', 'GradeController@exportIntoExcel')->name('grade.export');
Route::post('filter', 'GradeController@filter')->name('grade.filter');
