@props(['routes', 'objects', 'Models'])

<div class="row d-flex justify-content-between">
    <div class="col-7">
      {{ $objects->links() }}
    </div>
    <div class="col-3 d-flex align-self-center justify-content-end">
        @can('create', App\Models\$Models::class)
          <a class="btn btn-primary" href="{{route("$routes.create")}}">{{__("messages.Create $Models")}}</a>
        @endcan
    </div>
  </div>