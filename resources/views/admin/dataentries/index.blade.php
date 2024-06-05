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
                                    @if($meta['type'] == \BitPixel\SpringCms\Constants::FIELD_TYPE_IMAGE)
                                        <td>
                                            <img src="{{array_key_exists($slug, $row) ? $row[$slug] : ''}}" alt="" width="100">
                                        </td>
                                    @else
                                        <td>
                                            {{array_key_exists($slug, $row) ? $row[$slug] : ''}}
                                        </td>
                                    @endif
                                @endforeach
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('river.data-entries.edit', ['slug' => $data_slug, 'id' => $row['id']]) }}" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>
                                        <a href="#" class="confirm-delete btn btn-danger btn-sm" data-href="{{ route('river.data-entries.destroy', ['slug' => $data_slug, 'id' => $row['id']]) }}">
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
