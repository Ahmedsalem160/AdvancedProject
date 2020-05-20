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

    Route::get('youtube','CrudController@getVideo')->middleware('auth');
});

##################################Begin Ajax######################################
Route::group(['prefix'=>'ajax-offer'],function (){
    Route::get('create','OfferController@create');
    Route::post('save','OfferController@store')->name('ajax.offer.store');
    Route::get('showAllOffers','OfferController@showAll')->name('ajax.shawAll');
    Route::post('delete', 'OfferController@deleteOffer')->name('ajax.delete');

    Route::get('edit/{offer_id}', 'OfferController@editOffer');
    Route::post('update', 'OfferController@updateOffer')->name('ajax.update');
});


##################################Begin Middleware Authenticate && Guards ######################################
Route::group(['namespace'=>'Auth'],function (){
    Route::get('adults','CustomAuthController@adult')->middleware('CheckAge');
});
Route::view('notAllowed','customAuth\notAllowed')->name('notAllowed');
//////// Gaurds && middleware
Route::get('user','Auth\CustomAuthController@userSite')->middleware('auth:web');
Route::get('admin','Auth\CustomAuthController@adminSite')->middleware('auth:admin');
//view to admin login
Route::get('admin/login','Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login','Auth\CustomAuthController@checkAdminLogin')->name('save.admin.login');





##################################END Middleware Authenticate && Guards ######################################


################################## Begin Relation Routes ####################################
Route::group(['namespace'=>'Relations'],function (){
    Route::get('has-one','RelationController@hasOneRelation');
    Route::get('has-one/reverse','RelationController@hasOneRelationReverse');
    Route::get('user-has-phone','RelationController@userHasPhone');
    Route::get('user-not-has-phone','RelationController@userNotHasPhone');
    Route::get('user-has-phone-condition','RelationController@userHasPhoneWithCondition');
#############################Begin one To Many Relations  #########################
    Route::get('hospital-has-many','hasManyController@getHospitalDoctors');
    Route::get('hospitals','hasManyController@hospitals')->name('hospitals.all');
    Route::get('doctors/{hospital_id}','hasManyController@doctors')->name('hospital.doctor');
    Route::get('hospitals/{hospital_id}','hasManyController@deleteHospital')->name('hospital.delete');
    Route::get('hospital-has-doctor','hasManyController@hospitalHasDoctor');
    Route::get('hospital-not-has-doctor','hasManyController@hospitalNotHasDoctor');
    Route::get('hospital-has-doctor-male','hasManyController@hospitalHasDoctorMale');
############################ END one To Many Relations  ###########################

############################Begin Many To Many Relations  ##########################
    Route::get('doctors-services','ManyToManyController@getDoctorServices');
    Route::get('services-doctors','ManyToManyController@getServiceDoctors');
    Route::get('show-doctor-services/{doctor_id}','ManyToManyController@showDoctorServices')->name('show.doctor.services');
    Route::post('AddServices-to-doctor','ManyToManyController@saveServicesToDotor')->name('save.services.ToDoctor');
############################ END Many To Many Relations  ###########################
});
################################## END Relation Routes ######################################
