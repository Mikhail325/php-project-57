@extends('layouts.main')

@section('content')
<main class="container">
    <div class="bg-light p-5 rounded">
        <div class="modal-header border-bottom-0">
            <h1>{{$task->name}}</h5>
            <a type="button" href="{{route('task.index', $task)}}" class="btn-close" aria-label="Close"></a>
        </div>
        
        <p class="lead">{{$task->description}}</p>
    </div>
</main>
@endsection
