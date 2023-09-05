@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Изменение метки</h1>
<div>
  {{ Form::model($label, ['route' => ['label.update', $label], 'method' => 'PATCH']) }}
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
    {{ Form::text('name', $label->name, ['class' => 'form-control']) }}<br>
    {{ Form::label('description', 'Описание') }}
    {{ Form::text('description', $label->description, ['class' => 'form-control']) }}<br>
    {{ Form::submit('Обновить', ['class' => 'btn btn-primary']) }}
  {{ Form::close() }}
</div>
@endsection
