<div class="card shadow-sm">
    <div class="card-header text-secondary bg-white">
        <h5 class="pt-2"><?php echo $subtitle ?></h5>
    </div>
    <div class="card-body">
        <?php echo $this->session->flashdata('message') ?>
        <form method="post" action="<?php echo base_url('profile/password') ?>" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="for_name">Current Password</label>
                    <input type="password" name="old_password" id="for_name" class="form-control">
                    <small class="text-danger"><?php echo form_error('old_password') ?></small>
                </div>
                <div class="form-group">
                    <label for="for_url">New Password</label>
                    <input type="password" name="password" id="for_url" class="form-control">
                    <small class="text-danger"><?php echo form_error('password') ?></small>
                </div>
                <div class="form-group">
                    <label for="for_company">Repeat Passwod</label>
                    <input type="password" name="repassword" id="for_company" class="form-control">
                    <small class="text-danger"><?php echo form_error('repassword') ?></small>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Simpan</button>
        </div>
    </form>
</div>
