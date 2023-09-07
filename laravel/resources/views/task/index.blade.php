@extends('layouts.main')

@section('content')
<div class="container">
  @include('flash::message')
</div>
<div>
  <h1 class="mt-5 mb-5">Задачи</h1>
  @if (Route::has('login'))
    @auth
      <a href="{{route('task.create')}}">Создать</a>
    @endif
  @endif
</div>
<div class="col-sm-10">  
  {{ Form::open(['class' => 'form', 'route' => 'task.index', 'method' => 'get'])}}
  <div class="row">
      {{ Form::select('filter[status_id]', $statuses->pluck('name', 'id'), null, ['placeholder' => 'Статус', 'class' => 'form-control']) }}<br>
      {{ Form::select('filter[user_author_id]', $users->pluck('name', 'id'), null, ['placeholder' => 'Автор', 'class' => 'form-control']) }}<br>
      {{ Form::select('filter[user_executor_id]', $users->pluck('name', 'id'), null, ['placeholder' => 'Исполнитель', 'class' => 'form-control']) }}<br>
      {{ Form::submit('Фильтровать', ['class' => 'btn btn-primary']) }}
  {{ Form::close() }}
</div>
</div> 
<div>
  <table class="table table-success table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Статус</th>
        <th scope="col">Имя</th>
        <th scope="col">Автор</th>
        <th scope="col">Исполнитель</th>
        <th scope="col">Дата создания</th>
        @if (Route::has('login'))
          @auth
            <th scope="col">Действия</th>
          @endif
        @endif
      </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <th scope="row">{{$task->id}}</th>
                <td>{{$task->status->name}}</td>
                <td><a href="{{route('task.show', $task)}}" rel="nofollow">{{$task->name}}</a></td>
                <td>{{$task->userAuthor->name}}</td>
                <td>{{$task->userExecutor->name}}</td>
                <td>{{$task->created_at}}</td>
                @if (Route::has('login'))
                  @auth
                    <td>
                      <a href="{{route('task.destroy', $task)}}" data-method="delete" rel="nofollow">Удалить</a>
                      <a href="{{route('task.edit', $task)}}" rel="nofollow">Изменинить</a>
                    </td>
                  @endif
                @endif
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
<div>
  {{ $tasks->links() }}
</div>
@endsection
