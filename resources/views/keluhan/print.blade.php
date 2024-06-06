<!DOCTYPE html>
<html xmlns=''>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 5px;
        vertical-align: top;
    }

    .label {
        width: 25%;
        font-size: 14px;
        font-weight: bold;
    }

    .value {
        width: 70%;
        font-size: 14px;
    }

    .barcode {
        width: 10%;
        font-size: 6px;
    }
</style>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

<body style='font-family:Tahoma;font-size:12px;color: #333333;background-color:#FFFFFF;'>
    <table align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
        <tr>
            <td valign='top'>
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='10%'>
                            <img src="{{ public_path('dist/img/logo_gajah.jpg') }}" style="width: 55px; height: 65px;">
                        </td>
                        <td valign='top' width='80%' style='font-size:15px;'> <strong>PT. GAJAH ANGKASA
                                PERKASA</strong><br />
                            <strong>Quality Assurance Dept</strong><br /><br /><br><br>
                        </td>
                        <td valign='top' width='40%'>
                            <img src="{{ public_path('dist/img/logo_qa.jpg') }}" style="width: 50px; height: 50px;">
                        </td>
                        <td valign='top' width='60%' style='font-size:14px;'>GAP - FRM - QA - 22<br />
                        </td>
                    </tr>
                </table>
                {{-- <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td>
                            <div align='center' style='font-size: 22px;font-weight: bold;'>FORM PENYELESAIAN KELUHAN
                                PELANGGAN</div>
                            <br>
                        </td>
                    </tr>
                </table> --}}

                <table width='100%' cellspacing='0' cellpadding='3' border='1' bordercolor='#CCCCCC'>
                    <tr>
                        <td align='center' width='100%' bordercolor='#ccc' style='font-size:22px;'>
                            <strong>FORM PENYELESAIAN KELUHAN
                                PELANGGAN
                            </strong>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td class="label">Nomer FKP</td>
                        <td class="value">: {{ $keluhan->nomer_keluhan }}</td>
                        <td class="barcode" rowspan="9">
                            {!! DNS2D::getBarcodeHTML(
                            $keluhan->nomer_keluhan.'-'.
                            $keluhan->buyer->nama_buyer.'-'.
                            $keluhan->nama_marketing.'-'.
                            $keluhan->no_wo.'-'.
                            $keluhan->nama_motif.'-'.
                            $keluhan->cw_qty.'-'.
                            $keluhan->jenis.'-'.
                            $keluhan->masalah.'-'.
                            $keluhan->status
                            ,'QRCODE',3,3) !!}<br /><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal FKP</td>
                        <td class="value">: {{ $keluhan->tgl_keluhan }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nama Buyer</td>
                        <td class="value">: {{ $keluhan->buyer->nama_buyer }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nama Marketing</td>
                        <td class="value">: {{ $keluhan->nama_marketing }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nomer WO</td>
                        <td class="value">: {{ $keluhan->no_wo }}</td>
                    </tr>
                    <tr>
                        <td class="label">No Sc</td>
                        <td class="value">: {{ $keluhan->no_sc }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nama Motif</td>
                        <td class="value">: {{ $keluhan->nama_motif }}</td>
                    </tr>
                    <tr>
                        <td class="label">CW/QTY</td>
                        <td class="value">: {{ $keluhan->cw_qty }}, {{ $keluhan->qty_complaint }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jenis</td>
                        <td class="value">: {{ $keluhan->jenis }}</td>
                    </tr>
                </table>
                <table width='100%' cellspacing='0' cellpadding='3' border='1' bordercolor='#CCCCCC'>
                    <tr>
                        <td width='100%' bordercolor='#ccc' style='font-size:14px;'>
                            <strong>ASAL MASALAH COMPLAINT
                            </strong> :
                        </td>
                    </tr>
                </table><br>
                <table width='100%' cellspacing='0' cellpadding='3' border='1' bordercolor='#CCCCCC'>
                    <tr>
                        <td align="center" width='100%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>
                            <strong>MASALAH
                                YANG DI KOMPLAIN
                            </strong>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    <tr>
                        <td valign='top' style='font-size:12px;'>{!! $keluhan->masalah !!}</td>
                </table><br>
                <table width='100%' cellspacing='0' cellpadding='3' border='1' bordercolor='#CCCCCC'>
                    <tr>
                        <td align="center" width='100%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>
                            <strong>PENYEBAB MASALAH KOMPLAIN
                            </strong>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    </tr>
                    <tr>
                        <td valign='top' style='font-size:12px;' width="200" height="100">

                        </td>
                    </tr>
                </table><br>
                <table width='100%' cellspacing='0' cellpadding='3' border='1' bordercolor='#CCCCCC'>
                    <tr>

                        <td align="center" width='100%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>
                            <strong>TINDAKAN PERBAIKAN DAN PENCEGAHAN DARI PIHAK TERKAIT
                            </strong>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    </tr>
                    <tr>
                        <td valign='top' style='font-size:12px;' width="200" height="100"></td>
                    </tr>
                </table><br>
                <table width='100%' cellspacing='0' cellpadding='8' border='1' bordercolor='#CCCCCC'>
                    <tr>

                        <td align="center" width='100%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>
                            <strong>TARGET WAKTU DAN HASIL VERIFIKASI
                            </strong>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    </tr>
                    <tr>
                        <td valign='top' style='font-size:14px;'>
                            <?php
                            // Misalkan variabel $keluhan->tgl_keluhan adalah string tanggal
                            $tgl_keluhan = $keluhan->tgl_keluhan;

                            // Mengubah string tanggal menjadi objek DateTime
                            $date = new DateTime($tgl_keluhan);

                            // Menambahkan 14 hari
                            $date->modify('+16 days');

                            // Mengubah kembali objek DateTime menjadi string tanggal
                            $tgl_keluhan_baru = $date->format('Y-m-d');

                            ?>
                            <strong>Target Waktu : {{ \Carbon\Carbon::parse($tgl_keluhan_baru)->isoFormat('dddd, D MMMM
                                Y')
                                }}</strong><br>
                            <strong>Tanggal Verifikasi : </strong><br>
                            <strong>Hasil Verifikasi : </strong><br>
                        </td>
                    </tr>
                </table><br>

                <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='70%' style='font-size:14px;'>
                            <strong>Team Penyelidik </strong><br><br>
                            <br>
                            ___________________<br>
                        </td>
                        <td valign='top' width='80%' style='font-size:14px;'>
                            <strong>Kabag Terkait </strong><br><br>
                            <br>
                            ___________________<br>
                        </td>
                        <td valign='top' width='40%' style='font-size:14px;'>
                            <strong>Manager Terkait </strong><br><br>

                            <br>
                            ___________________<br>
                        </td>
                    </tr>
                </table>
                <br>

            </td>
        </tr>
    </table>

</body>

</html>