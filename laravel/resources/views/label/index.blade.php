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
        @foreach ($labels as $label)
            <tr>
                <th scope="row">{{$label->id}}</th>
                <td>{{$label->name}}</td>
                <td>{{$label->created_at}}</td>
                <td><a href="{{route('label.destroy', $label)}}" data-method="delete" rel="nofollow">Удалить</a></td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection
