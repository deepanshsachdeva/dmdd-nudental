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

Route::get("drugs", "DrugController@index")->name('drugs.index');
Route::get("drugs/new", "DrugController@createForm")->name('drugs.new');
Route::post("drugs/new", "DrugController@create");

Route::get("drugs/{id}", "DrugController@find")->name('drugs.find');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
