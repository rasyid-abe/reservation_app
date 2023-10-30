<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing_adm extends CI_Controller {

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
        store_history($this->id, "View", "Melihat Data List Biling");

        $title = "Biling";
        $subtitle = "Daftar Biling";
        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['link_home'] = $this->link;
        $data['list'] = $this->root_model->get_data_billing();
        $this->template->content("admin/billing/list", $data);
        $this->template->show('template/home');
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
        $data['row'] = $this->root_model->get_data_billing_by_id($id);
        $data['detail'] = $this->db->get_where('biling_detail', ['id_biling' => $id])->result();
        $data['link_home'] = $this->link;
        $this->template->content("admin/billing/detail", $data);
        $this->template->show('template/home');
    }

    public function edit($id)
    {
        $title = "Biling";
        $subtitle = "Ubah Biling";

        $data = array();
        $data['header_title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['row'] = $this->root_model->get_data_billing_by_id($id);
        $data['detail'] = $this->db->get_where('biling_detail', ['id_biling' => $id])->result();
        $data['link_home'] = $this->link;
        $data['id'] = $id;
        $this->template->content("admin/billing/edit", $data);
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
            redirect('admin/billing_adm/detail/' . $id);
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fa fa-check"></i> Gagal!</h6>
            Biling gagal diubah.
            ');
            redirect('admin/billing_adm/detail/' . $id);
        }
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
        store_history($this->id, "Export", "Export PDF Data Biling");

        $data['data'] = $this->root_model->get_export_data($tahun, $bulan);
        $this->load->view('root/billing/export_pdf', $data);
    }

    public function export_excel($tahun, $bulan){
        store_history($this->id, "Export", "Export Excel Data Biling");

        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Biling')
        ->setLastModifiedBy('My Code')
        ->setTitle("Data Biling")
        ->setSubject("Biling")
        ->setDescription("Laporan Semua Data Biling")
        ->setKeywords("Data Biling");

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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA BILING"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:J1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        if ($tahun != "") {
            $excel->setActiveSheetIndex(0)->setCellValue('A2', "Filter : Tahun " . $tahun); // Set kolom A1 dengan tulisan "DATA SISWA"
        }
        if ($bulan != "") {
            $excel->setActiveSheetIndex(0)->setCellValue('A2', "Filter : Bulan " . $b[$bulan] ." Tahun " . $tahun); // Set kolom A1 dengan tulisan "DATA SISWA"
        }
        $excel->getActiveSheet()->mergeCells('A2:J2'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(13); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B4', "ID BILING"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C4', "KODE DOKTER"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('D4', "NAMA DOKTER"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('E4', "NAMA KLIEN"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('F4', "TANGGAL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('G4', "JUMLAH HEWAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('H4', "KELUHAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('I4', "DIAGNOSA"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('J4', "BIAYA"); // Set kolom E3 dengan tulisan "ALAMAT"

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
        $excel->getActiveSheet()->getStyle('J4')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $data = $this->root_model->get_export_data($tahun, $bulan);

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
        $total_biaya = 0;
        foreach($data as $v){ // Lakukan looping pada variabel siswa

            $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $v['kode_biling']);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $v['kode_dokter']);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $v['nama_dokter']);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $v['nama_klien']);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, format_indo($v['tanggal']));
            $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $v['jumlah_hewan']);
            $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $v['keluhan']);
            $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $v['diagnosa']);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $v['biaya']);

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
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
            $total_biaya = $total_biaya + $v['biaya'];
        }

        $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, "Total Biaya"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->getStyle("A".$numrow.":I".$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->mergeCells("A".$numrow.":I".$numrow); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A'.$numrow)->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A'.$numrow)->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $total_biaya); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('J'.$numrow)->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('J'.$numrow)->getFont()->setSize(15); // Set font size 15 untuk kolom A1

        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Biling");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Biling.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
