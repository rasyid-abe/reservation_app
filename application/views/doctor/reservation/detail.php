<div class="row">
    <div class="col-sm-8">
        <div class="card mb-4 bg-default">
            <form class="" action="<?php echo base_url('root/user_doctor/check_ids') ?>" method="post">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="titll">
                            <i class="fas fa-table mr-1"></i>
                            <?php echo $subtitle ?>
                        </div>
                        <div class="button">
                            <a href="<?php echo base_url('doctor/reservation_doc') ?>" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-info" style="min-height: 400px"><br>
                    <?php echo $this->session->flashdata('message') ?>
                    <table width="100%" style="color: white">
                        <tr>
                            <th colspan="4" class="text-center"> <h3>Informasi Reservasi</h3> </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <td width="30%">&nbsp;</td>
                            <td>Kode Reservasi</td>
                            <td>:</td>
                            <th width="45%"><?php echo $row->kode_reservasi ?></th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Nama Dokter</td>
                            <td>:</td>
                            <th><?php echo $row->nama_dokter ?></th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Nama Klien</td>
                            <td>:</td>
                            <th><?php echo $row->namaklien ?></th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Alamat Klien</td>
                            <td>:</td>
                            <th><?php echo $row->alamatklien ?></th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Tanggal Reservasi</td>
                            <td>:</td>
                            <th><?php echo format_indo($row->tgl_reservasi) ?></th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Jam Reservasi</td>
                            <td>:</td>
                            <th><?php echo $row->jam_reservasi . ' WIB' ?></th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Keluhan</td>
                            <td>:</td>
                            <th><?php echo $row->keluhan ?></th>
                        </tr>
                        <?php if ($row->status == 0) {
                            $l = "Menunggu";
                        } elseif ($row->status == 1) {
                            $l = "Disetujui";
                        } elseif ($row->status == 2) {
                            $l = "Ditolak";
                        } else {
                            $l = "Dibatalkan";
                        } ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Status Reservasi</td>
                            <td>:</td>
                            <th><?php echo $l ?></th>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
