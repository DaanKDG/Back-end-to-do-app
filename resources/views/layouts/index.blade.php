@extends ('layouts.app')

@section ('content')

 @if (Auth::user())
    <div class="create-btn">
      <a href="{{route("tasks.create")}}"><i class="fas fa-plus-circle icon-size"></i></a>
    </div>
    @foreach($user->tasks as $task)
    <div class="card mr-4 mb-4" style="width: 20rem;">
        
        <div class="card-body">
            <h5 class="card-title"><a href="{{ route("tasks.show", ["id" => $task->id]) }}"> <strong>{{$task->title}} </strong></a> </h5>
            <h6 class="card-subtitle mb-2 text-muted"><small>{{$task -> created_at -> diffForHumans()}}</small></h6>
            <hr>
            <p class="card-text">{{$task->description}}</p>
            <button type="button" class="btn btn-outline-danger" data-toggle="popover" data-trigger="hover" title="{{count($task->comments)}} comments" data-html="true"
                    data-content=" @php foreach($task->comments as $comment)
                                        { 
                                           echo '<p>' . $comment->body . '</p> <hr>'; 
                                        } 
                                   @endphp"> comments</button>

            <a href="{{ route("tasks.edit", ["id" => $task->id]) }}" class="card-link"><button class="btn btn-outline-dark">Edit</button></a>

            {!! Form::open(['action' => ['TasksController@destroy', $task->id],'method' => 'POST', 'class'=> 'float-right']) !!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
            {!! Form::close() !!} 
        </div>
    </div>  
    @endforeach 
 @endif

 <script>
    $(document).ready(function(){
            $('[data-toggle="popover"]').popover();   
    });
</script>
@endsection