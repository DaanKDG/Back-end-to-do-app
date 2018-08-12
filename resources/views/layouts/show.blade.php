@extends('layouts.app')

@section ('content')
    <h1> {{$task -> title}}</h1>
    <p>{{$task -> description}}</p>
    <strong>Comments:</strong>
          @foreach($task->comments as $comment)
                <p>{{$comment->body}} <small> <em>{{$comment-> created_at -> diffForHumans()}}</em></small> </p>
             
          @endforeach

@endsection