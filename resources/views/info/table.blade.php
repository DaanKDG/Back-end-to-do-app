<table class="table table-bordered table-dark">
    <thead>
         <tr>
            <th scope="col">Titel</th>
            <th scope="col">Omschrijving</th>
            <th scope="col">Aangemaakt</th>
            <th scope="col">Laatst bijgewerkt</th>
            <th scope="col">Deadline</th>
         </tr>
    </thead>
     <tbody>
            <tr>
                <td>{{$task->title}}</td>
                <td>{{$task->description}}</td>
                <td>{{$task->created_at->timezone('Europe/Brussels')->formatLocalized('%A %d %b %Y')}} om <strong style='color:rgb(255,82,82);'>{{$task->created_at->timezone('Europe/Brussels')->format('H:i')}}</td>
                <td>{{$task->updated_at->timezone('Europe/Brussels')->formatLocalized('%A %d %b %Y')}} om <strong style='color:rgb(255,82,82);'>{{$task->updated_at->timezone('Europe/Brussels')->format('H:i')}}</td>
                <td>{{$task->end_date->timezone('Europe/Brussels')->formatLocalized('%A %d %b %Y')}} om <strong style='color:rgb(255,82,82);'>{{$task->end_date->timezone('Europe/Brussels')->format('H:i')}}</strong> </td>
             </tr>
   
     </tbody>
</table>

<table class="table table-bordered table-dark">
    <thead>
          <tr>
             <th scope="col">Comments</th>
          </tr>
     </thead>
      <tbody>
        @foreach($task->comments as $comment)
             <tr>
                <td>{{$comment->body}} <small style="color:rgb(255,82,82);" class="float-right"> {{$comment->created_at->diffForHumans()}} </small>
                @if($task->completed == 0) 
                    <a  class=''href="{{ route("comments.edit", ["task" => $task->id, "comment" => $comment->id]) }}"> 
                    <i class="fas fa-pencil-alt edit-icon ml-2"></i> </a>
                    {!! Form::open(['action' => ['CommentsController@destroy', $task->id, $comment->id],'method' => 'POST', 'class' => 'inline']) !!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::button('<i class="far fa-trash-alt ml-1 edit-icon"></i>', ['type' =>'submit', 'class' => 'submit-btn pointer'])}}   
                    {!! Form::close() !!} 
                @endif   
                 </td>
            </tr>
         @endforeach
     </tbody>
</table>