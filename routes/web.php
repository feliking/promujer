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

Route::group(['middleware' => ['auth', 'status']], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['middleware' => ['admin']], function(){
        //Usuarios
        Route::get('/user/main', 'UserController@main')->name('user.main');
        Route::apiResource('user', 'UserController');
        Route::post('/user/status', 'UserController@status')->name('user.status');
        Route::post('/user/verifica', 'UserController@verifica')->name('user.verifica');
        Route::post('/user/delete/role', 'UserController@deleteRole')->name('user.deleteRole');
        Route::post('/user/add/role', 'UserController@addRole')->name('user.addRole');
        Route::get('/user/config/administrator', 'UserController@config')->name('user.config');
        Route::post('/user/update/admin', 'UserController@updateAdmin')->name('user.updateadmin');
    });
    //Persona Natural
    Route::get('/providers_personal/main', 'ProviderPersonalController@main')->name('provider_personals.main');
    Route::apiResource('provider_personals', 'ProviderPersonalController');
    Route::get('/providers_personal/search/{id}', 'ProviderPersonalController@search')->name('provider_personals.search');
    Route::post('/providers_personal/provider_personals/pdf', 'ProviderPersonalController@pdf');
    
    //Persona Juridica
    Route::get('/provider_company/main', 'ProviderCompanyController@main')->name('provider_company.main');
    Route::apiResource('provider_company', 'ProviderCompanyController');
    Route::get('/provider_company/search/{id}', 'ProviderCompanyController@search')->name('provider_company.search');
    Route::post('/provider_company/pdf', 'ProviderCompanyController@pdf');
    Route::get('/provider_company/getpartners/{id}', 'ProviderCompanyController@getPartners')->name('provider_company.partners');
    Route::put('/provider_company/update/partner', 'ProviderCompanyController@updatePartners');
    
    //Partner
    Route::apiResource('/partner', 'PartnerController');
    
});
