@extends('_cache.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')

<section>

    
    <div class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
              <h1 class="display-4 fst-italic">All Blogs</h1>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row mb-2">
            @foreach($blogs as $blog)
            <div class="col-md-6">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <h3 class="mb-0">{{ $blog->title }}</h3>
                  <div class="mb-1 text-muted">{{ $blog->created_at }}</div>
                  <p class="card-text mb-auto">{{ $blog->short_desc }}</p>
                  <a href="{{ route('riversite.single-blog',$blog->slug ) }}" class="stretched-link">Continue reading</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                  <svg class="bd-placeholder-img" width="200" height="250" xmlns="{{ $blog->image }}" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/></svg>
        
                </div>
              </div>
            </div>
            @endforeach
          </div>
    </div>

</section>

@stop

@push('scripts')

@endpush
