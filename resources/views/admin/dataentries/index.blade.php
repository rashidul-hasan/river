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
                                    actions
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

    </script>
@endpush
