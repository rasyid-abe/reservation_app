<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <h3><?php echo $subtitle ?></h3><hr>
                <form method="post" action="<?php echo base_url('root/user_doctor/update/'  . $row->id_user) ?>" enctype="multipart/form-data">
                    <?php echo $this->session->flashdata('message') ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="full_name">Nama Lengkap</label>
                                <input type="text" name="full_name" id="full_name" class="form-control form-sm" placeholder="Full Name" value="<?php echo $row->nama_dokter ?>">
                                <small class="text-danger"><?php echo form_error('full_name') ?></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control form-sm" placeholder="Username" value="<?php echo $row->username ?>">
                                <small class="text-danger"><?php echo form_error('username') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control form-sm" name="gender" id="gender" required>
                                    <option value="">- Pilih Jenis Kelamin -</option>
                                    <option value="1" <?php echo $row->jenis_kelamin_dokter == 1 ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="2" <?php echo $row->jenis_kelamin_dokter == 2 ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-sm" placeholder="Email" value="<?php echo $row->email ?>">
                                <small class="text-danger"><?php echo form_error('email') ?></small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email">No HP</label>
                                <input type="text" name="hp" id="hp" class="form-control form-sm" placeholder="No HP" value="<?php echo $row->no_hp_dokter ?>">
                                <small class="text-danger"><?php echo form_error('hp') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Hari Praktek</label><br>
                        <div class="form-check form-check-inline">
                            <?php foreach ($days as $v): ?>
                                <input class="form-check-input" name="days[]" type="checkbox" id="days<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>" <?php echo in_array($v['id'], json_decode($row->hari_praktek)) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="days<?php echo $v['id'] ?>"><?php echo $v['hari'] ?></label>&nbsp;&nbsp;&nbsp;
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Ubah</button>
                    <a href="<?php echo base_url('root/user_doctor') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
