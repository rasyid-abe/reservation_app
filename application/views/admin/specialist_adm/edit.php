<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h3><?php echo $subtitle ?></h3><hr>
                <form method="post" action="<?php echo base_url('admin/specialist_adm/update/'  . $row->id) ?>" enctype="multipart/form-data">
                    <?php echo $this->session->flashdata('message') ?>
                    <div class="form-group">
                        <label for="spesialis">Spesialis</label>
                        <input type="text" name="spesialis" id="spesialis" class="form-control form-sm" placeholder="Spesialis" value="<?php echo $row->spesialis ?>">
                        <small class="text-danger"><?php echo form_error('spesialis') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control form-sm" placeholder="Keterangan" value="<?php echo $row->keterangan ?>">
                        <small class="text-danger"><?php echo form_error('keterangan') ?></small>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Ubah</button>
                    <a href="<?php echo base_url('admin/specialist_adm') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
