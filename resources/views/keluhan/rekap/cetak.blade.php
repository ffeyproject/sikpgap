<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
</head>

<body>
    <h1>Hello, world!</h1>
    <table id="t_barang" class="table table-bordered table-striped" border="1">
        <thead>
            <th>No</th>
            <th>No FKP</th>
            <th>Tanggal FKP</th>
            <th>Marketing</th>
            <th>Buyer</th>
            <th>No.Wo, No.Sc</th>
            <th>Motif, Quantity</th>
            <th>Masalah</th>
            <th>Hasil Penyelidikan</th>
            <th>Tindakan Perbaikan</th>
            <th>Asal Masalah</th>
            <th>Penyebab Komplain</th>
            <th>Target Penyelesaian</th>
            <th>Hasil Verifikasi</th>
        </thead>
        <?php $no = 1 ?>
        <tbody>
            @foreach($complaints as $complaint)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{$complaint->nomer_keluhan}}</td>
                <td>{{$complaint->tgl_keluhan}}</td>
                <td>{{$complaint->nama_marketing}}</td>
                <td>{{$complaint->buyer->nama_buyer}}</td>
                <td>{{$complaint->no_wo}}, {{ $complaint->no_sc }}</td>
                <td>{{$complaint->nama_motif}}, {{ $complaint->cw_qty }}</td>
                <td>{!!$complaint->masalah!!}</td>
                @foreach ($complaint->results as $item )
                <td>{!!$item->hasil_penelusuran!!}</td>
                <td>{!! $item->tindakan !!}</td>
                <td>{{ $item->departements->asal_masalah }}</td>
                <td>
                    @if ($item->defect)
                    {{ $item->defect->nama }}
                    @endif
                </td>
                <td>{{ $item->target_waktu }}</td>
                <td>{!! $item->hasil_verifikasi !!}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>