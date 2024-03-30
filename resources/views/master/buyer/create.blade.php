@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input Master Pelanggan</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('buyer.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kategori_buyer">Silahkan Kategori</label>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori_buyer"
                                        value="eksternal">
                                    <label class="form-check-label">External</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori_buyer" value="internal">
                                    <label class="form-check-label">Internal</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_buyer">Nama Buyer</label>
                            <input type="text" name="nama_buyer"
                                class="form-control @error('nama_buyer') is-invalid @enderror" id="nama_buyer"
                                value="{{ old('nama_buyer') ?: '' }}" placeholder="Masukkan Nama Buyer">
                            @if ($errors->has('nama_buyer'))
                            <div class="invalid-feedback">{{
                                $errors->first('nama_buyer') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="alamat_buyer">Alamat Buyer</label>
                            <input type="text" name="alamat_buyer"
                                class="form-control @error('alamat_buyer') is-invalid @enderror" id="alamat_buyer"
                                value="{{ old('alamat_buyer') ?: '' }}" placeholder="Masukkan Alamat Buyer">
                            @if ($errors->has('alamat_buyer'))
                            <div class="invalid-feedback">{{
                                $errors->first('alamat_buyer') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="cp_buyer">Contact Person</label>
                            <input type="text" name="cp_buyer"
                                class="form-control @error('cp_buyer') is-invalid @enderror" id="cp_buyer"
                                value="{{ old('cp_buyer') ?: '' }}" placeholder="Masukkan Contact Person">
                            @if ($errors->has('cp_buyer'))
                            <div class="invalid-feedback">{{
                                $errors->first('cp_buyer') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="telp_buyer">Telepon</label>
                            <input type="text" name="telp_buyer"
                                class="form-control @error('telp_buyer') is-invalid @enderror" id="telp_buyer"
                                value="{{ old('telp_buyer') ?: '' }}" placeholder="Masukkan Telepon">
                            @if ($errors->has('telp_buyer'))
                            <div class="invalid-feedback">{{
                                $errors->first('telp_buyer') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email_buyer">Email</label>
                            <input type="email" name="email_buyer"
                                class="form-control @error('email_buyer') is-invalid @enderror" id="email_buyer"
                                value="{{ old('email_buyer') ?: '' }}" placeholder="Masukkan Email">
                            @if ($errors->has('email_buyer'))
                            <div class="invalid-feedback">{{
                                $errors->first('email_buyer') }}</div>
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
    $(document).ready(function(){
          $('#categories_id').select2({
              placeholder: 'Pilih Categori',
              minimumInputLength: 1,
              allowClear: true
        });
       });
</script>
<script>
    $(function () {
    // Summernote
    $('#summernote').summernote()
  })
</script>


</script>
@endsection