<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h3><?php echo $subtitle ?></h3><hr>
                <form method="post" action="<?php echo base_url('root/user_admin/update/'  . $row->id_user) ?>" enctype="multipart/form-data">
                    <?php echo $this->session->flashdata('message') ?>
                    <div class="form-group">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" name="full_name" id="full_name" class="form-control form-sm" placeholder="Full Name" value="<?php echo $row->nama ?>">
                        <small class="text-danger"><?php echo form_error('full_name') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-sm" placeholder="Username" value="<?php echo $row->username ?>">
                        <small class="text-danger"><?php echo form_error('username') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control form-sm" name="gender" id="gender" required>
                            <option value="">- Pilih Jenis Kelamin -</option>
                            <option value="1" <?php echo $row->jenis_kelamin == 1 ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="2" <?php echo $row->jenis_kelamin == 2 ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-sm" placeholder="Email" value="<?php echo $row->email ?>">
                        <small class="text-danger"><?php echo form_error('email') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="position">Jabatan</label>
                        <input type="text" name="position" id="position" class="form-control form-sm" placeholder="Position" value="<?php echo $row->jabatan ?>">
                        <small class="text-danger"><?php echo form_error('position') ?></small>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Ubah</button>
                    <a href="<?php echo base_url('root/user_admin') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
