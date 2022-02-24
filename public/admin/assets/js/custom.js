// Alt Image Remove
function deleteAltImg(e, ssn_id) {
    var img_name = e.target.id;
    console.log(e.target);
    $(e.target).closest('span.pip').remove();
    $.ajax({
        method: 'POST',
        url: window.alt_tmp_img_remove,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            img_name: img_name,
            ssn_id: ssn_id,
        },
        success: function (result) {
            // console.log(result);
        },
    });
}

// Delete Alt Image By Id
function deleteAltImgById(e, id) {
    $(e.currentTarget).parent('.pip').remove();
    $.ajax({
        method: 'POST',
        url: window.delete_alt_img_by_id,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id,
        },
        success: function (result) {
            One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: result})
        },
    });
}

//single image preview
function readURL(input, imgControlName) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(imgControlName).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function singleImagePreview(e, preview) {
    $('#' + preview).closest('.pip').removeClass('d-none');
    var imgControlName = "#" + preview;
    readURL(e.target, imgControlName);
}
function removeSingleImage(ImgPreview,image) {
    $("#" + image).val("");
    $("#" + ImgPreview).attr("src", "");
    $('#' + ImgPreview).closest('.pip').addClass('d-none');
}

$(".confirm-delete").click(function (e) {
    e.preventDefault();
    var form = $("#deleteForm");
    var url = $(this).data("href");
    $("#delete-modal").modal("show");
    form.attr("action", url);
    form.attr("method", "POST");
});