<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/events','HomeController@events');
Route::get('/events/{name}','HomeController@eventDetail');
Route::get('/funevents/{name}','HomeController@funeventDetail');
Route::get('/inventory/{name}','HomeController@productDetail');
Route::get('/schedule','HomeController@schedule');
Route::get('/sponsor','HomeController@sponsor');
Route::get('/dashboard','HomeController@dashboard');
Auth::routes();
Route::get('/commitee','HomeController@commitee');
Route::post('/volunteer','HomeController@volunteer');
Route::post('/student_data','HomeController@student_data');
Route::post('/team','HomeController@team');
Route::get('/home', 'HomeController@index');
Route::get('/repay', 'HomeController@repay');
Route::get('/cart', 'HomeController@cart');
Route::get('/inventory', 'HomeController@inventory');
Route::get('/video', 'HomeController@video');
Route::get('/gallery', 'HomeController@gallery');
Route::get('/contact', 'HomeController@contact');
Route::get('/pronight', 'HomeController@pronight');
Route::get('/fun_events', 'HomeController@fun_events');
Route::post('/add_solo', 'HomeController@add_solo');
Route::post('/cancel_solo', 'HomeController@cancel_solo');
Route::post('/add_grp', 'HomeController@add_grp');
Route::post('/cancel_group', 'HomeController@cancel_group');
Route::post('/team_detail', 'HomeController@team_detail');
Route::post('/add_product', 'HomeController@add_product');
Route::post('/remove_product', 'HomeController@cancel_product');
Route::post('/update_qty', 'HomeController@update_qty');
Route::post('/product_add', 'HomeController@product_add');
Route::post('/remove_hostel', 'HomeController@remove_hostel');
Route::post('/add_hostel', 'HomeController@add_hostel');
Route::get('/payment', 'HomeController@payment');
Route::post('/complete', 'HomeController@complete');