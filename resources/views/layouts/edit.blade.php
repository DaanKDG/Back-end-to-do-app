@extends ('layouts.app')

@section ('content')
    <h1>Edit the to-do</h1>
    {!! Form::open(['action' => ['TasksController@update', $task->id], 'method' => 'POST']) !!}

    <div class="form-group">	
    {{Form::label('title', 'Title')}}
    {{Form::text('title', $task->title,['class' => 'form-control', 'placeholder' => 'Title'])}}

    </div>
    <div class="form-group">	
    {{Form::label('description', 'Description')}}
    {{Form::textarea('description', $task->description,['class' => 'form-control', 'placeholder' => 'Describe the task'])}}

    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-outline-light'])}}

    {!! Form::close() !!}  
@endsection