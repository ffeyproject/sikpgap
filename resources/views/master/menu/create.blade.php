@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input Menu Customer</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('menu.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="categori_menu">Categori Menu</label>
                            <select name="categori_menu" id="categori_menu"
                                class="form-control @error('categori_menu') is-invalid @enderror">
                                <option value=""></option>
                                <option value="Home">Home</option>
                                <option value="Penilaian">Penilaian</option>
                                <option value="Contact">Contact</option>
                            </select>
                            @if ($errors->has('categori_menu'))
                            <div class="invalid-feedback">{{
                                $errors->first('categori_menu') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="item_menu">Item Menu</label>
                            <input type="text" name="item_menu"
                                class="form-control @error('item_menu') is-invalid @enderror" id="item_menu"
                                value="{{ old('item_menu') ?: '' }}" placeholder="Masukkan Item Menu">
                            @if ($errors->has('item_menu'))
                            <div class="invalid-feedback">{{
                                $errors->first('item_menu') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="ket_menu">Keterangan</label>
                            <textarea class="form-control @error('ket_menu') is-invalid @enderror" name="ket_menu"
                                id="summernote" value="{{ old('ket_menu') ?: '' }}"></textarea>
                            @if ($errors->has('ket_menu'))
                            <div class="invalid-feedback">{{
                                $errors->first('ket_menu') }}</div>
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
          $('#categori_menu').select2({
              placeholder: 'Pilih Categori',
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
