<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\TwilioSMSController;
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

Auth::routes();

Route::post('/login/user', 'Auth\LoginController@webifiLogin')->name('post.webifi.login');

Route::get('/api/all', 'API\APIController@index')->name('home');

Route::get('/api/boilers/{type}/{power}', 'API\APIController@boilers')->name('boilers');

Route::get('/api/boilers/price/{type}/{power}', 'API\APIController@boilersByPrice')->name('boilers.price');

Route::get('/api/boilers/brand/{type}/{power}', 'API\APIController@boilersByBrand')->name('boilers.brand');

Route::get('/api/brands', 'API\APIController@allBrands')->name('brand.all');

Route::get('/api/boiler/{id}', 'API\APIController@boiler')->name('boiler');

Route::get('/api/brand/{id}', 'API\APIController@brand')->name('brand');

Route::get('/api/addon/{id}', 'API\APIController@addon')->name('addon');

Route::get('/api/smart-devices', 'API\APIController@smartDevice')->name('smartDevice');

Route::get('/api/control-devices/{id}', 'API\APIController@controlDevices')->name('control.devices');


Route::get('/api/new/boilers/{type}/{power}/{limit?}/{page?}', 'API\BoilerController@boilers')->name('new.boilers');
Route::get('/api/new/controls/{ids?}/{limit?}/{page?}', 'API\AddonController@controls_by_ids')->name('new.controls');
Route::get('/api/new/devices/{limit?}/{page?}', 'API\DeviceController@devices')->name('new.devices');

Route::get('/', 'Pages\IndexController@index')->name('page.index');
Route::get('/boilers', 'Pages\BoilerController@index')->name('page.boilers');
Route::get('/controls', 'Pages\ControlController@index')->name('page.controls');
Route::get('/radiators', 'Pages\RadiatorController@index')->name('page.radiators');
Route::get('/smart-devices', 'Pages\DeviceController@index')->name('page.smart-devices');
Route::get('/booking', 'Pages\BookingController@index')->name('page.booking');
Route::post('/save-answer','Pages\IndexController@saveAnswer')->name('save-answer');
Route::post('/update-answer','Pages\IndexController@updateAnswer')->name('update-answer');
Route::get('/boiler/{id}','Pages\BoilerController@view')->name('page.boiler');
//Route::post('/complete-booking','Pages\BookingController@completeBooking')->name('complete-booking');
Route::post('/save-order','Pages\BookingController@saveOrder')->name('save-order');
Route::post('/get-radiator-price','Pages\RadiatorController@getPrice')->name('get-radiator-price');
Route::post('/get-radiator-heights','Pages\RadiatorController@getHeights')->name('get-radiator-heights');
Route::post('/get-radiator-lengths','Pages\RadiatorController@getLengths')->name('get-radiator-lengths');

//Route::post('/get-client-secret','Pages\BookingController@getPaymentIntentClientSecret')->name('get-secret');
Route::post('/get-customer-client-secret','Pages\BookingController@createStripeCustomerAndClientSecret')->name('get-customer-secret');

//Route::post('/test-future-payout','Pages\BookingController@testStripeFuturePayout')->name('test-future-payout');
//Route::post('/delete-stripe-order','Pages\BookingController@deleteStripeOrder')->name('delete-stripe-order');
Route::get('/thankyou','Pages\BookingController@thankyou_page')->name('page.thankyou');
Route::post('/update-customer','Pages\BookingController@updateStripeCustomer')->name('update-stripe-customer');
Route::post('/order-notification-email-to-customer','Pages\BookingController@ajSendOrderNotificationEmailToCustomer')->name('order-notification-email-to-customer');
Route::post('/save-quote', 'Pages\QuoteController@saveQuote')->name('save.quote');

Route::get('/saved-quote/{id?}/{token?}', 'Pages\QuoteController@savedQuote')->name('saved.quote');

Route::get('sendSMS', [TwilioSMSController::class, 'index']);