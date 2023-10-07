@extends('layouts.main')

@section('content')
  {{ Form::model($label, ['route' => ['label.update', $label], 'method' => 'PATCH']) }}
      <div class="row m-0">
        <div class="col-9 square border border-light bg-slate-100 rounded p-3">
        {{ Form::label('name', __('messages.Title')) }}
        {{ Form::text('name', $label->name, ['class' => 'form-control']) }}
        <x-input-error :messages="$errors->get('name')" class="m-0 px-3" />
        <br>
        {{ Form::label('description', __('messages.Description')) }}
        {{ Form::textarea('description', $label->description, ['class' => 'form-control']) }}
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-3">
        <a class="btn btn-secondary" href="{{route('label.index')}}">{{__('messages.Cancel')}}</a>
        {{ Form::submit(__('messages.Edit'), ['class' => 'btn btn-primary mx-1.5']) }}
        </div>
      </div>
  {{ Form::close() }}
@endsection

@section('title')
  <x-title-task-manager text="messages.Changing the label"/>
@endsection
