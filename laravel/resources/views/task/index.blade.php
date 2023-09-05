@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Задачи</h1>
<div>
  @if (Route::has('login'))
    @auth
      <a href="{{route('task.create')}}">Создать</a>
    @endif
  @endif
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
                <td>{{$task->name}}</td>
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
@endsection
