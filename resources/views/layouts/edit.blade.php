@extends ('layouts.app')

@section ('content')
<div class="edit-task-form">
    <h1>Edit the to-do</h1>
    {!! Form::open(['action' => ['TasksController@update', $task->id], 'method' => 'POST']) !!}

    <div class="form-group">	
    {{Form::label('title', 'Title')}}
    {{Form::text('title', $task->title,['class' => 'form-control', 'placeholder' => 'Title', 'maxlength' => '20'])}}
    </div>

    <div class="form-group">	
    {{Form::label('description', 'Description')}}
    {{Form::textarea('description', $task->description,['class' => 'form-control', 'placeholder' => 'Describe the task', 'rows' => '2', 'maxlength' => '60'])}}
    </div>

    <div class="form-group">
    {{Form::label('date', 'Datum en tijd')}}
        <div class="form-inline">
            {{Form::date('end_date', $task->end_date->format('Y-m-d'),['class' => 'form-control mb-2 mr-sm-2 mb-sm-0'])}}
            {{Form::time('time', $task->end_date->timezone('Europe/Brussels')->format('H:i'),['class' => 'form-control'])}}
        </div>
    </div>
    
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-outline-light mb-5 mt-3'])}}

    {!! Form::close() !!}
</div>   
@endsection