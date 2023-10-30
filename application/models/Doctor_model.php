<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {

    public function get_data_reservation_count()
    {
        $sql = "
        SELECT *
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        JOIN user u ON d.id_user = u.id_user
        WHERE u.id_user = " . $this->session->userdata('id_user')
        ;

        return $this->db->query($sql)->num_rows();
    }

    public function get_data_reservation()
    {
        $sql = "
        SELECT *, r.nama_klien namaklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        JOIN user u ON d.id_user = u.id_user
        WHERE u.id_user = " . $this->session->userdata('id_user')
        ;

        return $this->db->query($sql)->result_array();
    }

    public function get_data_reservation_present()
    {
        $sql = "
        SELECT *, r.nama_klien namaklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        JOIN user u ON d.id_user = u.id_user
        WHERE r.status = 1 AND u.id_user = " . $this->session->userdata('id_user')
        ;

        return $this->db->query($sql)->result_array();
    }

    public function reservasi_dashboard()
    {
        $sql = "
        SELECT *, r.nama_klien namaklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        JOIN user u ON d.id_user = u.id_user
        WHERE r.status = 1 AND u.id_user = " . $this->session->userdata('id_user') ."
        ORDER BY id_reservasi DESC
        LIMIT 1
        "
        ;

        return $this->db->query($sql)->row();
    }

    public function get_data_reservation_by_id($id)
    {
        $sql = "
        SELECT *,  r.nama_klien namaklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        JOIN user u ON d.id_user = u.id_user
        WHERE r.id_reservasi = $id AND u.id_user = " . $this->session->userdata('id_user')
        ;

        return $this->db->query($sql)->row();
    }

    public function get_data_client()
    {
        $id = $this->db->get_where('dokter', ['id_user' => $this->session->userdata('id_user')])->row('id_dokter');
        $sql = "
        SELECT * FROM reservasi r
        JOIN klien k ON r.id_klien = r.id_klien
        WHERE r.id_dokter = $id
        GROUP BY kode_klien
        ";

        return $this->db->query($sql)->result_array();
    }

    public function get_data_client_count()
    {
        $id = $this->db->get_where('dokter', ['id_user' => $this->session->userdata('id_user')])->row('id_dokter');
        $sql = "
        SELECT * FROM reservasi r
        JOIN klien k ON r.id_klien = r.id_klien
        WHERE r.id_dokter = $id
        GROUP BY kode_klien
        ";

        return $this->db->query($sql)->num_rows();
    }

    public function get_data_billing_count()
    {
        $id = $this->db->get_where('dokter', ['id_user' => $this->session->userdata('id_user')])->row('id_dokter');
        $sql = "
        SELECT * FROM biling b
        JOIN biling_detail bd ON b.id_biling = bd.id_biling
        JOIN reservasi r ON b.id_reservasi = r.id_reservasi
        JOIN klien k ON r.id_klien = k.id_klien
        WHERE r.id_dokter = $id
        GROUP BY kode_biling"
        ;
        return $this->db->query($sql)->num_rows();
    }

    public function get_data_billing()
    {
        $id = $this->db->get_where('dokter', ['id_user' => $this->session->userdata('id_user')])->row('id_dokter');
        $sql = "
        SELECT *, SUM(bd.qty) * SUM(bd.harga) biaya FROM biling b
        JOIN biling_detail bd ON b.id_biling = bd.id_biling
        JOIN reservasi r ON b.id_reservasi = r.id_reservasi
        JOIN klien k ON r.id_klien = k.id_klien
        WHERE r.id_dokter = $id
        GROUP BY bd.id_biling"
        ;
        return $this->db->query($sql)->result_array();
    }

    public function get_data_billing_by_id($id)
    {
        $sql = "
        SELECT * FROM biling b
        JOIN reservasi r ON b.id_reservasi = r.id_reservasi
        JOIN klien k ON r.id_klien = k.id_klien
        JOIN dokter d ON r.id_dokter = d.id_dokter
        WHERE b.id_biling = $id "
        ;

        return $this->db->query($sql)->row();
    }
}
