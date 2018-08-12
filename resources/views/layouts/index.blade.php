@extends ('layouts.app')

@section ('content')
        <div class="create-btn">
            <h1></h1> <a href="{{route("tasks.create")}}"><i class="fas fa-plus-circle icon-size"></i></a>
        </div>   
            @if (count($tasks) > 0)
                    @foreach($tasks as $task)
                        <div class="tasks">
                            <a href="{{ route("tasks.show", ["id" => $task->id]) }}"><h4><strong>{{$task->title}} </strong></h4></a> 
                            <p>Description: {{$task->description}}</p>
                            <strong>Task created: {{$task -> created_at -> diffForHumans()}}</strong>
                            <hr>
                            <p>{{count($task->comments)}} comments</p>
                            <a href="{{ route("tasks.edit", ["id" => $task->id]) }}"><button class="btn btn-outline-light">Edit</button></a> 
                            {!! Form::open(['action' => ['TasksController@destroy', $task->id], 'method' => 'POST', 'class'=> 'float-right']) !!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
                            {!! Form::close() !!} 
                        </div>
                    @endforeach  
            @endif   

@endsection