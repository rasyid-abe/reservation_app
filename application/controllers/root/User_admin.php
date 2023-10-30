<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 1) redirect('auth/logout');
        $this->load->library('form_validation');
        $this->load->model('root_model');
        $this->load->model('profile_model');
        $this->link = 'home';
        $this->id = $this->session->userdata('id_user');
    }

    public function index()
    {
        store_history($this->id, "View", "Melihat Data List User Admin");

        $title = "User Admin";
        $subtitle = "Daftar Admin";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['list'] = $this->root_model->get_data_admin();

        $this->template->content("root/admin/list", $data);
        $this->template->show('template/home');
    }

    public function detail($id)
    {
        $code = $this->db->get_where('admin', ['id_user' => $id])->row('kode_admin');
        store_history($this->id, "View Detail", "Melihat Data Detail User Admin dengan kode " . $code);

        $title = "User";
        $subtitle = "Detail User";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['back'] = 'root/user_admin' ;
        $data['data'] = $this->profile_model->get_data_detail($id);
        // $data['sp'] = $this->db->get('spesialis_dokter')->result_array();
        $data['days'] = $this->db->get('hari_praktek')->result_array();
        $this->template->content("root/detail_user", $data);
        $this->template->show('template/home');
    }

    public function add()
    {
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim');

        if ($this->form_validation->run() == false) {
            $title = "User Admin";
            $subtitle = "Tambah Admin";

            $data = array();
            $data['header_title'] = $title;
            $data['subtitle'] = $subtitle;
            $data['from_action'] = 'add';
            $data['link_home'] = $this->link;

            $this->template->content("root/admin/add", $data);
            $this->template->show('template/home');
        } else {
            $data_user = [
                'username' =>  $this->input->post('username', true),
                'password' => password_hash(12345678, PASSWORD_DEFAULT),
                'email' =>  $this->input->post('email', true),
                'role_id' => 2,
                'image' => 'default.png',
                'is_active' => 1,
                'created_by' => $this->session->userdata('id_user'),
                'date_created' => time(),
            ];

            $this->db->insert('user', $data_user);
            $insert_id = $this->db->insert_id();

            $len = strlen($insert_id);
            if ($len < 2) {
                $kode_l = '0000' . $insert_id;
            } elseif ($len < 3) {
                $kode_l = '000' . $insert_id;
            } elseif ($len < 4) {
                $kode_l = '00' . $insert_id;
            } elseif ($len < 5) {
                $kode_l = '0' . $insert_id;
            }

            $data_admin = [
                'id_user' => $insert_id,
                'kode_admin' => 'ADM-' . $kode_l,
                'nama' => $this->input->post('full_name', true),
                'jenis_kelamin' => $this->input->post('gender', true),
                'jabatan' => $this->input->post('position', true),
            ];

            $in_user = $this->db->insert('admin', $data_admin);

            store_history($this->id, "Input", "Menambahkan Data User Admin");

            if ($in_user) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Sukses!</h6>
                User admin berhasil ditambah.
                </div>
                ');
                redirect('root/user_admin/add');
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Gagal!</h6>
                User admin gagal ditambah.
                </div>
                ');
                redirect('root/user_admin/add');
            }
        }
    }

    public function edit($id)
    {
        $title = "User Admin";
        $subtitle = "Edit Admin";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['row'] = $this->root_model->get_data_admin_by_id($id);
        $data['link_home'] = $this->link;
        $this->template->content("root/admin/edit", $data);
        $this->template->show('template/home');
    }

    public function update($id)
    {
        $ori_email = $this->db->get_where('user', ['id_user' => $id])->row('email') ;
        $is_unique_email = '';
        if($this->input->post('email') === $ori_email) {
            $is_unique_email =  '';
        } else {
            $is_unique_email =  '|is_unique[user.email]';
        }
        $ori_username = $this->db->get_where('user', ['id_user' => $id])->row('username') ;
        $is_unique_username = '';
        if($this->input->post('username') === $ori_username) {
            $is_unique_username =  '';
        } else {
            $is_unique_username =  '|is_unique[user.username]';
        }
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim'.$is_unique_email);
        $this->form_validation->set_rules('username', 'Username', 'required|trim'.$is_unique_username);
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($id);
        } else {
            $data_user = [
                'username' =>  $this->input->post('username', true),
                'email' =>  $this->input->post('email', true),
            ];

            $this->db->where('id_user', $id);
            $this->db->update('user', $data_user);

            $data_admin = [
                'nama' => $this->input->post('full_name', true),
                'jenis_kelamin' => $this->input->post('gender', true),
                'jabatan' => $this->input->post('position', true),
            ];

            $this->db->where('id_user', $id);
            $update =  $this->db->update('admin', $data_admin);

            $code = $this->db->get_where('admin', ['id_user' => $id])->row('kode_admin');
            store_history($this->id, "Update", "Mengubah Data User Admin dengan kode " . $code);

            if ($update) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Sukses!</h6>
                User admin berhasil diubah.
                </div>
                ');
                redirect('root/user_admin/edit/' . $id);
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Gagal!</h6>
                User admin gagal diubah.
                </div>
                ');
                redirect('root/user_admin/edit/' . $id);
            }
        }
    }

    public function reset($id)
    {
        $this->db->set('password', password_hash(12345678, PASSWORD_DEFAULT));
        $this->db->where('id_user', $id);
        $reset = $this->db->update('user');

        $code = $this->db->get_where('admin', ['id_user' => $id])->row('kode_admin');
        store_history($this->id, "Reset Password", "Mereset Password User Admin dengan kode " . $code);

        if ($reset) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Informasi!</h6>
                Password berhasil direset.
                </div>
            ');
            redirect('root/user_admin');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fa fa-check"></i> Reset Information!</h6>
            Password gagal direset.
            </div>
            ');
            redirect('root/user_admin');
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
        redirect('root/user_admin');
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
        redirect('root/user_admin');
    }
}
