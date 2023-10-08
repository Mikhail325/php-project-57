@extends('layouts.main')

@section('content')
  {{ Form::open(['class' => 'form', 'route' => ['task_statuses.update', $taskStatus], 'method' => 'PATCH'])}}
    <div class="col-4 d-flex align-items-center">
      <div class="row square border border-light bg-slate-100 hover:bg-gray-300 rounded py-2 ms-0">
        <div class="col-3 d-flex align-items-center">
          {{ Form::label('name', __('messages.Title')) }}
        </div>
        <div class="col-9">
          {{ Form::text('name', $taskStatus->name, ['class' => 'form-control']) }}
          <x-input-error :messages="$errors->get('name')" class="m-0 px-3" />
        </div>
      </div>
    </div>
    <x-button-form routes="task_statuses.index" text="Edit"/>
  {{ Form::close() }}
@endsection

@section('title')
  <x-title-task-manager text="messages.Changing the status"/>
@endsection