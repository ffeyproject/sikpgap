@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Master Buyer: <b>{{ $buyer->nama_buyer }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('buyer.update', $buyer->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_buyer">Nama Buyer</label>
                            <input type="text" name="nama_buyer"
                                class="form-control @error('nama_buyer') is-invalid @enderror" id="nama_buyer"
                                autocomplete="off" placeholder="Masukkan Nama Buyer" value="{{ $buyer->nama_buyer }}"
                                autocomplete="on">
                        </div>
                        <div class="form-group">
                            <label for="alamat_buyer">Alamat Buyer</label>
                            <input type="text" name="alamat_buyer"
                                class="form-control @error('alamat_buyer') is-invalid @enderror" id="alamat_buyer"
                                autocomplete="off" placeholder="Masukkan Alamat Buyer"
                                value="{{ $buyer->alamat_buyer }}" autocomplete="on">
                        </div>
                        <div class="form-group">
                            <label for="cp_buyer">Contact Person</label>
                            <input type="text" name="cp_buyer"
                                class="form-control @error('cp_buyer') is-invalid @enderror" id="cp_buyer"
                                autocomplete="off" placeholder="Masukkan Contact Person" value="{{ $buyer->cp_buyer }}"
                                autocomplete="on">
                        </div>
                        <div class="form-group">
                            <label for="telp_buyer">Telepon</label>
                            <input type="text" name="telp_buyer"
                                class="form-control @error('telp_buyer') is-invalid @enderror" id="telp_buyer"
                                autocomplete="off" placeholder="Masukkan Telepon" value="{{ $buyer->telp_buyer }}"
                                autocomplete="on">
                        </div>
                        <div class="form-group">
                            <label for="email_buyer">Email Buyer</label>
                            <input type="text" name="email_buyer"
                                class="form-control @error('email_buyer') is-invalid @enderror" id="email_buyer"
                                autocomplete="off" placeholder="Masukkan Telepon" value="{{ $buyer->email_buyer }}"
                                autocomplete="on">
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
