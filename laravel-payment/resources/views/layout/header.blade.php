<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Dashboard</title>
    <!-- plugins:css -->

    <!-- <link rel="stylesheet" href="assets/vendors/feather/feather.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}" />
    <!-- <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}" />
    <!-- <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/all.min.css') }}" /> -->
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- ----TinyMCE----- -->
    <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
        referrerpolicy="origin"></script>
    <!-- <script src="{{ asset('assets/js/tinymce.min.js') }}" referrerpolicy="origin"></script> -->
    <!-- ----TinyMCE----- -->
    <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}" />
    <!-- <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}" />
    <!-- <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}" />
    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="assets/images/favicon.png" /> -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <!-- <link rel="stylesheet" href="assets/css/cardview.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/css/cardview.css') }}" />
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/pagination.css" /> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pagination.css') }}" />
    <!-- <link rel="stylesheet" href="assets/css/categorycard.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/css/categorycard.css') }}" />
    <!-- <link rel="stylesheet" href="assets/css/modal.css" /> -->
    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}" />
    @cloudinaryJS
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{
            URL::to('/dashboard')
          }}"><img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1690132149/Notebook_1_gzusts.png"
                        class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{
            URL::to('/dashboard')
          }}"><img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1690131623/2_ew9ofh.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                                aria-label="search" aria-describedby="search" />
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="icon-bell mx-0"></i>
                            <span class="count"></span>
                        </a>


                    </li>
                    <!-- <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1683887268/User-Profile-PNG-High-Quality-Image_mwetdc.png"
                                alt="profile" />
                        </a>

                    </li> -->

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1683887268/User-Profile-PNG-High-Quality-Image_mwetdc.png"
                                alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="">
                                <i class="ti-user text-primary"></i>
                                <?php echo session('LoggedUserName'); ?>
                            </a>
                            <a class="dropdown-item" href="/logout">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>



                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
