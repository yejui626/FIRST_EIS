<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuantityController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderhisController;
use App\Http\Middleware\Customer;
use App\Models\Cartdetail;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
//use App\Http\Middleware\AuthenticateFile;
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

Route::get('/order-details/{id}', [CustomerController::class, 'order_details'])->name('order_details');

Route::get('/print_pdf/{id}', [CustomerController::class, 'print_pdf']);

Route::match(['get', 'post'], '/receipt/{id}/mail', [App\Http\Controllers\CustomerController::class, 'mailReceipt'])->name('receipt.mail');

// Route::get('/cartform{id}', [App\Http\Controllers\CustomerController::class, 'custdetail'])->name('custdetail');

// Route::post('/cartform', function () {
// 	$detail = new Cart();
// 	$detail->address = request('address');
// 	$detail->phone = request('phone');
// 	$detail->save();
// });
Route::get('orderhistory', [OrderhisController::class, 'index'])->name('orderhistory');
Route::get('orderhistory/records', [OrderhisController::class, 'records'])->name('orderhistory/records');

Route::get('/cartform/{id}', [App\Http\Controllers\CustomerController::class, 'custdetail'])->name('custdetail');
Route::get('/address/{id}', [App\Http\Controllers\CustomerController::class, 'address'])->name('address');
Route::get('/payment/{id}', [App\Http\Controllers\CustomerController::class, 'payment'])->name('payment');
Route::post('/cartform', [App\Http\Controllers\CustomerController::class, 'saveCartDetails'])->name('saveCartDetails');
Route::get('/search', [App\Http\Controllers\CustomerController::class, 'searchdata'])->name('searchdata');



Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('cust');
Route::get('/productshow', [App\Http\Controllers\CustomerController::class, 'productshow']);
Route::get('/stripe/{token}', [App\Http\Controllers\CustomerController::class, 'stripe'])
    ->name('stripe')
    ->middleware('auth');
Route::post('/stripe/post', [App\Http\Controllers\CustomerController::class, 'stripePost'])
    ->name('stripe.post')
    ->middleware('auth');

Route::get('/product_details/{id}', [App\Http\Controllers\CustomerController::class, 'product_details']);

Route::get('/show_cart', [App\Http\Controllers\CustomerController::class, 'show_cart']);

Route::get('/remove_cart/{id}', [App\Http\Controllers\CustomerController::class, 'remove_cart']);




Route::post('/add_cart/{id}', [App\Http\Controllers\CustomerController::class, 'add_cart'])->name('add_cart');


Route::get('invoice', [InvoiceController::class, 'Invoice']);

Route::resource('/supplier', SupplierController::class);

Route::resource('/product', ProductController::class);

Route::resource('/quantity', QuantityController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('Sales', function () {
	return view('Sales');
})->name('Sales')->middleware('Sales');

Route::get('Purchaser', function () {
	return view('Purchaser');
})->name('Purchaser')->middleware('Purchaser');

Route::get('Store', function () {
	return view('Store');
})->name('Store')->middleware('Store');

Route::get('Logistic', function () {
	return view('Logistic');
})->name('Logistic')->middleware('Logistic');

Route::get('Customer', function () {
	return view('Customer');
})->name('Customer')->middleware('Customer');

Route::get('Admin', function () {
	return view('Admin');
})->name('Admin')->middleware('Admin');



Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
