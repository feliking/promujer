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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('home');

//Providers
Route::get('/providers_personal/main', 'ProviderPersonalController@main')->name('provider_personals.main')->middleware('auth');
Route::apiResource('provider_personals', 'ProviderPersonalController')->middleware('auth');
