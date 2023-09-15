@extends('layouts.main')

@section('content')
  
    @foreach ($tasks as $task)
      <div>
      @switch($task->status->name)
        @case('новый')
            <div class="square shadow-sm bg-blue-600 rounded my-3">
            @break
      
        @case('в работе')
            <div class="square shadow-sm bg-pink-600 rounded my-3">
            @break

        @case('на тестировании')
            <div class="square shadow-sm bg-amber-400 rounded my-3">
            @break

        @case('завершен')
            <div class="square shadow-sm bg-green-500 rounded my-3">
            @break
      
        @default
            <div class="square shadow-sm bg-violet-600 rounded my-3">
      @endswitch
        
        <div class="square border border-light bg-slate-100 hover:bg-gray-300 rounded ms-1">
          <div class="row">

            <div class="col-5 d-flex position-relative">
              <p class="p-2 m-0 align-self-center">
                {{$task->id}}
                <a class="p-2 m-0 stretched-link link-underline link-underline-opacity-0 text-dark" href="{{route('task.show', $task)}}" rel="nofollow">{{$task->name}}</a>
              </p>
            </div>

            @switch($task->status->name)
              @case('новый')
                <div class="col-1 d-inline-flex align-self-center justify-content-center text-blue-600 border-1 border-blue-600 bg-blue-100 rounded-pill px-2">
                @break
      
              @case('в работе')
                <div class="col-1 d-inline-flex align-self-center justify-content-center text-pink-600 border-1 border-pink-600 bg-pink-100 rounded-pill px-2">
                @break

              @case('на тестировании')
                <div class="col-1 d-inline-flex align-self-center justify-content-center text-amber-600 border-1 border-amber-600 bg-amber-100 rounded-pill px-2">
                @break

              @case('завершен')
                <div class="col-1 d-inline-flex align-self-center justify-content-center text-green-600 border-1 border-green-600 bg-green-100 rounded-pill px-2">
                @break
      
              @default
                <div class="col-1 d-inline-flex align-self-center justify-content-center text-violet-600 border-1 border-violet-600 bg-violet-100 rounded-pill px-2">
            @endswitch
              <p class="m-0 text-center lh-1">{{$task->status->name}}</p>
            </div>

            <div class="col-3">
              <p class="p-2 m-0 pb-0">Автор: {{$task->userAuthor->name}}</p>
              <p class="p-2 m-0 pt-0">Исполнитель: {{$task->userExecutor->name}}</p>
            </div>

            <div class="col-3 d-flex align-items-end flex-column-reverse">
              <div class="p-2 pt-0 m-0">
                <p class="m-0 text-secondary">{{$task->created_at}}</p>
              </div>
            @can('create', App\Models\Task::class)
              <div class="p-2 pb-0 top-0 end-0">
                <a class="text-secondary p-0.5" href="{{route('task.create', $task)}}"><i class="bi bi-pencil hover:text-black"></i></a>
                <a class="text-secondary p-0.5" href="{{route('task.create', $task)}}"><i class="bi bi-trash hover:text-black"></i></a>
              </div>
            @endcan
            </div>
          </div>
        </div>
        
        </div>
      </div>
      @endforeach
  
  {{ $tasks->links() }}
</div>
@endsection

@section('title')
<div class="row">
  <div class="col-10">
    <h1 class="mt-5 mb-5">Задачи</h1>
  </div>
  <div class="col-2 d-flex align-self-center justify-content-end">
    @can('create', App\Models\Task::class)
      <a class="btn btn-primary" href="{{route('task.create')}}">Создать</a>
    @endcan
  </div>
</div>
@endsection

@section('filter')
<div class="my-3"> 
  {{ Form::open(['class' => 'form', 'route' => 'task.index', 'method' => 'get'])}}
  <div class="row  "> 
      <div class="col-2">{{ Form::select('filter[status_id]', $statuses->pluck('name', 'id'), null, ['placeholder' => 'Статус', 'class' => 'form-control']) }}</div>
      <div class="col-4">{{ Form::select('filter[user_author_id]', $users->pluck('name', 'id'), null, ['placeholder' => 'Автор', 'class' => 'form-control']) }}</div>
      <div class="col-4">{{ Form::select('filter[user_executor_id]', $users->pluck('name', 'id'), null, ['placeholder' => 'Исполнитель', 'class' => 'form-control']) }}</div>
      <div class="col-2 d-flex justify-content-end">{{ Form::submit('Фильтровать', ['class' => 'btn btn-primary']) }}</div>
  </div>
  {{ Form::close() }}
</div>
@endsection