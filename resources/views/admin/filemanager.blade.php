@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <iframe src="/river/tinyfilemanager.php" width="100%" height="500" title="file manager"></iframe>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
