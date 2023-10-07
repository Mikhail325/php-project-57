@extends('layouts.main')

@section('content')
{{ Form::open(['class' => 'form', 'route' => ['task.update', $task], 'method' => 'PATCH'])}}
<div class="row square border border-light bg-slate-100 rounded p-3 d-flex justify-content-center">
  <div class="col-9 ps-0">  
    {{ Form::label('name', __('messages.Title')) }}<br>
    {{ Form::text('name', $task->name, ['class' => 'form-control']) }}
    <x-input-error :messages="$errors->get('name')" class="m-0 px-3" />
    <br>
    {{ Form::label('description', __('messages.Description')) }}<br>
    {{ Form::textarea('description', $task->description, ['class' => 'form-control']) }}<br>
    {{ Form::label('assigned_to_id', __('messages.Executor')) }}<br>
    {{ Form::select('assigned_to_id', $users->pluck('name', 'id'), $task->userExecutor->id, ['class' => 'form-control']) }}
  </div>
  <div class="col-3 pe-0">
    {{ Form::label('label[]', __('messages.Label')) }}<br>
    {{ Form::select('label[]', $labels->pluck('name', 'id'), $task->labels, ['multiple' => true, 'class' => 'form-select', 'style' => 'height: 21.25rem;']) }}<br>
    {{ Form::label('status_id', __('messages.Status')) }}<br>
    {{ Form::select('status_id', $statuses->pluck('name', 'id'), $task->status->id, ['class' => 'form-control']) }}
    <x-input-error :messages="$errors->get('status_id')" class="m-0 px-3" />
  </div>
</div>
<div class="row mt-2">
  <div class="col-3 p-0">
  <a class="btn btn-secondary" href="{{route('task.index')}}">{{__('messages.Cancel')}}</a>
  {{ Form::submit(__('messages.Edit'), ['class' => 'btn btn-primary mx-1.5']) }}
  </div>
</div>
{{ Form::close() }}
@endsection

@section('title')
  <x-title-task-manager text="messages.Changing the task"/>
@endsection