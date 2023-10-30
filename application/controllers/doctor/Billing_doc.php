<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing_doc extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 3) redirect('auth/logout');
        $this->load->library('form_validation');
        $this->load->model('doctor_model');
        $this->link = 'home_doc';
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
        $data['list'] = $this->doctor_model->get_data_billing();
        $this->template->content("doctor/billing/list", $data);
        $this->template->show('template/home');
    }

    public function reservasi()
    {
        $title = "Biling";
        $subtitle = "Daftar Reservasi";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['list'] = $this->doctor_model->get_data_reservation_present();
        $this->template->content("doctor/billing/list_res", $data);
        $this->template->show('template/home');
    }

    public function store($id)
    {
        $title = "Biling";
        $subtitle = "Input Biling";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['row'] = $this->doctor_model->get_data_reservation_by_id($id);
        $data['link_home'] = $this->link;
        $this->template->content("doctor/billing/store", $data);
        $this->template->show('template/home');
    }

    public function add($id)
    {
        $data = [
            'id_reservasi' => $id,
            'kode_biling' => 'BIL-00' . time() . $this->session->userdata('id_user'),
            'keluhan' => $this->input->post('keluhan'),
            'diagnosa' => $this->input->post('diagnosa'),
            'jumlah_hewan' => $this->input->post('qty'),
            'created_by' => $this->session->userdata('id_user'),
            'date_created' => time(),
        ];

        $this->db->insert('biling', $data);
        $insert_id = $this->db->insert_id();

        $detail = $this->input->post('dynamic_form')['dynamic_form'];
        $data_detail = [];
        foreach ($detail as $v) {
            if (($v['desc'] != "") && ($v['qtyyy'] != "") && ($v['harga'] != "")) {
                $data_detail = [
                    'id_biling' => $insert_id,
                    'keterangan' => $v['desc'],
                    'qty' => $v['qtyyy'],
                    'harga' => $v['harga'],
                ];

                $this->db->insert('biling_detail', $data_detail);
            }
        }

        store_history($this->id, "Input", "Membuat Biling");

        if ($insert_id) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fa fa-check"></i> Sukses!</h6>
            Biling berhasil dibuat.
            </div>
            ');
            redirect('doctor/billing_doc/detail/' . $insert_id);
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fa fa-check"></i> Gagal!</h6>
            Biling gagal dibuat.
            ');
            redirect('doctor/billing_doc/detail/' . $insert_id);
        }

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
        $data['row'] = $this->doctor_model->get_data_billing_by_id($id);
        $data['detail'] = $this->db->get_where('biling_detail', ['id_biling' => $id])->result();
        $data['link_home'] = $this->link;
        $this->template->content("doctor/billing/detail", $data);
        $this->template->show('template/home');
    }

    public function edit($id)
    {
        $title = "Biling";
        $subtitle = "Ubah Biling";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['row'] = $this->doctor_model->get_data_billing_by_id($id);
        $data['detail'] = $this->db->get_where('biling_detail', ['id_biling' => $id])->result();
        $data['link_home'] = $this->link;
        $data['id'] = $id;
        $this->template->content("doctor/billing/edit", $data);
        $this->template->show('template/home');
    }

    public function update($id)
    {
        $this->db->delete('biling_detail', ['id_biling' => $id]);

        $desc = $this->input->post('ket');
        $qty = $this->input->post('qty00');
        $hrg = $this->input->post('hrg00');
        for ($i=0; $i < count($desc); $i++) {
            if (($desc[$i] != "") && ($qty[$i] != "") && ($hrg[$i] != "")) {
                $data_detail = [
                    'id_biling' => $id,
                    'keterangan' => $desc[$i],
                    'qty' => $qty[$i],
                    'harga' => $hrg[$i],
                ];

                $this->db->insert('biling_detail', $data_detail);
            }
        }

        $detail = $this->input->post('dynamic_form')['dynamic_form'];
        $data_detail = [];
        foreach ($detail as $v) {
            if (($v['desc'] != "") && ($v['qtyyy'] != "") && ($v['harga'] != "")) {
                $data_detail = [
                    'id_biling' => $id,
                    'keterangan' => $v['desc'],
                    'qty' => $v['qtyyy'],
                    'harga' => $v['harga'],
                ];

                $this->db->insert('biling_detail', $data_detail);
            }
        }

        $this->db->where('id_biling', $id);
        $update = $this->db->update('biling', ['diagnosa' => $this->input->post('diagnosa')]);

        $billing_code = $this->db->get_where('biling', ['id_biling' => $id])->row('kode_biling');
        store_history($this->id, "Update", "Mengubah Biling dengan kode ". $billing_code);

        if ($update) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fa fa-check"></i> Sukses!</h6>
            Biling berhasil diubah.
            </div>
            ');
            redirect('doctor/billing_doc/detail/' . $id);
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fa fa-check"></i> Gagal!</h6>
            Biling gagal diubah.
            ');
            redirect('doctor/billing_doc/detail/' . $id);
        }
    }
}
