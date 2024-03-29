<a href="#" class="btn btn-primary btn-add-fields mb-2">Add Fields</a>

<form class="custom-validation" action="{{route('river.datatypes.update-fields')}}" method="POST">
    <input type="hidden" name="type_id" value="{{$type->id}}">
    @csrf
    @method('PUT')
<table class="table">
    <thead>
    <tr>
        <th scope="col">Label</th>
        <th scope="col">Slug</th>
        <th scope="col">Type</th>
        <th scope="col">Required</th>
    </tr>
    </thead>
    <tbody>
    @foreach($type->fields as $field)
    <tr>
        <td>
            <input type="text" class="form-control" value="{{$field->label}}"
                   name="field[{{$field->id}}][label]">
        </td>
        <td>
            <input type="text" class="form-control" value="{{$field->slug}}"
                   name="field[{{$field->id}}][slug]">
        </td>
        <td>
            <select name="field[{{$field->id}}][type]" class="form-control">
                <option value="1" @if($field->type == '1') selected @endif>Text</option>
                <option value="2" @if($field->type == '2') selected @endif>Email</option>
                <option value="3" @if($field->type == '3') selected @endif>Password</option>
                <option value="4" @if($field->type == '4') selected @endif>Image</option>
                <option value="5" @if($field->type == '5') selected @endif>Checkbox</option>
            </select>
        </td>
        <td>
            <input type="checkbox" class="form-control"
                   @if($field->is_required == '1') checked @endif
                   name="field[{{$field->id}}][is_required]">
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
        Update
    </button>
</form>

@push('scripts')
    <script>
        $(function () {
            const queryString = window.location.search;
            const parameters = new URLSearchParams(queryString);
            const tab = parameters.get('tab');
            if (tab) {
                $('.nav-tabs a[href="#' + tab + '"]').tab('show');
            }
        });

        $('.btn-add-fields').click(function (e) {
            e.preventDefault();
            var filename = window.prompt('Enter name(s)');

            DynamicForm.create(route('river.datatypes.store-fields'), "POST")
                .addField("name", filename)
                .addField("type_id", "{{$type->id}}")
                .addCsrf()
                .submit();
        })
    </script>
@endpush
