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
                <?php
                    $this->load->view('Include/error');
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form method="POST" action="<?php echo base_url().'Working/result'; ?>">
                                <div class="card-header">
                                    <strong>.:: Filter Data ::.</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="control-label"><i class="fa fa-calendar fa-fw"></i>From Date :</label>
                                            <input type="date" name="tgl_awal" class="form-control" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="control-label">To Date :</label>
                                            <input type="date" name="tgl_akhir" class="form-control" required>
                                        </div>
                                    </div>
                                </div>      
                                <div class="card-footer">
                                    <button type="submit" id="tampil" class="btn btn-success btn-flat">Cari <i class="fa fa-search fa-fw"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </section>
        </div>