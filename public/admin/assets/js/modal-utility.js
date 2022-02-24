$('button[data-cms_action=create-modal]').click(function (e){
    e.preventDefault();
    var $this = $(this);

    //TODO check id all recquired data attribute is present
    var schemavar = $this.data('schema');
    var modal_title = $this.data('modal_title');
    var save_button_text = $this.data('modal_title') ? $this.data('modal_title') : 'Save';
    var form_action = $this.data('form_action');
    var form_method = $this.data('form_method');

    //callbacks
    var onsuccess = $this.data('onsuccess');
    var onerror = $this.data('onerror');

    var schema = window[schemavar];
    console.log({schema});
    if (!schema) {
        console.error('Schema not found');
        return;
    }

    var formmarkup = FormBuilder.formMarkup(schema);

    $.showModal({
        title: modal_title,
        modalDialogClass: 'modal-lg',
        body: formmarkup,
        onCreate: function (modal) {
            $(modal.element).on("click", "button[type='submit']", function (event) {
                event.preventDefault();
                var form = $(modal.element).find('form');
                var values = form.serializeArray();
                var action = form.attr('action');
                var method = form.attr('method');
                const formData = new FormData(form[0]);
                formData.append('csrf_token', $('[name=csrf-token]').attr('content'));
                $.ajax({
                    url: action,
                    type: method,
                    processData: false,
                    contentType: false,
                    cache: false,
                    // dataType: "json",
                    data: formData,
                    success: function (response) {
                        modal.hide();
                        const cb = window[onsuccess];
                        //check if cb is function
                        if (cb){
                            cb(response);
                        }
                    },
                    error: function (response) {
                        modal.hide();
                        const cb = window[onerror];
                        //check if cb is function
                        if (cb){
                            cb(response);
                        }
                    },
                });
            });
        }
    })

});
