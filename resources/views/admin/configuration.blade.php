@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')

@endsection

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
           
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('river.update-package') }}"> Update Package</a>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('river.clear-cache') }}"> Clear All Cache</a>
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
