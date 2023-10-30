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
            $html='<h3>LAPORAN BILING</h3>
                    <h4>Dibuat Pada : '.format_indo(date('Y-m-d')).'</h4>
                    <table cellspacing="0" cellpadding="1" border="1" style="border-color:gray;">
                        <tr bgcolor="#ffffff">
                            <th width="3%" align="center">NO</th>
                            <th width="12%" align="center">ID BILING</th>
                            <th width="10%" align="center">KODE DOKTER</th>
                            <th width="12%" align="center">NAMA DOKTER</th>
                            <th width="12%" align="center">NAMA KLIEN</th>
                            <th width="7%" align="center">TANGGAL</th>
                            <th width="7%" align="center">JUMLAH HEWAN</th>
                            <th width="11%" align="center">KELUHAN</th>
                            <th width="18%" align="center">DIAGNOSA</th>
                            <th width="8%" align="center">BIAYA</th>
                        </tr>';
                        $total_biaya = 0;
            foreach ($data as $row)
                {
                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
                            <td align="center">'.$row['kode_biling'].'</td>
                            <td align="center">'.$row['kode_dokter'].'</td>
                            <td>'.$row['nama_dokter'].'</td>
                            <td>'.$row['nama_klien'].'</td>
                            <td align="center">'.$row['tanggal'].'</td>
                            <td align="center">'.$row['jumlah_hewan'].'</td>
                            <td>'.$row['keluhan'].'</td>
                            <td>'.$row['diagnosa'].'</td>
                            <td align="right">'.number_format($row['biaya'],0,",",",").'</td>
                        </tr>';
                    $total_biaya = $total_biaya + $row['biaya'];
                }
                $html .= '
                    <tr>
                        <th colspan="9" align="center">TOTAL</th>
                        <th align="right">'.number_format($total_biaya,0,",",",").'</th>
                    </tr>
                ';
            $html.='</table>';
            $pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('Laporan_Biling.pdf', 'I');
?>
