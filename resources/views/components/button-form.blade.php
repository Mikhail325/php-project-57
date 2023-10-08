@props(['routes', 'text'])

<div class="row mt-2">
    <div class="col-3">
    <a class="btn btn-secondary" href="{{route($routes)}}">{{__("messages.Cancel")}}</a>
    {{ Form::submit(__("messages.$text"), ['class' => 'btn btn-primary mx-1.5']) }}
    </div>
</div>