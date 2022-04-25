@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Kepuasan Pelanggan</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('kepuasan.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Buyer</label>
                            <select name="buyers_id" id="buyers_id" class="dynamic form-control select2"
                                data-live-search="true">
                                <option value="">--Pilih Buyer--</option>
                                @foreach($buyer as $key => $country)
                                <option value='{{ $key }}'>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <select name="alamat" id="alamat" class="dynamic form-control input-lg select2" readonly>
                                {{-- <option></option> --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_kontak">Nama Kontak</label>
                            <input type="text" name="nama_kontak"
                                class="form-control @error('nama_kontak') is-invalid @enderror" id="nama_kontak"
                                value="{{ old('nama_kontak') ?: '' }}" placeholder="Masukkan Nama Kontak">
                            @if ($errors->has('nama_kontak'))
                            <div class="invalid-feedback">{{
                                $errors->first('nama_kontak') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tanggal Penilaian</label>
                            <div class="input-group date">
                                <input type="date" name="tgl_penilaian"
                                    class="form-control @error('tgl_penilaian') is-invalid @enderror"
                                    value="<?= date('Y-m-d') ?>" readonly>
                                @if ($errors->has('tgl_penilaian'))
                                <div class="invalid-feedback">{{
                                    $errors->first('tgl_penilaian') }}</div>
                                @endif
                            </div>
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
          $('#buyers_id').select2({
              placeholder: 'Pilih Buyer',
              minimumInputLength: 2,
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

<script type=text/javascript>
    $(document).ready(function(){
    $('#buyers_id').change(function(){
        var id = $(this).val();
        if(id){
          $.ajax({
            type:"GET",
            url:"{{url('get-customer-list')}}?alamat_buyer="+id,
            async: true,
            success:function(res){
            if(res){
              $("#alamat").empty();
              $.each(res,function(key,aa){
                $("#alamat").append('<option value="'+aa+'">'+aa+'</option>');
              });

            }else{
              $("#alamat").empty();
            }

            }
          });

        }else{
          $("#alamat").empty();
        }
        });
        });
</script>


@endsection
