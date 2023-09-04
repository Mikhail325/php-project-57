@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Создать статус</h1>
<div>
  {{ Form::model($status, ['route' => 'status.store']) }}
    {{ Form::label('name', 'Название') }}
    {{ Form::text('name', '', ['class' => 'form-control']) }}<br>
    {{ Form::submit('Создать', ['class' => 'btn btn-primary']) }}
  {{ Form::close() }}
</div>
@endsection
