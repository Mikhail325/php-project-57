@props(['status'])
@switch($status)
    @case('в работе')
        <div class="w-100 text-sm text-blue-500 border-1 border-blue-500 bg-blue-50 rounded-pill px-2 py-1">
        @break
          
    @case('новый')
        <div class="w-100 text-sm text-pink-500 border-1 border-pink-500 bg-pink-50 rounded-pill px-2 py-1">
        @break

    @case('на тестировании')
        <div class="w-100 text-sm text-amber-600 border-1 border-amber-600 bg-amber-50 rounded-pill px-2 py-1">
        @break

    @case('завершен')
        <div class="w-100 text-sm text-lime-600 border-1 border-lime-600 bg-lime-50 rounded-pill px-2 py-1">
        @break
          
    @default
        <div class="w-100 text-sm text-violet-500 border-1 border-violet-500 bg-violet-50 rounded-pill px-2 py-1">
@endswitch
            <p class="m-0 text-center lh-1">{{$status}}</p>
        </div>