@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! $form !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
