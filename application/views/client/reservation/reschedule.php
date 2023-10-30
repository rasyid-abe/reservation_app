<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3><?php echo $subtitle ?></h3><hr>
                <?php echo $this->session->flashdata('message') ?>
                <form method="post" action="<?php echo base_url('client/reservation_kl/update/'  . $row->id_reservasi) ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="kode_reservasi">Kode Reservasi</label>
                                <input type="text" name="kode_reservasi" id="kode_reservasi" class="form-control form-sm" placeholder="Kode Reservasi" value="<?php echo $row->kode_reservasi ?>" disabled>
                                <small class="text-danger"><?php echo form_error('kode_reservasi') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="full_name">Nama</label>
                                <input type="text" name="full_name" id="full_name" class="form-control form-sm" placeholder="Full Name" value="<?php echo $row->nama_klien ?>" disabled>
                                <small class="text-danger"><?php echo form_error('full_name') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="hp">Alamat</label>
                                <textarea class="form-control" name="address" rows="8" cols="60" disabled><?php echo $row->alamatklien ?></textarea>
                                <small class="text-danger"><?php echo form_error('address') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="gender">Dokter</label>
                                <select class="form-control form-sm" name="docter" id="docter" disabled>
                                    <option value=""><?php echo $row->nama_dokter ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="position">Tanggal</label>
                                <input type="date" name="date" id="position" class="form-control form-sm" value="<?php echo $row->tgl_reservasi ?>">
                                <small class="text-danger"><?php echo form_error('date') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="gender">Jam</label>
                                <select class="form-control form-sm" name="hour" id="hour" required>
                                    <option value="<?php echo $row->jam_reservasi ?>"><?php echo $row->jam_reservasi ?></option>
                                    <?php foreach ($hour as $v): ?>
                                        <option value="<?php echo $v['jam'] . ' WIB' ?>"><?php echo $v['jam'] . ' WIB' ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="position">Jumlah Klien</label>
                                <input type="number" name="qty" id="qty" class="form-control form-sm" value="<?php echo $row->jumlah_hewan ?>" disabled>
                                <small class="text-danger"><?php echo form_error('qty') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="hp">Keluhan</label>
                                <textarea class="form-control" name="keluhan" rows="8" cols="60" disabled><?php echo $row->keluhan ?></textarea>
                                <small class="text-danger"><?php echo form_error('keluhan') ?></small>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Reschedule</button>
                    <a href="<?php echo base_url('client/reservation_kl') ?>" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
