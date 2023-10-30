<div class="card mb-4">
    <form class="" action="<?php echo base_url('root/specialist/check_ids') ?>" method="post">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="titll">
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $subtitle ?>
                </div>
                <div class="button">
                    <!-- <input type="submit" onclick="return confirm('Anda yakin menghapus data ini?');" name="actionBtn" value="Hapus" class="btn btn-sm btn-danger"> -->
                    <a href="<?php echo base_url('root/specialist/add') ?>" class="btn btn-sm btn-info">Tambah Spesialis</a>
                </div>
            </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php echo $this->session->flashdata('message') ?>
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <!-- <th width="5%" ><input type="checkbox" id="checkAll"></th> -->
                        <th class="text-center">Aksi</th>
                        <th class="text-center">Spesialis</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $v): ?>
                        <tr>
                            <!-- <td>
                                <input type="checkbox" name="check_id[]" class="check_delete" value="<?php echo $v['id'] ?>"/>
                            </td> -->
                            <td class="text-center">
                                <a href="<?php echo base_url('root/specialist/edit/' . $v['id']) ?>" class="btn btn-sm btn-warning"></i>Ubah</a>
                            </td>
                            <td class="text-center"><?php echo $v['spesialis'] ?></td>
                            <td class="text-center"><?php echo $v['keterangan'] ?></td>
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
