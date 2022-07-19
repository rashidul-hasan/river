@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            @foreach($headers as $key => $header)
                                <th>{{$header['label']}}</th>
                            @endforeach
                            <th scope="col" style="width: 5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                @foreach($headers as $slug => $meta)
                                    @if($meta['type'] == 'image')
                                        <td>
                                            <img src="{{$row[$slug]}}" alt="" width="100">
                                        </td>
                                    @else
                                        <td>
                                            {{$row[$slug]}}
                                        </td>
                                    @endif
                                @endforeach
                                <td>
                                    <a href="{{ route('river.data-entries.edit', ['slug' => $data_slug, 'id' => $row['id']]) }}">
                                        <i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                    </a>
                                    <a href="#" class="confirm-delete" data-href="{{ route('river.data-entries.destroy', ['slug' => $data_slug, 'id' => $row['id']]) }}">
                                        <i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                    </a>
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
    <script>

        $('.confirm-delete').click(function (e) {
            var $this = $(this);
            e.preventDefault();
            if (confirm('Are you sure you want to delete this item?')) {
                window.location = $this.data('href');
            }
        });
    </script>
@endpush
