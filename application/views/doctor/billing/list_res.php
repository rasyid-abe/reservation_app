<div class="card mb-4">
    <form class="" action="<?php echo base_url('doctor/reservation_doc/check_ids') ?>" method="post">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="titll">
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $subtitle ?>
                </div>
                <div class="button">
                </div>
            </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php echo $this->session->flashdata('message') ?>
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Aksi</th>
                        <th class="text-center">ID Reservasi</th>
                        <th class="text-left">Nama Klien</th>
                        <th class="text-center">Tanggal-Jam</th>
                        <th class="text-center">Keluhan</th>
                        <th class="text-center">Jumlah Hewan</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $v):
                        if ($v['status'] == 0) {
                            $l = "<span class='text-secondary'>Menunggu</span>";
                        } elseif ($v['status'] == 1) {
                            $l = "<span class='text-success'>Disetujui</span>";
                        } elseif ($v['status'] == 2) {
                            $l = "<span class='text-warning'>Ditolak</span>";
                        } else {
                            $l = "<span class='text-danger'>Dibatalkan</span>";
                        }
                        ?>
                        <tr>
                            <td class="text-center">
                                <a href="<?php echo base_url('doctor/billing_doc/store/' . $v['id_reservasi']) ?>" class="btn btn-sm btn-warning"></i>Proses Biling</a>
                            </td>
                            <td class="text-center"><?php echo $v['kode_reservasi'] ?></td>
                            <td><?php echo $v['nama_klien'] ?></td>
                            <td class="text-center"><?php echo $v['tgl_reservasi'] .'  '. $v['jam_reservasi'] ?></td>
                            <td><?php echo $v['keluhan'] ?></td>
                            <td class="text-center"><?php echo $v['jumlah_hewan'] ?></td>
                            <td class="text-center"><?php echo $l ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
$("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});

</script>
