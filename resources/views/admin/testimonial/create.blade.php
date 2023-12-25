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
                        <div class="tab-content">
                            <div class="tab-pane active show p-5" id="general" role="tabpanel">
                                <form action="{{ route('river.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Name</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Image</label>
                                        <div class="col">
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Designation</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="designation" >
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Message</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="message">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Sort Order</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="sort_order"
                                                   value="">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="col-3 col-form-label ">Is Active</label>
                                        <div class="col d-flex ">
                                           
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="is_active" >
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                  Active
                                                </label>
                                              </div>
                                              <div class="form-check mx-2">
                                                <input class="form-check-input" type="radio" value="0" name="is_active">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                  Inactive
                                                </label>
                                              </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
