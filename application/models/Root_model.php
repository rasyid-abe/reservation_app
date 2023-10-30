<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Root_model extends CI_Model {

    public function get_data_admin()
    {
        $sql = "
        SELECT *
        FROM admin a
        JOIN user u ON a.id_user = u.id_user
        WHERE u.role_id = 2
        ";

        return $this->db->query($sql)->result_array();
    }

    public function get_data_admin_by_id($id)
    {
        $sql = "
        SELECT *
        FROM admin a
        JOIN user u ON a.id_user = u.id_user
        WHERE u.role_id = 2 AND u.id_user = $id
        ";

        return $this->db->query($sql)->row();
    }

    public function get_data_client()
    {
        $sql = "
        SELECT *
        FROM klien k
        JOIN user u ON k.id_user = u.id_user
        WHERE u.role_id = 4
        ";

        return $this->db->query($sql)->result_array();
    }

    public function get_data_client_by_id($id)
    {
        $sql = "
        SELECT *
        FROM klien k
        JOIN user u ON k.id_user = u.id_user
        WHERE u.role_id = 4 AND u.id_user = $id
        ";

        return $this->db->query($sql)->row();
    }

    public function get_data_doctor()
    {
        $sql = "
        SELECT *
        FROM dokter d
        JOIN user u ON u.id_user = d.id_user
        WHERE u.role_id = 3
        ";

        return $this->db->query($sql)->result_array();
    }

    public function get_data_doctor_by_id($id)
    {
        $sql = "
        SELECT *
        FROM dokter d
        JOIN user u ON u.id_user = d.id_user
        WHERE u.role_id = 3 AND u.id_user = $id
        ";

        return $this->db->query($sql)->row();
    }

    public function get_data_reservation()
    {
        $sql = "
        SELECT *, r.nama_klien namaklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        JOIN klien k ON r.id_klien = k.id_klien
        ";

        return $this->db->query($sql)->result_array();
    }

    public function get_data_reservation_export($tahun, $bulan)
    {
        $where = "1=1";
        if ($tahun != "") {
            $where .= " AND EXTRACT(YEAR FROM r.tgl_reservasi) = '$tahun'";
        }
        if ($bulan != "") {
            $where .= " AND EXTRACT(MONTH FROM r.tgl_reservasi) = '$bulan'";
        }
        $sql = "
        SELECT *, r.nama_klien namaklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        JOIN klien k ON r.id_klien = k.id_klien
        WHERE $where
        ";

        $data = $this->db->query($sql)->result_array();
        return $data;
    }

    public function get_data_reservation_by_id($id)
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

    public function get_data_reservation_by_code($id)
    {
        $sql = "
        SELECT *, r.nama_klien namaklien, r.alamat_klien alamatklien
        FROM reservasi r
        JOIN dokter d ON r.id_dokter = d.id_dokter
        JOIN klien k ON r.id_klien = k.id_klien
        WHERE r.kode_reservasi = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    public function get_data_billing()
    {
        $sql = "
        SELECT *, SUM(bd.qty) * SUM(bd.harga) biaya FROM biling b
        JOIN biling_detail bd ON b.id_biling = bd.id_biling
        JOIN reservasi r ON b.id_reservasi = r.id_reservasi
        JOIN klien k ON r.id_klien = k.id_klien
        GROUP BY bd.id_biling
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

    public function get_export_data($tahun, $bulan)
    {
        $where = "1=1";
        if ($tahun != "") {
            $where .= " AND EXTRACT(YEAR FROM b.tanggal) = '$tahun'";
        }
        if ($bulan != "") {
            $where .= " AND EXTRACT(MONTH FROM b.tanggal) = '$bulan'";
        }

        $sql = "
        SELECT b.kode_biling, b.keluhan, b.jumlah_hewan, b.diagnosa, b.tanggal, SUM(bd.qty) * SUM(bd.harga) biaya, r.nama_klien, d.nama_dokter, d.kode_dokter
        FROM biling b
        JOIN biling_detail bd ON b.id_biling = bd.id_biling
        JOIN reservasi r ON r.id_reservasi = b.id_reservasi
        JOIN dokter d ON d.id_dokter = r.id_dokter
        WHERE $where
        GROUP BY bd.id_biling
        ";

        return $this->db->query($sql)->result_array();
    }
}
