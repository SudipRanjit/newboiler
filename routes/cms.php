<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register cms routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "auth" middleware group. Now create something great!
|
*/

/* ==================================================================================
                            Dashboard
===================================================================================*/

$router->get('/', 'DashboardController@index')->name('dashboard');

$router->get('logger', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

$router->get('logout', function () {
  Auth::logout();
  return back();
})->name('logout');

/* ==================================================================================
                        Role Module
 ====================================================================================*/

 $router->get('user/roles', 'User\RoleController@index')->name('users.roles.index');

 $router->get('user/role/create', 'User\RoleController@create')->name('users.roles.create');
 
 $router->post('user/role/store', 'User\RoleController@store')->name('users.roles.store');
 
 $router->get('user/role/edit/{role}', 'User\RoleController@edit')->name('users.roles.edit');
 
 $router->patch('user/role/update/{role}', 'User\RoleController@update')->name('users.roles.update');
 
 $router->get('user/role/permissions/{role}', 'User\RoleController@permissions')->name('users.roles.permissions');
 
 $router->post('user/role/permission/update/{role}', 'User\RoleController@updatePermissions')->name('users.roles.permissions.update');
 
 /* ==================================================================================
                         User Module
  ====================================================================================*/
 
 $router->get('users', 'User\UserController@index')->name('users.index');
 
 $router->get('users/create', 'User\UserController@create')->name('users.create');
 
 $router->post('users/store', 'User\UserController@store')->name('users.store');
 
 $router->get('users/edit/{user}', 'User\UserController@edit')->name('users.edit');
 
 $router->patch('users/update/{user}', 'User\UserController@update')->name('users.update');
 
 $router->get('user/verification/check/{token}', 'User\UserController@verify')->name('users.verification.check');
 
 
 /* ==================================================================================
                         Category Module
  ====================================================================================*/
 
  $router->get('categories', 'Category\CategoryController@index')->name('categories.index');
 
 $router->get('categories/add', 'Category\CategoryController@create')->name('categories.create');
 
 $router->get('categories/edit/{category}', 'Category\CategoryController@edit')->name('categories.edit');
 
 $router->delete('categories/delete/{category}', 'Category\CategoryController@delete')->name('categories.delete');
 
 $router->patch('categories/update/{category}', 'Category\CategoryController@update')->name('categories.update');
 
 $router->post('categories/store','Category\CategoryController@store')->name('categories.store');

 $router->get('categories/search','Category\CategoryController@search')->name('categories.search');

 //Brands

 $router->get('brands', 'Brand\BrandController@index')->name('brands.index');
 
 $router->get('brands/add', 'Brand\BrandController@create')->name('brands.create');
 
 $router->get('brands/edit/{brand}', 'Brand\BrandController@edit')->name('brands.edit');
 
 $router->delete('brands/delete/{brand}', 'Brand\BrandController@delete')->name('brands.delete');
 
 $router->patch('brands/update/{brand}', 'Brand\BrandController@update')->name('brands.update');
 
 $router->post('brands/store','Brand\BrandController@store')->name('brands.store');

 $router->get('brands/search','Brand\BrandController@search')->name('brands.search');

 //Power
 $router->get('powers', 'Power\PowerController@index')->name('powers.index');
 
 $router->get('powers/add', 'Power\PowerController@create')->name('powers.create');
 
 $router->get('powers/edit/{power}', 'Power\PowerController@edit')->name('powers.edit');
 
 $router->delete('powers/delete/{power}', 'Power\PowerController@delete')->name('powers.delete');
 
 $router->patch('powers/update/{power}', 'Power\PowerController@update')->name('powers.update');
 
 $router->post('powers/store','Power\PowerController@store')->name('powers.store');

 $router->get('powers/search','Power\PowerController@search')->name('powers.search');

 /* ==================================================================================
                         Media Module
  ====================================================================================*/
 
 $router->get('medias', 'Media\MediaController@index')->name('medias.index');
 
 $router->get('medias/add', 'Media\MediaController@create')->name('medias.create');
 
 $router->get('medias/edit/{media}', 'Media\MediaController@edit')->name('medias.edit');
 
 $router->delete('medias/delete/{media}', 'Media\MediaController@delete')->name('medias.delete');
 
 $router->patch('medias/update/{media}', 'Media\MediaController@update')->name('medias.update');
 
 $router->post('medias/store','Media\MediaController@store')->name('medias.store');
 
 $router->get('/allMedia/{search?}', 'Media\MediaController@listMedia')->name('media.all');
 
 $router->post('/uploadFiles', 'Media\MediaController@uploadFiles')->name('uploadFiles');
 
 $router->post('/updateMedia/{id}', 'Media\MediaController@updateMedia')->name('media.update');
 
 $router->delete('/deleteMedia/{id}', 'Media\MediaController@deleteMedia')->name('media.delete');

  /* ==================================================================================
                         Boiler Module
  ====================================================================================*/

 $router->get('boilers', 'Boiler\BoilerController@index')->name('boilers.index');
 
 $router->get('boilers/add', 'Boiler\BoilerController@create')->name('boilers.create');
 
 $router->get('boilers/edit/{boiler}', 'Boiler\BoilerController@edit')->name('boilers.edit');
 
 $router->delete('boilers/delete/{boiler}', 'Boiler\BoilerController@delete')->name('boilers.delete');
 
 $router->patch('boilers/update/{boiler}', 'Boiler\BoilerController@update')->name('boilers.update');
 
 $router->post('boilers/store','Boiler\BoilerController@store')->name('boilers.store');

 $router->get('boilers/search','Boiler\BoilerController@search')->name('boilers.search');

  /*=====================================================================================
                         Addon Module
  ====================================================================================*/

  $router->get('addons', 'Addon\AddonController@index')->name('addons.index');
 
  $router->get('addons/add', 'Addon\AddonController@create')->name('addons.create');
  
  $router->get('addons/edit/{addon}', 'Addon\AddonController@edit')->name('addons.edit');
  
  $router->delete('addons/delete/{addon}', 'Addon\AddonController@delete')->name('addons.delete');
  
  $router->patch('addons/update/{addon}', 'Addon\AddonController@update')->name('addons.update');
  
  $router->post('addons/store','Addon\AddonController@store')->name('addons.store');
 
  $router->get('addons/search','Addon\AddonController@search')->name('addons.search');

  /*====================================================================================
                         Smart Devices Module
  ====================================================================================*/

  $router->get('devices', 'Device\DeviceController@index')->name('devices.index');
 
  $router->get('devices/add', 'Device\DeviceController@create')->name('devices.create');
  
  $router->get('devices/edit/{device}', 'Device\DeviceController@edit')->name('devices.edit');
  
  $router->delete('devices/delete/{device}', 'Device\DeviceController@delete')->name('devices.delete');
  
  $router->patch('devices/update/{device}', 'Device\DeviceController@update')->name('devices.update');
  
  $router->post('devices/store','Device\DeviceController@store')->name('devices.store');
 
  $router->get('devices/search','Device\DeviceController@search')->name('devices.search');

  /*===================================================================================
                         Radiator Module
  ====================================================================================*/

  $router->get('radiators', 'Radiator\RadiatorController@index')->name('radiators.index');
 
  $router->get('radiators/add', 'Radiator\RadiatorController@create')->name('radiators.create');
  
  $router->get('radiators/edit/{radiator}', 'Radiator\RadiatorController@edit')->name('radiators.edit');
  
  $router->delete('radiators/delete/{radiator}', 'Radiator\RadiatorController@delete')->name('radiators.delete');
  
  $router->patch('radiators/update/{radiator}', 'Radiator\RadiatorController@update')->name('radiators.update');
  
  $router->post('radiators/store','Radiator\RadiatorController@store')->name('radiators.store');
 
  $router->get('radiators/search','Radiator\RadiatorController@search')->name('radiators.search');

  /*===================================================================================
                         Booking Module
  ====================================================================================*/

  $router->get('custom-prices', 'Booking\CustomPriceController@create')->name('custom_prices.create');

  $router->get('block-dates', 'Booking\BlockDateController@index')->name('block_dates.index');

  $router->get('block-dates/add', 'Booking\BlockDateController@create')->name('block_dates.create');
  
  $router->get('block-dates/edit/{block_date}', 'Booking\BlockDateController@edit')->name('block_dates.edit');
  
  $router->delete('block-dates/delete/{block_date}', 'Booking\BlockDateController@delete')->name('block_dates.delete');
  
  $router->patch('block-dates/update/{block_date}', 'Booking\BlockDateController@update')->name('block_dates.update');
  
  $router->post('block-dates/store','Booking\BlockDateController@store')->name('block_dates.store');
 
  $router->get('block-dates/search','Booking\BlockDateController@search')->name('block_dates.search');

  $router->get('orders', 'Booking\OrderController@index')->name('orders.index');

  $router->get('orders/search','Booking\OrderController@search')->name('orders.search');

  $router->get('order-details/{order}', 'Booking\OrderDetailController@index')->name('order_details.index');

  $router->get('bookings', 'Booking\BookingController@index')->name('bookings.index');

  $router->get('bookings/search','Booking\BookingController@search')->name('bookings.search');

  $router->get('bookings/edit/{booking}', 'Booking\BookingController@edit')->name('bookings.edit');
 
  $router->patch('bookings/update/{booking}', 'Booking\BookingController@update')->name('bookings.update');
  
