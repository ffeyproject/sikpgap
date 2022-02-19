@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input Master Defect</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('defect.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori"
                                class="form-control @error('kategori') is-invalid @enderror">
                                <option value=""></option>
                                <option value="Dyeing">Dyeing</option>
                                <option value="Printing">Printing</option>
                                <option value="Weaving">Weaving</option>
                            </select>
                            @if ($errors->has('kategori'))
                            <div class="invalid-feedback">{{
                                $errors->first('kategori') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" value="{{ old('nama') ?: '' }}" placeholder="Masukkan Nama Defect">
                            @if ($errors->has('nama'))
                            <div class="invalid-feedback">{{
                                $errors->first('nama') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Description</label>
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
    $(document).ready(function(){
          $('#kategori').select2({
              placeholder: 'Pilih Kategori',
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
