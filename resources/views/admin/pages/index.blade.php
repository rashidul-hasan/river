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
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Menu Title</th>
                                <th>Slug</th>
                                <th>Meta Description</th>
                                <th>Content Type</th>
                                <th>Published</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($riverPages as $item)
                                <tr>
                                <td data-label="Name">
                                    <div class="d-flex py-1 align-items-center">
                                        <div class="flex-fill">
                                            <div class="font-weight-medium">{{$item->title}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Title">
                                    <div>{{$item->menu_title}}</div>
                                </td>
                                <td data-label="Title">
                                    <div>{{$item->slug}}</div>
                                </td>
                                <td data-label="Title">
                                    <div>{{$item->meta_description}}</div>
                                </td>
                                <td data-label="Title">
                                    <div>{{$item->content_type}}</div>
                                </td>
                                <td class="text-muted" data-label="Role">
                                    @if($item->is_published == 1)
                                        <span class="text-success">Yes</span>
                                    @else
                                        <span class="text-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{route('river.pages.edit',$item->id)}}" class="btn btn-sm btn-info">
                                            Edit
                                        </a>

                                        <a class="btn btn-sm btn-danger confirm-delete" href="javascript:void(0);" onclick="deleteTable({{$item->id}})">
                                            Delete
                                        </a>
                                            <form id="delete-form-{{$item->id}}"
                                                action="{{ route('river.pages.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
