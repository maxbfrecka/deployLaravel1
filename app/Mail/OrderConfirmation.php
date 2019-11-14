<?php

namespace App\Mail;

use \App\Album;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */

     //pass in the albums and set the public variable above to that
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //can add ->from()
        //_plain makes it plaintext
        return $this
                ->view('emails.orderconfirmation')
                ->with([
                    'cartstuff',Cart::content()
                ]);;
    }
}
