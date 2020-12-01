<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('details', function () {
//
//    $ip = '43.241.145.135';
//    $data = \Location::get($ip);
//    return $data;
//
//});

Route::group(['middleware' => ['sitesettings']], function () {
    Route::get('user/home', 'FrontendController@index')->name('home');
    Route::get('user/cart', 'FrontendController@pagecart')->name('user.cart');
    Route::get('user/login', 'FrontendController@pagelogin')->name('user.login');
    Route::get('user/register', 'FrontendController@pageregister')->name('user.register');
    Route::post('user/register', 'FrontendController@register')->name('user.register.submit');
    Route::post('user/login', 'FrontendController@userlogin')->name('user.login.submit');
    Route::post('user/logout', 'FrontendController@logout')->name('user.logout');


    Route::get('user/contact', 'FrontendController@pagecontact')->name('user.contact');
    Route::get('user/order', 'FrontendController@pageorder')->name('user.order');

    Route::get('/detail/{id}', 'ItemController@itemDetails')->name('itemDetails');
    Route::get('/category/{id}', 'FrontendController@getCategoryProduct')->name('user.category');
    Route::post('/user/verifyOTP', 'FrontendController@verifyOTP')->name('front.user.verifyOTP');

    Route::post('user/cart', 'FrontendController@addtocart')->name('frontend.addtocart');
    Route::post('user/updatecart', 'FrontendController@updatecart')->name('frontend.updatecart');
    Route::get('user/removeitem/{id}', 'FrontendController@removeitem')->name('frontend.remove');
    Route::get('user/checkout', 'FrontendController@checkout')->name('frontend.checkout');
    Route::get('user/address', 'FrontendController@pageshipingaddress')->name('frontend.address');
    Route::post('user/address', 'FrontendController@saveAddress')->name('frontend.address.submit');
    Route::post('user/placeorder', 'FrontendController@placeorder')->name('frontend.checkout.submit');

    Route::post('user/payment', 'FrontendController@payment')->name('payment');
    Route::get('user/pay-success', 'FrontendController@success')->name('pay-success');

});


Route::get('logout', 'QovexController@logout');

Route::get('pages-login', 'QovexController@index');
Route::get('pages-login-2', 'QovexController@index');
Route::get('pages-register', 'QovexController@index');
Route::get('pages-register-2', 'QovexController@index');
Route::get('pages-recoverpw', 'QovexController@index');
Route::get('pages-recoverpw-2', 'QovexController@index');
Route::get('pages-lock-screen', 'QovexController@index');
Route::get('pages-lock-screen-2', 'QovexController@index');
Route::get('pages-404', 'QovexController@index');
Route::get('pages-500', 'QovexController@index');
Route::get('pages-maintenance', 'QovexController@index');
Route::get('pages-comingsoon', 'QovexController@index');
Route::post('login-status', 'QovexController@checkStatus');


//// You can also use auth middleware to prevent unauthenticated users
//Route::group(['middleware' => 'auth'], function () {
//    // Route::get('/home', 'HomeController@index')->name('home');
//});


Route::group(['prefix' => 'admin'], function () {

    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    // Login Route

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Register Route

    Route::resource('register', 'Auth\AdminRegisterController');

    //  User Route

    Route::resource('users', 'UserController');
    Route::get('user/list', 'UserController@getUser')->name('users.list');
    Route::get('user/store/list', 'UserController@getStoreUser')->name('users.store.list');
    Route::get('user/store/home', 'UserController@storeuser')->name('user.store.home');
    Route::get('user/home', 'UserController@index')->name('user.home');
    Route::get('user/status/{id}', 'UserController@changeStatus')->name('users.status');
    Route::get('user/detail/{id}', 'UserController@showdetail')->name('users.detail');
    Route::post('user/update', 'UserController@updateDetail')->name('users.update.detail');
    Route::post('user/websitesettings/update', 'UserController@updateWebsiteSettingsDetail')->name('users.update.websettings');

    //  Role Route

    Route::resource('roles', 'RoleController');
    Route::get('role/home', 'RoleController@index')->name('role.home');
    Route::get('role/list', 'RoleController@getRole')->name('roles.list');

    // Business Category Route

    Route::resource('businesscategories', 'BusinessCategoryController');
    Route::get('businesscategory/home', 'BusinessCategoryController@index')->name('businesscategory.home');
    Route::get('businesscategory/list', 'BusinessCategoryController@getCategory')->name('businesscategories.list');
    Route::get('businesscategory/status/{id}', 'BusinessCategoryController@changeStatus')->name('businesscategories.status');

    // Business Category Route

    Route::resource('categories', 'CategoryController');
    Route::get('category/home', 'CategoryController@index')->name('categories.home');
    Route::get('category/list', 'CategoryController@getCategory')->name('categories.list');
    Route::get('category/status/{id}', 'CategoryController@changeStatus')->name('categories.status');

    // Items Route

    Route::resource('items', 'ItemController');
    Route::get('item/home', 'ItemController@index')->name('items.home');
    Route::get('item/list', 'ItemController@getItem')->name('items.list');
    Route::get('item/status/{id}', 'ItemController@changeStatus')->name('items.status');

    // Slider Route
    Route::resource('sliders', 'SliderController');
    Route::get('slider/home', 'SliderController@index')->name('slider.home');
    Route::get('slider/list', 'SliderController@getSlider')->name('sliders.list');
    Route::get('slider/status/{id}', 'SliderController@changeStatus')->name('sliders.status');


    // Order Route

    Route::resource('orders', 'OrderController');
    Route::get('order/home', 'OrderController@index')->name('order.home');
    Route::get('order/list', 'OrderController@getOrder')->name('orders.list');
    Route::get('order/status/{id}', 'OrderController@changeStatus')->name('orders.status');
    Route::get('order/{id}/delete', 'OrderController@deleteorderHistory')->name('orders.history');
    Route::get('print/{id}', 'OrderController@printinvoice')->name('orders.invoice');
    Route::get('printorder/{id}', 'OrderController@printorder')->name('orders.print');
    Route::get('orderhistory/status/{id}', 'OrderController@orderChangeStatus')->name('orderhistory.status');

    // Product Attribute Route

    Route::resource('attributes', 'AttributeController');
    Route::get('attribute/home', 'AttributeController@index')->name('attributes.home');
    Route::get('attribute/list', 'AttributeController@getAttribute')->name('attributes.list');
    Route::get('attribute/status/{id}', 'AttributeController@changeStatus')->name('attributes.status');

    // Product Attribute Value Route
    Route::resource('attributevalues', 'AttributeValueController');
    Route::get('attributevalue/home', 'AttributeValueController@index')->name('attributevalue.home');
    Route::get('attributevalue/list', 'AttributeValueController@getItemAttribute')->name('attributevalues.list');






});
