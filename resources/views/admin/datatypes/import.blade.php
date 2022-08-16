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
                        <form class="custom-validation"
                              enctype="multipart/form-data"
                              action="{{route('river.datatypes.postimport')}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4">Select JSON file</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                            <div class="form-group row mb-0 float-right">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                        Import
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
