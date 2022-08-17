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
            <div class="col-8">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $item)
                                <tr>
                                <td data-label="Name">
                                    <div class="d-flex py-1 align-items-center">
                                        <div class="flex-fill">
                                            <div class="font-weight-medium">{{$item->name}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Title">
                                    <div>
                                        @if($item->is_active == 1)
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">Inactive</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">
                                           Edit
                                        </a>
                                        <a class="btn btn-sm btn-danger confirm-delete" href="javascript:void(0);" onclick="deleteTable({{$item->id}})">
                                            Delete
                                        </a>
                                            <form id="delete-form-{{$item->id}}"
                                                action="{{ route('river.users-role.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                                @include('river::admin.usersrole-edit-modal')
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
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
                            <div class="form-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
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
