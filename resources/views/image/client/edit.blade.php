@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h1 class="card-title">Form Keluhan Pelanggan</h1>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <form method="post" action="{{route('client.update', $image->id)}}" enctype="multipart/form-data" id="form">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="nama_client">Nomer Wo</label>
                            <input type="text" name="nama_client"
                                class="form-control @error('nama_client') is-invalid @enderror" id="nama_client"
                                value="{{ $image->nama_client }}" placeholder="Masukkan No Wo">
                            @if ($errors->has('nama_client'))
                            <div class="invalid-feedback">{{
                                $errors->first('nama_client') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Gambar Client</label><br>
                            <img src="{{ url('image/client/'.$image->g_client) }}"
                                style="width: 100px; height: 100px;"><br>
                            <label>*) Jika Gambar Tidak Di Ganti, biarkan saja.</label><br>
                            <label for="g_client">Masukkan Gambar Client</label>
                            <input type="file" id="g_client" name="g_client"
                                class="@error('g_client') is-invalid @enderror" value="{{ $image->g_client }}">
                            @if ($errors->has('g_client'))
                            <div class="invalid-feedback">{{ $errors->first('g_client') }}</div>
                            @endif
                            <p class="help-block">Max.800kb</p>
                        </div>


                    </div>
                    @if ($image->status == 'Ya')
                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="{{ $image->status }}"
                                checked>
                            <label class="form-check-label">Ya</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="Tidak">
                            <label class="form-check-label">Tidak</label>
                        </div>
                    </div>
                    @elseif ($image->status == 'Tidak')
                    <label>Status</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="Ya">
                            <label class="form-check-label">Ya</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="{{ $image->status }}"
                                checked>
                            <label class="form-check-label">Tidak</label>
                        </div>
                    </div>
                    @endif

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

@endsection
