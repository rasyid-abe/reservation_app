<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3><?php echo $subtitle ?></h3><hr>
                <?php echo $this->session->flashdata('message') ?>
                <form method="post" action="<?php echo base_url('admin/user_client_adm/update/'  . $row->id_user) ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="full_name">Nama Lengkap</label>
                                <input type="text" name="full_name" id="full_name" class="form-control form-sm" placeholder="Full Name" value="<?php echo $row->nama_klien ?>">
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
                                    <option value="1" <?php echo $row->jenis_kelamin_klien == 1 ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="2" <?php echo $row->jenis_kelamin_klien == 2 ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="position">Tanggal Lahir</label>
                                <input type="date" name="date" id="position" class="form-control form-sm" value="<?php echo $row->tgl_lahir_klien ?>">
                                <small class="text-danger"><?php echo form_error('date') ?></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-sm" placeholder="Email" value="<?php echo $row->email ?>">
                                <small class="text-danger"><?php echo form_error('email') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="hp">No HP</label>
                                <input type="text" name="hp" id="hp" class="form-control form-sm" placeholder="Handphone" value="<?php echo $row->no_hp_klien ?>">
                                <small class="text-danger"><?php echo form_error('hp') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="hp">Alamat</label>
                                <textarea class="form-control" name="address" rows="8" cols="60"><?php echo $row->alamat_klien ?></textarea>
                                <small class="text-danger"><?php echo form_error('address') ?></small>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Ubah</button>
                    <a href="<?php echo base_url('admin/user_client_adm') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
