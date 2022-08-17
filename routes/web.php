<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Admin\ViewCommentController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;

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

Route::get('/','App\Http\Controllers\Frontend\FrontendController@index');
Route::get('product/{slug}',[FrontendController::class,'viewProduct']);
Route::get('category/{slug}',[FrontendController::class,'viewCategory']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('view-this-order/{id}', [App\Http\Controllers\HomeController::class, 'viewThisOrder']); //->name('home')
Route::get('delete-order/{id}',[App\Http\Controllers\HomeController::class, 'deleteorder']);
Route::get('redeem/{id}',[App\Http\Controllers\HomeController::class, 'redeem']);
Route::get('product_list',[FrontendController::class, 'productList']);
Route::post('searchproduct',[FrontendController::class, 'searchProduct']);

Route::middleware(['auth'])->group(function(){
    Route::get('cart',[CartController::class,'viewCart']);
    Route::get('checkout',[CheckoutController::class,'index']);
    Route::post('place-order',[CheckoutController::class, 'placeOrder']);
    Route::get('wishlist',[WishlistController::class,'index']);
    Route::get('complete-payment',[PaymentController::class, 'index']);
    
});
Route::post('delete-item',[CartController::class,'deleteitem']);
Route::post('add-to-cart',[CartController::class,'addProduct']);
Route::post('add-to-wishlist',[WishlistController::class,'add']);
Route::post('update-cart',[CartController::class,'updateProduct']);
Route::post('update-wish',[WishlistController::class,'updateProduct']);
Route::post('delete-wishlist-item',[WishlistController::class,'deleteitem']);
Route::post('place-comment',[CommentController::class, 'makeComment']);

Route::group(['middleware'=>['auth','checkAdmin']],function (){
   Route::get('/dashboard','App\Http\Controllers\Admin\DashboardController@index');
   Route::get('categories','App\Http\Controllers\Admin\CategoryController@index');
   Route::get('add-category','App\Http\Controllers\Admin\CategoryController@add');
   Route::post('insert-category','App\Http\Controllers\Admin\CategoryController@insert');
   Route::get('edit-prod/{id}','App\Http\Controllers\Admin\CategoryController@edit');
   Route::put('update-category/{id}','App\Http\Controllers\Admin\CategoryController@update');
   Route::get('delete-category/{id}','App\Http\Controllers\Admin\CategoryController@delete');
   Route::get('products','App\Http\Controllers\Admin\ProductController@index');
   Route::get('add-products','App\Http\Controllers\Admin\ProductController@add');
   Route::post('insert-product','App\Http\Controllers\Admin\ProductController@insert');
   Route::get('edit-e-prod/{id}','App\Http\Controllers\Admin\ProductController@edit');
   Route::put('update-product/{id}','App\Http\Controllers\Admin\ProductController@update');
   Route::get('delete-product/{id}','App\Http\Controllers\Admin\ProductController@delete');
   Route::get('view-order' , 'App\Http\Controllers\Admin\OrderController@index');
   Route::get('delivery-panel','App\Http\Controllers\Admin\DeliveryController@index');
   Route::post('update-delivery','App\Http\Controllers\Admin\DeliveryController@update');
   Route::get('view-coupons',[CouponController::class,'index']);
   Route::get('add-coupons',[CouponController::class,'add']);
   Route::post('insert-coupon',[CouponController::class,'insert']);
   Route::get('delete-coupon/{id}',[CouponController::class,'delete']);
   Route::get('view-users',[UserController::class,'index']);
   Route::get('view-comments',[ViewCommentController::class,'index']);
   Route::get('delete-comment/{id}',[ViewCommentController::class,'delete']);
   
});

Route::group(['middleware'=>['auth','checkDelivery']],function (){


});
