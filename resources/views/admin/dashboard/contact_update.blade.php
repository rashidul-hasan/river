@extends('river::admin.layouts.master')
@section('dashboard') active @endsection

@section('content')
<div class="container-xl">
    <div class="row row-deck row-cards">


        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                    href="{{ route('river.contact-form.update',$data->id) }}">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('river.Contact-Form-Field') }}">Fields</a>
            </li>
        </ul>

        <div class="p-5">
            <form method="POST" action={{ route('river.contact-form.update-store', $data->id) }}>
                @csrf
                @method('PUT');
                <div class="d-flex hstack">
                    <label class="form-label  px-5">Name</label>
                    <input type="text" class="form-control mx-5" name="name" value="{{ $data->name }}" />
                </div>

                <div class="d-flex hstack my-3">
                    <label class="form-label  px-5">Slug</label>
                    <input type="text" class="form-control mx-5" name="slug" value="{{ $data->slug }}" />
                </div>

                <div class="d-flex hstack">
                    <label class="form-label mx-5">Is Active</label>
                    <input type="checkbox" class="form-check-input mx-5" name="is_active" value="1" {{
                        ($data->is_active==1)?'checked' : '' }}>
                </div>


                <div class="mt-3">
                    <input type="submit" value="Update" class="btn btn-primary" />
                </div>


            </form>
        </div>

    </div>
</div>
@stop

@push('scripts')

@endpush
