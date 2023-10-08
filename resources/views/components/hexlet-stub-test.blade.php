<table class="text-light">
    @foreach ($objects as $object)
        <tr>
            <td>
                {{$object->id}}
            </td>
        </tr>
    @endforeach
</table>