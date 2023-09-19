@extends('layouts.main')

@section('content')
<div class="my-12">
    <div class="row bg-light p-2 rounded position-relative">
        <div>
            <div class="row d-flex justify-content-between">
                <div class="col-5 p-0">
                    <h1>{{$task->name}}</h1>
                </div>
                <div class="col-2 d-flex align-self-center justify-content-center">
                    <x-task-status status="{{$task->status->name}}"/>
                </div>
                <div class="col-3 d-flex align-top text-end flex-row-reverse pe-0">
                    <div>
                        @can('create', App\Models\Task::class)
                        <a class="text-secondary me-1" href="{{route('task.edit', $task)}}"><i class="bi bi-pencil hover:text-black"></i></a>
                        @endcan
                        <a class="text-secondary" href="{{route('task.index', $task)}}"><i class="bi bi-x-lg hover:text-black"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-danger border-1 border-top border-secondary m-1" />
            <div class="row">
                <div class="col-9 p-2 ps-4 border-end overflow-auto">
                    <p class="lead m-0">{{$task->description}}</p>
                </div>
                <div class="col-3 overflow-auto" style="height: 200px;">
                    <ul class="list-group list-group-flush">
                        @foreach($task->labels as $label)
                            <li class="list-group-item bg-light"><i class="bi bi-tag"></i> {{$label->name}}</li>
                        @endforeach
                      </ul>
                </div>
            </div>
            <hr class="bg-danger border-1 border-top border-secondary m-1"/>
            <div class="row">
                <div class="col-8 p-0">
                    <p class="m-0">Автор: {{$task->userAuthor->name}}</p>
                    <p class="m-0">Исполнитель: {{$task->userExecutor->name}}</p>
                  </div>
            </div>
            <p class="text-secondary position-absolute bottom-0 end-0 p-2 m-0">{{$task->created_at}}</p>
        </div>
    </div>
</div>
@endsection
