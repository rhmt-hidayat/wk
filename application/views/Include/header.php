<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $judul ?></title>
    <meta name="description" content="Recruitment Portal">
    <meta name="keywords" content="lowongan, pekerjaan, cikarang, operator, bekasi, plastik, injeksi, injection, plastic injection">
    <meta name="author" content="IT Department">

    <!-- Favicons -->
    <link href="<?php echo base_url().'assets/img/mini-bg.png'; ?>" rel="icon">
    <link href="<?php echo base_url().'assets/img/mini-bg.png'; ?>" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/fontawesome-free/css/all.min.css'; ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/dist/css/adminlte.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/summernote/summernote-bs4.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'; ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/select2/css/select2.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'; ?>">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'; ?>">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/bs-stepper/css/bs-stepper.min.css'; ?>">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/dropzone/min/dropzone.min.css'; ?>">  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
    <script src="<?php echo base_url().'assets/admin/plugins/jquery/jquery.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/jquery-ui/jquery-ui.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/jquery-ui/jquery-ui.css'; ?>"></script>
    <script src="<?php echo base_url().'assets/admin/plugins/jquery-ui/jquery-ui.theme.min.css'; ?>"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
        $(function(){
            $(".datepicker").datepicker({
                // changeMonth: true,
                // changeYear: true,
                format: 'dd/mm/yy'
            });
        });
    </script>
    
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>