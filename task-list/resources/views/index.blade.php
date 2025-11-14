@extends('layouts.app')

@section('title', 'The list of tasks')
<h1>

</h1>

@section('content')
<div> 
  {{--  @if(count($tasks)) --}}
   @forelse ($tasks as $task)
   <div>
      <a href="{{ route('tasks.show',['task'=>$task->id]) }}">{{$task->title}}</a>
   </div>
   @empty
   <div> There  are no tasks!</div>    
   @endforelse
   @if($tasks ->count())
   <nav>
      {{ $tasks->links() }}
   </nav>
   @endif
</div>
@endsection