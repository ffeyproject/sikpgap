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
            </td>
        </tr>
    </table>

    <table class="table table-head-fixed text-nowrap">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <?php $no = 1 ?>
        <tbody>
            @forelse ($icomplaint as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td><img src="{{ url('image/keluhan/'.$item->nama_image) }}" style="width: 300px; height: 300px;">
                </td>
                <td>{!! $item->keterangan !!}</td>
                @empty
            <tr>
                <td colspan="12">Gambar Pendukung Belum Ada.</td>
            </tr>
            </tr>
        </tbody>
        @endforelse
    </table>
</body>

</html>