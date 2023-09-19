@extends('layouts.main')

@section('content')  
      {{ Form::open(['class' => 'form', 'route' => 'task.store', 'method' => 'POST'])}}
      <div class="row mt-5 mb-3">
        <div class="col-10">
          <h1>Создать статус</h1>
        </div>
        <div class="col-2 d-flex align-self-center justify-content-end">
          <a class="btn btn-secondary" href="{{route('task.index')}}">Отменить</a>
          {{ Form::submit('Создать', ['class' => 'btn btn-primary mx-1.5']) }}
        </div>
      </div>
      <div class="col-10">  
        @if ($errors->any())
          @foreach ($errors->all() as $error)
            <div class="m-1">{{ $error }}</div>
          @endforeach
        @endif
      </div>
      <div class="row square border border-light bg-slate-100 rounded p-2 d-flex justify-content-center">
        <div class="col-9">  
          {{ Form::label('name', 'Название') }}<br>
          {{ Form::text('name', $task->name, ['class' => 'form-control']) }}<br>
          {{ Form::label('description', 'Описание') }}<br>
          {{ Form::textarea('description', $task->description, ['class' => 'form-control']) }}<br>
          {{ Form::label('user_executor_id', 'Исполнитель') }}<br>
          {{ Form::select('user_executor_id', $users->pluck('name', 'id'), null, ['placeholder' => '------------', 'class' => 'form-control']) }}
        </div>
        <div class="col-3">
          {{ Form::label('label[]', 'Метки') }}<br>
          {{ Form::select('label[]', $labels->pluck('name', 'id'), $task->labels, ['multiple' => true, 'class' => 'form-select', 'style' => 'height: 21.25rem;']) }}<br>
          {{ Form::label('status_id', 'Статус') }}<br>
          {{ Form::select('status_id', $statuses->pluck('name', 'id'), null, ['placeholder' => '------------', 'class' => 'form-control']) }}
        </div>
      {{ Form::close() }}
    </div>
@endsection