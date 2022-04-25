@extends('customer.layout.app')
@section('content')
<div class="page-banner home-banner">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-lg-6 py-3 wow fadeInUp">
                <h1 class="mb-4">Great Companies are built on great Products</h1>
                <p class="text-lg mb-5">Ignite the most powerfull growth engine you have ever built for your
                    company</p>
                <a href="#" class="btn btn-outline border text-secondary ">More Info</a>
                <a href="#modal2" class="btn btn-primary btn-split ml-2" data-toggle="modal">Watch Video <div
                        class="fab"><span class="mai-play"></span></div></a>
                <!-- Modal -->
                <div class="bs-example">
                    <div id="modal2" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <iframe id="modal3" width="770" height="450"
                                        src="https://drive.google.com/file/d/1IiDikPpAn4OGLd66P2MyEdrKev4eZgBt/preview"
                                        allowfullscreen type='video/mp4'>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow zoomIn">
                <div class="img-place">
                    <img src="{{asset('frontend/image/logo_gajah2.png') }}" alt="" width="100" height="200">
                </div>
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
