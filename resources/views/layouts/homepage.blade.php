@extends ('layouts.app')

@section ('content')

<div class="main">
@guest
<h1>Maak je eigen to-do lijstje</h1>
<h4>Log in of registreer om van start te gaan </h4>
<a class="started border border-red" href="#news">Start</a>
@else 
<h1> Maak een nieuwe to-do aan! </h1>
<a href="{{route("tasks.create")}}"><i class="fas fa-plus-circle icon-size"></i></a>
@endguest
</div>

@endsection