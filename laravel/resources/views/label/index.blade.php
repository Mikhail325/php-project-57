@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Метки</h1>
<div>
  <a href="{{route('label.create')}}">Создать</a>
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
        @foreach ($labels as $label)
            <tr>
                <th scope="row">{{$label->id}}</th>
                <td>{{$label->name}}</td>
                <td>{{$label->created_at}}</td>
                @if (Route::has('login'))
                  @auth
                    <td>
                      <a href="{{route('label.destroy', $label)}}" data-method="delete" rel="nofollow">Удалить</a>
                      <a href="{{route('label.edit', $label)}}" rel="nofollow">Изменинить</a>
                    </td>
                  @endif
                @endif
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection
