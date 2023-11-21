@extends('layouts.main')

@section('content')
  <section> 
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
                      <a class="p-2 m-0 stretched-link link-underline link-underline-opacity-0 text-dark" href="{{route('tasks.show', $task)}}">{{$task->name}}</a>
                    </p>
                  </div>

                  <div class="col-2 d-inline-flex align-self-center justify-content-center">
                    <x-task-status status="{{$task->status->name}}"/>
                  </div>

                  <div class="col-5">
                    <p class="p-2 m-0 pb-0">{{__('messages.Author')}}: {{$task->author->name}}</p>
                    <p class="p-2 m-0 pt-0">{{__('messages.Executor')}}: {{$task->assignedToUser->name}}</p>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <div class="col-12 d-flex align-items-end flex-column-reverse">
                  <div class="p-2 pb-0 top-0 end-0 text-secondary p-0.5">
                    @can('update', $task)
                      <a class="text-secondary p-0.5 link-underline link-underline-opacity-0" href="{{route('tasks.edit', $task)}}">
                        <i class="bi bi-pencil hover:text-black"></i>
                        <p class="d-none">{{__('messages.To change')}}</p>
                      </a>
                    @endcan
                    @can('delete', $task)
                      <a class="text-secondary p-0.5" href="{{route('tasks.destroy', $task)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">
                        <i class="bi bi-trash hover:text-black"></i>
                        <p class="d-none">{{__('messages.Delete')}}</p>
                      </a>
                    @endcan
                  </div>
                </div>
              </div>
            </div>
              <p class="m-0 px-2 pb-2 text-secondary position-absolute bottom-0 end-0">{{$task->formatted_date}}</p>
          </div>
        </div>
      </div>
    @endforeach
    <div class="row d-flex justify-content-between">
      <div class="col-7">
        {{ $tasks->links() }}
      </div>
      <div class="col-3 d-flex align-self-center justify-content-end">
          @can('create', App\Models\Task::class)
            <a class="btn btn-primary" href="{{route('tasks.create')}}">{{__('messages.Create task')}}</a>
          @endcan
      </div>
    </div>

    <table class="text-white">
      @foreach ($tasks as $task)
          <tr>
              <td>{{$task->id}}</td>
              <th>{{$task->name}}</th>
              <th>{{$task->status->name}}</th>
              <th>{{$task->formatted_date}}</th>
              <th>{{$task->author->name}}</th>
              <th>{{$task->assignedToUser->name}}</th>
          </tr>
      @endforeach
    </table>
  </section>  
@endsection

@section('title')
  <x-title-task-manager text="messages.Task"/>
@endsection

@section('filter')
  <div class="mb-3"> 
    {{ Form::open(['class' => 'form', 'route' => 'tasks.index', 'method' => 'get'])}}
    <div class="row">
        <div class="col-2">{{ Form::select('filter[status_id]', $statuses, $filter['status_id'] ?? null, ['placeholder' => __('messages.Status'), 'class' => 'form-control']) }}</div>
        <div class="col-4">{{ Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null, ['placeholder' => __('messages.Executor'), 'class' => 'form-control']) }}</div>
        <div class="col-2 offset-md-4 d-flex align-self-center justify-content-end">
          {{ Form::submit(__('messages.Apply'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
    {{ Form::close() }}
  </div>
@endsection
