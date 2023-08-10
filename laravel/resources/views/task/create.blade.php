@extends('layouts.main')

@section('content')
  <div class="col-sm-10">  
      <h1 class="mt-5 mb-5">Создать статус</h1>  
      {{ Form::open(['class' => 'form', 'route' => 'task.store', 'method' => 'POST'])}}
      <div class="row">
        <div class="col-sm-7">  
          {{ Form::label('name', 'Название') }}<br>
          {{ Form::text('name','', ['class' => 'form-control']) }}<br>
          {{ Form::label('description', 'Описание') }}<br>
          {{ Form::textarea('description','', ['class' => 'form-control']) }}<br>
          {{ Form::label('status_id', 'Статус') }}<br>
          {{ Form::select('status_id', $statuses->pluck('name', 'id'), null, ['class' => 'form-control']) }}<br>
          {{ Form::label('user_executor_id', 'Исполнитель') }}<br>
          {{ Form::select('user_executor_id', $users->pluck('name', 'id'), null, ['class' => 'form-control']) }}<br>
        </div>
        <div class="col-sm-3">
          {{ Form::label('label[]', 'Метки') }}<br>
          {{ Form::select('label[]', $labels->pluck('name', 'id'), null, ['multiple' => true, 'class' => 'form-select']) }}
        </div>
        {{ Form::submit('Создать', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
  </div> 
@endsection
