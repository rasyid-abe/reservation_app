<script type="text/javascript" src="<?php echo base_url('themes/js/dynamic-form.js') ?>"></script>
<form method="post" action="<?php echo base_url('doctor/billing_doc/add/') . $row->id_reservasi ?>" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-table mr-1"></i>
                    <?php echo $subtitle ?><hr>
                    <?php echo $this->session->flashdata('message')?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id_number">ID Reservasi</label>
                                <input type="text" name="id_number" id="id_number" class="form-control form-sm" placeholder="ID Number" value="<?php echo $row->kode_reservasi ?>" readonly>
                                <small class="text-danger"><?php echo form_error('id_number') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="username">Klien</label>
                                <input type="text" name="nama" id="nama" class="form-control form-sm" placeholder="Username" value="<?php echo $row->nama_klien ?>" readonly>
                                <small class="text-danger"><?php echo form_error('nama') ?></small>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Reservasi</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control form-sm" placeholder="Full Name" value="<?php echo $row->tgl_reservasi ?>" readonly>
                                        <small class="text-danger"><?php echo form_error('tanggal') ?></small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="jam">Jam</label>
                                        <select class="form-control form-sm" name="hour" id="hour" disabled>
                                            <option value="<?php echo $row->jam_reservasi ?>"><?php echo $row->jam_reservasi ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position">Jumlah Klien</label>
                                <input type="number" name="qty" id="qty" class="form-control form-sm" value="<?php echo $row->jumlah_hewan ?>" readonly>
                                <small class="text-danger"><?php echo form_error('qty') ?></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="hp">Keluhan</label>
                                <textarea class="form-control" name="keluhan" rows="4" cols="60" readonly><?php echo $row->keluhan ?></textarea>
                                <small class="text-danger"><?php echo form_error('keluhan') ?></small>
                            </div>
                            <div class="form-group">
                                <label for="hp">Diagnosa</label>
                                <textarea class="form-control" name="diagnosa" rows="5" required></textarea>
                                <small class="text-danger"><?php echo form_error('diagnosa') ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-info text-white">
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Harga</th>
                                <th class="text-right">Total</th>
                                <td>&nbsp;</td>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <td>&nbsp;</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="minus5" onclick="count_total('')">-</a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="plus5">+</a>
                                </td>
                            </tr>
                            <!-- <tr>
                                <th colspan="3" class="text-center bg-info text-white">Grand Total</th>
                                <th class="text-right"> <span id="grand_total"></span> </th>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-success mr-2">Simpan</button>
    <a href="<?php echo base_url('doctor/billing_doc/reservasi') ?>" class="btn btn-danger">Kembali</a>
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

function fnum(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function myFunc(total, num) {
  return total + num;
}

function count_total(e) {
    if (e != '') {
        let val = $('#' + e).val();
        let uniq = e.substring(5);
        if ($('#qtyyy' + uniq) != "" || $('#harga' + uniq) != "") {
            t = $('#qtyyy' + uniq).val() * $('#harga' + uniq).val();
            $('#total' + uniq).val(t)
        }
        // ek = $('.total_jq').map((_,el) => el.value).get();
        // let arr = []
        // $.each(ek, function(i, v) {
        //     if (v != "") {
        //         arr.push(parseInt(v));
        //     }
        // })

        // $('#grand_total').html('Rp. ' + fnum(arr.reduce(myFunc)));
    } else {
        // ek = $('.total_jq').map((_,el) => el.value).get();
        // console.log(ek);
        // let arr = []
        // $.each(ek, function(i, v) {
        //     if (v != "") {
        //         arr.push(parseInt(v));
        //     }
        // })
        //
        // // $('#grand_total').html('Rp. ' + fnum(arr.reduce(myFunc)));
        // el = $('.total_jq').map((_,el) => el.value).get();
        // console.log(el);
    }
}

</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
