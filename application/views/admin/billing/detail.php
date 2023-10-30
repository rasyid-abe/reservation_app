<div class="row">
    <div class="col-sm-12">
        <div class="card mb-4 bg-default">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="titll">
                        <i class="fas fa-table mr-1"></i>
                        <?php echo $subtitle ?>
                    </div>
                    <div class="button">
                        <a href="<?php echo base_url('admin/billing_adm') ?>" class="btn btn-danger">Kembali</a>
                        <div class="btn btn-info" onclick="printDiv('printableArea')">Cetak</div>
                    </div>
                </div>
            </div>
            <div id="printableArea" class="card-body" style="min-height: 400px"><br>
                <table width="100%">
                    <tr>
                        <th colspan="7" class="text-center"> <h3>Informasi Biling</h3> </th>
                    </tr>
                    <tr>
                        <th colspan="7">&nbsp;</th>
                    </tr>
                    <tr>
                        <td>Kode Reservasi</td>
                        <td>:</td>
                        <th><?php echo $row->kode_reservasi ?></th>
                        <td>&nbsp;</td>
                        <td>Kode Biling</td>
                        <td>:</td>
                        <th><?php echo $row->kode_biling ?></th>
                    </tr>
                    <tr>
                        <td>Tanggal Reservasi</td>
                        <td>:</td>
                        <th><?php echo format_indo($row->tgl_reservasi) ?></th>
                        <td>&nbsp;</td>
                        <td>Nama Klien</td>
                        <td>:</td>
                        <th><?php echo $row->nama_klien ?></th>
                    </tr>
                    <tr>
                        <td>Jam Reservasi</td>
                        <td>:</td>
                        <th><?php echo $row->jam_reservasi ?></th>
                        <td>&nbsp;</td>
                        <td>Nama Dokter</td>
                        <td>:</td>
                        <th><?php echo $row->nama_dokter ?></th>
                    </tr>
                    <tr>
                        <td>Jumlah Hewan</td>
                        <td>:</td>
                        <th><?php echo $row->jumlah_hewan ?></th>
                        <td>&nbsp;</td>
                        <td>Kode Dokter</td>
                        <td>:</td>
                        <th><?php echo $row->kode_dokter ?></th>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Keluhan</td>
                        <td style="vertical-align: top;">:</td>
                        <th width="30%" style="vertical-align: top;"><?php echo $row->keluhan ?></th>
                        <td>&nbsp;</td>
                        <td style="vertical-align: top;">Diagnosa</td>
                        <td style="vertical-align: top;">:</td>
                        <th width="30%" style="vertical-align: top;"><?php echo $row->diagnosa ?></th>
                    </tr>
                </table>
                <br>
                <table class="table">
                    <thead>
                        <tr class="bg-info">
                            <th>No</th>
                            <th>Keterangan</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $total = 0;
                        foreach ($detail as $v): ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $v->keterangan ?></td>
                            <td class="text-center"><?php echo $v->qty ?></td>
                            <td class="text-right"><?php echo rupiah($v->harga) ?></td>
                            <td class="text-right"><?php echo rupiah($v->harga * $v->qty) ?></td>
                        </tr>

                        <?php
                        $total = $total + $v->harga * $v->qty;
                        $no++;
                        ?>
                    <?php endforeach; ?>
                    <tr>
                        <th class="bg-dark text-white" colspan="4">Total</th>
                        <th class="text-right"><?php echo rupiah($total) ?></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
