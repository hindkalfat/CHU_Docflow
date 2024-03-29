<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo2/pages_error404.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 13:10:18 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>CollabDoc</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages/error/style-400.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>
<body class="error404 text-center">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mr-auto mt-5 text-md-left text-center">
                <a href="index.html" class="ml-md-5">
                    <img alt="image-404" src="{{asset('assets/img/logo2.svg')}}" class="theme-logo">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number">403</h1>
            <p class="mini-text">Ooops!</p>
            <p class="error-text mb-4 mt-1">Accès refusé!</p>
            @if(Auth::user()->roles->pluck('nomR')->contains("admin"))
                <a href="{{url('admin/documents')}}" class="btn btn-primary mt-5">Retour</a>
            @else
                <a href="{{url('user/documents')}}" class="btn btn-primary mt-5">Retour</a>
            @endif
        </div>
    </div>    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>

<!-- Mirrored from designreset.com/cork/ltr/demo2/pages_error404.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 13:10:18 GMT -->
</html>