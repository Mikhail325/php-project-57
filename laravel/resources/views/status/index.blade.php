@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Статусы</h1>
<div>
  @if (Route::has('login'))
    @auth
      <a href="{{route('status.create')}}">Создать</a>
    @endif
  @endif
</div>
<div>
  <table class="table table-success table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Имя</th>
        <th scope="col">Дата создания</th>
        @if (Route::has('login'))
          @auth
            <th scope="col">Действия</th>
          @endif
        @endif
      </tr>
    </thead>
    <tbody>
        @foreach ($statuses as $status)
            <tr>
                <th scope="row">{{$status->id}}</th>
                <td>{{$status->name}}</td>
                <td>{{$status->created_at}}</td>
                @if (Route::has('login'))
                  @auth
                    <td>
                      <a href="{{route('status.destroy', $status)}}" data-method="delete" rel="nofollow">Удалить</a>
                      <a href="{{route('status.edit', $status)}}" rel="nofollow">Изменинить</a>
                    </td>
                  @endif
                @endif
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection
