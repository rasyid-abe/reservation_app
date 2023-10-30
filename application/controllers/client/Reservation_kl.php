<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation_kl extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 4) redirect('auth/logout');
        $this->load->library('form_validation');
        $this->load->model('client_model');
        $this->link = 'home_kl';
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
        $data['link_home'] = 'home_kl';
        $data['list'] = $this->client_model->get_data_reservation();
        $this->template->content("client/reservation/list", $data);
        $this->template->show('template/home');
    }

    public function add()
    {
        $this->form_validation->set_rules('full_name', 'Nama Klien', 'required|trim');
        $this->form_validation->set_rules('address', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('date', 'Tanggal Reservasi', 'required|trim');
        $this->form_validation->set_rules('hour', 'Jam Reservasi', 'required|trim');
        $this->form_validation->set_rules('qty', 'Jumlah Klien', 'required|trim');
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $title = "Reservasi";
            $subtitle = "Tambah Reservasi";

            $data = array();
            $data['header_title'] = $title;
            $data['subtitle'] = $subtitle;
            $data['from_action'] = 'add';
            $data['link_home'] = 'home_kl';
            $data['doctor'] = $this->db->get('dokter')->result_array();
            $data['hour'] = $this->db->get('jam_reservasi')->result_array();
            $this->template->content("client/reservation/add", $data);
            $this->template->show('template/home');
        } else {
            $id_u = $this->db->get_where('klien', ['id_user' => $this->session->userdata('id_user')])->row('id_klien');
            $data = [
                'id_klien' => $id_u,
                'id_dokter' => $this->input->post('docter'),
                'kode_reservasi' => 'RSV-' . time() . $id_u,
                'nama_klien' => $this->input->post('full_name'),
                'alamat_klien' => $this->input->post('address'),
                'tgl_reservasi' => $this->input->post('date'),
                'jam_reservasi' => $this->input->post('hour'),
                'keluhan' => $this->input->post('keluhan'),
                'jumlah_hewan' => $this->input->post('qty'),
                'status' => 0,
                'created_by' => $this->session->userdata('id_user'),
                'date_created' => time()
            ];

            $dd = $this->db->get_where('dokter', ['id_dokter' => $this->input->post('docter')])->row_array();
            $email_dokter = $this->db->get_where('user', ['id_user' => $dd['id_user']])->row('email');
            $email_klien = $this->db->get_where('user', ['id_user' => $this->id])->row('email');
            $title_e = "Informasi Reservasi";

            $send_dokter = '
                <table>
                    <tr>
                        <th colspan="4"> <h3>'.$title_e.'</h3> </th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Kode Reservasi</td>
                        <td>:</td>
                        <td>'.$data['kode_reservasi'].'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Nama Klien</td>
                        <td>:</td>
                        <td>'.$data['nama_klien'].'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Alamat Klien</td>
                        <td>:</td>
                        <td>'.$data['alamat_klien'].'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Tanggal Reservasi</td>
                        <td>:</td>
                        <td>'.format_indo($data['tgl_reservasi']).'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Jam Reservasi</td>
                        <td>:</td>
                        <td>'.$data['jam_reservasi'].' WIB</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Keluhan</td>
                        <td>:</td>
                        <td>'.$data['keluhan'].'</td>
                    </tr>
                </table>
            ';

            $send_klien = '
                <table>
                    <tr>
                        <th colspan="4"> <h3>'.$title_e.'</h3> </th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Kode Reservasi</td>
                        <td>:</td>
                        <td>'.$data['kode_reservasi'].'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Kode Dokter</td>
                        <td>:</td>
                        <td>'.$dd['kode_dokter'].'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Nama Dokter</td>
                        <td>:</td>
                        <td>'.$dd['nama_dokter'].'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Nama Klien</td>
                        <td>:</td>
                        <td>'.$data['nama_klien'].'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Alamat Klien</td>
                        <td>:</td>
                        <td>'.$data['alamat_klien'].'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Tanggal Reservasi</td>
                        <td>:</td>
                        <td>'.format_indo($data['tgl_reservasi']).'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Jam Reservasi</td>
                        <td>:</td>
                        <td>'.$data['jam_reservasi'].' WIB</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Keluhan</td>
                        <td>:</td>
                        <td>'.$data['keluhan'].'</td>
                    </tr>
                </table>
            ';

            // Send email
            _sendDokter($email_dokter, $send_dokter, $title_e);
            _sendKlien($email_klien, $send_klien, $title_e);


            $in_user = $this->db->insert('reservasi', $data);
            $insert_id = $this->db->insert_id();

            store_history($this->id, "Input", "Membuat Reservasi pada tanggal " . format_indo($this->input->post('date')));

            if ($in_user) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Sukses!</h6>
                Reservasi berhasil dibuat.
                </div>
                ');
                redirect('client/reservation_kl/detail_reservation/' .$insert_id);
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Gagal!</h6>
                Reservasi gagal dibuat.
                </div>
                ');
                redirect('client/reservation_kl/detail_reservation/' .$insert_id);
            }
        }
    }

    public function reschedule($id)
    {
        $title = "Reservasi";
        $subtitle = "Reschedule";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['row'] = $this->client_model->get_data_reservation_by_id($id);
        $data['hour'] = $this->db->get('jam_reservasi')->result_array();
        $data['link_home'] = 'home_kl';
        $this->template->content("client/reservation/reschedule", $data);
        $this->template->show('template/home');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('date', 'Tanggal Reservasi', 'required|trim');
        $this->form_validation->set_rules('hour', 'Jam Reservasi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($id);
        } else {
            $data = [
                'tgl_reservasi' => $this->input->post('date', true),
                'jam_reservasi' => $this->input->post('hour', true),
                'status' => 0,
            ];

            $res = $this->db->get_where('reservasi', ['id_reservasi' => $id])->row_array();
            $dok = $this->db->get_where('dokter', ['id_dokter' => $res['id_dokter']])->row_array();

            $email_dokter = $this->db->get_where('user', ['id_user' => $dok['id_user']])->row('email');
            $email_klien = $this->db->get_where('user', ['id_user' => $this->id])->row('email');
            $title_e = "Informasi Reschedule";

            $send_dokter = '
                <table>
                    <tr>
                        <th colspan="4"> <h3>Informasi Reschedule Reservasi</h3> </th>
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
                        <td>'.format_indo($this->input->post('date', true)).'</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Jam Reservasi</td>
                        <td>:</td>
                        <td>'.$this->input->post('hour', true).'</td>
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
                        <th colspan="4"> <h3>Informasi Reschedule Reservasi</h3> </th>
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

            $this->db->where('id_reservasi', $id);
            $update = $this->db->update('reservasi', $data);

            $code = $this->db->get_where('reservasi', ['id_reservasi' => $id])->row('kode_reservasi');
            store_history($this->id, "Reschedule", "Mengubah Jadwal Reservasi dengan kode " . $code . " menjadi tanggal " . format_indo($this->input->post('date', true)) . " dan jam " . $this->input->post('hour', true));

            if ($update) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Sukses!</h6>
                Reschedule berhasil.
                </div>
                ');
                redirect('client/reservation_kl/detail_reservation/' . $id);
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Gagal!</h6>
                Reschedule Gagal.
                </div>
                ');
                redirect('client/reservation_kl/detail_reservation/' . $id);
            }
        }
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
        $this->template->content("client/reservation/detail", $data);
        $this->template->show('template/home');
    }

    public function check_ids()
    {
        if ($_POST['actionBtn'] != "Batalkan") {
            $this->delete($this->input->post('check_id'));
        } else {
            $this->cencel($this->input->post('check_id'), 3);
        }
    }

    public function delete($ids)
    {
        // $no_success = 0;
        // $no_failed = 0;
        //
        // foreach ($ids as $key => $value) {
        //     $this->db->delete('klien', ['id_user' => $value]);
        //     $delete = $this->db->delete('user', ['id_user' => $value]);
        //     if ($delete) {
        //         $no_success++;
        //     } else {
        //         $no_failed++;
        //     }
        // }
        //
        // $this->session->set_flashdata('message', '
        // <div class="alert alert-info alert-dismissible">
        // <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        // <h6><i class="icon fa fa-check"></i> Informasi Menghapus!</h6>
        // '.$no_success.' Klien berhasil dihapus. '.$no_failed.' Klien gagal dihapus.
        // </div>
        // ');
        // redirect('client/user_client_adm');
    }

    public function cencel($ids, $sts)
    {
        $no_success = 0;
        $no_failed = 0;

        foreach ($ids as $key => $value) {
            $this->db->where('id_reservasi', $value);
            $code = $this->db->get_where('reservasi', ['id_reservasi' => $value])->row('kode_reservasi');
            $update = $this->db->update('reservasi', ['status' => 3]);
            if ($update) {
                store_history($this->id, "Cencel", "Membatalkan Reservasi dengan kode " . $code);
                $no_success++;
            } else {
                $no_failed++;
            }
        }

        $this->session->set_flashdata('message', '
        <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6><i class="icon fa fa-check"></i> Informasi Pembatalan!</h6>
        '.$no_success.' Klien berhail dibatalkan. '.$no_failed.' Klien gagal dibatalkan.
        </div>
        ');
        redirect('client/reservation_kl');
    }
}
