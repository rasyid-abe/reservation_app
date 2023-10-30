<script type="text/javascript" src="<?php echo base_url('themes/js/dynamic-form.js') ?>"></script>
<form action="<?php echo base_url('root/billing_ro/update/' . $id) ?>" method="post">
    <input type="hidden" name="id_biling" value="<?php echo $id ?>">
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
                            <th width="30%" style="vertical-align: top;"> <textarea name="diagnosa" class="form-control" rows="5"><?php echo $row->diagnosa ?></textarea> </th>
                        </tr>
                    </table>
                    <br>
                    <table class="table">
                        <thead>
                            <tr class="bg-info">
                                <th>Keterangan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Total</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($detail as $v): ?>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Keterangan" type="text" name="ket[]" value="<?php echo $v->keterangan ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="qty00[]" id="qty00<?= $no ?>" placeholder="Jumlah" onkeyup = "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"; value="<?php echo $v->qty ?>" onchange="count_ttl(this.id)">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="hrg00[]" id="hrg00<?= $no ?>" placeholder="Harga" onkeyup = "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"; value="<?php echo $v->harga ?>" onchange="count_ttl(this.id)">
                                    </div>
                                </td>
                                <td class="text-right"><input type="text" id="ttl00<?= $no ?>" value="<?php echo $v->harga * $v->qty ?>" class="form-control total_jq" readonly> </td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                        <tr id="dynamic_form">
                            <td>
                                <input type="text" name="desc" id="desc" placeholder="Keterangan" class="form-control">
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control" name="qtyyy" id="qtyyy" placeholder="Jumlah" onkeyup = "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"; onchange="count_total(this.id)">
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" onkeyup = "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"; onchange="count_total(this.id)">
                            </td>
                            <td class="text-right"><input type="text" name="total" id="total" class="form-control total_jq" readonly> </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="minus5" onclick="count_total('')">-</a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="plus5">+</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success mr-2">Ubah</button>
                <a href="<?php echo base_url('root/billing_ro') ?>" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function() {
    var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
        limit:10,
        formPrefix : "dynamic_form",
        normalizeFullForm : false
    });

    // dynamic_form.inject([{p_name: 'Hemant',quantity: '123',remarks: 'testing remark'},{p_name: 'Harshal',quantity: '123',remarks: 'testing remark'}]);

    $("#dynamic_form #minus5").on('click', function(){
        var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
        if (initDynamicId === 2) {
            $(this).closest('#dynamic_form').next().find('#minus5').hide();
        }
        $(this).closest('#dynamic_form').remove();
    });

});
function count_ttl(e) {
    if (e != '') {
        let val = $('#' + e).val();
        let uniq = e.substring(5);
        if ($('#qty00' + uniq) != "" || $('#hrg00' + uniq) != "") {
            t = $('#qty00' + uniq).val() * $('#hrg00' + uniq).val();
            $('#ttl00' + uniq).val(t)
        }
    }
}
function count_total(e) {
    if (e != '') {
        let val = $('#' + e).val();
        let uniq = e.substring(5);
        if ($('#qtyyy' + uniq) != "" || $('#harga' + uniq) != "") {
            t = $('#qtyyy' + uniq).val() * $('#harga' + uniq).val();
            $('#total' + uniq).val(t)
        }
    }
}
</script>
