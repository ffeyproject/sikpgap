@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Master Defect: <b>{{ $item->nama }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('item.update', $item->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Penilaian</label>
                            <input type="text" name="nama_penilaian"
                                class="form-control @error('nama_penilaian') is-invalid @enderror" id="nama_penilaian"
                                autocomplete="off" placeholder="Masukkan Nama Defect"
                                value="{{ $item->nama_penilaian }}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                    style="resize:none" name="keterangan" id="summernote" required
                                    rows="6">{{$item->keterangan}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection

@section('tablejs')
<script>
    $(function () {
    // Summernote
    $('#summernote').summernote()
  })
</script>


</script>
@endsection
