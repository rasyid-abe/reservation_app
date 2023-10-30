<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_doc extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 3) redirect('auth/logout');
        $this->id = $this->session->userdata('id_user');
        $this->load->model('profile_model');
        $this->load->model('doctor_model');
    }

    public function index()
	{
        $title = "Dashboard Dokter";
		$data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = '';
        $data['arr_breadcrumbs'] = array(
            $title => '#',
        );
        $this->db->order_by("id_history", "desc");
        $data['history'] = $this->db->get_where('history', ['id_user' => $this->id])->result();
        $data['link_home'] = 'home_doc';
        $data['profile'] = $this->profile_model->get_data($this->id);
        $data['reservasi'] = $this->doctor_model->get_data_reservation_count();
        $data['billing'] = $this->doctor_model->get_data_billing_count();
        $data['client'] = $this->doctor_model->get_data_client_count();
        $data['jadwal'] = $this->doctor_model->reservasi_dashboard();
        $this->template->content("doctor/dashboard", $data);
        $this->template->show('template/home');
	}

}
