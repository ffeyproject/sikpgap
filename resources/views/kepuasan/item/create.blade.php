@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input Master Index Penilaian</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('item.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Penilaian</label>
                            <input type="text" name="nama_penilaian"
                                class="form-control @error('nama_penilaian') is-invalid @enderror" id="nama_penilaian"
                                value="{{ old('nama_penilaian') ?: '' }}" placeholder="Masukkan Nama Penilaian">
                            @if ($errors->has('nama_penilaian'))
                            <div class="invalid-feedback">{{
                                $errors->first('nama_penilaian') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                id="summernote" value="{{ old('keterangan') ?: '' }}"></textarea>
                            @if ($errors->has('keterangan'))
                            <div class="invalid-feedback">{{
                                $errors->first('keterangan') }}</div>
                            @endif
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
