<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h3><?php echo $subtitle ?></h3><hr>
                <form method="post" action="<?php echo base_url('root/hour/update/'  . $row->id) ?>" enctype="multipart/form-data">
                    <?php echo $this->session->flashdata('message') ?>
                    <div class="form-group">
                        <label for="jam">Spesialis</label>
                        <input type="text" name="jam" id="jam" class="form-control form-sm" placeholder="" value="<?php echo $row->jam ?>">
                        <small class="text-danger"><?php echo form_error('jam') ?></small>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Ubah</button>
                    <a href="<?php echo base_url('root/hour') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
