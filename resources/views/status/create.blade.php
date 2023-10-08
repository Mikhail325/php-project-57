@extends('layouts.main')

@section('content')
  {{ Form::model($status, ['route' => 'task_statuses.store']) }}
    <div class="col-4 d-flex align-items-center">
      <div class="row square border border-light bg-slate-100 hover:bg-gray-300 rounded py-2 ms-0">
        <div class="col-3 d-flex align-items-center">
          {{ Form::label('name', __('messages.Title')) }}
        </div>
        <div class="col-9">
          {{ Form::text('name', '', ['class' => 'form-control']) }}
          <x-input-error :messages="$errors->get('name')" class="m-0 px-3" />
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-3">
        <a class="btn btn-secondary" href="{{route('task_statuses.index')}}">{{__('messages.Cancel')}}</a>
        {{ Form::submit(__('messages.Create'), ['class' => 'btn btn-primary mx-1.5']) }}
      </div>
    </div>
  {{ Form::close() }}
@endsection

@section('title')
  <x-title-task-manager text="messages.Create a status"/>
@endsection
