@extends('layouts.app')

@section('extra-css')
{{-- stripe js --}}
<script src="https://js.stripe.com/v3/"></script>
@endsection


@section('content')

<div class="container">
    <h1>Checkout</h1>

    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{session()->get('success_message')}}
        </div>
    @endif

    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="checkoutOrder">
        <h2>Your Order</h2>
        @foreach(Cart::content() as $item)
            <div class="checkoutItem">
                <img src="{{$item->model->coverartURL}}" height="50px">
                <p>{{$item->model->title}}</p>
                <p>{{asDollars($item->model->price)}}</p>
            </div>
        @endforeach
    </div>

    <div class="checkoutTotals">
        <div class="cartTotals">
            <h2>Subtotal</h2>
            {{asDollars(Cart::subtotal())}}
            <h2>Tax</h2>
            {{asDollars(Cart::tax())}}
            <h2>Total</h2>
            {{asDollars(Cart::total())}}
        </div>
    </div>

    <div class="form-group">

    <form action="{{route('checkout.store')}}" method="POST"  id="payment-form">
        {{csrf_field()}}
            <div class="form-group">
                <label>Email (We'll send your receipt here)</label>
                <input type="text" type="email" name="email" id="email" value="{{old('email')}}" required>
                <div class="form-group">
                    <label>Would you like us to email you when we release new music?</label>
                    <input type="checkbox">
                </div>
            </div>

            <div class="form-group">
                <label>Name on Card</label>
            <input type="text" name="name" id="name-on-card" value="{{old('name')}}" required>
                <label>Address Line 1</label>
                <input type="text" name="address" id="address" value="{{old('address')}}" required>
                <label>Address Line 2</label>
                <input type="text" name="address2" value="{{old('address2')}}" >
                <label>City</label>
                <input type="text" name="city" id="city" value="{{old('city')}}" required>
                <label>State</label>
                <input type="text" name="state" id="state" value="{{old('state')}}" required>
                <label>ZIP Code</label>
                <input type="text" name="zip" id="zip" value="{{old('zip')}}" required>
                <label>Country</label>
                <input type="text" name="country" value="{{old('country')}}" required>


            </div>
            
            <div class="form-group">
                <label for="card-element">Credit or debit card</label>

                <div id="card-element" style="width: 30em">
                <!-- A Stripe Element will be inserted here. -->
                </div>
            
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert" style="width: 30em"></div>
            </div>

            @foreach(Cart::content() as $item)
                <input type="hidden" name="fullpurchaseURL" value="{{$item->model->fullpurchaseURL}}">
            @endforeach

            <button class="button-primary" action="submit" id="complete-order">Submit Order</button>
        </form>
    </div>

    </div>

</div>


@endsection


{{-- THE STRIPE SCRIPT --}}
@section('extra-js')

<script>

(function(){

    //I had to do this. Not sure why it wasn't working for me otherwise.
    //We want to prevent this script from executing until the DOM is loaded
    document.addEventListener('DOMContentLoaded', init, false);
        
    function init(){
        console.log('instripe')
        // Create a Stripe client.
        var stripe = Stripe('pk_test_8Wv3HfyAzaWbe2hMDl5hU4w50037hKM5S9');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode:true,
        });
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            //to prevent user from double clicking and submitting multiple charges
            document.getElementById('complete-order').disabled=true;

        var options = {
            name: document.getElementById('name-on-card').value,
            address_line1: document.getElementById('address').value,
            address_city: document.getElementById('city').value,
            address_state: document.getElementById('state').value,
            address_zip: document.getElementById('zip').value

        }

        stripe.createToken(card, options).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            document.getElementById('complete-order').disabled=false;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();




        }
    }
})();
</script>
@endsection