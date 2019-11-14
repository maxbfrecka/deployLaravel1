@extends('layouts.app')

@section('content')


<a href="/albums">Back to Music</a>
<h1>Cart</h1>

<div class="cart-section container">
    <div>
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

        {{-- cart count determiner --}}
        @if(Cart::count() >0 )
        <h2>{{Cart::count()}} item(s) in your cart</h2>
        @endif
        @if(Cart::count()==0)
        <h3>No items in cart</h3>
        @endif

        <div class="cart-table">
            @foreach(Cart::content() as $item)
            <div class="cart-table-row">
            <a class="cart-item" href="albums/{{$item->model->catalogID}}">
                <img src="{{$item->model->coverartURL}}" height="100px">
                <h3 class="cartItemTitle">{{$item->model->title}}</h3>
                <span>{{$item->model->asDollars()}}</span>
            
            </a>
            <form action="{{route('cart.removeItem')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="rowId" value="{{$item->rowId}}">
                <button action="submit">Remove Item</button>
            </form>

            </div>


            @endforeach
        </div>

        <div class="cartTotals">
            <h2>Subtotal</h2>
            {{asDollars(Cart::subtotal())}}
            <h2>Tax</h2>
            {{asDollars(Cart::tax())}}
        <h2 id="totalId" data-id="{{asDollars(Cart::total())}}">Total</h2>
            {{asDollars(Cart::total())}}
        </div>

        @if(Cart::count() >0 )
            <a class="btn btn-block bg-orange btn-primary" href="{{route('checkout.index')}}">Proceed to Checkout</a>
        @endif

        {{-- remove this in prod --}}
        @if(Cart::count() >0 )
        <a class="btn btn-block bg-orange btn-primary" href="{{route('cart.empty')}}">Empty the Cart</a>
        @endif
    </div>
</div>

@endsection

@section('extra-js')

{{-- this links axios --}}
<script src="{{asset('js/app.js')}}"></script>

<script>
    (function(){
        //We want to prevent this script from executing until the DOM is loaded
        document.addEventListener('DOMContentLoaded', init, false);
            
        function init(){
            console.log('cart-js');

            //by observing this closely, you can see how to pass
            //data between the back end and the front end
            //axios is installed inside this Laravel project and imported in the above script
            //the route in web.php is a post route that takes an /axios/{id}
            //it refers to the resource CartController update which takes
            //$Request and $id
            //the $id is the axios/$id
            //below we see you can use ES6 using the `` symbol instead of the ''
            //we grab the data using basic javascript in const idA. this is easy to grasp
            //we then pass it from this HTML/JS script into an axios post-AJAX request
            //it then goes to the backend route in the PHP where it hits the controller
            //the controller then responds to the AJAX request
            //axios receives the RESPONSE object
            //axios can do whatever it wants with the RESPONSE, in this case
            //it prints to the console.
            //I can also modify the php backend
            const idA = document.getElementById('totalId').getAttribute('data-id') 

            axios.post(`/axios/${idA}`, {
                id: '1234567',
                id2: 'blahblahblah',
                idA: idA,
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });


        }
    })();
</script>

@endsection