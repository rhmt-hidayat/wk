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
                            <form action="<?php echo base_url('Transaksi/update'); ?>" method="POST" id="simpan">
                                <div class="card-header">
                                    <a href="<?php echo base_url().'Transaksi'; ?>" class="btn btn-flat btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                                    <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i> Save & Close</button>
                                    <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i> Save & New</button>
                                    <button type="submit" form="simpan" class="btn btn-default">simpan ke database</button>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Working Ticket No.</label>
                                                <input type="text" name="kode" value="<?php echo $edit['WT_no'] ?>" class="form-control" readonly>
                                                <input type="hidden" name="id" value="<?php echo $edit['id'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Working Ticket Date</label>
                                                <input type="date" name="tanggal" value="<?php echo $edit['WT_date'] ?>" class="form-control datepicker-days" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Process Name</label>
                                                <select name="proses" id="proses" class="form-control select2bs4" required>
                                                    <option value="">-- Select Process Name --</option>
                                                    <?php
                                                        foreach($dept as $dept)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $dept->FItemID; ?>" <?php if($edit['proses_name'] == $dept->FItemID){ ?> selected <?php } ?>><?php echo $dept->FName; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Select MO</label>
                                                <select name="mo" id="mo" class="form-control select2bs4" required>
                                                    <option value="">-- Select MO No</option>
                                                    <?php
                                                        foreach($icmo as $icmo)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $icmo->FBillNo; ?>" <?php if($edit['MO_no'] == $icmo->FBillNo){ ?> selected <?php } ?>><?php echo $icmo->FBillNo; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Batch No.</label>
                                                <input type="text" name="batch" id="batch" value="<?php echo $edit['batch_no'] ?>" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">MO Planed Date</label>
                                                <input type="text" name="planed" id="planed" value="<?php echo $edit['MO_date'] ?>" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Part No</label>
                                                <input type="text" name="part" id="part" value="<?php echo $edit['part_no'] ?>" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Qty Planned</label>
                                                <input type="text" name="qty_planed" id="qty_planed" value="<?php echo $edit['qty_planed'] ?>" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Shift Capacity</label>
                                                <input type="number" name="capacity" id="capacity" value="<?php echo $edit['shiftcapacity'] ?>" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label">Machine No.</label>
                                                <input type="text" name="machine" id="machine" value="<?php echo $edit['machine_no'] ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Operator Name</label>
                                                <select name="operator" class="form-control select2bs4" required>
                                                    <option value="">-- Select Operator --</option>
                                                    <?php
                                                        foreach($karyawan as $k)    
                                                        {
                                                            ?>
                                                                <option value="<?php echo $k->NIK; ?>" <?php if($edit['operator_name'] == $k->NIK){ ?> selected <?php } ?>><?php echo $k->nama; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Shift</label>
                                                <select name="shift" class="form-control select2bs4" required>
                                                    <option value="">-- Select Shift --</option>
                                                    <option value="A" <?php if($edit['shift'] == 'A'){ ?> selected <?php } ?>>A</option>
                                                    <option value="B" <?php if($edit['shift'] == 'B'){ ?> selected <?php } ?>>B</option>
                                                    <option value="C" <?php if($edit['shift'] == 'C'){ ?> selected <?php } ?>>C</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Qualified Qty</label>
                                                <input type="number" name="qty_qualified" id="qty_qualified" value="<?php echo $edit['qty_qualified'] ?>" class="form-control" required onchange="hasil()">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="theoretic">Theoretic working hour</label>
                                                <input type="text" name="theoretic" id="theoretic" value="<?php echo $edit['theoretic'] ?>" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <label class="control-label">Actual Working Hour</label>
                                                        <input type="text" name="actual" id="actual" value="<?php echo $edit['actual'] ?>" class="form-control" onchange="resultEditWorking()">
                                                    </div>
                                                    <div class="col-4">
                                                    <label class="control-label">Status</label>
                                                        <select name="status" class="form-control select2bs4" required>
                                                            <option value="">-- Select Status --</option>
                                                            <option value="1" <?php if($edit['status'] == '1'){ ?> selected <?php } ?>>Open</option>
                                                            <!-- <option value="2" <?php if($edit['status'] == '2'){ ?> selected <?php } ?>>On Progress</option>
                                                            <option value="3" <?php if($edit['status'] == '3'){ ?> selected <?php } ?>>Monitoring</option> -->
                                                            <option value="0" <?php if($edit['status'] == '0'){ ?> selected <?php } ?>>Close</option>
                                                        </select>
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Reason Extra Working Hour</label>
                                                <select name="reason[]" id="reason" multiple class="form-control select2bs4">
                                                    <option value="">
                                                        Select Reason
                                                    </option>
                                                    <?php
                                                        $data = str_replace('"','',$edit['reason']); 
                                                        $data1 = str_replace('\\','',$data); 
                                                        $data2 = explode(',', $data1);
                                                        foreach($alasan as $asn)
                                                        {
                                                            foreach($data2 as $xx)
                                                            {
                                                                $idReason = $xx;
                                                                ?>
                                                                    <option value="<?php echo $asn->id; ?>" <?php if($asn->id == $idReason){ ?> selected <?php } ?>><?php echo $asn->deskripsi; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    
                                                    ?>
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

    <script>
        //Edit Transaksi
        $(document).ready(function(){
            $('#proses').change(function(){
                var FItemID= $(this).val();
                // alert(FItemID);
                $.ajax({
                    url : '<?php echo base_url("Transaksi/getMo"); ?>',
                    method : "POST",
                    data : {FItemID: FItemID},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].FBillNo+'>'+data[i].FBillNo+'</option>';
                        }
                        $('#mo').html(html);

                    }
                });
                return false;
            }); 
            
        });

        //Pilih MO (FBillNo)
        $(document).ready(function(){
            $('#mo').change(function(){ 
            var id = $(this).val();
            // alert(id);
            $.ajax({
                url : '<?php echo base_url("Transaksi/getDataMo"); ?>',
                method : "POST",
                data : {id: id},
                async : true,
                dataType : "json",
                success: function(data){
                    $('#batch').val(data.lot);
                    $('#planed').val(data.tanggal);
                    $('#part').val(data.FNumber);
                    $('#qty_planed').val(data.qty);
                    $('#capacity').val(data.shiftcapacity);
                    $('#machine').val(data.mesin);
                },
                error: function(data){
                    console.log('Error', data);
                }
            });
            return false;
        });    
        });

        //Menghitung theoretic WH
        function hasil()
        {
            var data1 = $('#qty_qualified').val();
            var data2 = $('#capacity').val();
            var process = $('#proses').val();
            if(process == '135') 
            {
                var result = (data1/data2) * 8;
                result = result.toFixed(2);
                $('#theoretic').val(result);
            }
            else if(process == '2886')
            {
                var result = (data1/data2) * 7;
                result = result.toFixed(2);
                $('#theoretic').val(result);
            }
            else if(process == '136')
            {
                var result = (data1/data2) * 7;
                result = result.toFixed(2);
                $('#theoretic').val(result);
            }       
        }

        function resultEditWorking()
        {
            var data1 = $('#theoretic').val();
            var data2 = $('#actual').val();
            var result;

            result = data2 - data1;
            // alert(result);
            if(result > 0){
                $.ajax({
                    url : '<?php echo base_url("Transaksi/getReason"); ?>',
                    method : "POST",
                    // data : {FItemID: FItemID},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id+'>'+data[i].deskripsi+'</option>';
                        }
                        $('#reason').html(html);
                    }
                });
            }
            else
            {
                var html = '';
                html += '<option>-- TIDAK ADA REASON --</option>';
                $('#reason').html(html);
            }
        }
    </script>