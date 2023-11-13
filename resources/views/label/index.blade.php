@extends('layouts.main')

@section('content')
  <section>
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
                          <p class="text-secondary m-0">{{$label->formatted_date}}</p>
                        </div>
                          <div class="col-2 p-0">
                            @can('update', $label)
                              <a class="text-secondary link-underline link-underline-opacity-0" href="{{route('labels.edit', $label)}}">
                                <i class="bi bi-pencil hover:text-black "></i>
                                <p class="d-none">{{__('messages.To change')}}</p>
                              </a>
                            @endcan
                            @can('delete', $label)
                              <a class="text-secondary p-0.5" href="{{route('labels.destroy', $label)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">
                                <i class="bi bi-trash hover:text-black"></i>
                                <p class="d-none">{{__('messages.Delete')}}</p>
                              </a>
                            @endcan
                          </div>
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
      <div class="col-3 d-flex align-self-center justify-content-end">
          @can('create', App\Models\Label::class)
            <a class="btn btn-primary" href="{{route('labels.create')}}">{{__('messages.Create label')}}</a>
          @endcan
      </div>
    </div>

    <x-hexlet-stub-test :objects="$labels"/>
  </section>
@endsection

@section('title')
  <x-title-task-manager text="messages.Label"/>
@endsection