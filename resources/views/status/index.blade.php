@extends('layouts.main')

@section('content')
  @foreach ($statuses as $status)
    <div class="row m-2.5">
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
                <p class="text-secondary m-0">{{$status->created_at()}}</p>
              </div>
              @can('create', App\Models\TaskStatus::class)
                <div class="col-2 p-0">
                  <a class="text-secondary link-underline link-underline-opacity-0" href="{{route('status.edit', $status)}}">
                    <i class="bi bi-pencil hover:text-black"></i>
                    <p class="d-none">{{__('messages.To change')}}</p>
                  </a>                         
                  <a class="text-secondary p-0.5" href="{{route('status.destroy', $status)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">
                    <i class="bi bi-trash hover:text-black"></i>
                    <p class="d-none">{{__('messages.Delete')}}</p>
                  </a>
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
    <div class="col-3 d-flex align-self-center justify-content-end">
        @can('create', App\Models\TaskStatus::class)
          <a class="btn btn-primary" href="{{route('status.create')}}">{{__('messages.Create status')}}</a>
        @endcan
    </div>
  </div>
@endsection

@section('title')
  <x-title-task-manager text="messages.Statuses"/>
@endsection
