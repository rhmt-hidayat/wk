<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url().'assets/img/mini-bg.png'; ?>">
    <title>Administrator Login System</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/fontawesome-free/css/all.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/admin/dist/css/adminlte.min.css'; ?>">
</head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="<?php echo base_url(); ?>" class="h1">
                        <img class="image" width="80%" src="<?php echo base_url().'assets/img/mini-full.png'; ?>">
                    </a>
                </div>
                <div class="card-body">
                    <?php
                        if($this->session->flashdata('message'))
                        {
                            ?>
                                <p class="login-box-msg"><?php echo $this->session->flashdata('message') ?></p>
                            <?php
                        }
                    ?>
                    <form method="POST" action="<?php echo base_url().'Login/cekLogin' ?>">
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" autofocus id="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" id="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" onclick="onSubmitForm()">Sign In</button>                                
                            </div>
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url().'assets/admin/plugins/jquery/jquery.min.js'; ?>"></script>
        <script src="<?php echo base_url().'assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
        <script src="<?php echo base_url().'assets/admin/dist/js/adminlte.min.js'; ?>"></script>
    </body>
</html>
