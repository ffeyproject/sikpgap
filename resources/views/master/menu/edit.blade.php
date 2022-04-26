@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Menu Customer: <b>{{ $menuDashboard->item_menu }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('menu.update', $menuDashboard->id)}}" id="form">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="categori_menu">Categori Menu</label>
                            <select name="categori_menu" id="categori_menu"
                                class="form-control @error('categori_menu') is-invalid @enderror">
                                <option value="{{ $menuDashboard->categori_menu }}">{{ $menuDashboard->categori_menu }}
                                </option>
                                <option value="Home">Home</option>
                                <option value="Penilaian">Penilaian</option>
                                <option value="Contact">Contact</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item_menu">Nama Menu Item</label>
                            <input type="text" name="item_menu"
                                class="form-control @error('item_menu') is-invalid @enderror" id="item_menu"
                                autocomplete="off" placeholder="Masukkan Menu Item"
                                value="{{ $menuDashboard->item_menu }}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            @if($menuDashboard->status == 'Aktif')
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status"
                                    value="{{ $menuDashboard->posisi }}" checked>
                                <label class="form-check-label">Ya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Tidak">
                                <label class="form-check-label">Tidak</label>
                            </div>
                            @else
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Aktif">
                                <label class="form-check-label">Ya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status"
                                    value="{{ $menuDashboard->posisi }}" checked>
                                <label class="form-check-label">Tidak</label>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <label for="ket_menu">Keterangan</label>
                            <textarea class="form-control @error('ket_menu') is-invalid @enderror" style="resize:none"
                                name="ket_menu" id="summernote" required
                                rows="6">{{$menuDashboard->ket_menu}}</textarea>
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
