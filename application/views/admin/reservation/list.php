<div class="card mb-4">
    <form class="" action="<?php echo base_url('admin/reservation_adm/type_export') ?>" method="post">
        <div class="card-header">
            <!-- <div class="d-flex align-items-center">
                <div class="titll">
                </div> -->
                <!-- <div class="button"> -->
                    <div class="row">
                        <div class="col-sm-6">
                            <i class="fas fa-table mr-1"></i>
                            <?php echo $subtitle ?>
                        </div>
                        <div class="col-sm-2 float-right">
                            <select class="form-control" name="tahun" id="tahunselect" onchange="unlock()">
                                <option value="">Tahun</option>
                                <?php $now=date('Y'); ?>
                                <?php for ($a=2012;$a<=$now;$a++) { ?>
                                    <option value="<?php echo $a ?>"><?php echo $a ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="bulan" id="bulanselect" class="form-control" disabled>
                                <option value="">Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-sm-1 float-right">
                            <input type="submit" name="actionBtn" value="Export Excel" class="btn btn-block btn-success">
                        </div>
                        <div class="col-sm-1 float-right">
                            <input type="submit" name="actionBtn" value="Export PDF" class="btn btn-block btn-danger">
                        </div>
                    </div>
                <!-- </div> -->
            <!-- </div> -->
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php echo $this->session->flashdata('message') ?>
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Aksi</th>
                        <th class="text-center">ID Reservasi</th>
                        <th class="text-left">Nama Dokter</th>
                        <th class="text-left">Nama Klien</th>
                        <th class="text-center">Tanggal - Jam</th>
                        <th class="text-center">Jumlah Hewan</th>
                        <th class="text-center">Keluhan</th>
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
                                <a href="<?php echo base_url('admin/reservation_adm/detail_reservation/' . $v['id_reservasi']) ?>" class="btn btn-sm btn-info"></i>Detail</a>
                            </td>
                            <td class="text-center"><?php echo $v['kode_reservasi'] ?></td>
                            <td><?php echo $v['nama_dokter'] ?></td>
                            <td><?php echo $v['namaklien'] ?></td>
                            <td class="text-center"><?php echo format_indo($v['tgl_reservasi']) . ' - ' . $v['jam_reservasi'] ?></td>
                            <td class="text-center"><?php echo $v['jumlah_hewan'] ?></td>
                            <td><?php echo $v['keluhan'] ?></td>
                            <td><?php echo $l ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</div>
<script type="text/javascript">
function unlock() {
    let val = $('#tahunselect').val();
    let select = `
    <option value="" selected>Bulan</option>
    <option value="01">Januari</option>
    <option value="02">Februari</option>
    <option value="03">Maret</option>
    <option value="04">April</option>
    <option value="05">Mei</option>
    <option value="06">Juni</option>
    <option value="07">Juli</option>
    <option value="08">Agustus</option>
    <option value="09">September</option>
    <option value="10">Oktober</option>
    <option value="11">November</option>
    <option value="12">Desember</option>
    `;
    console.log(val);
    if (val == "") {
        $('#bulanselect').html(select);
    } else {
        $('#bulanselect').removeAttr( 'disabled' );
    }
}

</script>
