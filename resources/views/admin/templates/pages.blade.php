@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">
            <div class="list-group">
                @foreach($pages as $file)
                <a class="list-group-item" href="{{route('river.template-pages.edit', $file->id)}}">{{$file->filename}}</a>
                @endforeach
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
