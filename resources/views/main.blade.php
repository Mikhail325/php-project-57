@extends('layouts.main')

@section('content')
<h1 class="mt-5 mb-5">@lang('messages.Greetings from Hexlet!')</h1>
<div>
  <h2>@lang('messages.This is a simple task manager on Laravel')</h2>
  <a class="btn btn-primary" href="{{route('tasks.index')}}" role="button">@lang('messages.Push me')</a>
</div>
@endsection