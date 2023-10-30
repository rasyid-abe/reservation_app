<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

    public function get_data_reservation()
    {
        $id = $this->db->get_where('klien', ['id_user' => $this->session->userdata('id_user')])->row('id_klien');
        $sql = "
        SELECT *
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        WHERE r.id_klien = $id
        ";

        return $this->db->query($sql)->result_array();
    }

    public function reservation_dashboard()
    {
        $id = $this->db->get_where('klien', ['id_user' => $this->session->userdata('id_user')])->row('id_klien');
        $sql = "
        SELECT *, r.nama_klien namaklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        WHERE r.status = 1 AND r.id_klien = $id
        ORDER BY id_reservasi DESC
        LIMIT 1
        ";

        return $this->db->query($sql)->row();
    }

    public function get_data_detail($id)
    {
        $sql = "
        SELECT *, r.nama_klien namaklien, r.alamat_klien alamatklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        JOIN klien k ON r.id_klien = k.id_klien
        WHERE r.id_reservasi = $id
        ";

        return $this->db->query($sql)->row();
    }


    public function get_data_reservation_by_id($id)
    {
        $sql = "
        SELECT * , r.nama_klien namaklien, r.alamat_klien alamatklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        where id_reservasi = $id
        ";

        return $this->db->query($sql)->row();
    }


    public function get_data_billing()
    {
        $klien = $this->db->get_where('klien', ['id_user' => $this->session->userdata('id_user')])->row('id_klien');
        $sql = "
        SELECT *, SUM(bd.qty) * SUM(bd.harga) biaya FROM biling b
        JOIN biling_detail bd ON b.id_biling = bd.id_biling
        JOIN reservasi r ON b.id_reservasi = r.id_reservasi
        JOIN klien k ON r.id_klien = k.id_klien
        WHERE k.id_klien = $klien
        GROUP BY kode_biling
        "
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
