@extends('layouts.app')

@section('content')

    <a href="/albums"><h3>Back to Albums</h3></a>
    <h1>{{$album->title}}</h1>
    <img src={{$album->coverartURL}} height="300px">
    <h3>CREATED: {{$album->created_at}}</h3>
    {{-- will need to think out the price setting, 
    this currently uses function in model to display price --}}
    <h3> PRICE : {{$album->asDollars()}}</h3>
    <audio controls>
    <source src="{{$album->previewURL}}" type="audio/ogg">    
    </audio>
    <p>DESCRIPTION: {{$album->blurb}}</p>


    <form action="{{route('cart.store')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$album->catalogID}}">
        <input type="hidden" name="name" value="{{$album->title}}">
        <input type="hidden" name="price" value="{{$album->price}}">
        <button type="submit" class="btn btn-primary hover:bg-purple-500 border-orange-500 border-8">Add to Cart</button>
    </form>


@endsection