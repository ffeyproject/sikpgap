@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h1 class="card-title">Form Keluhan Internal</h1>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div>
            <br>
            <div class="col-md-12">
                <div class="callout callout-danger">
                    <h5>Informasi !</h5>
                    <p>Setiap Keluhan harus diisikan Lengkap disertai Bukti Pendukung yang Cukup.</p>
                </div>
            </div>
        </div>
        <form method="post" action="{{route('keluhan.store.internal')}}" id="form" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date:</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="date" name="tgl_keluhan" class="form-control datetimepicker-input"
                                    data-target="#reservationdate" />
                                <div class="input-group-append" data-target="#reservationdate"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="buyers_id">Departement komplent yang membuat </label>
                            <select name="buyers_id" id="buyers_id"
                                class="form-control @error('buyers_id') is-invalid @enderror">
                                <option value="{{ old('buyers_id') ?: '' }}"></option>
                                @foreach($buyer as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_buyer }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('buyers_id'))
                            <div class="invalid-feedback">{{
                                $errors->first('buyers_id') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nama_marketing">Nama Yang Membuat</label>
                            <select name="nama_marketing" id="nama_marketing"
                                class="form-control @error('nama_marketing') is-invalid @enderror">
                                <option value="{{ old('nama_marketing') ?: '' }}"></option>
                                @foreach($user as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('nama_marketing'))
                            <div class="invalid-feedback">{{
                                $errors->first('nama_marketing') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="no_wo">Nomer Wo</label>
                            <input type="text" name="no_wo" class="form-control @error('no_wo') is-invalid @enderror"
                                id="no_wo" value="{{ old('no_wo') ?: '' }}" placeholder="Masukkan No Wo">
                            @if ($errors->has('no_wo'))
                            <div class="invalid-feedback">{{
                                $errors->first('no_wo') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="solusi">Informasi Solusi</label>
                            <textarea class="form-control @error('solusi') is-invalid @enderror" name="solusi"
                                id="solusi" value="{{ old('solusi') ?: '' }}">-</textarea>
                            @if ($errors->has('solusi'))
                            <div class="invalid-feedback">{{
                                $errors->first('solusi') }}</div>
                            @endif
                        </div>

                        <label for="jenis">Silahkan Pilih Jenis</label>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" value="Dyeing">
                                <label class="form-check-label">Dyeing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" value="Printing">
                                <label class="form-check-label">Printing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" value="Weaving">
                                <label class="form-check-label">Weaving</label>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="nama_motif">Nama Motif</label>
                            <input type="text" name="nama_motif"
                                class="form-control @error('nama_motif') is-invalid @enderror" id="nama_motif"
                                value="{{ old('nama_motif') ?: '' }}" placeholder="Masukkan Nama Motif">
                            @if ($errors->has('nama_motif'))
                            <div class="invalid-feedback">{{
                                $errors->first('nama_motif') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="cw_qty">CW Complaint</label>
                            <input type="text" name="cw_qty" class="form-control @error('cw_qty') is-invalid @enderror"
                                id="cw_qty" value="{{ old('cw_qty') ?: '' }}" placeholder="Masukkan CW">
                            @if ($errors->has('cw_qty'))
                            <div class="invalid-feedback">{{
                                $errors->first('cw_qty') }}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="masalah">Deksripsi Masalah</label>
                            <textarea class="form-control @error('masalah') is-invalid @enderror" name="masalah"
                                id="summernote">{{ old('masalah') ?: '' }}</textarea>
                            @if ($errors->has('masalah'))
                            <div class="invalid-feedback">{{
                                $errors->first('masalah') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="keterangan_sample">* Keterangan Sample / Bukti Pendukung</label>
                            <input type="text" name="keterangan_sample"
                                class="form-control @error('keterangan_sample') is-invalid @enderror"
                                id="keterangan_sample" value="{{ old('keterangan_sample') ?: '' }}"
                                placeholder="Masukkan Keterangan Sample / Bukti Pendukung" required>
                            @if ($errors->has('keterangan_sample'))
                            <div class="invalid-feedback">{{
                                $errors->first('keterangan_sample') }}</div>
                            @endif
                        </div>


                    </div>


                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('tablejs')
<script>
    $(document).ready(function(){
          $('#buyers_id').select2({
              placeholder: 'Pilih',
              minimumInputLength: 1,
              allowClear: true
        });
          $('#nama_marketing').select2({
              placeholder: 'Pilih',
              minimumInputLength: 2,
              allowClear: true
        });
       });
</script>
<script>
    $(function () {
    // Summernote
    $('#summernote').summernote(
        {
        placeholder: 'Silahkan isi keterangan masalah',
        tabsize: 2,
        height: 120,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['view', ['fullscreen', 'codeview', 'help']]
        ]
        }
    );
  })
    $(function () {
    // Summernote
    $('#solusi').summernote(
    {
    placeholder: '',
    tabsize: 2,
    height: 120,
    toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'underline', 'clear']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['view', ['fullscreen', 'codeview', 'help']]
    ]
    });
  })
</script>

<script>
    $(function () {

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

//Date picker
$('#reservationdate').datetimepicker({
format: 'L'
});

//Date and time picker
$('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });


})
</script>


@endsection