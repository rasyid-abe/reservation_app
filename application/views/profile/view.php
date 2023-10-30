<div class="card shadow-sm">
    <div class="card-header text-secondary bg-white">
        <h5 class="pt-2"><?php echo $subtitle ?></h5>
    </div>
    <div class="card-body">
        <?php echo $this->session->flashdata('message') ?>
        <form method="post" action="<?php echo base_url('profile/edit') ?>" enctype="multipart/form-data">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label for="image">Foto Profil</label><br>
                        <img src="<?= base_url() . 'themes/assets/img/profile/'. $data['image'];?>" id="preview" class="img-circle mb-1" width=150 height="150"><br>
                        <input type="file" id="file" name="file">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo $data['username'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $data['email'] ?>">
                    </div>
                </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="number_id">ID</label>
                            <?php if ($data['role_id'] == 2): ?>
                                <input type="text" name="number_id" id="number_id" class="form-control" value="<?php echo $data['kode_admin'] ?>" readonly>
                            <?php elseif ($data['role_id'] == 3): ?>
                                <input type="text" name="number_id" id="number_id" class="form-control" value="<?php echo $data['kode_dokter'] ?>" readonly>
                            <?php elseif ($data['role_id'] == 4): ?>
                                <input type="text" name="number_id" id="number_id" class="form-control" value="<?php echo $data['kode_klien'] ?>" readonly>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Nama</label>
                            <?php if ($data['role_id'] == 2): ?>
                                <?php if ($data['nama'] != null): ?>
                                    <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $data['nama'] ?>">
                                <?php else: ?>
                                    <input type="text" name="fullname" id="fullname" class="form-control">
                                <?php endif; ?>
                            <?php elseif ($data['role_id'] == 3): ?>
                                <?php if ($data['nama_dokter'] != null): ?>
                                    <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $data['nama_dokter'] ?>">
                                <?php else: ?>
                                    <input type="text" name="fullname" id="fullname" class="form-control">
                                <?php endif; ?>
                            <?php elseif ($data['role_id'] == 4): ?>
                                <?php if ($data['nama_klien'] != null): ?>
                                    <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $data['nama_klien'] ?>">
                                <?php else: ?>
                                    <input type="text" name="fullname" id="fullname" class="form-control">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="node">Jenis Kelamin</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <?php if ($data['role_id'] == 2): ?>
                                    <option value="1" <?php echo $data['jenis_kelamin'] == 1 ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="2" <?php echo $data['jenis_kelamin'] == 2 ? 'selected' : ''; ?>>Perempuan</option>
                                <?php elseif ($data['role_id'] == 3): ?>
                                    <option value="1" <?php echo $data['jenis_kelamin_dokter'] == 1 ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="2" <?php echo $data['jenis_kelamin_dokter'] == 2 ? 'selected' : ''; ?>>Perempuan</option>
                                <?php elseif ($data['role_id'] == 4): ?>
                                    <option value="1" <?php echo $data['jenis_kelamin_klien'] == 1 ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="2" <?php echo $data['jenis_kelamin_klien'] == 2 ? 'selected' : ''; ?>>Perempuan</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php if ($data['role_id'] == 4): ?>
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <?php if ($data['alamat_klien'] != null): ?>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?php echo $data['tgl_lahir_klien'] ?>">
                                <?php else: ?>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <?php if ($data['role_id'] == 4): ?>
                                <label for="fullname">Alamat</label>
                                <?php if ($data['alamat_klien'] != null): ?>
                                    <textarea name="alamat" rows="4" class="form-control" cols="80"><?php echo $data['alamat_klien'] ?></textarea>
                                <?php else: ?>
                                    <textarea name="alamat" rows="4" class="form-control" cols="80"></textarea>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <?php if ($data['role_id'] == 2): ?>
                                <label for="fullname">Jabatan</label>
                                <?php if ($data['jabatan'] != null): ?>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?php echo $data['jabatan'] ?>">
                                <?php else: ?>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <?php if ($data['role_id'] == 3): ?>
                                <label for="nohp">No. HP</label>
                                <?php if ($data['no_hp_dokter'] != null): ?>
                                    <input type="text" name="nohp" id="nohp" class="form-control" value="<?php echo $data['no_hp_dokter'] ?>">
                                <?php else: ?>
                                    <input type="text" name="nohp" id="nohp" class="form-control">
                                <?php endif; ?>
                            <?php elseif ($data['role_id'] == 4): ?>
                                <label for="nohp">No. HP</label>
                                <?php if ($data['no_hp_klien'] != null): ?>
                                    <input type="text" name="nohp" id="nohp" class="form-control" value="<?php echo $data['no_hp_klien'] ?>">
                                <?php else: ?>
                                    <input type="text" name="nohp" id="nohp" class="form-control">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <!-- <div class="form-group">
                            <?php if ($data['role_id'] == 3): ?>
                                <label for="tgl_lahir">Spesialis</label><br>
                                <div class="form-check form-check-inline">
                                <?php if ($data['spesialis'] != null): ?>
                                    <?php foreach ($sp as $v): ?>
                                        <input class="form-check-input" name="sp[]" type="checkbox" id="sp<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>" <?php echo in_array($v['id'], json_decode($data['spesialis'])) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="sp<?php echo $v['id'] ?>"><?php echo $v['spesialis'] ?></label>&nbsp;&nbsp;&nbsp;
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <?php foreach ($sp as $v): ?>
                                        <input class="form-check-input" name="sp[]" type="checkbox" id="sp<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>">
                                        <label class="form-check-label" for="sp<?php echo $v['id'] ?>"><?php echo $v['spesialis'] ?></label>&nbsp;&nbsp;&nbsp;
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div> -->
                        <div class="form-group">
                            <?php if ($data['role_id'] == 3): ?>
                                <label for="tgl_lahir">Hari Praktek</label><br>
                                <div class="form-check form-check-inline">
                                <?php if ($data['days'] != null): ?>
                                    <?php foreach ($days as $v): ?>
                                        <input class="form-check-input" name="days[]" type="checkbox" id="days<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>" <?php echo in_array($v['id'], json_decode($data['hari_praktek'])) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="days<?php echo $v['id'] ?>"><?php echo $v['hari'] ?></label>&nbsp;&nbsp;&nbsp;
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <?php foreach ($days as $v): ?>
                                        <input class="form-check-input" name="days[]" type="checkbox" id="days<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>">
                                        <label class="form-check-label" for="days<?php echo $v['id'] ?>"><?php echo $v['hari'] ?></label>&nbsp;&nbsp;&nbsp;
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-check"></i> Simpan</button>
        </div>
    </form>
</div>
