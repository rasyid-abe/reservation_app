<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_doctor_kl extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 4) redirect('auth/logout');
        $this->load->library('form_validation');
        $this->load->model('root_model');
        $this->load->model('profile_model');
        $this->link = 'home_kl';
        $this->id = $this->session->userdata('id_user');
    }

    public function index()
    {
        store_history($this->id, "View", "Melihat Data List User Dokter");

        $title = "Data Dokter";
        $subtitle = "Daftar Dokter";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = 'home_kl';
        $data['list'] = $this->root_model->get_data_doctor();
        $this->template->content("client/doctor/list", $data);
        $this->template->show('template/home');
    }

    public function detail($id)
    {
        $code = $this->db->get_where('dokter', ['id_user' => $id])->row('kode_dokter');
        store_history($this->id, "View Detail", "Melihat Data Detail User Dokter dengan kode " . $code);

        $title = "User";
        $subtitle = "Detail User";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = 'home_kl';
        $data['back'] = 'client/user_doctor_kl' ;
        $data['data'] = $this->profile_model->get_data_detail($id);
        // $data['sp'] = $this->db->get('spesialis_dokter')->result_array();
        $data['days'] = $this->db->get('hari_praktek')->result_array();
        $this->template->content("root/detail_user", $data);
        $this->template->show('template/home');
    }
}
