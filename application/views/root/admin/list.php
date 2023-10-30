<div class="card mb-4">
    <form class="" action="<?php echo base_url('root/user_admin/check_ids') ?>" method="post">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="titll">
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $subtitle ?>
                </div>
                <div class="button">
                    <input type="submit" name="actionBtn" value="Aktifkan" class="btn btn-sm btn-success">
                    <input type="submit" name="actionBtn" value="Nonaktifkan" class="btn btn-sm btn-dark">
                    <input type="submit" onclick="return confirm('Anda yakin menghapus data ini?');" name="actionBtn" value="Hapus" class="btn btn-sm btn-danger">
                    <a href="<?php echo base_url('root/user_admin/add') ?>" class="btn btn-sm btn-info">Tambah Admin</a>
                </div>
            </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php echo $this->session->flashdata('message') ?>
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%" ><input type="checkbox" id="checkAll"></th>
                        <th class="text-center">Aksi</th>
                        <th class="text-center">Nomor ID</th>
                        <th class="text-left">Nama Lengkap</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $v): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="check_id[]" class="check_delete" value="<?php echo $v['id_user'] ?>"/>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo base_url('root/user_admin/edit/' . $v['id_user']) ?>" class="btn btn-sm btn-warning"></i>Ubah</a>
                                <a href="<?php echo base_url('root/user_admin/reset/' . $v['id_user']) ?>" class="btn btn-sm btn-danger"></i>Reset</a>
                                <a href="<?php echo base_url('root/user_admin/detail/' . $v['id_user']) ?>" class="btn btn-sm btn-info"></i>Detail</a>
                            </td>
                            <td class="text-center"><?php echo $v['kode_admin'] ?></td>
                            <td><?php echo $v['nama'] ?></td>
                            <td class="text-center"><?php echo $v['jenis_kelamin']  > 1 ? 'Perampuan' : 'Laki-laki'  ?></td>
                            <td><?php echo $v['username'] ?></td>
                            <td class="text-center"><?php echo $v['is_active']  > 1 ? "<span class='text-secondary'>Tidak Aktif</span>" : "<span class='text-success'>Aktif</span>" ?></td>
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
