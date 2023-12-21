@extends('river::admin.layouts.master')
@section('settings') active @stop

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center ">
                        <h4 class="mb-0">Site Backup</h4>
                        <a class="btn btn-primary mx-3" href="{{ route('river.site-backup-store') }}">Download backup</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('scripts')
    <script>



    </script>
@endpush
