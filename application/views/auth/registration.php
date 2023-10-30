<div class="col-lg-7">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header text-center">
            <img src="<?= base_url('themes/assets/img/logo.jpg')?>" id="preview" class="img-circle mb-1" width=200 height="200">
            <h3 class="text-center font-weight-light my-4">Registrasi Akun</h3>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('message') ?>
            <form action="<?php echo base_url('auth/registration') ?>" method="post">
                <div class="form-group">
                    <label class="small mb-1" for="inputEmailAddress">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username') ?>">
                    <small class="text-danger"><?php echo form_error('username') ?></small>
                </div>
                <div class="form-group">
                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>">
                    <small class="text-danger"><?php echo form_error('email') ?></small>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="inputConfirmPassword">Konfirmasi Password</label>
                            <input type="password" name="repassword" class="form-control" placeholder="Ulangi password">
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary submit-btn">Register</button></div>
            </form>
        </div>
        <div class="card-footer text-center">
            <div class="small"><a href="<?= base_url('auth') ?>">Sudah punya Akun? Login Disini</a></div>
        </div>
    </div>
</div>
