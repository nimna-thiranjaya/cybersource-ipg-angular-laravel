<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payment</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">

    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" /> -->
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
                            <div style="font-weight: 600; color: red; font-size : 30px; text-align : center">
                                Data Changed by some one or invalid signature
                            </div>

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