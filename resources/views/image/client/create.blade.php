@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input Gambar Client</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('client.store')}}" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Client</label>
                            <input type="text" name="nama_client"
                                class="form-control @error('nama_client') is-invalid @enderror" id="nama_client"
                                value="{{ old('nama_client') ?: '' }}" placeholder="Masukkan Nama Client">
                            @if ($errors->has('nama_client'))
                            <div class="invalid-feedback">{{
                                $errors->first('nama_client') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="g_client">Gambar Client</label>
                            <input type="file" name="g_client"
                                class="form-control @error('g_client') is-invalid @enderror" id="g_client"
                                value="{{ old('g_client') ?: '' }}" placeholder="">
                            @if ($errors->has('g_client'))
                            <div class="invalid-feedback">{{
                                $errors->first('g_client') }}</div>
                            @endif
                            <p class="help-block">Max.800kb</p>
                        </div>
                        <div class="form-group">
                            <label for="status">Status Aktif</label>
                            <div class="custom-control custom-radio">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Ya" checked>
                                    <label class="form-check-label">Ya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Tidak">
                                    <label class="form-check-label">Tidak</label>
                                </div>
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
@endsection
