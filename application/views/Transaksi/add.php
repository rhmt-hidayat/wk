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
                            <form action="<?php echo base_url('Transaksi/insert'); ?>" method="POST" id="simpan">
                                <div class="card-header">
                                    <a href="<?php echo base_url().'Transaksi'; ?>" class="btn btn-flat btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                                    <button type="submit" name="submit" value="1" class="btn btn-success btn-flat"><i class="fas fa-save"></i> Save & Close</button>
                                    <button type="submit" name="submit" value="0" class="btn btn-success btn-flat"><i class="fas fa-save"></i> Save & New</button>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Working Ticket No.</label>
                                                <input type="text" name="kode" value="<?php echo $kode; ?>" class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Working Ticket Date</label>
                                                <input type="date" name="tanggal" class="form-control datepicker-days" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Process Name</label>
                                                <select name="proses" id="proses" class="form-control select2bs4" required>
                                                    <option value="">-- Select Process Name --</option>
                                                    <?php
                                                        foreach($dept as $dept)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $dept->FItemID; ?>"><?php echo $dept->FName; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Select MO</label>
                                                <select name="mo" id="mo" class="form-control select2bs4" required>
                                                    <option value="">-- Select MO No</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Batch No.</label>
                                                <input type="text" name="batch" id="batch" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">MO Planed Date</label>
                                                <input type="text" name="planed" id="planed" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Part No</label>
                                                <input type="text" name="part" id="part" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Qty Planned</label>
                                                <input type="text" name="qty_planed" id="qty_planed" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Shift Capacity</label>
                                                <input type="number" name="capacity" id="capacity" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label">Machine No.</label>
                                                <input type="text" name="machine" id="machine" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Operator Name</label>
                                                <select name="operator" class="form-control select2bs4" required>
                                                    <option value="">-- Select Operator --</option>
                                                    <?php
                                                        foreach($karyawan as $k)    
                                                        {
                                                            ?>
                                                                <option value="<?php echo $k->NIK; ?>"><?php echo $k->nama; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Shift</label>
                                                <select name="shift" class="form-control select2bs4" required>
                                                    <option value="">-- Select Shift --</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Qualified Qty</label>
                                                <input type="number" name="qty_qualified" id="qty_qualified" class="form-control" required onchange="hasil()">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="theoretic">Theoretic working hour</label>
                                                <input type="text" name="theoretic" id="theoretic" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <label class="control-label">Actual Working Hour</label>
                                                        <input type="text" name="actual" id="actual" class="form-control" onchange="resultWorking()">
                                                    </div>
                                                    <div class="col-4">
                                                    <label class="control-label">Status</label>
                                                        <select name="status" class="form-control select2bs4" required>
                                                            <option value="">-- Select Status --</option>
                                                            <option value="1">Open</option>
                                                            <!-- <option value="2">On Progress</option>
                                                            <option value="3">Monitoring</option> -->
                                                            <option value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Reason Extra Working Hour</label>
                                                <select name="reason[]" id="reason" multiple class="form-control select2bs4">
                                                    <option value="">--  Select Option --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>