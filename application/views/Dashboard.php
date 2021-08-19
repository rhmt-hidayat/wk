<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0"><?php echo $judul; ?></h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <?php
                        $this->load->view('Include/error');
                    ?>
                    <div class="row">
                        <div class="col-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <img src="<?php echo base_url().'assets/img/file-download.png'; ?>" class="img-fluid img-thumbnail rounded mx-auto d-block">
                                </div>
                                <div class="card-footer" style="text-align: center; font-size:x-large;">
                                    DOCUMENT IN
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <img src="<?php echo base_url().'assets/img/file-upload.png'; ?>" class="img-fluid img-thumbnail rounded mx-auto d-block">
                                </div>
                                <div class="card-footer" style="text-align: center; font-size:x-large;">
                                    DOCUMENT OUT
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <img src="<?php echo base_url().'assets/img/management.png'; ?>" class="img-fluid img-thumbnail rounded mx-auto d-block">
                                </div>
                                <div class="card-footer" style="text-align: center; font-size:x-large;">
                                    DOCUMENT MANAGEMENT
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>