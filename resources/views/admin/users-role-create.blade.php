@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{route('river.users-role.store')}}" method="POST">
                                @csrf
                                <div class="form-group mb-3 ">
                                    <label class="form-label required">Name</label>
                                    <div>
                                        <input type="text" class="form-control" placeholder="Enter Name" name="name">
                                    </div>
                                </div>
                                <div class="form-group mb-3 ">
                                    <label class="form-label required">Status</label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active">
                                        <span class="form-check-label">Active</span>
                                    </label>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="form-label required">Data Types</label>
                                    @foreach($types as $data)
                                        <div class="form-group mb-3 col-3">
                                            <label class="form-label ">{{$data->slug}}</label>
                                            <div class="form-check">
                                                <input class="form-check-input cursor-pointer" type="checkbox" value="{{$data->slug}}.create" id="{{$data->slug}}.create" name="data_types[]">
                                                <label class="form-check-label" for="{{$data->slug}}.create">
                                                    Create
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input cursor-pointer" type="checkbox" value="{{$data->slug}}.edit" id="{{$data->slug}}.edit" name="data_types[]">
                                                <label class="form-check-label" for="{{$data->slug}}.edit">
                                                    Edit
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input cursor-pointer" type="checkbox" value="{{$data->slug}}.update" id="{{$data->slug}}.update" name="data_types[]">
                                                <label class="form-check-label" for="{{$data->slug}}.update">
                                                    Update
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input cursor-pointer" type="checkbox" value="{{$data->slug}}.destroy" id="{{$data->slug}}.destroy" name="data_types[]">
                                                <label class="form-check-label" for="{{$data->slug}}.destroy">
                                                    Delete
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group mb-3 ">
                                    <label class="form-label required">All Routes</label>
                                    <div class="row">
                                        @foreach(array_chunk($route_name, count($route_name)/4) as $chunk)
                                            <div class="col-md-3">
                                                @foreach($chunk as $route)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input cursor-pointer" type="checkbox" id="{{$route}}" value="{{$route}}" name="route_names[]">
                                                        <label class="form-check-label" for="{{$route}}">{{$route}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('scripts')
    <script>
        function deleteTable(id) {
            if(confirm("Do you want to delete this item?")) {
                document.getElementById('delete-form-'+id).submit();
                toastr.success('Deleted!', "")
            }
        }
    </script>
@endpush
