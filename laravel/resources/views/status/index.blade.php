@extends('layouts.main')

@section('content')
<div class="container">
  @include('flash::message')
</div>
<div>
  <h1 class="mt-5 mb-5">Статусы</h1>
  @if (Route::has('login'))
    @auth
      <a href="{{route('status.create')}}">Создать</a>
    @endif
  @endif
</div>
<div>
  <table class="table table-success table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Имя</th>
        <th scope="col">Дата создания</th>
        @if (Route::has('login'))
          @auth
            <th scope="col">Действия</th>
          @endif
        @endif
      </tr>
    </thead>
    <tbody>
        @foreach ($statuses as $status)
            <tr>
                <th scope="row">{{$status->id}}</th>
                <td>{{$status->name}}</td>
                <td>{{$status->created_at}}</td>
                @if (Route::has('login'))
                  @auth
                    <td>
                      <a href="{{route('status.destroy', $status)}}" data-method="delete" rel="nofollow">Удалить</a>
                      <a href="{{route('status.edit', $status)}}" rel="nofollow">Изменинить</a>
                    </td>
                  @endif
                @endif
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('title')
<div class="row">
  <div class="col-10">
    <h1 class="mt-5 mb-5">Статусы</h1>
  </div>
  <div class="col-2 d-flex align-self-center justify-content-end">
    @can('create', App\Models\Task::class)
      <a class="btn btn-primary" href="{{route('status.create')}}">Создать</a>
    @endcan
  </div>
</div>
@endsection

@foreach ($statuses as $status)
        <div class="square border border-light bg-slate-100 hover:bg-gray-300 rounded ms-1 position-relative">
          <div class="row ">
            <div class="col-10 position-relative">
              <div class="row">

                <div class="col-5 d-flex">
                  <p class="p-2 m-0 align-self-center">
                    {{$status->id}}
                    {{$status->name}}
                  </p>
                </div>

                <div class="col-2 d-inline-flex align-self-center justify-content-center">
                  <x-task-status status="{{$task->status->name}}"/>
                </div>

                <div class="col-5">
                  <p class="p-2 m-0 pb-0">Автор: {{$task->userAuthor->name}}</p>
                  <p class="p-2 m-0 pt-0">Исполнитель: {{$task->userExecutor->name}}</p>
                </div>
              </div>
            </div>
            <div class="col-2">
              <div class="col-12 d-flex align-items-end flex-column-reverse">
                @can('create', App\Models\Task::class)
                  <div class="p-2 pb-0 top-0 end-0 text-secondary p-0.5">
                    <a class="text-secondary p-0.5" href="{{route('task.edit', $task)}}"><i class="bi bi-pencil hover:text-black"></i></a>
                    <a class="text-secondary p-0.5" href="#" data-bs-toggle="modal" data-bs-target="#taskDeleteModal{{$task->id}}">
                      <i class="bi bi-trash hover:text-black"></i>
                    </a>
                  </div>
                @endcan
              </div>
            </div>
          </div>
            <p class="m-0 px-2 pb-2 text-secondary position-absolute bottom-0 end-0">{{$task->created_at}}</p>
        </div>
      </div>
      
    </div>
  @endforeach
  {{ $tasks->links() }}