<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_client_doc extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 3) redirect('auth/logout');
        $this->load->library('form_validation');
        $this->load->model('doctor_model');
        $this->load->model('profile_model');
        $this->link = 'home_doc';
        $this->id = $this->session->userdata('id_user');
    }

    public function index()
    {
        store_history($this->id, "View", "Melihat Data List User Klien");

        $title = "Klien Saya";
        $subtitle = "Daftar Klien";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['list'] = $this->doctor_model->get_data_client();
        $this->template->content("doctor/client/list", $data);
        $this->template->show('template/home');
    }

    public function detail($id)
    {
        $code = $this->db->get_where('klien', ['id_user' => $id])->row('kode_klien');
        store_history($this->id, "View Detail", "Melihat Data Detail User Klien dengan kode " . $code);

        $title = "User";
        $subtitle = "Detail User";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['back'] = 'doctor/user_client_doc' ;
        $data['data'] = $this->profile_model->get_data_detail($id);
        $data['days'] = $this->db->get('hari_praktek')->result_array();
        $this->template->content("root/detail_user", $data);
        $this->template->show('template/home');
    }
}
