@extends('layouts.main')

@section('content')
  {{ Form::model($status, ['route' => 'status.store']) }}
  <div class="row mt-5 mb-3 d-flex justify-content-between">
    <div class="col-4">
      <h1 class="">{{__('messages.Create a status')}}</h1>
    </div>
  </div>
  @if ($errors->any())
  <div>
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
<div class="col-4 d-flex align-items-center">
  <div class="row square border border-light bg-slate-100 hover:bg-gray-300 rounded py-2 ms-0">
    <div class="col-3 d-flex align-items-center">
    {{ Form::label('name', __('messages.Title')) }}
    </div>
    <div class="col-9">
    {{ Form::text('name', '', ['class' => 'form-control']) }}
    </div>
  </div>
</div>
<div class="row mt-2">
  <div class="col-3">
  <a class="btn btn-secondary" href="{{route('status.index')}}">{{__('messages.Cancel')}}</a>
  {{ Form::submit(__('messages.Create'), ['class' => 'btn btn-primary mx-1.5']) }}
  </div>
</div>
  {{ Form::close() }}
@endsection
