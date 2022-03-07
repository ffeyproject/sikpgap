@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Master Asal Masalah: <b>{{ $defect->nama }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('defect.update', $defect->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori"
                                class="form-control @error('kategori') is-invalid @enderror">
                                <option value="{{ $defect->kategori }}">{{ $defect->kategori }}</option>
                                <option value="Dyeing">Dyeing</option>
                                <option value="Printing">Printing</option>
                                <option value="Weaving">Weaving</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Defect</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" autocomplete="off" placeholder="Masukkan Nama Defect"
                                value="{{ $defect->nama }}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                    style="resize:none" name="keterangan" id="summernote" required
                                    rows="6">{{$defect->keterangan}}</textarea>
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
@endsection
