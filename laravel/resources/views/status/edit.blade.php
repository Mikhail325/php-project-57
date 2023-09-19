@extends('layouts.main')

@section('content')
{{ Form::model($status, ['route' => ['status.update', $status], 'method' => 'PATCH']) }}
{{ Form::model($status, ['route' => 'status.store']) }}
<div class="row mt-5 mb-3 d-flex justify-content-between">
  <div class="col-4">
    <h1 class="">Создать статус</h1>
  </div>
  <div class="col-4 d-flex align-items-center">
    <div class="row square border border-light bg-slate-100 hover:bg-gray-300 rounded p-2">
      <div class="col-3 d-flex align-items-center">
      {{ Form::label('name', 'Название') }}
      </div>
      <div class="col-9">
      {{ Form::text('name', $status->name, ['class' => 'form-control']) }}
      </div>
    </div>
  </div>
  <div class="col-3 d-flex align-self-center justify-content-end">
    <a class="btn btn-secondary" href="{{route('status.index')}}">Отменить</a>
    {{ Form::submit('Изменить', ['class' => 'btn btn-primary mx-1.5']) }}
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
{{ Form::close() }}
@endsection