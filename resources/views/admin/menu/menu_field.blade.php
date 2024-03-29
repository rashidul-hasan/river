{{-- @extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/lib/codemirror.css" />
    <link rel="stylesheet" href="/river/admin/codemirror-5.65.2/theme/monokai.css" />
    <style>
        .CodeMirror {
            height: 400px;
        }
        .content{
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl">
{{ $type }}
    </div>
@endsection --}}

@section('page-header')
    <x:river::header>
            <x-slot:title>
            Add Menu Fileds
            </x-slot>

            <x-slot:breads>
                <li class="breadcrumb-item"><a href="{{route('river.admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('river.menu.index')}}">Menus</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Add Fildes</a></li>
            </x-slot:breads>

            <x-slot:buttons>
                <a href="{{route('river.menu.index')}}" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0"/><path d="M5 12l6 6"/><path d="M5 12l6 -6"/></svg>
                    Back
                </a>
            </x-slot:buttons>

    </x:river::header>
@stop


<a href="#" class="btn btn-primary btn-add-fields mb-2">Add Fields</a>

<form class="custom-validation" action="{{ route('river.menu_update-fields') }}" method="POST">
    <input type="hidden" name="type_id" value="{{$type->id}}">
    @csrf
    @method('PUT')

    <table class="table">
        <thead>
        <tr>
            <th scope="col" style="width: 5%;color: red;">Delete</th>
            <th scope="col" style="width: 10%">title</th>
            <th scope="col" style="width: 10%">Url</th>
            <th scope="col" style="width: 10%">Sort Order</th>
            <th scope="col" style="width: 5%">CSS Class</th>
            <th scope="col" style="width: 5%">CSS Id</th>
        </tr>
        </thead>



        <tbody>
           @foreach ($type->menuitem as $field)

           <tr>
            <td>
                <input type="checkbox" class="form-check-input"
                       name="field[{{$field->id}}][delete_field]">
            </td>
            <td>
                <input type="text" class="form-control" value="{{$field->title}}"
                       name="field[{{$field->id}}][title]">
            </td>
            <td>
                <input type="text" class="form-control" value="{{$field->url}}"
                       name="field[{{$field->id}}][url]">
            </td>
            <td>
                <input type="text" class="form-control" value="{{$field->sort_order}}"
                name="field[{{$field->id}}][sort_order]">

            </td>
            <td>
                <input type="text" class="form-control" value="{{$field->css_class}}"
                name="field[{{$field->id}}][css_class]">
            </td>
            <td>
                <input type="text" class="form-control" value="{{$field->css_id}}"
                name="field[{{$field->id}}][css_id]">
            </td>

        </tr>

           @endforeach




        </tbody>


        {{-- <tbody>

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

                <td>
                    <input type="checkbox" class="form-check-input"
                           @if($field->is_required == '1') checked @endif
                           name="field[{{$field->id}}][is_required]">
                 </td>
                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#field_meta_{{$field->id}}">
                        <i class="fa fa-eye"></i>
                    </button>
                     @include('river::admin.contact_form.field_meta_modal',['field' => $field])
                </td>
            </tr>

        </tbody> --}}
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
                DynamicForm.create(route('river.store-fields'), "POST")
                    .addField("title", filename)
                    .addField("type_id", "{{$type->id}}")
                    .addCsrf()
                    .submit();
            }
        })
    </script>
@endpush
