@extends('river::admin.layouts.master')

@section('website_setup') active pcoded-trigger @stop

@section('css')
@stop

@section('content')

    <div class="container-xl">
        <div class="row row-cards">
            <h3> Newsletter Emails:</h3>
            

            <table class="table">
                <thead>
                    <tr>
                        <th> SL</th>
                        <th>Email</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($value as $key=>$file)
                    <tr>
                        <td><p class="list-group-item mt-3">{{++$key}}</p> </td>
                        <td> <p class="list-group-item mt-3">{{$file->email}}</p></td>
                        <td> <p class="list-group-item mt-3">{{$file->date}}</p> </td>  
                    </tr>
                    @endforeach
                </tbody>
            </table>


            
        </div>
    </div>
@stop


