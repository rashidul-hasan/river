@extends('river::admin.layouts.master')
@section('settings') active @stop

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <h2 class="pb-4"> Code Snippets</h2>
            <form method="post" action="{{route('river.store-settings')}}">
                @csrf
                <div class="col-12">
                    <h3> Header Code</h3>
                    <div class="page-title-box d-flex align-items-center ">
                        <textarea class="form-control" id="floatingTextarea"
                            name="header_code"> {{ river_settings('header_code') }} </textarea>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <h3> Footer Code</h3>
                    <div class="page-title-box d-flex align-items-center ">
                        <textarea class="form-control" id="floatingTextarea"
                            name="footer_code">{{ river_settings('footer_code') }}</textarea>
                    </div>
                </div>

                <div class="col-12 mt-5">

                    <div class="page-title-box d-flex align-items-center ">
                        <input type="submit" class="btn btn-primary" />
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

@stop

@push('scripts')
<script>



</script>
@endpush
