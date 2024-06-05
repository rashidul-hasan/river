<div class="modal modal-blur fade" id="field_meta_{{$field->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('river.contact-form.field-meta')}}" method="post">
                @csrf
                <div class="modal-body">
                    @if($field->type == \BitPixel\SpringCms\Constants::FIELD_TYPE_SELECT)
                        <div class="mb-3">
                            <label class="form-label">Option</label>
                            <input type="text" class="form-control" name="options" value="">
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
