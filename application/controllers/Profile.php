<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public $id = '';
    public $home = '';

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('profile_model');
        $this->load->model('root_model');
        $this->id = $this->session->userdata('id_user');
        if ($this->id == 1) {
            $this->home = 'root/home';
        } elseif ($this->id == 2) {
            $this->home = 'admin/home_adm';
        } elseif ($this->id == 3) {
            $this->home = 'doctor/home_doc';
        } elseif ($this->id == 4) {
            $this->home = 'client/home_kl';
        }
    }

    public function index()
    {
        store_history($this->id, "View", "Melihat Data Profil Saya");

        $title = "Profil";
        $subtitle = "Pengaturan Profil";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->home;
        $data['data'] = $this->profile_model->get_data($this->id);
        // $data['sp'] = $this->db->get('spesialis_dokter')->result_array();
        $data['days'] = $this->db->get('hari_praktek')->result_array();
        $this->template->content("profile/view", $data);
        $this->template->show('template/home');
    }

    public function edit()
    {
        $id = $this->session->userdata('id_user');
        $old = $this->db->get_where('user', ['id_user' => $id])->row('image');
        $upload_file = [
            'type' => 'gif|jpg|png',
            'size' => '2048',
            'path' => './themes/assets/img/profile/',
            'old' => $old,
            'file' => $_FILES,
        ];

        $data_user = [];

        if ($_FILES['file']['name'] != null) {
            $data_user['image'] = my_upload_file($upload_file);
        }

        $data_user['username'] = $this->input->post('username', true);
        $data_user['email'] = $this->input->post('email', true);

        $this->db->where('id_user', $id);
        $this->db->update('user', $data_user);

        $role = $this->session->userdata('role_id');
        if ($role == 4) {
            $data = [
                'nama_klien' => $this->input->post('fullname', true),
                'tgl_lahir_klien' => $this->input->post('tgl_lahir', true),
                'jenis_kelamin_klien' => $this->input->post('gender', true),
                'alamat_klien' => $this->input->post('alamat', true),
                'no_hp_klien' => $this->input->post('nohp', true),
            ];

            $this->db->where('id_user', $id);
            $update = $this->db->update('klien', $data);
        } elseif ($role == 3) {
            $data = [
                'nama_dokter' => $this->input->post('fullname', true),
                'jenis_kelamin_dokter' => $this->input->post('gender', true),
                'spesialis' => json_encode($this->input->post('sp', true)),
                'hari_praktek' => json_encode($this->input->post('days', true)),
                'no_hp_dokter' => $this->input->post('nohp', true),
            ];

            $this->db->where('id_user', $id);
            $update = $this->db->update('dokter', $data);
        } elseif ($role == 2) {
            $data = [
                'nama' => $this->input->post('fullname', true),
                'jenis_kelamin' => $this->input->post('gender', true),
                'jabatan' => $this->input->post('jabatan', true),
            ];

            $this->db->where('id_user', $id);
            $update = $this->db->update('admin', $data);
        }

        store_history($this->id, "Update", "Mengubah Data Profil Saya");

        if ($update) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fa fa-check"></i> Sukses!</h6>
            Profil anda berhasil diubah.
            </div>
            ');
            redirect('profile');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fa fa-check"></i> Gagal!</h6>
            Profil anda gagal diubah.
            </div>
            ');
            redirect('profile');
        }

    }

    public function password()
    {
        $this->form_validation->set_rules('old_password', 'Current Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[repassword]', [
            'matches' => 'Password not match!'
        ]);
        $this->form_validation->set_rules('repassword', 'Repeat Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {
            $title = "Profil";
            $subtitle = "Ubah Password";

            $data = array();
            $data['header_title'] = $title;
            $data['subtitle'] = $subtitle;
            $data['link_home'] = $this->home;
            $this->template->content("profile/password", $data);
            $this->template->show('template/home');
        } else {
            $id = $this->session->userdata('id_user');
            $user = $this->db->get_where('user', ['id_user' => $id])->row_array();

            $old_password = $this->input->post('old_password', true);

            if (password_verify($old_password, $user['password'])) {
                $this->db->set('password', password_hash($this->input->post('password', true), PASSWORD_DEFAULT));
                $this->db->where('id_user', $id);
                $this->db->update('user');

                store_history($this->id, "Change Password", "Mengubah Password Saya");

                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Success!</h6>
                Your password has been changed.
                </div>
                ');
                redirect('profile/password');
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Error!</h6>
                Your current password is wrong.
                </div>
                ');
                redirect('profile/password');
            }
        }
    }
}
