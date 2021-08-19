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
                        <div class="col-12">
                            <div class="card">
                                <form method="POST" action="<?php echo base_url().'Sync/getData'; ?>" >
                                    <div class="card-header">
                                        <h5 class="card-title">Select Manufacturing Order Date Ranges</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <label class="control-label">From Date</label>
                                                <input type="date" name="tgl_mulai" class="form-control" placeholder="First name">
                                            </div>
                                            <div class="col">
                                                <label class="control-label">To Date</label>
                                                <input type="date" name="tgl_selesai" class="form-control" placeholder="Last name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-flat btn-success"><i class="fas fa-download"></i> Load Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <form method="POST" action="<?php echo base_url().'Sync/loadMaterial' ?>">
                                    <div class="card-header">
                                        Sync Material Data From K3
                                    </div>

                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-sync"></i> Sync Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <form method="POST" action="<?php echo base_url().'Sync/loadDept' ?>">
                                    <div class="card-header">
                                        Sync Department Data From K3
                                    </div>

                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-sync"></i> Sync Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>