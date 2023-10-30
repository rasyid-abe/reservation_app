<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3><?php echo $subtitle ?></h3><hr>
                <?php echo $this->session->flashdata('message') ?>
                <form method="post" action="<?php echo base_url('client/reservation_kl/add') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="full_name">Nama</label>
                                <input type="text" name="full_name" id="full_name" class="form-control form-sm" placeholder="Full Name" value="<?php echo set_value('full_name') ?>">
                                <small class="text-danger"><?php echo form_error('full_name') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="hp">Alamat</label>
                                <textarea class="form-control" name="address" rows="8" cols="60"><?php echo set_value('address') ?></textarea>
                                <small class="text-danger"><?php echo form_error('address') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="gender">Dokter</label>
                                <select class="form-control form-sm" name="docter" id="docter" required>
                                    <option value="">- Pilih Dokter -</option>
                                    <?php foreach ($doctor as $v): ?>
                                        <option value="<?php echo $v['id_dokter'] ?>"><?php echo $v['nama_dokter'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="position">Tanggal</label>
                                <input type="date" name="date" id="position" class="form-control form-sm" value="<?php echo set_value('date') ?>">
                                <small class="text-danger"><?php echo form_error('date') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="gender">Jam</label>
                                <select class="form-control form-sm" name="hour" id="hour" required>
                                    <option value="">- Pilih JAM -</option>
                                    <?php foreach ($hour as $v): ?>
                                        <option value="<?php echo $v['jam'] . ' WIB' ?>"><?php echo $v['jam'] . ' WIB' ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="position">Jumlah Klien</label>
                                <input type="number" name="qty" id="qty" class="form-control form-sm" value="<?php echo set_value('qty') ?>">
                                <small class="text-danger"><?php echo form_error('qty') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="hp">Keluhan</label>
                                <textarea class="form-control" name="keluhan" rows="8" cols="60"><?php echo set_value('keluhan') ?></textarea>
                                <small class="text-danger"><?php echo form_error('keluhan') ?></small>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                    <a href="<?php echo base_url('client/reservation_kl') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
