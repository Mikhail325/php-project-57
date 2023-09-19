@extends('layouts.main')

@section('content')
{{ Form::model($labels, ['route' => 'label.store']) }}
  <div class="row mt-5 mb-3 d-flex justify-content-between">
    <div class="col-4">
      <h1 class="">Создать метку</h1>
    </div>
    <div class="col-3 d-flex align-self-center justify-content-end">
      <a class="btn btn-secondary" href="{{route('label.index')}}">Отменить</a>
      {{ Form::submit('Создать', ['class' => 'btn btn-primary mx-1.5']) }}
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
  <div class="row d-flex justify-content-center">
    <div class="col-9 square border border-light bg-slate-100 hover:bg-gray-300 rounded p-3">
    {{ Form::label('name', 'Название') }}
    {{ Form::text('name', '', ['class' => 'form-control']) }}<br>
    {{ Form::label('description', 'Описание') }}
    {{ Form::text('description', '', ['class' => 'form-control', 'style' => 'height: 21.25rem;']) }}
    </div>
  </div>
{{ Form::close() }}
@endsection