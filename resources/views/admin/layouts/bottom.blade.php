<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="/river/admin/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="/river/admin/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/river/admin/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="/river/admin/bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- waves js -->
<script src="/river/admin/assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="/river/admin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- Float Chart js -->
<script src="/river/admin/assets/pages/chart/float/jquery.flot.js"></script>
<script src="/river/admin/assets/pages/chart/float/jquery.flot.categories.js"></script>
<script src="/river/admin/assets/pages/chart/float/curvedLines.js"></script>
<script src="/river/admin/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>

<script type="text/javascript" src="/river/admin/bower_components/switchery/js/switchery.min.js"></script>
<!-- data-table js -->
<script src="/river/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/river/admin/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/river/admin/assets/pages/data-table/js/jszip.min.js"></script>
<script src="/river/admin/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="/river/admin/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="/river/admin/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/river/admin/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/river/admin/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/river/admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/river/admin/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
{{--<script src="/river/admin/assets/vendor/dropify/js/dropify.js"></script>--}}
<script src="/river/admin/assets/vendor/toastr.min.js"></script>
<script src="/river/admin/assets/vendor/sweetalert2.min.js"></script>
<!-- Select 2 js -->
<script type="text/javascript" src="/river/admin/bower_components/select2/js/select2.full.min.js"></script>
<!-- Custom js -->
<script src="/river/admin/assets/js/pcoded.min.js"></script>
<script src="/river/admin/assets/js/classie.js"></script>
<script type="text/javascript" src="/river/admin/assets/js/modalEffects.js"></script>
{{--<script type="text/javascript" src="/river/admin/assets/pages/advance-elements/custom-picker.js"></script>--}}
<script type="text/javascript" src="/river/admin/assets/pages/advance-elements/select2-custom.js"></script>
<script src="/river/admin/assets/pages/data-table/js/data-table-custom.js"></script>
<script src="/river/admin/assets/js/vertical/vertical-layout.min.js"></script>
{{--<script type="text/javascript" src="/river/admin/assets/pages/dashboard/crm-dashboard.min.js"></script>--}}
<script type="text/javascript" src="/river/admin/assets/js/script.min.js"></script>
<script type="text/javascript" src="/river/admin/assets/js/custom.js"></script>
<script src="/river/admin/assets/js/bootstrap-show-modal.js"></script>
<script src="/river/admin/assets/js/form-builder.js"></script>
<script src="/river/admin/assets/js/modal-utility.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html, { size: 'small' });
    });
</script>


@if (Session::has('warning'))
    <script>
        toastr.warning("{{ Session::get('warning') }}", 'Warning');
    </script>
@endif

@if (Session::has('message'))
    <script>
        toastr.info("{{ Session::get('message') }}", 'Info');
    </script>
@endif

@if (Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}", 'Success');
    </script>
@endif

@if (Session::has('error'))
    <script>
        toastr.error("{{ Session::get('error') }}", 'Error');
    </script>
@endif

<script>
    // add csrf token to ajax request
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

</script>

<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{$error}}', 'Error', {
        closeButton:true,
        progressBar:true,
    });
    @endforeach
    @endif
</script>
