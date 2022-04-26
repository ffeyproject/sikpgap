<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PT. Gajah Angkasa Perkasa - Kepuasan Pelanggan</title>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/dashboard/assets/css/select2.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/assets/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{ asset('frontend/dashboard/assets/vendor/animate/animate.css')}}">

    <link rel="stylesheet" href="{{ asset('frontend/dashboard/assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{ asset('frontend/dashboard/assets/css/maicons.css')}}">

    <link rel="stylesheet" href="{{ asset('frontend/dashboard/assets/vendor/owl-carousel/css/owl.carousel.css')}}">

    <link rel="stylesheet" href="{{ asset('frontend/dashboard/assets/css/theme.css')}}">

    <link rel="stylesheet" href="{{ asset('frontend/dashboard/assets/css/custom.css')}}">


    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <script>
        $(document).ready(function() {
                var url = $("#modal#").attr('src');
                $("#modal2").on('hide.bs.modal', function() {
                    $("#modal#").attr('src', '');
                });
                $("#modal2").on('show.bs.modal', function() {
                    $("#modal#").attr('src', url);
                });
            });
    </script>

    <script>
        $(".select2").select2({
        placeholder: "Select a color",
        allowClear: true
        });
    </script>

</head>

<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light navbar-float">
            <div class="container">
                <a href="index.html" class="navbar-brand">PT.<span class="text-primary"> GAP</span></a>

                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarContent">
                    <ul class="navbar-nav ml-lg-4 pt-3 pt-lg-0">
                        <li class="nav-item">
                            <a href="{{ route('customer.dashboard') }}"
                                class="nav-link {{ (request()->is('customer-dashboard')) ? 'active' : '' }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.penilaian') }}"
                                class="nav-link {{ (request()->is('customer-penilaian')) || (request()->is('customer-penilaian/create')) || (request()->is('customer-penilaian/index/')) ? 'active' : '' }}">Penilaian</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.contact') }}"
                                class="nav-link {{ (request()->is('customer-contact')) ? 'active' : '' }}">Contact</a>
                        </li>
                    </ul>

                    <div class="ml-auto">
                        <img src="{{ Auth::user()->avatar }}" width='30%' class="user-image img-circle elevation-1"
                            alt="User Image">
                        <a href="#" class="btn btn-default btn-flat float-right"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ Auth::user()->name }}<br>
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>

    </header>

    <section>
        @yield('content')
    </section>



    <footer class="page-footer">
        <div class="row">
            <div class="col-sm-6 py-2">
                <p id="">&copy; 2022 <a href="https://gajahtex.com/">PT. Gajah Angkasa Perkasa</a>. All rights reserved
                </p>
            </div>
        </div>
    </footer> <!-- .page-footer -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
                  $('#buyers_id').select2({
                      placeholder: 'Pilih Buyer',
                      minimumInputLength: 6,
                      allowClear: true
                });
               });
    </script>

    <script>
        $(document).ready(function() {

        // Gets the video src from the data-src on each button

        var $videoSrc;
        $('.video-btn').click(function() {
        $videoSrc = $(this).data( "src" );
        });
        console.log($videoSrc);

        // when the modal is opened autoplay it
        $('#myModal').on('shown.bs.modal', function (e) {

        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you
        never know what you're gonna get
        $("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" );
        })

        // stop playing the youtube video when I close the modal
        $('#myModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#video").attr('src',$videoSrc);
        })


        // document ready
        });
    </script>

    <script src="{{ asset('frontend/dashboa rd/assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('frontend/dashboa rd/assets/js/select2.min.js')}}"></script>

    <script src="{{ asset('frontend/dashboard/assets/js/bootstrap.bundle.min.js')}}">
        </sc>

    <script src="{{ asset('frontend/dashboard/assets/vendor/wow/wow.min.js')}}">
    </script>

    <script src="{{ asset('frontend/dashboard/assets/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>

    <script src="{{ asset('frontend/dashboard/assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>

    <script src="{{ asset('frontend/dashboard/assets/vendor/animateNumber/jquery.animateNumber.min.js')}}"></script>

    <script src="{{ asset('frontend/dashboard/assets/js/google-maps.js')}}"></script>

    <script src="{{ asset('frontend/dashboard/assets/js/theme.js')}}"></script>


</body>

</html>
