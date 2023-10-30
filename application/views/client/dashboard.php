<div class="row">
    <div class="col-xl-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area mr-1"></i>
                Reservasi
            </div>
            <div class="card-body" style="min-height: 250px;">
                <br>
                <br>
                <a href="<?php echo base_url('client/reservation_kl/add') ?>" class="btn btn-xl btn-block btn-primary">Reservasi</a>
                <p class="text-center">Klik disini untuk memulai perawatan atau pemeriksaan</p>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar mr-1"></i>
                Jadwal Saya
            </div>
            <div class="card-body" style="min-height: 250px;">
                <?php if ($jadwal != null): ?>
                    <table>
                        <tr>
                            <td>Kode Reservasi</td>
                            <td>:</td>
                            <th><?php echo $jadwal->kode_reservasi ?></th>
                        </tr>
                        <tr>
                            <td>Nama Dokter</td>
                            <td>:</td>
                            <th><?php echo $jadwal->nama_dokter ?></th>
                        </tr>
                        <tr>
                            <td>Kode Dokter</td>
                            <td>:</td>
                            <th><?php echo $jadwal->kode_dokter ?></th>
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
