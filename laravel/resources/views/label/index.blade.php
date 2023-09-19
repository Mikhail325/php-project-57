@extends('layouts.main')

@section('content')
<div class="container">
  @include('flash::message')
</div>
@foreach ($labels as $label)
<div class="row justify-content-center m-2.5">
        <div class="square border border-light bg-slate-100 hover:bg-gray-300 rounded ms-1">
          <div class="row d-flex justify-content-between">
            <div class="col-3">
                  <p class="p-2 m-0 align-self-center">
                    {{$label->id}}
                    {{$label->name}}
                  </p>
            </div>
            <div class="col-6">
              <p class="p-2 m-0 align-self-center">
                {{$label->description}}
              </p>
            </div>
            <div class="col-3 p-2">
                <div class="row justify-content-end">
                    <div class="col-10 d-flex align-self-center justify-content-end">
                      <p class="text-secondary m-0">{{$label->created_at}}</p>
                    </div>
                    @can('create', App\Models\Label::class)
                    <div class="col-2 p-0">
                        <a class="text-secondary" href="{{route('label.edit', $label)}}"><i class="bi bi-pencil hover:text-black"></i></a>
                        <a class="text-secondary" href="{{route('label.index', $label)}}"><i class="bi bi-x-lg hover:text-black"></i></a>  
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
    {{ $labels->links() }}
  </div>
  <div class="col-2 d-flex align-self-center justify-content-end">
      @can('create', App\Models\Label::class)
        <a class="btn btn-primary" style="width: 125.7px" href="{{route('label.create')}}">Создать</a>
      @endcan
  </div>
</div>

@endsection

@section('title')
<div class="row">
  <div class="col-10">
    <h1 class="mt-5 mb-3">Метки</h1>
  </div>
</div>
@endsection