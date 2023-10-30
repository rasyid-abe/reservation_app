<div class="col-lg-5">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header text-center">
            <img src="<?= base_url('themes/assets/img/logo.jpg')?>" id="preview" class="img-circle mb-1" width=200 height="200">
            <h3 class="text-center font-weight-light my-4">Login Disini</h3>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata('message') ?>
            <form action="<?= base_url('auth') ?>" method="post" autocomplete="off">
                <div class="form-group">
                    <label class="small mb-1">Username</label>
                    <input type="text" class="form-control"  name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username') ?>">
                    <small class="text-danger"><?php echo form_error('username') ?></small>
                </div>
                <div class="form-group">
                    <label class="small mb-1" for="inputPassword">Password</label>
                    <input type="password" class="form-control" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="<?= base_url('auth/forgot_password') ?>">Lupa Password?</a>
                    <button type="submit" id="sendlogin" class="btn btn-primary submit-btn">Login</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <div class="small"><a href="<?= base_url('auth/registration') ?>">Registrasi Akun Disini</a></div>
        </div>
    </div>
</div>
