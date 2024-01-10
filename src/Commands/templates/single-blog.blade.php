@extends('_cache.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')

<section>
    <div class="container">  
        <article class="blog-post">
            <h2 class="blog-post-title mb-2">{{ $single_blog->title }}</h2>
            <img src="{{ $single_blog->image }}"/>
            <p class="blog-post-meta">{{ $single_blog->created_at }}</p>
            
            <p class="m-5">{!! $single_blog->content !!}</p>
        </article>
    </div>
</section>

@stop

@push('scripts')

@endpush