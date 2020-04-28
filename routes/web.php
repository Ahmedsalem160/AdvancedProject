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
    });
});


/*
 *
 * Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::group(['prefix' => 'offers'], function () {
        //   Route::get('store', 'CrudController@store');
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers.store');

        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@UpdateOffer')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@delete')->name('offers.delete');
        Route::get('all', 'CrudController@getAllOffers')->name('offers.all');
    });

    Route::get('youtube', 'CrudController@getVideo');
});

 *
 */

