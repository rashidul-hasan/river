<form class="custom-validation" action="{{$action}}"
      method="{{$method == 'GET' ? 'GET' : 'POST'}}">
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

    @endforeach

    <div class="form-group row mb-0 float-right">
        <div class="col-md-8">
            <button type="submit" class="{{$submit[1]}}">
                {{$submit[0]}}
            </button>
        </div>
    </div>
</form>

