<div class="col-lg-5">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header text-center">
            <img src="<?= base_url('themes/assets/img/logo.jpg')?>" id="preview" class="img-circle mb-1" width=200 height="200">
            <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
        </div>
        <div class="card-body">
            <div class="small mb-3 text-muted">Change your password here.</div>
            <?php echo $this->session->flashdata('message') ?>
            <form action="<?php echo base_url('auth/change_password') ?>" method="post">
                <div class="form-group">
                    <label class="small mb-1">Username</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="small mb-1">Retype Password</label>
                    <input type="password" name="repassword" class="form-control" placeholder="Retype password">
                    <small class="text-danger"><?php echo form_error('password') ?></small>
                </div>
                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="<?= base_url('auth') ?>">Return to login</a>
                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <div class="small"><a href="<?= base_url('auth/registration') ?>">Need an account? Sign up!</a></div>
        </div>
    </div>
</div>
