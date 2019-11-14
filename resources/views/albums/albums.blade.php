@extends('layouts.app')

@section('content')
{{-- checks if there are albums 
    displays data from the controller--}}
@if(count($albums)>0)
    @foreach($albums as $album)
        <div class="well">
            {{-- "albums/{{$album->catalogID}}" also works for the links --}}
        <a href="{{route('album.show', $album->catalogID)}}">
            <h2>{{$album->title}}</h2>
            <img src={{$album->coverartURL}} height="300px">
            <h3>CREATED: {{$album->created_at}}</h3>
            {{-- will need to think out the price setting, 
                this currently uses function in model to display price --}}
            <h3> PRICE : {{$album->asDollars()}}</h3>
            <audio controls>
                <source src="{{$album->previewURL}}" type="audio/ogg">    
            </audio>
            <p>DESCRIPTION: {{$album->blurb}}</p>
        </a>
        <form action="/cart" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$album->catalogID}}">
            <input type="hidden" name="name" value="{{$album->title}}">
            <input type="hidden" name="price" value="{{$album->price}}">
            <button type="submit" class="button button-plain">Add to Cart</button>
        </form>
        </div>
    @endforeach
@else
    <p>NO ALBUMS FOUND</p>
@endif


@endsection