@extends('admin.layouts.master')
@section('settings') active @stop

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Settings</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul role="tablist" class="nav nav-tabs nav-tabs-custom">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#general" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">General</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Shipping_Method" role="tab" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Shipping Method</span>
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="general" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="{{route('store-settings')}}" method="POST" >
                                                @csrf
{{--                                                <div class="form-group row">--}}
{{--                                                    <label for="example-text-input" class="col-md-2 col-form-label">Maintenance Mode</label>--}}
{{--                                                    <div class="col-md-10 d-flex align-items-center">--}}
{{--                                                        <input type="checkbox" id="switch3" switch="bool" name="maintenance_mode" value="1">--}}
{{--                                                        <label for="switch3" data-on-label="Yes" data-off-label="No"></label>--}}
{{--                                                        <label class="ml-3 text-warning">Put the application into maintenance mode</label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <h4>Mail Config</h4>

                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Mail From Address</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="header_text" value="{{$settings['mail_from_address'] ?? ''}}"
                                                               id="example-text-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Mail From Name</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="email" value="{{$settings['mail_from_name'] ?? ''}}" id="example-text-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Mail Host</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="phone" value="{{$settings['mail_host'] ?? ''}}" id="example-text-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Mail Port</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="phone" value="{{$settings['mail_port'] ?? ''}}" id="example-text-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Mail Username</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="phone" value="{{$settings['mail_username'] ?? ''}}" id="example-text-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Mail Password</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="phone" value="{{$settings['mail_password'] ?? ''}}" id="example-text-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Mail Encryption</label>
                                                    <div class="col-md-10">
                                                        <select name="mail_encryption" class="form-control custom-select-black" id="mail_encryption">
                                                            <option value="">Please Select</option>
                                                            <option value="ssl">SSL</option>
                                                            <option value="tls">Tls</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-success">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="Shipping_Method" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="{{route('store-settings')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <h4>Free Shipping</h4>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">
                                                        <strong>Minimum Amount</strong>
                                                    </label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" id="example-text-input" name="free_ship_min_amount"
                                                               value="{{$settings['free_ship_min_amount'] ??
                                                        ''}}">
                                                    </div>
                                                </div>
{{--                                                <div class="form-group row">--}}
{{--                                                    <label for="example-text-input" class="col-md-2 col-form-label"><strong>Active Status</strong></label>--}}
{{--                                                    <div class="col-md-10">--}}
{{--                                                        <input type="checkbox" id="switch1" switch="none" name="free_ship_status" {{$settings['free_ship_status'] ===--}}
{{--                                                        '1' ? 'checked' : ''}}/>--}}
{{--                                                        <label for="switch1" data-on-label="On" data-off-label="Off"></label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <h4 class="mt-4">Inside Dhaka Shipping</h4>

                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label"><strong>Amount</strong></label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="number" id="example-text-input" name="inside_ship_amount"
                                                               value="{{$settings['inside_ship_amount'] ??
                                                        ''}}">
                                                    </div>
                                                </div>
{{--                                                <div class="form-group row">--}}
{{--                                                    <label for="example-text-input" class="col-md-2 col-form-label"><strong>Active Status</strong></label>--}}
{{--                                                    <div class="col-md-10">--}}
{{--                                                        <input type="checkbox" id="switch2" switch="none" name="inside_ship_status" {{$settings['inside_ship_status'] ===--}}
{{--                                                        '1' ? 'checked' : ''}}/>--}}
{{--                                                        <label for="switch2" data-on-label="On" data-off-label="Off"></label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <h4 class="mt-4">Outside Dhaka Shipping</h4>
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label"><strong> Amount</strong></label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="number" id="example-text-input" name="outside_ship_amount"
                                                               value="{{$settings['outside_ship_amount'] ??
                                                        ''}}">
                                                    </div>
                                                </div>
{{--                                                <div class="form-group row">--}}
{{--                                                    <label for="example-text-input" class="col-md-2 col-form-label"><strong>Active Status</strong></label>--}}
{{--                                                    <div class="col-md-10">--}}
{{--                                                        <input type="checkbox" id="switch3" switch="none" name="Outside_ship_status" {{$settings['Outside_ship_status']--}}
{{--                                                         ===--}}
{{--                                                        '1' ? 'checked' : ''}}/>--}}
{{--                                                        <label for="switch3" data-on-label="On" data-off-label="Off"></label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <button type="submit" class="btn btn-success">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('scripts')
    <script>
        // var loadLoginFile = function(event) {
        //     var reader = new FileReader();
        //     reader.onload = function(){
        //         var output = document.getElementById('output1');
        //         output.src = reader.result;
        //         // output.style.display = 'block';
        //     };
        //     reader.readAsDataURL(event.target.files[0]);
        // };
        //
        // var loadFavFile = function(event) {
        //     var reader = new FileReader();
        //     reader.onload = function(){
        //         var output = document.getElementById('output2');
        //         output.src = reader.result;
        //         // output.style.display = 'block';
        //     };
        //     reader.readAsDataURL(event.target.files[0]);
        // };

        $(document).ready(function(){
            $('.dropify').dropify();
        });

    </script>
@endpush
