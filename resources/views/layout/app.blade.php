<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 13:08:46 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<title>CollabDoc </title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}"/>
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/js/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:400,600,700')}}" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
	<link rel="stylesheet" href="{{asset('https://use.fontawesome.com/releases/v5.13.0/css/all.css')}}" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <link href="{{asset('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <link href="{{asset('plugins/drag-and-drop/dragula/dragula.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/drag-and-drop/dragula/example.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/editors/quill/quill.snow.css')}}">
{{--     <link href="{{asset('assets/css/apps/todolist.css')}}" rel="stylesheet" type="text/css" />
 --}}    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/apps/contacts.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{asset('assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/noUiSlider/nouislider.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/noUiSlider/custom-nouiSlider.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('plugins/bootstrap-range-Slider/bootstrap-slider.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />

 	<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
	 @yield('link')


    <!-- jQuery & jQuery UI are required -->
	<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
	<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->



</head>
<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
        @include('menus.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
            @include('menus.sideMenu_admin')
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
            @yield('content')
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

	<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
	
	<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/js/dashboard/dash_1.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/drag-and-drop/dragula/dragula.min.js')}}"></script>
    <script src="{{asset('plugins/drag-and-drop/dragula/custom-dragula.js')}}"></script>
    <script src="{{asset('assets/js/ie11fix/fn.fix-padStart.js')}}"></script>
    <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
{{--     <script src="{{asset('assets/js/apps/todoList.js')}}"></script>
 --}}    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('assets/js/components/ui-accordions.js')}}"></script>
    <script src="{{asset('plugins/noUiSlider/nouislider.min.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>
    <script src="{{asset('plugins/noUiSlider/custom-nouiSlider.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js')}}"></script>
	<script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>{{-- 
	<script src="{{asset('assets/js/authentication/form-2.js')}}"></script> --}}




    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });
    </script>

    <script>
        /* Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                //var min = parseInt( $('#min').val(), 10 );
                var min = Date.parse($('#min').val());
                var max = Date.parse($('#max').val());
                //var max = parseInt( $('#max').val(), 10 );
                var age = parseFloat( data[3] ) || 0; // use data for the age column
         
                if ( ( isNaN( min ) && isNaN( max ) ) ||
                     ( isNaN( min ) && age <= max ) ||
                     ( min <= age   && isNaN( max ) ) ||
                     ( min <= age   && age <= max ) )
                {
                    return true;
                }
                return false;
            }
        );         
        $(document).ready(function() {
            var table = $('#range-search').DataTable({
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });             
            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').keyup( function() { table.draw(); } );
        } );
    </script>
        

	<!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
	<script>
		$(document).on("click","#notificationDropdown",function(){
			$('#unread').remove();
		});
		$(document).on("click","#messageDropdown",function(){
			$('#unreadMsg').remove();
		});
	</script>
	@yield('script')    

	<script>
		const psn = new PerfectScrollbar('.notif');
		const psm = new PerfectScrollbar('.notif1');
	</script>

</body>

<!-- Mirrored from designreset.com/cork/ltr/demo2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 13:08:48 GMT -->
</html>