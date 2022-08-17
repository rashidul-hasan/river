
<form action="{{route('river.users-role.update', $item->id)}}" method="POST">
    @csrf
    @method('PUT')
<div class="modal modal-blur fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3 ">
                    <label class="form-label required">Name</label>
                    <div>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$item->name}}">
                    </div>
                </div>
                <div class="form-group mb-3 ">
                    <label class="form-label required">Status</label>
                    <label class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" {{$item->is_active == 1 ? 'checked' : ''}}>
                        <span class="form-check-label">Active</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
            </div>
        </div>
    </div>
</div>
</form>
