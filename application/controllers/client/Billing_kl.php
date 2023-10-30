<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing_kl extends CI_Controller {

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
        store_history($this->id, "View", "Melihat Data List Biling");

        $title = "Biling";
        $subtitle = "Daftar Biling";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['list'] = $this->client_model->get_data_billing();
        $this->template->content("client/billing/list", $data);
        $this->template->show('template/home');
    }

    public function detail($id)
    {
        $code = $this->db->get_where('biling', ['id_biling' => $id])->row('kode_biling');
        store_history($this->id, "View Detail", "Melihat Data Detail Biling dengan kode " . $code);
        
        $title = "Biling";
        $subtitle = "Detail Biling";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['row'] = $this->client_model->get_data_billing_by_id($id);
        $data['detail'] = $this->db->get_where('biling_detail', ['id_biling' => $id])->result();
        $data['link_home'] = $this->link;
        $this->template->content("client/billing/detail", $data);
        $this->template->show('template/home');
    }
}
