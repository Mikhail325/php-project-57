@extends('layouts.main')

@section('content')
<div class="container">
  @include('flash::message')
</div>
@foreach ($statuses as $status)
<div class="row justify-content-center m-2.5">
        <div class="col-6 square border border-light bg-slate-100 hover:bg-gray-300 rounded ms-1">
          <div class="row d-flex justify-content-between">
            <div class="col-6">
                  <p class="p-2 m-0 align-self-center">
                    {{$status->id}}
                    {{$status->name}}
                  </p>
            </div>

            <div class="col-6 p-2">
                <div class="row justify-content-end">
                    <div class="col-10 d-flex align-self-center justify-content-end">
                      <p class="text-secondary m-0">{{$status->created_at}}</p>
                    </div>
                    @can('create', App\Models\Status::class)
                    <div class="col-2 p-0">
                        <a class="text-secondary" href="{{route('status.edit', $status)}}"><i class="bi bi-pencil hover:text-black"></i></a>
                        <a class="text-secondary" href="{{route('status.index', $status)}}"><i class="bi bi-x-lg hover:text-black"></i></a>  
                    </div>
                    @endcan
                </div>
            </div>
          </div>
            
        </div>
</div>
@endforeach
<div class="row d-flex justify-content-between">
  <div class="col-7">
    {{ $statuses->links() }}
  </div>
  <div class="col-2 d-flex align-self-center justify-content-end">
      @can('create', App\Models\Status::class)
        <a class="btn btn-primary" style="width: 125.7px" href="{{route('status.create')}}">Создать</a>
      @endcan
  </div>
</div>

@endsection

@section('title')
<div class="row">
  <div class="col-10">
    <h1 class="mt-5 mb-3">Статусы</h1>
  </div>
</div>
@endsection

