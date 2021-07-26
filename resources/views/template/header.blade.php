<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
{{-- data tables --}}
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
{{-- end datatables --}}
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

{{-- data tables --}}
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('plugins/js/jquery.mask.js')}}"></script>
{{-- end datatables --}}

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    // data tables 1
    $(document).ready(function() {
        var table = $('#example').DataTable({
            fixedHeader: {
                header: true,
                footer: true
            }
        });
    });
    $(document).ready(function() {
        $('#example1').DataTable({
            // dom: 'lBfrtip',
            "buttons": [{
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'colvis',
                    text: "Select",
                    postfixButtons: ['colvisRestore']
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
    // end tables 1
    // data tables 2
    $(document).ready(function() {
        $('#example2').DataTable({
            // dom: 'lBfrtip',
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
    // end tables 2
    //image
    function preSantri(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('previewSantri');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    //Ayah Upload
    function preWali(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('previewWali');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function preWaliibu(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('previewWaliibu');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    //REGISTRASI KELAS BULK
    $(function() {
        $('.counter').text('0');

        var generallen = $("input.register:checked").length;
        if (generallen > 0) {
            $(".counter").text('' + generallen + '');
        } else {
            $(".counter").text('0');
        }
    });

    function updateCounter() {
        var kapasitas = $("input.kapasitas").val();
        var len = $("input.register:checked").length;
        if (len > 0) {
            $(".counter").text('' + len + '');
        } else {
            $(".counter").text('0');
        }
        if (len > kapasitas) {
            $(".saved").attr('disabled', 'disabled');
        } else {
            $(".saved").removeAttr('disabled');
        }
    }
    $(".reset").on("click", function() {
        $('.counter').text('0');
    });
    $("input.register").on("change", function() {
        updateCounter();
    });
</script>