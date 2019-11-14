<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('shop.checkout');
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
    public function store(CheckoutRequest $request)
    {
        
        $downloads = [];
        $albums= [];

        foreach(Cart::content() as $row) {
            array_push($downloads, $row->model->fullpurchaseURL);
        }
        foreach(Cart::content() as $row) {
            array_push($albums, $row->model);
        }
        
        $contents= Cart::content()->map(function($item){
            return $item->model->catalogID.','.$item->model->title.','.$item->qty;
        })->values()->toJson();
        $downloadsMeta= Cart::content()->map(function($item){
            return $item->model->catalogID.','.$item->model->title.','.$item->fullpurchaseURL;
        })->values()->toJson();

        try{
            $charge = Stripe::charges()->create([
                //TEST AMOUNT
                'amount' => 100,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'order',
                'receipt_email' => $request->email,
                //change to Order ID once using DB
                'metadata'=>[
                    'contents' => $contents,
                    'quantity'=> 'test quantity right now',
                    'downloads'=>$downloadsMeta,
                ],
            ]);
            
            //AUTOMATED EMAIL
            // try{
            //     $testname="maximilian";
            //     $testaddress="maxbfrecka@gmail.com";
            //     $data = array('name'=>$testname, 'email'=>$testaddress);
            //     Mail::send('emails.orderconfirmation', $data, function($message) use ($data){
            //         $message->to($data['email'],$data['name'])->subject('Test Subject YO');
            //     });   
            // }catch (Exception $e){
    
            // }

            //EMAIL USING REAL SENDER
            try{
                Mail::to($request->email)->send(new OrderConfirmation());
            }catch (Exception $e){
            }

            //empty cart
            // Cart::destroy();
            
            return redirect()->route('confirmation.store')
            ->with('success_message', 'Your order has been successfully placed!')
            ->with('downloads',$downloads)
            ->with('albums',$albums);
        
        //this is for the errors
        //can pick different errors from the documentation for Stripe Laravel
        //must be used from reference file Stripe at top
        }catch(CardErrorException $e){
            //dunno this syntax 'Error!' . $e ETC
            return back()->withErrors('Error!'. $e->getMessage()); 

        }
    }



    //VUE API CALL

    public function checkoutVue(CheckoutRequest $request){
        try{
            $charge = Stripe::charges()->create([
                //TEST AMOUNT
                'amount' => 100,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'order',
                'receipt_email' => $request->email,
                //change to Order ID once using DB
                'metadata'=>[
                    'contents' => 'yeah whatever for now',
                    'quantity'=> 'test quantity right now',
                    'downloads'=> 'test data for download',
                ],
            ]);
            //EMAIL USING REAL SENDER
            // try{
            //     Mail::to($request->email)->send(new OrderConfirmation());
            // }catch (Exception $e){
            // }
            return $request->all();
        
        //this is for the errors
        //can pick different errors from the documentation for Stripe Laravel
        //must be used from reference file Stripe at top
        }catch(CardErrorException $e){
            //dunno this syntax 'Error!' . $e ETC
            return $e->getMessage(); 

        }

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
    }
}
