<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\CartModel;
use Illuminate\Http\Request;
use \App\Http\Requests; 
use \App\Http\Resources\Cart as CartResource;
//session facade
use \Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('shop.cart');
    }

    /**
     * Show the form for creating a new resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //GETCART API
    public function getCart(){
        $cart = Cart::content();
        return CartResource::collection($cart);
    }
    public function getSession(){
        $cart = Cart::content();
        Session::put('subtotal',asDollars(Cart::subtotal()));
        Session::put('tax',asDollars(Cart::tax()));
        Session::put('total',asDollars(Cart::total()));
        Session::put('myCart', CartResource::collection($cart));
        $session = Session::all();
        return $session;
    }

    public function getTotals(){
        // $session = Session::store()->all();

        $session = Session::all();
        return $session;
    }

    public function addToCart(Request $request){
        $duplicates = Cart::search(function($cartItem, $rowId) use($request){
            return $cartItem->id ===$request->id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('/vcart')->with('success_message','Item already in cart');
        }
        //pass data into the cart
        //id, name, price, quantity, attributes?
        //associates with the Album model
        //3rd parameter is the quantity
        Cart::add($request->id,$request->name, 1, $request->price)
            ->associate('App\Album');

        return response()->json([
            'success_message' => 'Item added to cart!',
            'cart' => Cart::content(),     
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //make sure item is not duplicate:
        $duplicates = Cart::search(function($cartItem, $rowId) use($request){
            return $cartItem->id ===$request->id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message','Item already in cart');
        }
        //pass data into the cart
        //id, name, price, quantity, attributes?
        //associates with the Album model
        //3rd parameter is the quantity
        Cart::add($request->id,$request->name, 1, $request->price)
            ->associate('App\Album');

        return redirect()->route('cart.index')->with('success_message', 'good job! item added');
    }

    //empties the cart and responds with new cart
    public function emptyCart()
    {
        Cart::destroy();
        $cart = Cart::content();
        return CartResource::collection($cart);
    }

    public function removeItem(Request $request)
    {
        Cart::remove($request->rowId);
        $cart = Cart::content();
        return CartResource::collection($cart);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Cart::remove($id);
        return back()->with('success_message', 'item removed'); 
    }
}
