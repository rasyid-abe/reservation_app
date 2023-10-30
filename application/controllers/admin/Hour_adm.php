<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hour_adm extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 2) redirect('auth/logout');
        $this->load->library('form_validation');
        $this->load->model('root_model');
        $this->load->model('profile_model');
        $this->link = 'home';
        $this->id = $this->session->userdata('id_user');
    }

    public function index()
    {
        store_history($this->id, "View", "Melihat Data List Jam Reservasi");

        $title = "Jam Reservasi";
        $subtitle = "Data Jam Reservasi";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['list'] = $this->db->get('jam_reservasi')->result_array();
        $this->template->content("admin/hour_adm/list", $data);
        $this->template->show('template/home');
    }

    public function add()
    {
        $this->form_validation->set_rules('jam', 'Jam', 'required|trim');

        if ($this->form_validation->run() == false) {
            $title = "Jam Reservasi";
            $subtitle = "Tambah Jam Reservasi";

            $data = array();
            $data['header_title'] = $title;
            $data['subtitle'] = $subtitle;
            $data['from_action'] = 'add';
            $data['link_home'] = $this->link;

            $this->template->content("admin/hour_adm/add", $data);
            $this->template->show('template/home');
        } else {
            $data = [
                'jam' =>  $this->input->post('jam', true),
            ];

            $in_user = $this->db->insert('jam_reservasi', $data);

            store_history($this->id, "Input", "Menambahkan Data Jam Reservasi");

            if ($in_user) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Sukses!</h6>
                Data Jam Reservasi berhasil ditambah.
                </div>
                ');
                redirect('admin/hour_adm/add');
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Gagal!</h6>
                Data Jam Reservasi gagal ditambah.
                </div>
                ');
                redirect('admin/hour_adm/add');
            }
        }
    }

    public function edit($id)
    {
        $title = "Jam Reservasi";
        $subtitle = "Edit Data Jam Reservasi";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['row'] = $this->db->get_where('jam_reservasi', ['id' => $id])->row();
        $data['link_home'] = $this->link;
        $this->template->content("admin/hour_adm/edit", $data);
        $this->template->show('template/home');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('jam', 'Jam', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($id);
        } else {
            $data = [
                'jam' =>  $this->input->post('jam', true),
            ];

            $this->db->where('id', $id);
            $update = $this->db->update('jam_reservasi', $data);

            store_history($this->id, "Update", "Mengubah Data Jam Reservasi");

            if ($update) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Sukses!</h6>
                Data Jam Reservasi berhasil diubah.
                </div>
                ');
                redirect('admin/hour_adm/edit/' . $id);
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Gagal!</h6>
                Data Jam Reservasi gagal diubah.
                </div>
                ');
                redirect('admin/hour_adm/edit/' . $id);
            }
        }
    }

    public function check_ids()
    {
        if ($_POST['actionBtn'] == "Hapus") {
            $this->delete($this->input->post('check_id'));
        } elseif ($_POST['actionBtn'] == "Aktifkan") {
            $this->studentsStatus($this->input->post('check_id'), 1);
        } else {
            $this->studentsStatus($this->input->post('check_id'), 2);
        }
    }

    public function delete($ids)
    {
        $no_success = 0;
        $no_failed = 0;

        foreach ($ids as $key => $value) {
            $this->db->delete('admin', ['id_user' => $value]);
            $code = $this->db->get_where('admin', ['id_user' => $value])->row('kode_admin');
            $delete = $this->db->delete('user', ['id_user' => $value]);
            if ($delete) {
                store_history($this->id, "Delete", "Menghapus Data User Admin dengan kode " . $code);
                $no_success++;
            } else {
                $no_failed++;
            }
        }

        $this->session->set_flashdata('message', '
        <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6><i class="icon fa fa-check"></i> Informasi Menghapus!</h6>
        '.$no_success.' Admin berhasil dihapus. '.$no_failed.' Admin gagal dihapus.
        </div>
        ');
        redirect('admin/hour_adm');
    }

    public function studentsStatus($ids, $sts)
    {
        $no_success = 0;
        $no_failed = 0;

        foreach ($ids as $key => $value) {
            $this->db->where('id_user', $value);
            $update = $this->db->update('user', ['is_active' => $sts]);

            $code = $this->db->get_where('admin', ['id_user' => $value])->row('kode_admin');
            if ($sts == 1) {
                store_history($this->id, "Activate", "Mengaktifkan Data User Admin dengan kode " . $code);
            } else {
                store_history($this->id, "Deactivate", "Nonaktigkan Data User Admin dengan kode " . $code);
            }

            if ($update) {
                $no_success++;
            } else {
                $no_failed++;
            }
        }

        if ($sts == 1) {
            $msg1 = 'di aktifkan';
            $msg2 = 'di aktifkan';
        } else {
            $msg1 = 'di nonaktifkan';
            $msg2 = 'di nonaktifkan';
        }

        $this->session->set_flashdata('message', '
        <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6><i class="icon fa fa-check"></i> Informasi Aktivasi!</h6>
        '.$no_success.' Admin berhail '.$msg1.'. '.$no_failed.' Admin gagal '.$msg2.'.
        </div>
        ');
        redirect('admin/hour_adm');
    }
}
