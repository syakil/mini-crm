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

Route::get('/language/{lang}','LanguageController')->name('language.switch');

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/companies/index', 'CompaniesController@index')->name('companies.index');
Route::get('/companies/listData','CompaniesController@listData')->name('companies.data');
Route::get('/companies/getId/{id}','CompaniesController@getId')->name('companies.getId');
Route::post('/companies/store', 'CompaniesController@store')->name('companies.store');
Route::put('/companies/update', 'CompaniesController@update')->name('companies.update');
Route::delete('/companies/delete/{id}', 'CompaniesController@destroy')->name('companies.delete');

Route::get('/employees/index', 'EmployeesController@index')->name('employees.index');
Route::get('/employees/listData','EmployeesController@listData')->name('employees.data');
Route::get('/employees/getId/{id}','EmployeesController@getId')->name('employees.getId');
Route::post('/employees/store', 'EmployeesController@store')->name('employees.store');
Route::put('/employees/update', 'EmployeesController@update')->name('employees.update');
Route::delete('/employees/delete/{id}', 'EmployeesController@destroy')->name('employees.delete');