 @extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table id="alt-pg-dt" class="table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Alt Text</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $data)
                                    <tr>
                                        <td><img src="{{asset($data->image)}}" width="100px" height="50px"></td>
                                        <td>{{$data->alt_text}}</td>
                                        <td class="">
                                            <div class="btn-list flex-nowrap">
                                                <a class="mr-3 btn btn-sm btn-warning" href="{{ route('river.banners.edit', $data->id) }}">
                                                    Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger confirm-delete" href="{{ route('river.banners.destroy', $data->id) }}"
                                                   data-href="{{ route('river.banners.destroy', $data->id) }}">
                                                    Delete
                                                </a>
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
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('river.banners.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="form-label" for="alt_text">Alt text</div>
                                <input type="text" class="form-control" id="alt_text" name="alt_text" value="{{ old('alt_text') }}"/>
                            </div>
                            <div class="mb-3">
                                <div class="form-label required">Image</div>
                                <input type="file" class="form-control" name="image" id="image" onchange="singleImagePreview(event,'ImgPreview1')">
                            </div>
                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center flex-wrap">
                                    <span class="pip d-none">
                                        <img class="imageThumb" id="ImgPreview1" src="" style="height: 200px;">
                                        <span class="remove btn btn-sm btn-danger" id="removeImage1" onclick="removeSingleImage('ImgPreview1','image')">
                                            Remove
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $('body').on('change',"#statusChange",function () {
        var id = $(this).attr('data-id');

        if (this.checked){
            var status = 1;
        }else{
            var status = 0;
        }
        $.ajax({
            url:"/backpanel/slider-status/" + id + '/' + status,
            method:"GET",
            success:function (done) {
                console.log(done);
                toastr.success(done.message, '');
            }
        });
    })

</script>

<script>
    $('.confirm-delete').click(function (e) {
        var $this = $(this);
        e.preventDefault();
        if (confirm('Are you sure you want to delete this item?')) {
            DynamicForm.create($this.attr('href'), "DELETE")
                .addCsrf()
                .submit();
        }
    });

</script>

@endpush
