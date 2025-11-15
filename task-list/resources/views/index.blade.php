@extends('layouts.app')

@section('title', 'The list of tasks')
<h1>

</h1>

@section('content')
<nav class="mb-4">
   <a href = "{{ route('tasks.create') }}" class="link"><h2> Add Task</h2></a>
</nav>
<div> 
  {{--  @if(count($tasks)) --}}
   @forelse ($tasks as $task)
   <div>
      <a href="{{ route('tasks.show',['task'=>$task->id]) }}"
         @class(['line-through' => $task->completed]) >{{$task->title}}</a>
   </div>
   @empty
   <div> There  are no tasks!</div>    
   @endforelse
   @if($tasks ->count())
   <nav class="mt-4">
      {{ $tasks->links() }}
   </nav>
   @endif
</div>
@endsection