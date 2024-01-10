@extends('_cache.master')

@section('css')

@endsection

@section('content')


<section>
    <div class="container">
        <article class="blog-post">
            <h2 class="blog-post-title mb-2">{{$service->title}}</h2>
            <img src="{{$service->image}}"/>
            <p class="m-5">{!! $service->content!!}</p>
        </article>

       
    </div>
</section>



@stop

@push('scripts')

@endpush
