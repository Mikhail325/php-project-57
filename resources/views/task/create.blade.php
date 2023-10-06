@extends('layouts.main')

@section('content')  
      {{ Form::open(['class' => 'form', 'route' => 'task.store', 'method' => 'POST'])}}
      <div class="row square border border-light bg-slate-100 rounded p-2 d-flex justify-content-center">
        <div class="col-9">
          {{ Form::label('name', __('messages.Title')) }}<br>
          {{ Form::text('name', $task->name, ['class' => 'form-control']) }}
          <x-input-error :messages="$errors->get('name')" class="m-0 px-3" />
          <br>
          {{ Form::label('description', __('messages.Description')) }}<br>
          {{ Form::textarea('description', $task->description, ['class' => 'form-control']) }}<br>
          {{ Form::label('assigned_to_id', __('messages.Executor')) }}<br>
          {{ Form::select('assigned_to_id', $users->pluck('name', 'id'), null, ['placeholder' => '------------', 'class' => 'form-control']) }}
        </div>
        <div class="col-3">
          {{ Form::label('label[]', __('messages.Label')) }}<br>
          {{ Form::select('label[]', $labels->pluck('name', 'id'), $task->labels, ['multiple' => true, 'class' => 'form-select', 'style' => 'height: 21.25rem;']) }}<br>
          {{ Form::label('status_id', __('messages.Status')) }}<br>
          {{ Form::select('status_id', $statuses->pluck('name', 'id'), null, ['placeholder' => '------------', 'class' => 'form-control']) }}
          <x-input-error :messages="$errors->get('status_id')" class="m-0 px-3" />
        </div>
      {{ Form::close() }}
    </div>
    <div class="row mt-2">
      <div class="col-3 p-0">
      <a class="btn btn-secondary" href="{{route('task.index')}}">{{__('messages.Cancel')}}</a>
      {{ Form::submit(__('messages.Create'), ['class' => 'btn btn-primary mx-1.5']) }}
      </div>
    </div>
@endsection

@section('title')
  <x-title-task-manager text="messages.Create a task"/>
@endsection

