@extends('_cache.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <main id="main">
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-title">
                    <h2>{{$title}}</h2>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        {!! $content !!}
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop

@push('scripts')

@endpush
