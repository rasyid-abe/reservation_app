<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    public function get_data($id)
    {
        if ($this->session->userdata('role_id') == 2) {
            $join = "JOIN admin a ON u.id_user = a.id_user";
        } elseif ($this->session->userdata('role_id') == 3) {
            $join = "JOIN dokter d ON u.id_user = d.id_user";
        } elseif ($this->session->userdata('role_id') == 4) {
            $join = "JOIN klien k ON u.id_user = k.id_user";
        }

        $sql = "
        SELECT *
        FROM user u
        $join
        WHERE u.id_user = $id
        ";

        return $this->db->query($sql)->row_array();
    }

    public function get_data_detail($id)
    {
        $role = $this->db->get_where('user', ['id_user' => $id])->row('role_id');
        if ($role == 2) {
            $join = "JOIN admin a ON u.id_user = a.id_user";
        } elseif ($role == 3) {
            $join = "JOIN dokter d ON u.id_user = d.id_user";
        } elseif ($role == 4) {
            $join = "JOIN klien k ON u.id_user = k.id_user";
        }

        $sql = "
        SELECT *
        FROM user u
        $join
        WHERE u.id_user = $id
        ";

        return $this->db->query($sql)->row_array();
    }
}
