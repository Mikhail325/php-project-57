@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Задачи</h1>
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
        <th scope="col">Действия</th>
      </tr>
    </thead>
    <tbody>
      <a href="{{route('task.create')}}">Создать</a>
        @foreach ($tasks as $task)
            <tr>
                <th scope="row">{{$task->id}}</th>
                <td>{{$task->status}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->userExecutor}}</td>
                <td>{{$task->created_at}}</td>
                <td><a href="{{route('task.destroy', $task)}}" data-method="delete" rel="nofollow">Удалить</a></td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection
