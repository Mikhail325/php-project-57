@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Изменение статуса</h1>
<div>
  {{ Form::model($status, ['route' => ['status.update', $status], 'method' => 'PATCH']) }}
      @if ($errors->any())
      <div>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    {{ Form::label('name', 'Название') }}
    {{ Form::text('name') }}<br>
    {{ Form::submit('Обновить') }}
  {{ Form::close() }}
</div>
@endsection