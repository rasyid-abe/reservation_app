<?php
            $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->setPageOrientation('L');
            $pdf->SetTitle('Laporan Biling');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');

            $pdf->setPageUnit('pt');
            $document_width = $pdf->pixelsToUnits('100');
            $document_height = $pdf->pixelsToUnits('100');
            $x = $pdf->pixelsToUnits('20');
            $y = $pdf->pixelsToUnits('20');
            $font_size = $pdf->pixelsToUnits('10');

            $pdf->AddPage();
            $i=0;
            $html='<h3>LAPORAN RESERVASI</h3>
                    <h4>Dibuat Pada : '.format_indo(date('Y-m-d')).'</h4>
                    <table cellspacing="0" cellpadding="1" border="1" style="border-color:gray;">
                        <tr bgcolor="#ffffff">
                            <th width="3%" align="center">NO</th>
                            <th width="12%" align="center">ID RESERVASI</th>
                            <th width="14%" align="center">NAMA KLIEN</th>
                            <th width="10%" align="center">TANGGAL</th>
                            <th width="10%" align="center">JAM</th>
                            <th width="7%" align="center">JUMLAH HEWAN</th>
                            <th width="22%" align="center">KELUHAN</th>
                            <th width="14%" align="center">NAMA DOKTER</th>
                            <th width="8%" align="center">STATUS</th>
                        </tr>';
            foreach ($data as $row)
                {
                    if ($row['status'] == 0) {
                        $l = "Menunggu";
                    } elseif ($row['status'] == 1) {
                        $l = "Disetujui";
                    } elseif ($row['status'] == 2) {
                        $l = "Ditolak";
                    } else {
                        $l = "Dibatalkan";
                    }

                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
                            <td align="center">'.$row['kode_reservasi'].'</td>
                            <td>'.$row['namaklien'].'</td>
                            <td align="center">'.$row['tgl_reservasi'].'</td>
                            <td align="center">'.$row['jam_reservasi'].'</td>
                            <td align="center">'.$row['jumlah_hewan'].'</td>
                            <td>'.$row['keluhan'].'</td>
                            <td>'.$row['nama_dokter'].'</td>
                            <td align="center">'.$l.'</td>
                        </tr>';
                }
            $html.='</table>';
            $pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('Laporan_Biling.pdf', 'I');
?>
