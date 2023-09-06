@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Изменение статуса</h1>
<div>
  {{ Form::model($task, ['route' => ['task.update', $task], 'method' => 'PATCH']) }}
  <div class="row">
    <div class="col-sm-7">  
      @if ($errors->any())
      <div>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <div class="col-sm-7">  
      {{ Form::label('name', 'Название') }}<br>
      {{ Form::text('name', $task->name, ['class' => 'form-control']) }}<br>
      {{ Form::label('description', 'Описание') }}<br>
      {{ Form::textarea('description', $task->description, ['class' => 'form-control']) }}<br>
      {{ Form::label('status_id', 'Статус') }}<br>
      {{ Form::select('status_id', $statuses->pluck('name', 'id'), null, ['class' => 'form-control']) }}<br>
      {{ Form::label('user_executor_id', 'Исполнитель') }}<br>
      {{ Form::select('user_executor_id', $users->pluck('name', 'id'), null, ['class' => 'form-control']) }}<br>
    </div>
    <div class="col-sm-3">
      {{ Form::label('label[]', 'Метки') }}<br>
      {{ Form::select('label[]', $labels->pluck('name', 'id'), $task->labels, ['multiple' => true, 'class' => 'form-select']) }}
    </div>
    {{ Form::submit('Изменинить', ['class' => 'btn btn-primary']) }}
  {{ Form::close() }}
</div>
@endsection