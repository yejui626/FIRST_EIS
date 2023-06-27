<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LogisticController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuantityController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\GRNController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderhisController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StoreUserController;
use App\Http\Middleware\Customer;
use App\Models\Cartdetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
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

Route::get('/addMultipleRow', [App\Http\Controllers\ProductController::class, 'test'])->name('testing-page');


Route::post('/add_cart/{id}', [App\Http\Controllers\CustomerController::class, 'add_cart'])->name('add_cart');	


Route::get('invoice', [InvoiceController::class, 'Invoice']);


Route::get('/order-detail', [SalesController::class, 'viewOrderDetail'])->name('sales.order.detail');
Route::get('/weekly-sales', [SalesController::class, 'viewWeeklySales'])->name('sales.weekly.sales');
Route::get('/monthly-report', [SalesController::class, 'generateMonthlyReport'])->name('sales.monthly.report');
Route::get('/monthly-report/download/', [SalesController::class, 'downloadMonthlyReport'])->name('sales.monthly.report.download');
Route::get('/sales/dashboard', [SalesController::class, 'dashboard'])->name('sales.dashboard');



Route::group(['middleware' => 'role:3'], function () {
    Route::resource('/order', OrderController::class);
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::post('/purchaserequest/create', [PurchaseRequestController::class, 'store'])->name('purchaseRequest.store');
	 Route::get('purchaserequest/createwithproduct/{product_id}', [PurchaseRequestController::class, 'createwithproduct'])->name('purchaseRequest.createwithproduct');
	 
    Route::resource('/quantity', QuantityController::class);
    Route::put('/purchase-order/{id}/update-status', [PurchaseOrderController::class, 'updateStatus'])->name('po.updateStatus');
	Route::get('/grn/create/{id}', [GRNController::class, 'create'])->name('grn.Create');
});

Route::group(['middleware' => 'role:2'], function () {
    
Route::resource('/supplier', SupplierController::class);
Route::resource('/product', ProductController::class);
Route::resource('/productcategory', ProductCategoryController::class);
Route::get('/purchase-order/create/{id}', [PurchaseOrderController::class, 'create'])->name('po.createOrder');
Route::put('/purchaserequest/{id}/update-status', [PurchaseRequestController::class, 'updateStatus'])->name('purchaseRequest.updateStatus');
});

Route::put('/purchase-order/{id}', [PurchaseOrderController::class, 'update'])->name('po.Update');
Route::resource('/purchase-order', PurchaseOrderController::class, ['names' => 'po']);
Route::resource('/grn', GRNController::class);
Route::resource('/purchaserequest', PurchaseRequestController::class);
Route::get('/purchaserequest/{id}', [PurchaseRequestController::class, 'show'])->name('purchaseRequest.show');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/logistic-detail', [LogisticController::class, 'viewLogisticDetail'])->name('logistic.detail');
Route::put('/logistic/{logistic}', [LogisticController::class, 'update'])->name('logistic.update');


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


Route::get('/store/dashboard', [StoreUserController::class, 'dashboard'])->name('store_dashboard');


