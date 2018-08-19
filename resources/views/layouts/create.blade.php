@extends ('layouts.app')

@section ('content')
<div class="create-task-form">
    <h1>Maak een nieuw to-do aan</h1>
    {!! Form::open(['action' => 'TasksController@store', 'method' => 'POST']) !!}
    <div class="form-group">	
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '',['class' => 'form-control', 'placeholder' => 'Title', 'maxlength' => '20'])}}
    </div>

    <div class="form-group">	
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', '',['class' => 'form-control', 'placeholder' => 'Describe the task', 'rows' => '2 ', 'maxlength' => '60'])}}
    </div>

    <div class="form-group">
         {{Form::label('date', 'Datum en tijd')}}
         <div class="form-inline">
            {{Form::date('end_date', \Carbon\Carbon::now()->timezone('Europe/Brussels'),['class' => 'form-control mb-2 mr-sm-2 mb-sm-0'])}}
            {{Form::time('time', \Carbon\Carbon::now()->timezone('Europe/Brussels')->format('H:i'),['class' => 'form-control'])}}
         </div>
    </div>

    {{Form::submit('Submit', ['class' => 'btn btn-outline-light mb-5 mt-1'])}}
    {!! Form::close() !!}   
</div>    
@endsection