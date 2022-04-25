@extends('customer.layout.app')
@section('content')
<div class="page-banner home-banner">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="container">
                <a href="{{ route('penilaian.create') }}" class="btn btn-primary btn-lg"><i
                        class="far fa-plus-square"></i> Berikan Penilaian</a><br><br>
                @include('components.alert')
                <div class="row justify-content-center">
                    <table id="customers">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>View</th>
                                <th>Kode Penilaian</th>
                                <th>Tanggal Penilaian</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama Kontak</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php $no = 1 ?>
                        <tbody>
                            @forelse ($kepuasan as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <a href="{{ route('kepuasan.vpenilaian', $item->id) }}" target="_blank" <button
                                        type="button" class="btn btn-info btn-sm">
                                        Detail</button></a>
                                </td>
                                <td>{{ $item->kode_penilaian }}</td>
                                <td>{{ $item->tgl_penilaian }}</td>
                                <td>{{ $item->buyer->nama_buyer }}</td>
                                <td>{{ $item->nama_kontak }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    @if($item->status == 'open')
                                    <div class="container">
                                        <form action="{{ route('kepuasan.destroy', $item->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </td>
                                @empty
                            <tr>
                                <td colspan="12">Data tidak ada.</td>
                            </tr>
                            </tr>
                        </tbody>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-section client-section">
    <div class="container-fluid">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 justify-content-center">
            @foreach($image as $item)
            <div class="item wow zoomIn">
                <img src="{{ url('image/client/'.$item->g_client) }}" alt="">
            </div>
            @endforeach
        </div>
    </div> <!-- .container-fluid -->
</div> <!-- .page-section -->
@endsection
