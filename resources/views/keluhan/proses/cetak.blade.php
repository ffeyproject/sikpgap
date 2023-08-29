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
                        <td valign='top' width='90%' style='font-size:16px;'> <strong>PT. GAJAH ANGKASA
                                PERKASA</strong><br />
                            <strong>MARKETING DEPT</strong><br /><br /><br><br>
                        </td>
                        <td valign='top' width='70%'>
                        </td>
                        <td valign='top' width='50%' style='font-size:14px;'>GAP - FRM - MKT - 06<br />
                        </td>
                    </tr>
                </table>
                <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td>
                            <div align='center' style='font-size: 22px;font-weight: bold;'>FORM KELUHAN PELANGGAN</div>
                            <br><br>
                        </td>
                    </tr>
                </table>
                <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='25%' style='font-size:16px;'><strong>Nomer FKP</strong><br>
                            <strong>Tanggal </strong><br>
                            <strong>Nama Toko/Buyer </strong><br>
                            <strong>Nama Marketing </strong><br>
                            <strong>Nomer Wo </strong><br>
                            <strong>No Sc </strong><br>
                            <strong>Nama Motif </strong><br>
                            <strong>CW/.QTY </strong><br>
                            <strong>Jenis </strong><br>
                            <strong>Tanggal Proses </strong><br>
                            <strong>Asal Masalah </strong><br>
                            <strong>Penyelidik </strong><br>
                        </td>
                        <td valign='top' width='70%' style='font-size:16px;'>
                            : {{ $keluhan->nomer_keluhan }} <br>
                            : {{ $keluhan->tgl_keluhan }} <br>
                            : {{ $keluhan->buyer->nama_buyer }} <br>
                            : {{ $keluhan->nama_marketing }} <br>
                            : {{ $keluhan->no_wo }} <br>
                            : {{ $keluhan->no_sc }} <br>
                            : {{ $keluhan->nama_motif }} <br>
                            : {{ $keluhan->cw_qty }} <br>
                            : {{ $keluhan->jenis }} <br>
                            : {{ $keluhan->tgl_proses }} <br>
                            @forelse($result as $item)
                            : {{ $item->departements->asal_masalah }} <br>
                            : {{ $item->users->name }} <br><br>
                            @empty
                            <strong></strong>
                            @endforelse
                        </td>
                        <td valign='top' width='10%' style='font-size:6px;'>
                            {!!
                            DNS2D::getBarcodeHTML(
                            $keluhan->nomer_keluhan.'-'.
                            $keluhan->buyer->nama_buyer.'-'.
                            $keluhan->nama_marketing.'-'.
                            $keluhan->no_wo.'-'.
                            $keluhan->nama_motif.'-'.
                            $keluhan->cw_qty.'-'.
                            $keluhan->jenis.'-'.
                            $keluhan->tgl_proses.'-'.
                            $keluhan->masalah.'-'.
                            $keluhan->status
                            ,'QRCODE',3,3)
                            !!}<br /><br>
                        </td>
                    </tr>
                </table>
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
                            <strong>HASIL PENELUSURAN MASALAH
                            </strong>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    </tr>
                    @forelse ($result as $item)
                    <tr>
                        <td valign='top' style='font-size:12px;'>{!! $item->hasil_penelusuran !!}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12">Data Penelurusan Belum Ada.</td>
                    </tr>
                    @endforelse
                </table><br>
                <table width='100%' cellspacing='0' cellpadding='3' border='1' bordercolor='#CCCCCC'>
                    <tr>

                        <td align="center" width='100%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>
                            <strong>TINDAKAN PERBAIKAN DAN PENCEGAHAN
                            </strong>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    </tr>
                    @forelse ($result as $item)
                    <tr>
                        <td valign='top' style='font-size:12px;'>{!! $item->tindakan !!}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12">Data Penelurusan Belum Ada.</td>
                    </tr>
                    @endforelse
                </table><br>
                <table width='100%' cellspacing='0' cellpadding='3' border='1' bordercolor='#CCCCCC'>
                    <tr>
                        <td align="center" width='100%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>
                            <strong>TINDAKAN AKHIR
                            </strong>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    <tr>
                        <td valign='top' style='font-size:12px;'>{!! $keluhan->solusi !!}</td>
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
                    @forelse ($result as $item)
                    <tr>
                        <td valign='top' style='font-size:14px;'>
                            <strong>Target Waktu : {{ $item->target_waktu }}</strong><br>
                            <strong>Tanggal Verifikasi : {{ $item->tgl_verifikasi }}</strong><br>
                            <strong>Hasil Verifikasi : {!! $item->hasil_verifikasi !!}</strong><br>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12">Data Penelurusan Belum Ada.</td>
                    </tr>
                    @endforelse
                </table><br>
                <table width='100%' cellspacing='0' cellpadding='3' border='1' bordercolor='#CCCCCC'>
                    <tr>
                        <td align="center" width='100%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:16px;'>
                            <strong>VERIFIKASI AKHIR
                            </strong>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    <tr>
                        <td valign='top' style='font-size:12px;'>{!! $keluhan->verifikasi_akhir !!}</td>
                </table><br><br>

                <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='70%' style='font-size:16px;'>
                            <strong>Marketing </strong><br><br>
                            <img src="{{ public_path('image/ttd/'.$keluhan->users->g_ttd) }}" style="float:left;"
                                widht="80" height="85"><br><br><br><br><br>
                            ( {{ $keluhan->nama_marketing }})
                            <br>
                        </td>
                        <td valign='top' width='80%' style='font-size:16px;'>
                            <strong>Manajer Marketing </strong><br><br>
                            <img src="{{ public_path('image/ttd/ferry.png') }}" style="float:center;" widht="80"
                                height="85">
                            <br><br><br><br><br>
                            ( Ferry Halim )<br>
                        </td>
                        <td valign='top' width='40%' style='font-size:16px;'>
                            <strong>Team Penyelidik </strong><br><br>
                            @foreach ($result as $item)
                            <img src="{{ public_path('image/ttd/'. $item->users->g_ttd) }}" style="float:right;"
                                widht="80" height="85">
                            <br><br><br><br><br>
                            ( {{ $item->users->name }})<br>
                            @endforeach
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>