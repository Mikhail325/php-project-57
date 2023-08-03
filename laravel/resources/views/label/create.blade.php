@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Создать статус</h1>
<div>
  {{ Form::model($labels, ['route' => 'label.store']) }}
    {{ Form::label('name', 'Название') }}
    {{ Form::text('name') }}<br>
    {{ Form::label('description', 'Описание') }}
    {{ Form::text('description') }}<br>
    {{ Form::submit('Создать') }}
  {{ Form::close() }}
</div>
@endsection