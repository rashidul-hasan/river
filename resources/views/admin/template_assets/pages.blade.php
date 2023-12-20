@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')

    <div class="container-xl">
        <div class="row card row-cards">
            <h3>Css Files</h3>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-vcenter">
                      <thead>
                        <tr>
                          <th>File Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($css_file_name as $key=>$file)
                        <tr>
                            <td>{{$file}}</td>
                            <td class="text-secondary">
                              Delete
                            </td>
                          </tr>
                        @endforeach
              
                      </tbody>
                    </table>
                  </div>
                  
            </div>
            
        </div>

        <div class="row card row-cards mt-5">

            <h3>JS Files</h3>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-vcenter">
                      <thead>
                        <tr>
                          <th>File Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($js_file_name as $key=>$file)
                        <tr>
                            <td>{{$file}}</td>
                            <td class="text-secondary">
                              Delete
                            </td>
                          </tr>
                        @endforeach
              
                      </tbody>
                    </table>
                  </div>
                  
            </div>
            
        </div>

        <div class="row card row-cards mt-5">

            <h3>Image Files</h3>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-vcenter">
                      <thead>
                        <tr>
                          <th>File Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($image_file_name as $key=>$file)
                        <tr>
                            <td > <img style="width:100px" src="/river/assets/{{ $file }}" /> {{$file}}</td>
                            <td class="text-secondary">
                              Delete
                            </td>
                          </tr>
                        @endforeach
              
                      </tbody>
                    </table>
                  </div>
                  
            </div>
            
        </div>



    </div>
@stop

@push('scripts')
    {{-- <script>
        $('#btn-add-new').click(function (e) {
            e.preventDefault();
            var filename = window.prompt('Enter file name');

            DynamicForm.create(route('river.template-assets.store'), "POST")
                .addField("filename", filename)
                .addCsrf()
                .submit();
        })
    </script> --}}
@endpush
