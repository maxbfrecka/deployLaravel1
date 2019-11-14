<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//list albums
Route::get('albums','AlbumController@getAlbums');
//get single album by id
Route::get('albumid/{id}','AlbumController@getAlbumId');
//get single album by catalogid
Route::get('albumcatalogid/{catalogID}','AlbumController@getAlbumCatalogId');


//CART API
Route::get("cart", 'CartController@getCart');
Route::post("cart", 'CartController@addToCart');
Route::get('emptycart', "CartController@emptyCart")->name('cart.empty');
Route::post("removeitem", 'CartController@removeItem')->name('cart.removeItem');
//session fun
Route::get("session", "CartController@getSession");
//CHECKOUT!!!
Route::post("checkout","CheckoutController@checkoutVue")->name('checkoutVue'); 

// //cart API for posting
// Route::post("/cart", 'CartController@store')->name('cart.store');
// //cart API for removing item
// Route::post("empty", 'CartController@removeItem')->name('cart.removeItem');
// //seeing if this route is faster
// Route::delete("/cart/{album}", 'CartController@destroy')->name('cart.destroy');

// //checkouts route
// Route::get("/checkout","CheckoutController@index")->name('checkout.index');
// //post to checkouts
// Route::post("/checkout","CheckoutController@store")->name('checkout.store'); 
// //empty cart route
// Route::get('empty',function(){
//     Cart::destroy();
// });