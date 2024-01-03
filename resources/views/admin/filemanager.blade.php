@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <iframe src="{{route('river.tinyfilemanager')}}?_token={{csrf_token()}}" width="100%" height="500" title="file manager"></iframe>

                    {{--for https://github.com/alexusmai/laravel-file-manager--}}
{{--                    <div id="fm" style="height: 600px;"></div>--}}

                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
