<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyersController;
use App\Http\Controllers\VendorController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

Route::get('/register', function () {
    return Inertia::render('Register');
})->name('register');


Route::get('/dashboard', function () {
    if(Auth::check()){
        return Inertia::render('Dashboard');
    }else{
        redirect('bladelogin');
    }
})->name('dashboard');

Route::get('/product', function () {
    return Inertia::render('Product');
})->name('product');

Route::get('/orders', function () {
    return Inertia::render('Orders');
})->name('orders');

Route::get('/withdraw', function () {
    return Inertia::render('Withdraw');
})->name('withdraw');

Route::get('buyer', function (){
    return Inertia::render('buyerspage');
})->name('buyer');

Route::get('bladelogin', function (){
return view('login');
})->name('bladelogin');

Route::get('vendor', [AdminController::class, 'allvendor'])->name('vendor');

Route::get('vendregister', function () {
    return view('vendorsfolder.register');
})->name('vendregister');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {



});
//route for login and register
Route::post('registerprocess', [AuthController::class, 'register'])->name('registerprocess');
Route::post('log', [AuthController::class, 'log'])->name('log');
//route for all admin
Route::get('admindash', [AdminController::class, 'admindash'])->name('admindash');
Route::get('alladmin', [AdminController::class, 'alladmin'])->name('alladmin');
Route::post('/addvendor', [AdminController::class, 'addvendor'])->name('addvendor');
Route::delete('deleteadmin/{id}', [AdminController::class, 'delete'])->name('deleteadmin');
Route::get('adminadd', [AdminController::class, 'adminpage'])->name('adminadd');
Route::post('addadmin', [AdminController::class, 'addadmin'])->name('addadmin');
Route::get('viewvendors', [AdminController::class, 'viewvendors'])->name('viewvendors');
Route::get('allprod', [AdminController::class, 'allprod'])->name('allprod');
Route::get('allbuyer', [AdminController::class, 'allbuyer'])->name('allbuyer');
Route::any('approveprod/{id}', [AdminController::class, 'approveprod'])->name('approveprod');
Route::any('disapproveprod/{id}', [AdminController::class, 'disapproveprod'])->name('disapproveprod');
Route::get('viewproducts/{id}', [AdminController::class, 'viewproducts'])->name('viewproducts');
Route::post('updateproducts/{id}', [AdminController::class, 'updateproducts'])->name('updateproducts');
//for approve vendors and vendor register
Route::any('approve/{id}', [AdminController::class, 'approve'])->name('approve');
Route::any('disapprove/{id}', [AdminController::class, 'disapprove'])->name('disapprove');
Route::post('vendreg', [VendorController::class, 'vendreg'])->name('vendreg');
//for products
Route::get('getprod', [VendorController::class, 'getprod'])->name('getprod');
Route::post('addprod', [VendorController::class, 'addprod'])->name('addprod');
Route::get('viewprod', [VendorController::class, 'viewprod'])->name('viewprod');
Route::get('editprod/{id}', [VendorController::class, 'editprod'])->name('editprod');
Route::any('updateprod/{id}', [VendorController::class, 'updateprod'])->name('updateprod');
//all orders for a vendors product
Route::get('vendorprod', [VendorController::class,'vendorprod'])->name('vendorprod');
//for buyers
Route::get('buyerdash', [BuyersController::class, 'index'])->name('buyerdash');
Route::get('allproducts', [BuyersController::class, 'allproducts'])->name('allproducts');
Route::get('view_prod/{id}', [BuyersController::class, 'view_prod'])->name('view_prod');
//for cart
Route::get('cartlist', [BuyersController::class, 'cartlist'])->name('cartlist');
Route::post('addcart/{id}', [BuyersController::class, 'addToCart'])->name('addcart');
Route::post('update_cart', [BuyersController::class, 'updatecart'])->name('update_cart');
Route::post('delet_cart', [BuyersController::class, 'deletcart'])->name('delet_cart');
// Route::post('clear', [BuyersController::class, 'clearAllCart'])->name('cart.clear');

//for checkout
Route::get('checkout', [BuyersController::class, 'checkout'])->name('checkout');
Route::post('placeorder', [BuyersController::class, 'placeorder'])->name('placeorder');
Route::post('proceed_to_pay', [BuyersController::class, 'razorpay'])->name('proceed_to_pay');
//for orders
Route::get('my_orders', [BuyersController::class, 'myorders'])->name('my_orders');
Route::get('view_order/{id}', [BuyersController::class, 'vieworder'])->name('view_order');
//cart count
Route::get('load-cart', [BuyersController::class, 'cartcount'])->name('load-cart');
//for logistics and market survey
Route::get('getlogistics', [BuyersController::class, 'getlogistics'])->name('getlogistics');
Route::post('submitlogistics', [BuyersController::class, 'submitlogistics'])->name('submitlogistics');
Route::get('payment/{id}', [BuyersController::class, 'payment'])->name('payment');
Route::post('make_payment', [BuyersController::class, 'make_payment'])->name('make_payment');
Route::get('mysurvey', [BuyersController::class, 'mysurvey'])->name('mysurvey');
// Route::post('paywithrazor', [BuyersController::class, 'paywithrazor'])->name('paywithrazor');
//for pickup request
Route::get('getdelivery', [BuyersController::class, 'getdelivery'])->name('getdelivery');
Route::post('submitdeliveryreq', [BuyersController::class, 'submitdeliveryreq'])->name('submitdeliveryreq');
Route::get('mydeliveryreq', [BuyersController::class, 'mydeliveryreq'])->name('mydeliveryreq');
//for orders in admin dashboard
Route::get('orders', [AdminController::class, 'orders'])->name('orders');
Route::get('orderhistory', [AdminController::class, 'orderhistory'])->name('orderhistory');
Route::get('vieworder/{id}', [AdminController::class, 'vieworder'])->name('vieworder');
Route::any('update_status/{id}', [AdminController::class, 'updateorder'])->name('update_status');
//for category
Route::get('category', [AdminController::class, 'category'])->name('category');
Route::post('addcategory', [AdminController::class, 'addcategory'])->name('addcategory');
Route::get('viewcate', [AdminController::class, 'viewcate'])->name('viewcate');
//profile view for every user including admin
Route::get('profile', [AdminController::class, 'profile'])->name('profile');
Route::get('edituser/{id}', [AdminController::class, 'edituser'])->name('edituser');
Route::post('updateuser/{id}', [AdminController::class, 'updateuser'])->name('updateuser');
Route::get('changepass', [AdminController::class, 'changepass'])->name('changepass');
Route::post('updatepassword/{id}', [AdminController::class, 'updatepassword'])->name('updatepassword');
//for delivery and survey request
Route::get('viewdeliveryreq', [AdminController::class,'viewdeliveryreq'])->name('viewdeliveryreq');
Route::get('deliveryhistory', [AdminController::class,'deliveryhistory'])->name('deliveryhistory');
Route::get('viewdelivery/{id}', [AdminController::class, 'viewdelivery'])->name('viewdelivery');
Route::any('update_deliverystatus/{id}', [AdminController::class, 'update_deliverystatus'])->name('update_deliverystatus');
Route::post('senddeliveryresp', [AdminController::class, 'senddeliveryresp'])->name('senddeliveryresp');
Route::get('allsentdeliveryemail', [AdminController::class, 'allsentdeliveryemail'])->name('allsentdeliveryemail');
Route::get('viewsurveyreq', [AdminController::class,'viewsurveyreq'])->name('viewsurveyreq');
Route::get('surveyhistory', [AdminController::class,'surveyhistory'])->name('surveyhistory');
Route::get('viewsurvey/{id}', [AdminController::class,'viewsurvey'])->name('viewsurvey');
Route::any('update_surveystatus/{id}', [AdminController::class,'update_surveystatus'])->name('update_surveystatus');
Route::post('sendsurveyresp', [AdminController::class,'sendsurveyresp'])->name('sendsurveyresp');
Route::get('allsentsurveyemail', [AdminController::class, 'allsentsurveyemail'])->name('allsentsurveyemail');
//for reports generate
Route::post('generatereports', [AdminController::class, 'generatereports'])->name('generatereports');
Route::get('reports', [AdminController::class, 'reports'])->name('reports');
//for user getting email in their dashboard
Route::get('deliveryrequestemail', [BuyersController::class, 'deliveryrequestemail'])->name('deliveryrequestemail');
Route::get('viewreceivedmail/{id}', [BuyersController::class, 'viewreceivedmail'])->name('viewreceivedmail');
Route::post('payfordelivery', [BuyersController::class, 'payfordelivery'])->name('payfordelivery');





