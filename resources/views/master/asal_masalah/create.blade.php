@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input Master Asal Masalah</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('asal_masalah.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="asal_masalah">Asal Masalah</label>
                            <input type="text" name="asal_masalah"
                                class="form-control @error('asal_masalah') is-invalid @enderror" id="asal_masalah"
                                value="{{ old('asal_masalah') ?: '' }}" placeholder="Masukkan Nama Asal Masalah">
                            @if ($errors->has('asal_masalah'))
                            <div class="invalid-feedback">{{
                                $errors->first('asal_masalah') }}</div>
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
@endsection
