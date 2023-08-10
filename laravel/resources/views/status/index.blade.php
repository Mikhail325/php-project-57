@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Статусы</h1>
<div>
  <a href="{{route('status.create')}}">Создать</a>
  <table class="table table-success table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Имя</th>
        <th scope="col">Дата создания</th>
        <th scope="col">Действия</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($statuses as $status)
            <tr>
                <th scope="row">{{$status->id}}</th>
                <td>{{$status->name}}</td>
                <td>{{$status->created_at}}</td>
                <td><a href="{{route('status.destroy', $status)}}" data-method="delete" rel="nofollow">Удалить</a></td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection
