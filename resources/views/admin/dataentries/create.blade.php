@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <form class="card" action="{{route('river.data-entries.store', $type->slug)}}" method="POST">
                    @csrf
                    {{--<div class="card-header">
                        <h3 class="card-title">Horizontal form</h3>
                    </div>--}}
                    @php
                     use \Rashidul\River\Constants;
                    @endphp
                    <div class="card-body">
                        @foreach($fields as $slug => $options)
                            @if($options['type'] === Constants::FIELD_TYPE_TEXT)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="text" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif

                            @if($options['type'] === Constants::FIELD_TYPE_NUMBER)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="number" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif

                            @if($options['type'] === Constants::FIELD_TYPE_EMAIL)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="email" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif


                            @if($options['type'] === Constants::FIELD_TYPE_PHONE)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="number" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif

                            @if($options['type'] === Constants::FIELD_TYPE_PASSWORD)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="password" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif

                            @if($options['type'] === Constants::FIELD_TYPE_IMAGE)
                                <div class="form-group mb-3 row">
                                    <div class="form-group">
                                        <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                        <div class="col">
                                            @include('river::admin.components.image-picker', ['name' => $slug, 'default' => river_settings('image')])
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($options['type'] === Constants::FIELD_TYPE_DATE)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="date" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif

                            @if($options['type'] === Constants::FIELD_TYPE_DATETIME)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="datetime-local" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif

                            @if($options['type'] === Constants::FIELD_TYPE_BELONGSTO)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="text" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif

                            @if($options['type'] === Constants::FIELD_TYPE_TEXTAREA)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <textarea name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>

                                        </textarea>
                                    </div>
                                </div>
                            @endif



                            @if($options['type'] === Constants::FIELD_TYPE_CHECKBOX)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="checkbox"  name="{{$slug}}"  {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif


                            @if($options['type'] === Constants::FIELD_TYPE_RADIO)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">
                                        <input type="radio"  name="{{$slug}}" class="form-check-input" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                    </div>
                                </div>
                            @endif


                            @if($options['type'] === Constants::FIELD_TYPE_DROPDOWN)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">

                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown link
                                        </a>
                                        <ul name="{{$slug}}"  class="dropdown-menu" aria-labelledby="dropdownMenuLink" {{$options['is_required'] === 1 ? 'required' : ''}} checked>
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @endif


                            @if($options['type'] === Constants::FIELD_TYPE_SELECT)
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                    <div class="col">

                                        <select name="{{$slug}}" class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            @endif

                            @if($options['type'] === Constants::FIELD_TYPE_RICHTEXT)
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                <div>
                                    <textarea class="form-control" id="content_type" name="{{$slug}}"  >

                                    </textarea>
                                </div>
                            </div>
                        @endif




                        @endforeach
                        {{--<div class="mb-3 row">
                            <label class="col-3 col-form-label required">Password</label>
                            <div class="col">
                                <input type="password" class="form-control" placeholder="Password">
                                <small class="form-hint">
                                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain
                                    spaces, special characters, or emoji.
                                </small>
                                <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div></div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label">Select</label>
                            <div class="col">
                                <select class="form-select">
                                    <option>Option 1</option>
                                    <optgroup label="Optgroup 1">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                    </optgroup>
                                    <option>Option 2</option>
                                    <optgroup label="Optgroup 2">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                    </optgroup>
                                    <optgroup label="Optgroup 3">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                    </optgroup>
                                    <option>Option 3</option>
                                    <option>Option 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-3 col-form-label pt-0">Checkboxes</label>
                            <div class="col">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" checked="">
                                    <span class="form-check-label">Option 1</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-label">Option 2</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled="">
                                    <span class="form-check-label">Option 3</span>
                                </label>
                            </div>
                        </div>--}}
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>

    /*tinymce.init({
            selector: '#content_type',
        })*/
        $(function() {
            /*$('#contentType').change(function(){
                $('.{{$slug}}').hide();
                $('#' + $(this).val()).show();
            });*/
            $('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix})
        });

</script>


@endpush
