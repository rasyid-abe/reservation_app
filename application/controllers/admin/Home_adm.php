<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_adm extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 2) redirect('auth/logout');
        $this->load->model('root_model');
        $this->id = $this->session->userdata('id_user');
    }

    public function index()
	{
        $title = "Dashboard Admin";
		$data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = '';
        $data['arr_breadcrumbs'] = array(
            $title => '#',
        );
        $data['link_home'] = 'home';
        $this->db->order_by("id_history", "desc");
        $data['history'] = $this->db->get_where('history', ['id_user' => $this->id])->result();
        $data['client'] = $this->db->get_where('user', ['role_id' => '4'])->num_rows();
        $data['doctor'] = $this->db->get_where('user', ['role_id' => '3'])->num_rows();
        $data['reservasi'] = $this->db->get('reservasi')->num_rows();
        $data['biling'] = $this->db->get('biling')->num_rows();
        $this->template->content("admin/dashboard", $data);
        $this->template->show('template/home');
	}

    public function check_reservasi()
    {
        $title = "Reservasi";
        $subtitle = "Detail Reservasi";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $kode = $this->input->post('id_reservasi');
        $data['row'] = $this->root_model->get_data_reservation_by_code($kode);
        $this->template->content("admin/check_present", $data);
        $this->template->show('template/home');
    }

    public function set_present($id)
    {
        $this->db->where('id_reservasi', $id);
        $update = $this->db->update('reservasi', ['datang' => 1]);

        $this->session->set_flashdata('message', '
        <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6><i class="icon fa fa-check"></i> Sukses!</h6>
        Kode Reservasi berhasil di proses.
        </div>
        ');
        redirect('admin/home_adm');
    }
}
