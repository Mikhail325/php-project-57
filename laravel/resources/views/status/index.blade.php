@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Статусы</h1>
<div>
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
        @foreach ($statuses as $stastus)
            <tr>
                <th scope="row">{{$stastus->id}}</th>
                <td>{{$stastus->name}}</td>
                <td>{{$stastus->created_at}}</td>
                <td><a href="{{route('status.destroy', $stastus)}}" data-method="delete" rel="nofollow">Удалить</a></td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection
