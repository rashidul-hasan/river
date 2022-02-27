@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#fields" role="tab" aria-controls="profile" aria-selected="false">Fields</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form class="custom-validation" action="{{route('river.datatypes.update', $type->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-md-4">Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name"
                                               value="{{ $type->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4">Slug</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="slug"
                                               value="{{ $type->slug }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-0 float-right">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="fields" role="tabpanel" aria-labelledby="profile-tab">
                            @include('river::admin.datatypes.fields', ['type' => $type])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
