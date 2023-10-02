@extends('layouts.main')

@section('content')
  @foreach ($tasks as $task)
      <div>
        <x-task-status-badge status="{{$task->status->name}}"/>

        <div class="square border border-light bg-slate-100 hover:bg-gray-300 rounded ms-1 position-relative">
          <div class="row ">
            <div class="col-10 position-relative">
              <div class="row">

                <div class="col-5 d-flex">
                  <p class="p-2 m-0 align-self-center">
                    {{$task->id}}
                    <a class="p-2 m-0 stretched-link link-underline link-underline-opacity-0 text-dark" href="{{route('task.show', $task)}}">{{$task->name}}</a>
                  </p>
                </div>

                <div class="col-2 d-inline-flex align-self-center justify-content-center">
                  <x-task-status status="{{$task->status->name}}"/>
                </div>

                <div class="col-5">
                  <p class="p-2 m-0 pb-0">{{__('messages.Author')}}: {{$task->userAuthor->name}}</p>
                  <p class="p-2 m-0 pt-0">{{__('messages.Executor')}}: {{$task->userExecutor->name}}</p>
                </div>
              </div>
            </div>
            <div class="col-2">
              <div class="col-12 d-flex align-items-end flex-column-reverse">
                @can('create', App\Models\Task::class)
                  <div class="p-2 pb-0 top-0 end-0 text-secondary p-0.5">
                    <a class="text-secondary p-0.5 link-underline link-underline-opacity-0" href="{{route('task.edit', $task)}}">
                      <i class="bi bi-pencil hover:text-black"></i>
                      <p class="d-none">{{__('messages.To change')}}</p>
                    </a>
                    <a class="text-secondary p-0.5" href="#" data-bs-toggle="modal" data-bs-target="#taskDeleteModal{{$task->id}}">
                      <i class="bi bi-trash hover:text-black"></i>
                      <p class="d-none">{{__('messages.Delete')}}</p>
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
  <div class="row d-flex justify-content-between">
    <div class="col-7">
      {{ $tasks->links() }}
    </div>
    <div class="col-2 d-flex align-self-center justify-content-end">
        @can('create', App\Models\Task::class)
          <a class="btn btn-primary" style="width: 125.7px" href="{{route('task.create')}}">{{__('messages.Create')}}</a>
        @endcan
    </div>
  </div>
@endsection

@section('title')
<div class="row">
  <div class="col-10">
    <h1 class="mt-5 mb-3">{{__('messages.Task')}}</h1>
  </div>
</div>
@endsection

@section('filter')
<div class="mb-3"> 
  {{ Form::open(['class' => 'form', 'route' => 'task.index', 'method' => 'get'])}}
  <div class="row  "> 
      <div class="col-2">{{ Form::select('filter[status_id]', $statuses->pluck('name', 'id'), null, ['placeholder' => 'Статус', 'class' => 'form-control']) }}</div>
      <div class="col-4">{{ Form::select('filter[user_author_id]', $users->pluck('name', 'id'), null, ['placeholder' => 'Автор', 'class' => 'form-control']) }}</div>
      <div class="col-4">{{ Form::select('filter[user_executor_id]', $users->pluck('name', 'id'), null, ['placeholder' => 'Исполнитель', 'class' => 'form-control']) }}</div>
      <div class="col-2 d-flex justify-content-end">
        {{ Form::submit(__('messages.Filter'), ['class' => 'btn btn-primary']) }}
      </div>
  </div>
  {{ Form::close() }}
</div>
@endsection

@foreach ($tasks as $task)
<div class="modal fade" id="taskDeleteModal{{$task->id}}" tabindex="-1" role="dealog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">{{__('messages.Confirm the action on the page')}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <p>
          {{__('messages.Are you sure you want to delete the task')}}
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">{{__('messages.Cancel')}}</button>
        <a class="btn btn-primary" href="{{route('task.destroy', $task)}}" data-method="delete" rel="nofollow">{{__('messages.Delete')}}</a>
      </div>
    </div>
  </div>
</div>
@endforeach