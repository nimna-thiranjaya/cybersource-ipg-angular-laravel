<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">

    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" id="alert-message">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @php
                            Session::forget('success');
                            header("refresh:3;url=/");
                            @endphp

                        </div>
                        @endif

                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" id="alert-message">
                            {{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @php
                            Session::forget('error');
                            @endphp
                        </div>
                        @endif
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1690132149/Notebook_1_gzusts.png"
                                    alt="logo" />
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">
                                Signing up is easy. It only takes a few steps
                            </h6>
                            <form class="pt-3" action="{{ URL::to('/user-register') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="username"
                                        id="exampleInputUsername1" placeholder="Username" value="{{old('username')}}" />
                                    @if ($errors->has('username'))
                                    <h6 class="text-danger mt-2">{{ $errors->first('username') }}</h6>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email"
                                        id="exampleInputEmail1" placeholder="Email" value="{{old('email')}}" />
                                    @if ($errors->has('email'))
                                    <h6 class="text-danger mt-2">{{ $errors->first('email') }}</h6>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password" name="password"
                                        value="{{old('password')}}" />
                                    @if ($errors->has('password'))
                                    <h6 class="text-danger mt-2">{{ $errors->first('password') }}</h6>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Confirm Password"
                                        value="{{old('confirmPassword')}}" name="confirmPassword" />
                                    @if ($errors->has('confirmPassword'))
                                    <h6 class="text-danger mt-2">{{ $errors->first('confirmPassword') }}</h6>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="allow" class="form-check-input" />
                                            I agree to all Terms & Conditions
                                        </label>
                                        @if ($errors->has('allow'))
                                        <h6 class="text-danger mt-2">{{ $errors->first('allow') }}</h6>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN
                                        UP</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account?
                                    <a href="/" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- <script src="../../vendors/js/vendor.bundle.base.js"></script> -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <!-- <script src="../../js/off-canvas.js"></script> -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <!-- <script src="../../js/hoverable-collapse.js"></script> -->
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <!-- <script src="../../js/template.js"></script> -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- <script src="../../js/settings.js"></script> -->
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <!-- <script src="../../js/todolist.js"></script> -->
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <script>
    $(document).ready(function() {

    });
    document.addEventListener('DOMContentLoaded', function() {
        const Alert = document.getElementById('alert-message');
        // Hide the success alert after 2 seconds
        setTimeout(function() {
            Alert.style.display = 'none';
        }, 3000);
    });
    </script>
</body>






</html>