        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0-rc
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="<?php echo base_url().'assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/dist/js/adminlte.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/dist/js/demo.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/dist/js/myscript.js'; ?>"></script>
    <!-- <script src="<?php echo base_url().'assets/admin/plugins/jquery/jquery-3.3.1.js'; ?>"></script> -->
    <!-- DataTables  & Plugins -->
    <script src="<?php echo base_url().'assets/admin/plugins/datatables/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/jszip/jszip.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/pdfmake/pdfmake.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/pdfmake/vfs_fonts.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/datatables-buttons/js/buttons.print.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js'; ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url().'assets/admin/plugins/select2/js/select2.full.min.js'; ?>"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="<?php echo base_url().'assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js'; ?>"></script>
    <!-- dropzonejs -->
    <script src="<?php echo base_url().'assets/admin/plugins/dropzone/min/dropzone.min.js'; ?>"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
            $("#data1").DataTable();
            $("#rm1").DataTable();
            $("#cp1").DataTable();
            $("#aux1").DataTable();

            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox();

            //Tooltip
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-tooltip="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
