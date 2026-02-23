@extends('layouts.master-without-nav')
@section('title')
@lang('translation.signin')
@endsection
@section('content')

<!-- auth-page wrapper -->
<div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100 zoomFade">

    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="border-color: #1b8fcd">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="bg-overlay"></div>
                                <div class="position-relative h-100 d-flex flex-column">
                                    <div id="qoutescarouselIndicators" class="carousel slide " data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                data-bs-slide-to="0" class="active" aria-current="true"
                                                aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                data-bs-slide-to="2" aria-label="Slide 3"></button>
                                            {{-- <button type="button" data-bs-target="#qoutescarouselIndicators" --}}
                                                {{-- data-bs-slide-to="3" aria-label="Slide 4"></button>--}}
                                        </div>

                                        <div class="carousel-inner text-center text-white-50 pb-5">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100 img-fluid"
                                                    src="{{ URL::asset('images/fams_1.jpeg') }}" alt="Slide 1">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100 img-fluid"
                                                    src="{{ URL::asset('images/fams_2.jpeg') }}" alt="Slide 2">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100 img-fluid"
                                                    src="{{ URL::asset('images/fams_3.jpeg') }}" alt="Slide 3">
                                            </div>

                                        </div>
                                    </div>

                                    <!-- end carousel -->

                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6"
                                style=" background-image: url('{{ URL::asset('build/images/bg.png') }}');background-size: cover;background-position: center;background-repeat: no-repeat;">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 style="
                                        font-family: 'Bodoni 72', serif;
                                        font-size: 30px;
                                        font-weight: bold;
                                        letter-spacing: 3px;
                                        text-transform: none;
                                        text-align: center;
                                        color: transparent;
                                        background: linear-gradient(135deg, #5cb85c, #3e8e41);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                        text-shadow: 2px 2px 6px rgba(0,0,0,0.25);
                                        padding: 12px;
                                        border-radius: 10px;
                                        border-bottom: 3px solid #5cb85c;">
                                            FAMS
                                        </h5>
                                        <p class="text-muted text-center">Family Management System</p>
                                    </div>
                                    <div class="img-circle mx-auto">
                                        <img src="{{ URL::asset('images/fams-logo.jpg') }}" alt="Image description"
                                            style="
                        width: 100%;
                        height: 100%;
                        object-fit: contain;
                        background-color: #fff;
                        border-radius: 50%;
                        box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.1);">
                                    </div>

                                    <div class="mt-4 auth-box ">
                                        <form action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control"
                                                     id="email" name="email"
                                                    placeholder="Enter username">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">

                                                <label class="form-label" for="password-input">Password <span
                                                        class="text-danger">*</span></label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password"
                                                        class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                        name="password" placeholder="Enter password"
                                                        id="password-input">
                                                    <button
                                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                        type="button" id="password-addon"><i
                                                            class="ri-eye-fill align-middle"></i></button>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="auth-remember-check">
                                                <label class="form-check-label" for="auth-remember-check">Remember
                                                    me</label>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-success w-100" type="submit">Sign In</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-3 text-center">
                        <b style="color: #305fa7">Copyright &copy;<script>
                                document.write(new Date().getFullYear())
                            </script> <a target="_blank" href="#" style="color: #5cb85c">Family Management Information
                                System</a> | All Rights Reserved | FAMS v1.0.0</b>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->
@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection