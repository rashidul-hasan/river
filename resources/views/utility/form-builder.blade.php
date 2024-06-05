@if(!$skip_form_tag)
    <form class="custom-validation" action="{{$action}}"
          method="{{$method == 'GET' ? 'GET' : 'POST'}}">
@endif
    @if($method != 'GET')
        @csrf
        @method($method)
    @endif

    @foreach($fields as $field)
        @if($field['type'] == 'text' || $field['type'] == 'email' || $field['type'] == 'password')
            <div class="form-group row">
                <label class="col-md-4">{{$field['label']}}</label>
                <div class="col-md-8">
                    <input type="{{$field['type']}}"
                           class="form-control"
                           value="{{$field['value']}}"
                           name="{{$field['name']}}" />
                </div>
            </div>
        @endif

        @if($field['type'] == \BitPixel\SpringCms\Constants::FIELD_TYPE_PHONE)
            {{--TODO add formatting option for phn number--}}
            <div class="form-group row">
                <label class="col-md-4">{{$field['label']}}</label>
                <div class="col-md-8">
                    <input type="text"
                           class="form-control"
                           value="{{$field['value']}}"
                           name="{{$field['name']}}" />
                </div>
            </div>
        @endif

        @if($field['type'] == \BitPixel\SpringCms\Constants::FIELD_TYPE_DATE)
            {{--TODO add a good date picker--}}
            <div class="form-group row">
                <label class="col-md-4">{{$field['label']}}</label>
                <div class="col-md-8">
                    <input type="date"
                           class="form-control"
                           value="{{$field['value']}}"
                           name="{{$field['name']}}" />
                </div>
            </div>
        @endif

        @if($field['type'] == 'textarea')
            <div class="form-group row">
                <label class="col-md-4">{{$field['label']}}</label>
                <div class="col-md-8">
                    <textarea name="{{$field['name']}}"
                              id=""  class="form-control" cols="30" rows="10">{{$field['value']}}</textarea>
                </div>
            </div>
        @endif

        @if($field['type'] == 'checkbox')
            <div class="form-group row">
                <label class="col-md-4"></label>
                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               name="{{$field['name']}}"
                               @if($field['value']) checked @endif
                               type="checkbox" id="{{$field['name']}}">
                        <label class="form-check-label" for="{{$field['name']}}">{{$field['label']}}</label>
                    </div>
                </div>
            </div>
        @endif

        @if($field['type'] == \BitPixel\SpringCms\Constants::FIELD_TYPE_BELONGSTO)
            <div class="form-group row">
                <label class="col-md-4">{{$field['label']}}</label>
                @php
                $metas = $field['metas'];

                $type = collect($metas)->first(function ($item) {
                    return $item['name'] == \BitPixel\SpringCms\Models\DataFieldMeta::NAME_RELATED_TYPE;
                });
                   $column = collect($metas)->first(function ($item) {
                    return $item['name'] == \BitPixel\SpringCms\Models\DataFieldMeta::NAME_RELATED_TYPE_LABEL_COLUMN;
                });

                $data = river_find($type['value']);
                @endphp
                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <select name="{{$field['name']}}" id="" class="form-control">
                            @foreach($data as $datum)
                            <option value="{{$datum['id']}}">{{$datum[$column['value']]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @endif

    @endforeach

    <div class="form-group row mb-0 float-right">
        <div class="col-md-8">
            <button type="submit" class="{{$submit[1]}}">
                {{$submit[0]}}
            </button>
        </div>
    </div>
@if(!$skip_form_tag)
</form>
@endif

