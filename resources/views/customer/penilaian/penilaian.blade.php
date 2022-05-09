@extends('customer.layout.app')
@section('content')
<div class="page-banner home-banner">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="container">
                @foreach ($menuDashboard as $aa )
                @if($aa->item_menu == 'Beri Penilaian' && $aa->status == 'Aktif')
                <a href="{{ route('penilaian.create') }}" class="btn btn-primary btn-lg"><i
                        class="far fa-plus-square"></i> Berikan
                    Penilaian
                </a>
                @elseif($aa->item_menu == 'Info Penilaian' && $aa->status == 'Aktif')
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        {!! $aa->ket_menu !!}
                    </div>
                </div>
                @endif
                @endforeach
                <br><br>
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
