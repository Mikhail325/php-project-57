@extends('layouts.main')

@section('content')
<div class="container">
  @include('flash::message')
</div>
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
                      <p class="text-secondary m-0">{{$status->created_at}}</p>
                    </div>
                    @can('create', App\Models\TaskStatus::class)
                    <div class="col-2 p-0">
                        <a class="text-secondary link-underline link-underline-opacity-0" href="{{route('status.edit', $status)}}">
                          <i class="bi bi-pencil hover:text-black"></i>
                          <p class="d-none">{{__('messages.To change')}}</p>
                        </a>
                        <a class="text-secondary p-0.5" href="#" data-bs-toggle="modal" data-bs-target="#statusDeleteModal{{$status->id}}">
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
  <div class="col-2 d-flex align-self-center justify-content-end">
      @can('create', App\Models\TaskStatus::class)
        <a class="btn btn-primary" style="width: 125.7px" href="{{route('status.create')}}">{{__('messages.Create')}}</a>
      @endcan
  </div>
</div>

@endsection

@section('title')
<div class="row">
  <div class="col-10">
    <h1 class="mt-5 mb-3">{{__('messages.Statuses')}}</h1>
  </div>
</div>
@endsection

@foreach ($statuses as $status)
<div class="modal fade" id="statusDeleteModal{{$status->id}}" tabindex="-1" role="dealog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.Confirm the action on the page')}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <p>
          {{__('messages.Are you sure you want to delete the status')}}
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">{{__('messages.Cancel')}}</button>
        <a class="btn btn-primary" href="{{route('status.destroy', $status)}}" data-method="delete" rel="nofollow">{{__('messages.Delete')}}</a>
      </div>
    </div>
  </div>
</div>
@endforeach
