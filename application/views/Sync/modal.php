<div class="modal fade" id="kriteria" tabindex="-1" role="document" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?php echo base_url().'Sync/getData'; ?>">
                <div class="modal-header">
                    <h4>Select Criteria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
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

                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-flat float-right"><i class="fas fa-download"></i> Load Data</button>
                </div>
            </form>
        </div>
    </div>
</div>