<div class="modal fade" id="{{$text}}DeleteModal{{$object->id}}" tabindex="-1" role="dealog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{__('messages.Confirm the action on the page')}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <p>{{__("messages.Are you sure you want to delete the $text")}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">{{__('messages.No')}}</button>
                <a class="btn btn-primary" href="{{route($text . '.destroy', $object)}}" data-method="delete" rel="nofollow">{{__('messages.Yes')}}</a>
            </div>
        </div>
    </div>
</div>