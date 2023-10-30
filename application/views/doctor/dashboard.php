<div class="row">
    <div class="col-sm-4">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body text-right"> <h2><?php echo $client ?></h2> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('doctor/user_client_doc') ?>">Total Klien Saya</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card bg-info text-white mb-4">
            <div class="card-body text-right"> <h2><?php echo $reservasi ?></h2> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('doctor/reservation_doc') ?>">Total Reservasi Saya</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body text-right"> <h2><?php echo $billing ?></h2> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('doctor/billing_doc') ?>">Total Biling Saya</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area mr-1"></i>
                Jadwal Saya
            </div>
            <div class="card-body" style="min-height: 282px;">
                <?php if ($jadwal != null): ?>
                    <br>
                    <br>
                    <table>
                        <tr>
                            <td>Kode Reservasi</td>
                            <td>:</td>
                            <th><?php echo $jadwal->kode_reservasi ?></th>
                        </tr>
                        <tr>
                            <td>Nama Klien</td>
                            <td>:</td>
                            <th><?php echo $jadwal->namaklien ?></th>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <th><?php echo format_indo($jadwal->tgl_reservasi) ?></th>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td>:</td>
                            <th><?php echo $jadwal->jam_reservasi ?></th>
                        </tr>
                        <tr>
                            <td>Jumlah Hewan</td>
                            <td>:</td>
                            <th><?php echo $jadwal->jumlah_hewan ?></th>
                        </tr>
                        <tr>
                            <td>Keluhan</td>
                            <td>:</td>
                            <th><?php echo $jadwal->keluhan ?></th>
                        </tr>
                    </table>
                    <?php else: ?>
                        <h5>Belum ada jadwal.</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="<?= base_url() . 'themes/assets/img/profile/'. $profile['image'];?>" id="preview" class="img-circle mb-1" width=200 height="200">
                <br>
                <br>
                <h4><?php echo $profile['nama_dokter'] ?></h4>
                <h6><?php echo $profile['kode_dokter'] ?></h6>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        History
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Aktivitas</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($history as $v): ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $v->waktu ?></td>
                            <td><?php echo $v->aktivitas ?></td>
                            <td><?php echo $v->keterangan ?></td>
                        </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
