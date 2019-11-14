@extends('layouts.app')



@section('content')

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

    <h3>Congrats on your purchase!</h3>
    <h3>Your Download Files:</h3>
        <div class="confirmDownloads">
            @foreach((session()->get('albums')) as $album)
                <a href="{{$album->fullpurchaseURL}}"><h2>{{$album->title}}</h2></a>
            @endforeach
        </div>
    <h3>These files have also been sent to your email</h3>

@endsection