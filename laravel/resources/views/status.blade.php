@extends('layouts.main')

@section('content')
    @foreach ($statuses as $stastus)
        <div>{{$stastus->name}}</div>
    @endforeach
@endsection
    