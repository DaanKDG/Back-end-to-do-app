@extends ('layouts.app')

@section ('content')
    <h1>Maak een nieuw to-do aan</h1>
    {!! Form::open(['action' => 'TasksController@store', 'method' => 'POST']) !!}

        <div class="form-group">	
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '',['class' => 'form-control', 'placeholder' => 'Title'])}}
        
        </div>
        <div class="form-group">	
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', '',['class' => 'form-control', 'placeholder' => 'Describe the task'])}}
        
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-outline-light'])}}
    
    {!! Form::close() !!}   
@endsection