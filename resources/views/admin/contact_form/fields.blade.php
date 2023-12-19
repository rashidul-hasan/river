<a href="#" class="btn btn-primary btn-add-fields mb-2">Add Fields</a>

<form class="custom-validation" action="{{ route('river.contact-form.update-fields') }}" method="POST">
    <input type="hidden" name="type_id" value="{{$type->id}}">
    @csrf
    @method('PUT')
    
    <table class="table">
        <thead>
        <tr>
            <th scope="col" style="width: 5%;color: red;">Delete</th>
            <th scope="col" style="width: 10%">Name</th>
            <th scope="col" style="width: 10%">Slug</th>
            <th scope="col" style="width: 10%">Type</th>
            <th scope="col" style="width: 5%">Is required</th>
            {{-- <th scope="col" style="width: 5%">Nullable</th> --}}
            {{-- <th scope="col" style="width: 10%">Default</th> --}}
            {{-- <th scope="col" style="width: 5%">Listing</th> --}}
            <th scope="col" style="width: 5%"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($type->contactformfield as $field)

            <tr>
                <td>
                    <input type="checkbox" class="form-check-input"
                           name="field[{{$field->id}}][delete_field]">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{$field->name}}"
                           name="namefield[{{$field->id}}][name]">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{$field->slug}}"
                           name="field[{{$field->id}}][slug]">
                </td>
                {{-- <td>
                    <input type="text" class="form-control" value="{{$field->label}}"
                           name="field[{{$field->id}}][label]">
                </td> --}}
                <td>
                    <select name="field[{{$field->id}}][type]" class="form-control">
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_TEXT}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_TEXT) selected @endif>
                            Text
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_TEXTAREA}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_TEXTAREA) selected @endif>
                            Textarea
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_EMAIL}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_EMAIL) selected @endif>
                            Email
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_PHONE}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_PHONE) selected @endif>
                            Phone
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_PASSWORD}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_PASSWORD) selected @endif>
                            Password
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_IMAGE}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_IMAGE) selected @endif>
                            Image
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_CHECKBOX}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_CHECKBOX) selected @endif>
                            Checkbox
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_SELECT}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_SELECT) selected @endif>
                            Select
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_RADIO}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_RADIO) selected @endif>
                            Radio
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_DROPDOWN}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_DROPDOWN) selected @endif>
                            Dropdown
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_TEXT}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_TEXT) selected @endif>
                            Text
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_NUMBER}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_NUMBER) selected @endif>
                            Number
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_DATE}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_DATE) selected @endif>
                            Date
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_DATETIME}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_DATETIME) selected @endif>
                            Date time
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_RICHTEXT}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_RICHTEXT) selected @endif>
                            Richtext
                        </option>
                        <option value="{{\Rashidul\River\Constants::FIELD_TYPE_BELONGSTO}}"
                                @if($field->type == \Rashidul\River\Constants::FIELD_TYPE_BELONGSTO) selected @endif>
                            Belongs To
                        </option>
                    </select>
                </td>
                <td>
                    <input type="checkbox" class="form-check-input"
                           @if($field->is_required == '1') checked @endif
                           name="field[{{$field->id}}][is_required]">
                 </td>
                {{-- <td>
                    <input type="checkbox" class="form-check-input"
                           @if($field->is_nullable == '1') checked @endif
                           name="field[{{$field->id}}][is_nullable]">
                </td>
                <td>
                    <input type="text" class="form-control"
                           value="{{$field->default}}"
                           name="field[{{$field->id}}][default]">
                </td>
                <td>
                    <input type="checkbox" class="form-check-input"
                           @if($field->show_on_list == '1') checked @endif
                           name="field[{{$field->id}}][show_on_list]">
                </td> --}}
                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#field_meta_{{$field->id}}">
                        <i class="fa fa-eye"></i>
                    </button>
                    @include('river::admin.contact_form.field_meta_modal',['field' => $field])
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
            if (filename) {
                DynamicForm.create(route('river.contact-form.store-fields'), "POST")
                    .addField("name", filename)
                    .addField("type_id", "{{$type->id}}")
                    .addCsrf()
                    .submit();
            }
        })
    </script>
@endpush
