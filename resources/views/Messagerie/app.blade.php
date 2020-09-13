<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo2/apps_mailbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 13:08:38 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CollabDoc</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="plugins/editors/quill/quill.snow.css">
    <link href="assets/css/apps/mailbox.css" rel="stylesheet" type="text/css" />

    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />

        <!-- jQuery & jQuery UI are required -->
	<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
	<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>

    <!--  END CUSTOM STYLE FILE  -->
</head>
<body class="alt-menu sidebar-noneoverflow">

    <!--  BEGIN NAVBAR  -->
        @include('menus.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @if(Auth::user()->roles->pluck('nomR')->contains("admin"))
            @include('menus.sideMenu_admin')
        @else
            @include('menus.sideMenu_user')
        @endif
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
            @yield('content')
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    @yield('script')
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/ie11fix/fn.fix-padStart.js"></script>
    <script src="plugins/editors/quill/quill.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="assets/js/apps/custom-mailbox.js"></script>
</body>

<!-- Mirrored from designreset.com/cork/ltr/demo2/apps_mailbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 13:08:45 GMT -->
</html>