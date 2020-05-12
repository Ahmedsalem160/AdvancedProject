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

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//facebook
//Route::get('/redirect/facebook','SocialController@redirect');

// will make a variable to all websites such as facebook,githup,gmail,....bla bla
Route::get('/redirect/{service}','SocialController@redirect');
Route::get('/callback/{service}','SocialController@callback');

//
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::group(['prefix' => 'offers'], function () {
        //   Route::get('store', 'CrudController@store');
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers.store');
        //Editing & Uddate the edit in DB
        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@deleteOffer')->name('offers.delete');

        Route::get('showAllOffers','CrudController@showAll');
    });

    Route::get('youtube','CrudController@getVideo');
});

##################################Begin Ajax######################################
Route::group(['prefix'=>'ajax-offer'],function (){
    Route::get('create','OfferController@create');
    Route::post('save','OfferController@store')->name('ajax.offer.store');
    Route::get('showAllOffers','OfferController@showAll')->name('ajax.shawAll');
    Route::post('delete', 'OfferController@deleteOffer')->name('ajax.delete');
});


##################################END Ajax######################################

