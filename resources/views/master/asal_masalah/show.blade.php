@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Master Asal Masalah: <b>{{ $departement->nama }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('asal_masalah.update', $departement->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="asal_masalah">Asal Masalah</label>
                            <input type="text" name="asal_masalah"
                                class="form-control @error('asal_masalah') is-invalid @enderror" id="asal_masalah"
                                autocomplete="off" placeholder="Masukkan asal_masalah Defect"
                                value="{{ $departement->asal_masalah }}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                    style="resize:none" name="keterangan" id="summernote" required
                                    rows="6">{{$departement->keterangan}}</textarea>
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
