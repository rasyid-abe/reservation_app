<div class="col-lg-5">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header text-center">
            <img src="<?= base_url('themes/assets/img/logo.jpg')?>" id="preview" class="img-circle mb-1" width=200 height="200">
            <h3 class="text-center font-weight-light my-4">Pemulihan Password</h3>
        </div>
        <div class="card-body">
            <div class="small mb-3 text-muted">Masukkan username dan alamat email anda. Kami akan mengirimkan link untuk mengubah password anda.</div>
            <?php echo $this->session->flashdata('message') ?>
            <form action="<?php echo base_url('auth/forgot_password') ?>" method="post">
                <div class="form-group">
                    <label class="small mb-1">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username') ?>">
                    <small class="text-danger"><?php echo form_error('username') ?></small>
                </div>
                <div class="form-group">
                    <label class="small mb-1">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>">
                    <small class="text-danger"><?php echo form_error('email') ?></small>
                </div>
                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="<?= base_url('auth') ?>">Kembali ke login</a>
                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <div class="small"><a href="<?= base_url('auth/registration') ?>">Registrasi Akun Disini</a></div>
        </div>
    </div>
</div>
