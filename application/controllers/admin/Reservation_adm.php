<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation_adm extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        if($this->session->userdata('role_id') != 2) redirect('auth/logout');
        $this->load->library('form_validation');
        $this->load->model('root_model');
        $this->link = 'home_adm';
        $this->id = $this->session->userdata('id_user');
        $this->load->library('Pdf');
    }

    public function index()
    {
        store_history($this->id, "View", "Melihat Data List Reservasi");

        $title = "Reservasi";
        $subtitle = "Daftar Reservasi";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['list'] = $this->root_model->get_data_reservation();
        $this->template->content("admin/reservation/list", $data);
        $this->template->show('template/home');
    }

    public function detail_reservation($id)
    {
        $code = $this->db->get_where('reservasi', ['id_reservasi' => $id])->row('kode_reservasi');
        store_history($this->id, "View Detail", "Melihat Data Detail Reservasi dengan kode " . $code);

        $title = "Reservasi";
        $subtitle = "Detail Reservasi";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['row'] = $this->root_model->get_data_reservation_by_id($id);
        $this->template->content("admin/reservation/detail", $data);
        $this->template->show('template/home');
    }

    public function type_export()
    {
        $tipe = $this->input->post('actionBtn');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        if ($tipe == "Export Excel") {
            $this->export_excel($tahun, $bulan);
        } else {
            $this->export_pdf($tahun, $bulan);
        }
    }

    public function export_pdf($tahun, $bulan)
    {
        store_history($this->id, "Export", "Export PDF Data Reservasi");

        $data['data'] = $this->root_model->get_data_reservation_export($tahun, $bulan);
        $this->load->view('root/reservation/export_pdf', $data);
    }

    public function export_excel($tahun, $bulan){
        store_history($this->id, "Export", "Export Data Reservasi");

        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Reservasi')
        ->setLastModifiedBy('My Code')
        ->setTitle("Data Reservasi")
        ->setSubject("Reservasi")
        ->setDescription("Laporan Semua Data Reservasi")
        ->setKeywords("Data Reservasi");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Untuk Subtitle
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $b = [
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember",
        ];

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA RESERVASI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        if ($tahun != "") {
            $excel->setActiveSheetIndex(0)->setCellValue('A2', "Filter : Tahun " . $tahun); // Set kolom A1 dengan tulisan "DATA SISWA"
        }
        if ($bulan != "") {
            $excel->setActiveSheetIndex(0)->setCellValue('A2', "Filter : Bulan " . $b[$bulan] ." Tahun " . $tahun); // Set kolom A1 dengan tulisan "DATA SISWA"
        }
        $excel->getActiveSheet()->mergeCells('A2:I2'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(13); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B4', "ID RESERVASI"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA KLIEN"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D4', "TANGGAL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E4', "JAM"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('F4', "JUMLAH HEWAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('G4', "KELUHAN"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('H4', "NAMA DOKTER"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('I4', "STATUS"); // Set kolom E3 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I4')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $data = $this->root_model->get_data_reservation_export($tahun, $bulan);

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($data as $v){ // Lakukan looping pada variabel siswa

            if ($v['status'] == 0) {
                $l = "Menunggu";
            } elseif ($v['status'] == 1) {
                $l = "Disetujui";
            } elseif ($v['status'] == 2) {
                $l = "Ditolak";
            } else {
                $l = "Dibatalkan";
            }

            $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $v['kode_reservasi']);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $v['namaklien']);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, format_indo($v['tgl_reservasi']));
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $v['jam_reservasi']);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $v['jumlah_hewan']);
            $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $v['keluhan']);
            $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $v['nama_dokter']);
            $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $l);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Reservasi");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Reservasi.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
