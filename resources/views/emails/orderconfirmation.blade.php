<!DOCTYPE html>

<body>

<p>Hey!</p>

<h3>CONGRATULATIONS KING/QUEEN!</h3>
<h1>Here are your files:</h1>

{{-- @foreach((session()->get('albums')) as $album)
    <a href="{{$album->fullpurchaseURL}}"><h2>{{$album->title}}</h2></a>
@endforeach --}}

@foreach(Cart::content() as $item)
    <div class="checkoutItem">
        <img src="{{$item->model->coverartURL}}" height="30px">
        <a href="{{$item->model->fullpurchaseURL}}"><h2>{{$item->model->title}}</h2></a>
    </div>
@endforeach

</body>

</html>