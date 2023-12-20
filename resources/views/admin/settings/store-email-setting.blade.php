@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Email Seetings</h4>
                    <form class="custom-validation" action="{{route('river.store-settings')}}" method="POST">
                        @csrf
                        <div class="form-group mb-3 row">
                            <label class="col-md-4">Gmail user name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="gmail_name"
                                       value=" {{ river_settings('gmail_name') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-4">Gmail app Password</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="gmail_password"
                                       value="{{ river_settings('gmail_password') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-4">Newletter Submission</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="newsletter_submission"
                                       value="{{ river_settings('newsletter_submission') }}">
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
             

        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endpush
