@extends('customer.layout.app')
@section('content')
<div class="page-banner home-banner">
    <br><br>
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="container">
                <table class="table table-bordered table-striped" border="2">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Item Penilaian</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <?php $no = 1 ?>
                    <tbody>
                        @foreach ($detail as $row)
                        <input type="hidden" name="satisfactions_id" value="{{ $kepuasan->id }}">
                        <tr>
                            <td>{{ $no++ }}.</td>
                            <td>{{ $row->itemevaluation->nama_penilaian}}
                            <td>{{ $row->score}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div class="form-group">
                    <label for="rata-rata">NILAI RATA RATA : {{round($detail->avg('score'), 2)}}</label>
                </div>

                <div class="card-body">
                    <div class="callout callout-info">
                        <h5>Kesesuaian Produk terhadap persyaratan Sertifikasi SNI 56-2017 untuk Merek MAFELA dan
                            GAIA</h5>
                        <p>{!! $kepuasan->desc_kesesuaian !!}</p>
                    </div><br>
                    <div class="callout callout-danger">
                        <h5>Kritik dan Saran</h5>
                        <p>{!! $kepuasan->kritik_saran !!}.</p>
                    </div>
                    <div class="text-center p-t-136">
                        <a href="{{ route('customer.penilaian') }}" <button type="button" class="btn btn-info btn-lg">
                            Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<br><br><br><br><br><br><br>

<br><br><br>

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
