@extends('customer.layout.app')
@section('content')
<div class="page-banner home-banner">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="container">
                <button type="button" class="btn btn-primary btn-large" data-toggle="modal" data-target="#modalMessage"
                    id="open">Send Message</button><br><br>
                @include('components.alert')
                @include('sweetalert::alert')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Kirim Pesan gagal.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="col-lg-3 py-3">
                    <p>Data Terakhir.</p>
                </div>
                <div class="row justify-content-center">
                    <table id="customers">
                        <thead>
                            <tr>
                                <th>Message</th>
                                <th>Created At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <?php $no = 1 ?>
                        <tbody>
                            @forelse ($contact as $item)
                            <tr>
                                <td>{{ $item->message }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->status }}</td>
                                @empty
                            <tr>
                                <td colspan="12">Data tidak ada.</td>
                            </tr>
                            </tr>

                        </tbody>
                        @endforelse
                    </table>
                </div>
                <form method="post" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal -->
                    <div class="container h-200">
                        <div class="row align-items-center h-200">
                            <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea class="form-control @error('message') is-invalid @enderror"
                                                    name="message" id="message"
                                                    value="{{ old('message') ?: '' }}"></textarea>
                                                @error('message')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="page-section client-section">
    <div class="container-fluid">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 justify-content-center">
            @foreach($image as $item)
            <div class="item wow zoomIn">
                <img src="{{ url('image/client/'.$item->g_client) }}" alt="">
            </div>
            @endforeach
        </div>
    </div> <!-- .container-fluid -->
</div> <!-- .page-section -->

@endsection
