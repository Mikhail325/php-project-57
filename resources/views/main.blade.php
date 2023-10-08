@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">Привет от Хекслета!</h1>
<div>
  <h2>Это простой менеджер задач на Laravel</h2>
  <a class="btn btn-success" href="{{route('tasks.index')}}" role="button">Нажми меня</a>
</div>
@endsection