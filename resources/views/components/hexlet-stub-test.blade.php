<table class="text-white">
    @foreach ($objects as $object)
        <tr>
            <td>
                {{$object->id}}
            </td>
        </tr>
    @endforeach
</table>