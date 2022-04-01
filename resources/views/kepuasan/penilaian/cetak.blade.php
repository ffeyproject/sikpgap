<!DOCTYPE html>
<html xmlns=''>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

<body style='font-family:Tahoma;font-size:12px;color: #333333;background-color:#FFFFFF;'>
    <table align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
        <tr>
            <td valign='top'>
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='88%'>
                        </td>
                        <td valign='top' width='27%' style='font-size:14px;'>GAP - FRM - MKT - 03<br />
                        </td>
                    </tr>
                </table>
                <table width='100%' cellspacing='0' cellpadding='3' border='1'>
                    <tr>
                        <td align="center" width='100%' style='font-size:16px;'>
                            <strong>
                                PT. GAJAH ANGKASA PERKASA
                            </strong><br>
                            <strong>
                                MARKETING DEPT
                            </strong><br><br>
                            < <strong> FORM PENILAIAN KEPUASAN PELANGGAN </strong>
                        </td>
                    </tr>
                </table><br>
                <table width='100%' height='100' cellspacing='0' cellpadding='0' border='1'>
                    <tr>
                        <td valign='top' width='50%' style='font-size:16px;'>
                            <strong>Kode Penilaian </strong><br>
                            <strong>Nama Pelanggan </strong>
                        </td>
                        <td valign='top' width='100%' style='font-size:16px;'>
                            <strong>: {{ $kepuasan->kode_penilaian }} </strong><br>
                            <strong>: {{ $kepuasan->buyer->nama_buyer }} </strong>
                        </td>
                        <td valign='top' width='30%' style='font-size:16px;'>
                            <strong>Kota </strong>
                        </td>
                        <td valign='top' width='60%' style='font-size:16px;'>
                            <strong>: {{ $kepuasan->alamat }} </strong>
                        </td>
                    </tr>
                </table>
                <table width='100%' height='100' cellspacing='0' cellpadding='0' border='1'>
                    <tr>
                        <td valign='top' width='50%' style='font-size:16px;'>
                            <strong>Nama Kontak</strong>
                        </td>
                        <td valign='top' width='100%' style='font-size:16px;'>
                            <strong>: {{ $kepuasan->nama_kontak }} </strong>
                        </td>
                        <td valign='top' width='30%' style='font-size:15px;'>
                            <strong>Tanggal Penilaian </strong>
                        </td>
                        <td valign='top' width='60%' style='font-size:16px;'>
                            <strong>: {{ $kepuasan->tgl_penilaian }} </strong>
                        </td>
                    </tr>
                </table><br>
                <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='25%' style='font-size:14px;'><strong>POINT PENILAIAN</strong><br>
                            <ul>
                                <li>
                                    Skor 0, apabila <b>TIDAK ADA PENILAIAN</b>
                                </li>
                                <li>Skor 20, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                    <b>TIDAK BAIK</b>
                                </li>
                                <li>Skor 40, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                    <b>KURANG BAIK</b>
                                </li>
                                <li>Skor 60, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                    <b>CUKUP BAIK</b>
                                </li>
                                <li>Skor 80, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                    <b>BAIK</b>
                                </li>
                                <li>Skor 100, apabila penilaian menurut anda atas komponen yang dinilai adalah
                                    <b>BAIK SEKALI</b>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <table width='100%' cellspacing='0' cellpadding='3' border='2' bordercolor='#CCCCCC'>
                    <thead>
                        <tr>
                            <th class="text-center" bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>No</th>
                            <th class="text-center" bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>Item
                                Penilaian</th>
                            <th bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>Score</th>
                        </tr>
                    </thead>
                    <?php $no = 1 ?>
                    <tbody>
                        @foreach ($detail as $row)
                        <tr>
                            <td style='font-size:16px;'>{{ $no++ }}.</td>
                            <td style='font-size:16px;'>{{ $row->itemevaluation->nama_penilaian}}
                            <td style='font-size:16px;'>{{ $row->score}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <ul>
                    <li>
                        <strong>
                            <label for="rata-rata" style='font-size:15px;'>NILAI RATA-RATA :
                                {{round($detail->avg('score'),2)}}
                            </label>
                        </strong>
                    </li>
                </ul>
                <table width='100%' cellspacing='0' cellpadding='2' border='2' bordercolor='#CCCCCC'>
                    <tr>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'><b> Produk terhadap
                                persyaratan Sertifikasi SNI 56-2017 untuk
                                Merek MAFELA dan
                                GAIA</b>
                    </tr>
                    <tr>
                        <td style='font-size:14px;'>{!! $kepuasan->desc_kesesuaian !!}</td>
                    </tr>
                </table>
                <table width='100%' cellspacing='0' cellpadding='2' border='2' bordercolor='#CCCCCC'>
                    <tr>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'><b>Kritik dan Saran</b>
                    </tr>
                    <tr>
                        <td style='font-size:14px;'>{!! $kepuasan->kritik_saran !!}</td>
                    </tr>
                </table><br><br><br>
                <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='30%' style='font-size:16px;'>
                            <strong>Buyer </strong><br><br>
                            <img src="{{ public_path('image/ttd/sign.png') }}" style="float:center;" widht="80"
                                height="85">
                            <br><br><br><br><br>
                            ( {{ $kepuasan->buyer->nama_buyer }})
                            <br>
                        </td>
                        <td valign='top' width='10%' style='font-size:16px;'>
                            <strong>Marketing </strong><br><br>
                            <img src="{{ public_path('image/ttd/'.$kepuasan->users->g_ttd) }}" style="float:left;"
                                widht="80" height="85"><br><br><br><br><br>
                            ( {{ $kepuasan->users->name }})
                            <br>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>
