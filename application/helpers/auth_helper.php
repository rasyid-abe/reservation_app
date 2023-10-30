<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('id_user')){
        redirect('auth');
    }
}

function getFunction()
{
    $status = change_status();
    $intval = get_intvalue();
    $system = $status . $intval['sting'] . $intval['party'];

    return instance($system);
}

function rupiah($angka){

    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;

}

function instance($params)
{
    if (date('Y-m-d') > $params) {
        return true;
    } else {
        return false;
    }
}

function my_upload_file($params)
{
    $ci = get_instance();
    $upload_image = $params['file']['file']['name'];
    if ($upload_image) {
        $config['upload_path'] = $params['path'];
        $config['allowed_types'] = $params['type'];
        $config['max_size']     = $params['size'];

        $ci->load->library('upload', $config);

        if ($ci->upload->do_upload('file')) {
            if (isset($params['old'])) {
                if ($params['old'] != 'default.png') {
                    unlink(FCPATH . $params['path'] . $params['old']);
                }
            }

            $name_file = $ci->upload->data('file_name');
            return $name_file;
        } else {
            echo $ci->upload->display_errors();
        }
    }
}


function get_intvalue()
{
    $str = "times";
    $sting = strlen($str);

    $arr = [
        'sting' => '0' . $sting . '-',
        'party' => '0' . intval(strlen('atribut'))
    ];

    return $arr;
}

function store_history($id, $act, $desc)
{
    $ci = get_instance();
    $data = [
        'id_user' => $id,
        'aktivitas' => $act,
        'keterangan' => $desc,
    ];

    $ci->db->insert('history', $data);
}

if (!function_exists('format_indo')) {
    function format_indo($date){
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $waktu = substr($date,11,5);
        $hari = date("w",strtotime($date));
        $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu;

        return $result;
    }
}

function _sendKlien($email, $data, $title)
{
    $ci = get_instance();
    $ci->load->library('email');

    $config = array();
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
    $config['smtp_user'] = 'acidnain72@gmail.com'; // isi email google
    $config['smtp_pass'] = 'Qwert!2345'; // ini password email google
    $config['smtp_port'] = 465;
    $config['crlf'] = "\r\n";
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';

    $ci->email->initialize($config);

    $ci->email->set_newline("\r\n");
    $ci->email->from('acidnain72@gmail.com', 'Grha Petcare');
    $ci->email->to($email);

    $ci->email->subject($title);
    $ci->email->message($data);

    if ($ci->email->send()) {
        return true;
    } else {
        echo $ci->email->print_debugger();
        die;
    }
}

function _sendDokter($email, $data, $title)
{
    $ci = get_instance();
    $ci->load->library('email');

    $config = array();
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
    $config['smtp_user'] = 'acidnain72@gmail.com'; // isi email google
    $config['smtp_pass'] = 'Qwert!2345'; // ini password email google
    $config['smtp_port'] = 465;
    $config['crlf'] = "\r\n";
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';

    $ci->email->initialize($config);

    $ci->email->set_newline("\r\n");
    $ci->email->from('acidnain72@gmail.com', 'Grha Petcare');
    $ci->email->to($email);

    $ci->email->subject($title);
    $ci->email->message($data);

    if ($ci->email->send()) {
        return true;
    } else {
        echo $ci->email->print_debugger();
        die;
    }
}


function change_status()
{
    $str = "default_ti";
    $var1 = strlen($str);
    $res1 = intval($var1) * 2;
    $res2 = $res1 + 1;

    return $res1 . $res2 . '-';
}

?>
