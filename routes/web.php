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

//Persona Natural
Route::get('/providers_personal/main', 'ProviderPersonalController@main')->name('provider_personals.main')->middleware('auth');
Route::apiResource('provider_personals', 'ProviderPersonalController')->middleware('auth');
Route::get('/providers_personal/search/{id}', 'ProviderPersonalController@search')->name('provider_personals.search')->middleware('auth');
Route::post('/providers_personal/provider_personals/pdf', 'ProviderPersonalController@pdf')->middleware('auth');

//Persona Juridica
Route::get('/provider_company/main', 'ProviderCompanyController@main')->name('provider_company.main')->middleware('auth');
Route::apiResource('provider_company', 'ProviderCompanyController')->middleware('auth');
Route::get('/provider_company/search/{id}', 'ProviderCompanyController@search')->name('provider_company.search')->middleware('auth');
Route::post('/provider_company/pdf', 'ProviderCompanyController@pdf')->middleware('auth');
Route::get('/provider_company/getpartners/{id}', 'ProviderCompanyController@getPartners')->name('provider_company.partners')->middleware('auth');

//Partner
Route::apiResource('/partner', 'PartnerController')->middleware('auth');
