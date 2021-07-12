
<script>

    const APP_URL           = "{{ URL::to('/')}}";
    const MYHUB_URL         = "{{ env('MYHUB_URL')}}";
    const SESSION_LIFETIME  = "6000000";
    const LOGOUT_URL        = "{{ URL::to('/logout')}}";
    var WebURL = {!! json_encode(url('/')) !!}

</script>




<!-- Jquery Core Js -->
<script src="{{ URL::asset('template/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ URL::asset('template/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Select Plugin Js -->
{{-- <script src="{{ URL::asset('template/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script> --}}

<!-- Slimscroll Plugin Js -->
<script src="{{ URL::asset('template/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Bootstrap Colorpicker Js -->
<script src="{{ URL::asset('template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>

<!-- Dropzone Plugin Js -->
<script src="{{ URL::asset('template/plugins/dropzone/dropzone.js')}}"></script>

<!-- Input Mask Plugin Js -->
<script src="{{ URL::asset('template/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

<!-- Multi Select Plugin Js -->
{{-- <script src="{{ URL::asset('template/plugins/multi-select/js/jquery.multi-select.js')}}"></script> --}}

 <!-- Jquery Spinner Plugin Js -->
 <script src="{{ URL::asset('template/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>

<!-- Bootstrap Tags Input Plugin Js -->
<script src="{{ URL::asset('template/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

<!-- Select2 Input Plugin Js -->
<script src="{{ URL::asset('template/plugins/select2/select2.min.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ URL::asset('template/plugins/node-waves/waves.js')}}"></script>

<script src="{{ URL::asset('template/plugins/jquery/jquery-ui.js')}}"></script>
<script src="{{ URL::asset('template/plugins/jquery/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<script src="{{ URL::asset('template/plugins/timepicker/jquery.timepicker.min.js')}}"></script>

<!-- SweetAlert Plugin Js -->
<script src="{{ URL::asset('template/plugins/sweetalert/sweetalert.min.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ URL::asset('template/plugins/node-waves/waves.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{ URL::asset('template/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{ URL::asset('template/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
{{-- <script src="{{ URL::asset('https://cdn.datatables.net/select/1.3.1/js/dataTables.select.js')}}"></script> --}}
{{-- <script src="{{ URL::asset('https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js')}}"></script> --}}
<!-- Custom Js -->
<script src="{{ URL::asset('template/js/admin.js')}}"></script>

<script src="{{ URL::asset('template/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="{{ URL::asset('template/js/pages/ui/dialogs.js')}}"></script>

<!-- Token field -->
<script src="{{ URL::asset('template/plugins/tokenfield/bootstrap-tokenfield.min.js')}}"></script>

<!-- CUSTOM JS -->
<script src="{{ URL::asset('template/js/admin.js')}}"></script>
<script src="{{ URL::asset('custom/js/global.js')}}"></script>

<script src="{{ URL::asset('custom/js/sidebar.js')}}"></script>
@yield('js')
