@extends ('layouts.app')

@section ('content')

<div class="create-btn">     
   <a href="{{route("tasks.create")}}"><i class="fas fa-plus-circle icon-size"></i></a>
</div>
<div class="card-section clearfix">
        @foreach($user->tasks as $task)
                <div class="card mr-3 mb-4 float-left task-style {{ ($dateToday->gt($task->end_date)) ? 'border-red' : '' }}">
                        <div class="top-right-icons">
                                {!! Form::open(['action' => ['TasksController@destroy', $task->id],'method' => 'POST', 'class'=> 'float-right']) !!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::button('<i class="far fa-trash-alt icon-size"></i>', ['type' =>'submit', 'class' => 'submit-btn pointer'])}}
                                {!! Form::close() !!} 

                           @if($task->completed == 0)

                                <a href="{{ route("tasks.edit", ["id" => $task->id]) }}" class="float-right"><i class="far fa-edit icon-size mr-1 "></i></a>
                                {!! Form::open(['action' => ['TasksController@update', $task->id],'method' => 'POST', 'class'=> 'float-right']) !!}
                                        {{Form::hidden('_method','PUT')}}
                                        {{Form::button('<i class="far fa-calendar-check icon-size mr-2"></i>', ['type' =>'submit', 'class' => 'submit-btn pointer'])}}
                                {!! Form::close() !!} 
                           @endif
            
                        </div>
                            <div class="card-body">
                                 <div class="card-header-height pt-1">
                                     <h5 class="card-title"><a href="{{ route("tasks.show", ["id" => $task->id]) }}"> <strong>{{$task->title}} </strong></a> </h5>
                                     <h6 class="card-subtitle mb-2 text-muted"><small><p> {{$task->end_date->timezone('Europe/Brussels')->formatLocalized('%A %d %b %Y')}} om <strong style='color:red;'>{{$task->end_date->timezone('Europe/Brussels')->format('H:i')}}</strong> </p></small></h6>
                                 </div>
                                 <hr>
                                 <p class="card-text">{{$task->description}}</p>
                                 <hr>
                                 <a href="#" type="" class="" data-toggle="popover" data-trigger="hover" title="comments" data-html="true"
                                    data-content=" @php foreach($task->comments as $comment)
                                                        { 
                                                        echo '<p>' . $comment->body . '</p> <hr>'; 
                                                        } 
                                                   @endphp"><i class="far fa-clipboard icon-size mr-1"></i></a>
                                        @if($task->completed == 0) 

                                        <a href="#demo{{$task->id}}" class="" data-toggle="collapse"><i class="fas fa-plus-circle icon-size"></i></a>
                                        <div id="demo{{$task->id}}" class="collapse">
                                                {!! Form::open(['action' => ['CommentsController@store', $task->id],'method' => 'POST', 'class'=> 'form-group row']) !!}
                                                        <div class="form-group row">
                                                                <div class="col-9">
                                                                        {{Form::text('body', '', ['class' => 'form-control form-control-sm ml-3 mt-2', 'placeholder' => 'Comment' , 'maxlength' => '30'])}}
                                                                </div>
                                                        {{Form::button('<i class="far fa-check-circle icon-size mt-2"></i>', ['type' =>'submit', 'class' => 'submit-btn pointer ml-2'])}}
                                                        </div>
                                                {!! Form::close() !!} 
                                        </div>
                                        @endif
                           </div>
                </div>

        @endforeach 
</div>

 <script>
    $(document).ready(function(){
            $('[data-toggle="popover"]').popover();   
    });
</script>
@endsection