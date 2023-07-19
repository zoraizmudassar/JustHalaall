<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/admin/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
{{--<script src="{{asset('assets/admin/vendor/chart.js/Chart.min.js')}}"></script>--}}

<!-- Page level custom scripts -->
{{--<script src="{{asset('assets/admin/js/demo/chart-area-demo.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/demo/chart-pie-demo.js')}}"></script>--}}
<script src="{{asset('assets/admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/js/demo/datatables-demo.js')}}"></script>
{{--JS files for UI Ajax messages--}}
<script src="{{asset('assets/admin/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/admin/js/toastr.min.js')}}"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>--}}
<script src="{{asset('assets/admin/js/bootstrap-toggle.min.js')}}"></script>
<script>

    /* START - blockUi */
    function blockUi(){
        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
    }
    function successMsg(_msg){
        window.toastr.success(_msg);
    }
    function errorMsg(_msg){
        window.toastr.error(_msg);
    }
    function warningMsg(_msg){
        window.toastr.warning(_msg);
    }
</script>


<script>
    $('#sidebarToggle').click(function(){
        $('.fa-laugh-wink').toggle();
    });

    function blockUi(){
        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
    }


    function successMsg(_msg){
        window.toastr.success(_msg);
    }

    function errorMsg(_msg){
        window.toastr.error(_msg);
    }

    function warningMsg(_msg){
        window.toastr.warning(_msg);
    }



</script>

@yield('script')
