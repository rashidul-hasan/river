@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 5%;color: red;">Delete</th>
                    <th scope="col" style="width: 10%">Slug</th>
                    <th scope="col" style="width: 10%">Label</th>
                    <th scope="col" style="width: 10%">Type</th>
                    <th scope="col" style="width: 5%">Required</th>
                    <th scope="col" style="width: 5%">Nullable</th>
                    <th scope="col" style="width: 10%">Default</th>
                    <th scope="col" style="width: 5%">Listing</th>
                    <th scope="col" style="width: 5%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($type->fields as $field)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-control"
                                   name="field[{{$field->id}}][delete_field]">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$field->slug}}"
                                   name="field[{{$field->id}}][slug]">
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{$field->label}}"
                                   name="field[{{$field->id}}][label]">
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
                        <td>
                            <input type="checkbox" class="form-control"
                                   @if($field->is_nullable == '1') checked @endif
                                   name="field[{{$field->id}}][is_nullable]">
                        </td>
                        <td>
                            <input type="text" class="form-control"
                                   value="{{$field->default}}"
                                   name="field[{{$field->id}}][default]">
                        </td>
                        <td>
                            <input type="checkbox" class="form-control"
                                   @if($field->show_on_list == '1') checked @endif
                                   name="field[{{$field->id}}][show_on_list]">
                        </td>
                        <td>
                            <button type="button" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@push('scripts')
    <script>

    </script>
@endpush
