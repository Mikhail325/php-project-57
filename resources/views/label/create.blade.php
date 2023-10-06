@extends('layouts.main')

@section('content')
{{ Form::model($labels, ['route' => 'label.store']) }}
  <div class="row mt-5 mb-3">
    <div class="col-4">
      <h1>{{__('messages.Create a label')}}</h1>
    </div>
  </div>
  <div class="col-12">  
    @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          <div class="m-1">{{ $error }}</div>
        @endforeach
      </div>
    @endif
  </div>
  <div class="row m-0">
    <div class="col-9 square border border-light bg-slate-100 rounded p-3">
    {{ Form::label('name', __('messages.Title')) }}
    {{ Form::text('name', '', ['class' => 'form-control']) }}<br>
    {{ Form::label('description', __('messages.Description')) }}
    {{ Form::textarea('description', '', ['class' => 'form-control', 'style' => 'height: 21.25rem;']) }}
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-3">
    <a class="btn btn-secondary" href="{{route('label.index')}}">{{__('messages.Cancel')}}</a>
    {{ Form::submit(__('messages.To change'), ['class' => 'btn btn-primary mx-1.5']) }}
    </div>
  </div>
{{ Form::close() }}
@endsection