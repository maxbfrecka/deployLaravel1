<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use App\CartModel;
use Illuminate\Http\Request;
use \App\Http\Requests; 
use \App\Http\Resources\Cart as CartResource;

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


//SPA views. For now this works.
Route::get('/{any}', 'SPAController@index')->where('any', '.*');
// Route::get('/', 'SPAController@index');
// Route::get('/albums', 'SPAController@index');
// Route::get("/albums/{album}", 'SPAController@index');


// Route::get('/', function () {
//     return view('layouts.app',
//         [
//             'cart' => Cart::content()
//         ]
//     );
// });

// Route::get('/vcart', function () {
//     return view('layouts.app',
//         [
//             'cart' => Cart::content()
//         ]
//     );
// });


//cart view
Route::get("/cart", 'CartController@index')->name('cart.index');
//cart API for posting
Route::post("/cart", 'CartController@store');
//cart API for removing item
Route::post("empty", 'CartController@removeItem')->name('cart.removeItem');
//seeing if this route is faster
Route::delete("/cart/{album}", 'CartController@destroy')->name('cart.destroy');

//checkouts route
Route::get("/checkout","CheckoutController@index")->name('checkout.index');
//post to checkouts
Route::post("/checkout","CheckoutController@store")->name('checkout.store'); 
//empty cart route
Route::get('empty', "CartController@emptyCart")->name('cart.empty');


//confirmation route of purchase
Route::get('/success', 'ConfirmationController@index')->name('confirmation.index');
//
Route::post('/success', 'ConfirmationController@store')->name('confirmation.store');

//email route
Route::get('sendemail/{id}','EmailController@sendEmail')->name('email.sendEmail');



//axios/AJAX test request fun
Route::post('/axios/{id}','CartController@update')->name('cart.update');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
