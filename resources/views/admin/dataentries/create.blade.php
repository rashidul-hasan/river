@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <form class="card">
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

                                @if($options['type'] === Constants::FIELD_TYPE_EMAIL)
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                        <div class="col">
                                            <input type="email" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
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

@endpush
