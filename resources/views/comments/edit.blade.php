@extends('layouts.app')

@section('content')
<div class="edit-comment">
    <h1 class="mb-3">Bewerk comment</h1>
    {!! Form::open(['action' => ['CommentsController@update', $task->id, $comment->id], 'method' => 'POST']) !!}

<div class="form-group">	
{{Form::text('body', $comment->body,['class' => 'form-control', 'maxlength' => '30'])}}
</div>

{{Form::hidden('_method','PUT')}}
{{Form::submit('Submit', ['class' => 'btn btn-outline-light mb-5 mt-1'])}}

{!! Form::close() !!}
</div>
@endsection
