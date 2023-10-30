<div class="card mb-4">
    <form class="" action="<?php echo base_url('doctor/billing_doc/check_ids') ?>" method="post">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="titll">
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $subtitle ?>
                </div>
                <div class="button">
                    <a href="<?php echo base_url('doctor/billing_doc/reservasi') ?>" class="btn btn-sm btn-info">Input Biling</a>
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
                        <th class="text-center">ID Biling</th>
                        <th class="text-left">Nama Klien</th>
                        <th class="text-center">Keluhan</th>
                        <th class="text-center">Diagnosa</th>
                        <th class="text-center">Jumlah Hewan</th>
                        <th class="text-center">Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $v):?>
                        <tr>
                            <td class="text-center">
                                <a href="<?php echo base_url('doctor/billing_doc/detail/' . $v['id_biling']) ?>" class="btn btn-sm btn-info"></i>Detail</a>
                                <a href="<?php echo base_url('doctor/billing_doc/edit/' . $v['id_biling']) ?>" class="btn btn-sm btn-warning"></i>Edit</a>
                            </td>
                            <td class="text-center"><?php echo $v['kode_biling'] ?></td>
                            <td><?php echo $v['nama_klien'] ?></td>
                            <td ><?php echo $v['keluhan'] ?></td>
                            <td ><?php echo $v['diagnosa'] ?></td>
                            <td class="text-center"><?php echo $v['jumlah_hewan'] ?></td>
                            <td class="text-right"><?php echo rupiah($v['biaya']) ?></td>
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
