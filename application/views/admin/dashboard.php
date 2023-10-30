<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body text-right"> <h2><?php echo $client ?></h2> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('admin/user_client_adm') ?>">Total Klien</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body text-right"><h2><?php echo $doctor ?></h2></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('admin/user_doctor_adm') ?>">Total Dokter</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white mb-4">
            <div class="card-body text-right"><h2><?php echo $reservasi ?></h2></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('admin/reservation_adm') ?>">Total Reservasi</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body text-right"><h2><?php echo $biling ?></h2></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url('admin/billing_adm') ?>">Total Biling</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area mr-1"></i>
                Cek Kode Reservasi
            </div>
            <div class="card-body">
                <?php echo $this->session->flashdata('message') ?>
                <form method="post" action="<?php echo base_url('admin/home_adm/check_reservasi') ?>">
                    <div class="form-group">
                        <label for="id_reservasi">Kode Reservasi</label>
                        <input type="text" class="form-control" name="id_reservasi" id="id_reservasi" placeholder="Masukkan Kode Reservasi">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div> -->
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
