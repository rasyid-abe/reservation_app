<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_kl extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 4) redirect('auth/logout');
        $this->id = $this->session->userdata('id_user');
        $this->load->model('client_model');
    }

    public function index()
	{
        $title = "Dashboard Klien";
		$data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = '';
        $data['arr_breadcrumbs'] = array(
            $title => '#',
        );
        $this->db->order_by("id_history", "desc");
        $data['history'] = $this->db->get_where('history', ['id_user' => $this->id])->result();
        $data['jadwal'] = $this->client_model->reservation_dashboard();
        $data['link_home'] = 'home_kl';
        $this->template->content("client/dashboard", $data);
        $this->template->show('template/home');
	}

    public function get_dashboard()
    {
        // $data = [
        //     'total_parent' => $this->admin_model->total_parent(),
        //     'total_teacher' => $this->admin_model->total_teacher(),
        //     'total_student' => $this->admin_model->total_student(),
        // ];
        //
        // echo json_encode($data);
    }
}
