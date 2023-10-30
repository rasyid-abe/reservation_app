<div class="card mb-4">
    <form class="" action="<?php echo base_url('admin/user_client_adm/check_ids') ?>" method="post">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="titll">
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $subtitle ?>
                </div>
                <div class="button">
                    <!-- <input type="submit" name="actionBtn" value="Aktifkan" class="btn btn-sm btn-success">
                    <input type="submit" name="actionBtn" value="Nonaktifkan" class="btn btn-sm btn-dark">
                    <input type="submit" onclick="return confirm('Anda yakin menghapus data ini?');" name="actionBtn" value="Hapus" class="btn btn-sm btn-danger">
                    <a href="<?php echo base_url('admin/user_client_adm/add') ?>" class="btn btn-sm btn-info">Tambah client</a> -->
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
                        <th class="text-center">Nomor ID</th>
                        <th class="text-left">Nama Lengkap</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">HP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $v): ?>
                        <tr>
                            <td class="text-center">
                                <a href="<?php echo base_url('doctor/user_client_doc/detail/' . $v['id_user']) ?>" class="btn btn-sm btn-info"></i>Detail</a>
                            </td>
                            <td class="text-center"><?php echo $v['kode_klien'] ?></td>
                            <td><?php echo $v['nama_klien'] ?></td>
                            <td class="text-center"><?php echo $v['jenis_kelamin_klien']  > 1 ? 'Perampuan' : 'Laki-laki'  ?></td>
                            <td><?php echo $v['alamat_klien'] ?></td>
                            <td><?php echo $v['no_hp_klien'] ?></td>
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
