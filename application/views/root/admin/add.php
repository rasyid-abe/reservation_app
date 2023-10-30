<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h3><?php echo $subtitle ?></h3><hr>
                <form method="post" action="<?php echo base_url('root/user_admin/add') ?>" enctype="multipart/form-data">
                    <?php echo $this->session->flashdata('message') ?>
                    <!-- <div class="form-group">
                        <label for="id_number">Nomor ID</label>
                        <input type="text" name="id_number" id="id_number" class="form-control form-sm" placeholder="ID Number" value="<?php echo set_value('id_number') ?>">
                        <small class="text-danger"><?php echo form_error('id_number') ?></small>
                    </div> -->
                    <div class="form-group">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" name="full_name" id="full_name" class="form-control form-sm" placeholder="Full Name" value="<?php echo set_value('full_name') ?>">
                        <small class="text-danger"><?php echo form_error('full_name') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-sm" placeholder="Username" value="<?php echo set_value('username') ?>">
                        <small class="text-danger"><?php echo form_error('username') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control form-sm" name="gender" id="gender" required>
                            <option value="">- Pilih Jenis Kelamin -</option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-sm" placeholder="Email" value="<?php echo set_value('email') ?>">
                        <small class="text-danger"><?php echo form_error('email') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="position">Jabatan</label>
                        <input type="text" name="position" id="position" class="form-control form-sm" placeholder="Jabatan" value="<?php echo set_value('position') ?>">
                        <small class="text-danger"><?php echo form_error('position') ?></small>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                    <a href="<?php echo base_url('root/user_admin') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
