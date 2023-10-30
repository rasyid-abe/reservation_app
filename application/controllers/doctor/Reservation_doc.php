<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation_doc extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 3) redirect('auth/logout');
        $this->load->library('form_validation');
        $this->load->model('doctor_model');
        $this->load->model('client_model');
        $this->link = 'home_doc';
        $this->id = $this->session->userdata('id_user');
    }

    public function index()
    {
        store_history($this->id, "View", "Melihat Data List Reservasi");

        $title = "Reservasi";
        $subtitle = "Daftar Reservasi";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['list'] = $this->doctor_model->get_data_reservation();
        $this->template->content("doctor/reservation/list", $data);
        $this->template->show('template/home');
    }

    public function detail_reservation($id)
    {
        $code = $this->db->get_where('reservasi', ['id_reservasi' => $id])->row('kode_reservasi');
        store_history($this->id, "View Detail", "Melihat Data Detail Reservasi dengan kode " . $code);

        $title = "Reservasi";
        $subtitle = "Detail Reservasi";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['row'] = $this->client_model->get_data_detail($id);
        $this->template->content("doctor/reservation/detail", $data);
        $this->template->show('template/home');
    }

    public function check_ids()
    {
        if ($_POST['actionBtn'] == "Setuju") {
            $this->status_res($this->input->post('check_id'), 1);
        } else {
            $this->status_res($this->input->post('check_id'), 2);
        }
    }

    public function status_res($ids, $sts)
    {
        $no_success = 0;
        $no_failed = 0;

        foreach ($ids as $key => $value) {
            $this->db->where('id_reservasi', $value);
            $update = $this->db->update('reservasi', ['status' => $sts]);

            $code = $this->db->get_where('reservasi', ['id_reservasi' => $value])->row('kode_reservasi');

            $res = $this->db->get_where('reservasi', ['id_reservasi' => $value])->row_array();
            $dok = $this->db->get_where('dokter', ['id_dokter' => $res['id_dokter']])->row_array();
            $kli = $this->db->get_where('klien', ['id_klien' => $res['id_klien']])->row_array();

            $email_dokter = $this->db->get_where('user', ['id_user' => $this->id])->row('email');
            $email_klien = $this->db->get_where('user', ['id_user' => $kli['id_user']])->row('email');
            $title_e = "Informasi Approval";

            if ($sts == 1) {
                $send_dokter = '
                    <table>
                        <tr>
                            <th colspan="4"> <h3>Reservasi Disetujui</h3> </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Kode Reservasi</td>
                            <td>:</td>
                            <td>'.$res['kode_reservasi'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Nama Klien</td>
                            <td>:</td>
                            <td>'.$res['nama_klien'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Alamat Klien</td>
                            <td>:</td>
                            <td>'.$res['alamat_klien'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Tanggal Reservasi</td>
                            <td>:</td>
                            <td>'.format_indo($res['tgl_reservasi']).'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Jam Reservasi</td>
                            <td>:</td>
                            <td>'.$res['jam_reservasi'].' WIB</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Keluhan</td>
                            <td>:</td>
                            <td>'.$res['keluhan'].'</td>
                        </tr>
                    </table>
                ';

                $send_klien = '
                    <table>
                        <tr>
                            <th colspan="4"> <h3>Reservasi Disetujui</h3> </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Kode Reservasi</td>
                            <td>:</td>
                            <td>'.$res['kode_reservasi'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Kode Dokter</td>
                            <td>:</td>
                            <td>'.$dok['kode_dokter'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Nama Dokter</td>
                            <td>:</td>
                            <td>'.$dok['nama_dokter'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Nama Klien</td>
                            <td>:</td>
                            <td>'.$res['nama_klien'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Alamat Klien</td>
                            <td>:</td>
                            <td>'.$res['alamat_klien'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Tanggal Reservasi</td>
                            <td>:</td>
                            <td>'.format_indo($res['tgl_reservasi']).'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Jam Reservasi</td>
                            <td>:</td>
                            <td>'.$res['jam_reservasi'].' WIB</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Keluhan</td>
                            <td>:</td>
                            <td>'.$res['keluhan'].'</td>
                        </tr>
                    </table>
                ';

                // Send email
                _sendDokter($email_dokter, $send_dokter, $title_e);
                _sendKlien($email_klien, $send_klien, $title_e);

                store_history($this->id, "Approve", "Menyetujui Reservasi dengan kode " . $code);
            } else {
                $send_dokter = '
                    <table>
                        <tr>
                            <th colspan="4"> <h3>Reservasi Ditolak</h3> </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Kode Reservasi</td>
                            <td>:</td>
                            <td>'.$res['kode_reservasi'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Nama Klien</td>
                            <td>:</td>
                            <td>'.$res['nama_klien'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Alamat Klien</td>
                            <td>:</td>
                            <td>'.$res['alamat_klien'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Tanggal Reservasi</td>
                            <td>:</td>
                            <td>'.format_indo($res['tgl_reservasi']).'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Jam Reservasi</td>
                            <td>:</td>
                            <td>'.$res['jam_reservasi'].' WIB</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Keluhan</td>
                            <td>:</td>
                            <td>'.$res['keluhan'].'</td>
                        </tr>
                    </table>
                ';

                $send_klien = '
                    <table>
                        <tr>
                            <th colspan="4"> <h3>Reservasi Ditolak</h3> </th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Kode Reservasi</td>
                            <td>:</td>
                            <td>'.$res['kode_reservasi'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Kode Dokter</td>
                            <td>:</td>
                            <td>'.$dok['kode_dokter'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Nama Dokter</td>
                            <td>:</td>
                            <td>'.$dok['nama_dokter'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Nama Klien</td>
                            <td>:</td>
                            <td>'.$res['nama_klien'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Alamat Klien</td>
                            <td>:</td>
                            <td>'.$res['alamat_klien'].'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Tanggal Reservasi</td>
                            <td>:</td>
                            <td>'.format_indo($res['tgl_reservasi']).'</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Jam Reservasi</td>
                            <td>:</td>
                            <td>'.$res['jam_reservasi'].' WIB</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Keluhan</td>
                            <td>:</td>
                            <td>'.$res['keluhan'].'</td>
                        </tr>
                    </table>
                ';

                // Send email
                _sendDokter($email_dokter, $send_dokter, $title_e);
                _sendKlien($email_klien, $send_klien, $title_e);

                store_history($this->id, "Reject", "Menolak Reservasi dengan kode " . $code);
            }

            if ($update) {
                $no_success++;
            } else {
                $no_failed++;
            }
        }

        if ($sts == 1) {
            $msg1 = 'disetujui';
            $msg2 = 'disetujui';
        } else {
            $msg1 = 'ditolak';
            $msg2 = 'ditolak';
        }

        $this->session->set_flashdata('message', '
        <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6><i class="icon fa fa-check"></i> Informasi Reservasi!</h6>
        '.$no_success.' reservasi berhail '.$msg1.'. '.$no_failed.' reservasi gagal '.$msg2.'.
        </div>
        ');
        redirect('doctor/reservation_doc');
    }
}
