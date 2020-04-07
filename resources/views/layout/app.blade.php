<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 13:08:46 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CHU Docflow </title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}"/>
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/js/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:400,600,700')}}" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/fullcalendar/custom-fullcalendar.advance.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <link href="{{asset('plugins/drag-and-drop/dragula/dragula.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/drag-and-drop/dragula/example.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/editors/quill/quill.snow.css')}}">
    <link href="{{asset('assets/css/apps/todolist.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/apps/contacts.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{asset('assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/noUiSlider/nouislider.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/noUiSlider/custom-nouiSlider.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/bootstrap-range-Slider/bootstrap-slider.css')}}" rel="stylesheet" type="text/css">
{{-- 	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
 --}}	
 	<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
	 @yield('link')



    <!-- Flowchart CSS and JS -->
	<link rel="stylesheet" href="{{asset('css/jquery.flowchart.css')}}">
    <script src="{{asset('js/jquery.flowchart.js')}}"></script>
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
	@yield('script')
{{--     <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
 --}}    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
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
    <script src="{{asset('plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>
    <script src="{{asset('plugins/fullcalendar/custom-fullcalendar.advance.js')}}"></script>
    <script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/drag-and-drop/dragula/dragula.min.js')}}"></script>
    <script src="{{asset('plugins/drag-and-drop/dragula/custom-dragula.js')}}"></script>
    <script src="{{asset('assets/js/ie11fix/fn.fix-padStart.js')}}"></script>
    <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
    <script src="{{asset('assets/js/apps/todoList.js')}}"></script>
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/apps/contact.js')}}"></script>
    <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('assets/js/components/ui-accordions.js')}}"></script>
    <script src="{{asset('plugins/noUiSlider/nouislider.min.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>
    <script src="{{asset('plugins/noUiSlider/custom-nouiSlider.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>


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

    <!-- Flowchart JS -->
    <script type="text/javascript">
		/* global $ */
		$(document).ready(function() {
			var $flowchart = $('#flowchartworkspace');
			var $container = $flowchart.parent();

			// Apply the plugin on a standard, empty div...
			$flowchart.flowchart({
				data: defaultFlowchartData,
				defaultSelectedLinkColor: '#000055',
				grid: 10,
				multipleLinksOnInput: true,
				multipleLinksOnOutput: true
			});


			function getOperatorData($element) {
				var nbInputs = parseInt($element.data('nb-inputs'), 10);
				var nbOutputs = parseInt($element.data('nb-outputs'), 10);
				var data = {
					properties: {
						title: $element.text(),
						inputs: {},
						outputs: {}
					}
				};

				var i = 0;
				for (i = 0; i < nbInputs; i++) {
					data.properties.inputs['input_' + i] = {
						label: 'Input ' + (i + 1)
					};
				}
				for (i = 0; i < nbOutputs; i++) {
					data.properties.outputs['output_' + i] = {
						label: 'Output ' + (i + 1)
					};
				}

				return data;
			}



			//-----------------------------------------
			//--- operator and link properties
			//--- start
			var $operatorProperties = $('#operator_properties');
			$operatorProperties.hide();
			var $linkProperties = $('#link_properties');
			$linkProperties.hide();
			var $operatorTitle = $('#operator_title');
			var $linkColor = $('#link_color');

			$flowchart.flowchart({
				onOperatorSelect: function(operatorId) {
					$operatorProperties.show();
					$operatorTitle.val($flowchart.flowchart('getOperatorTitle', operatorId));
					return true;
				},
				onOperatorUnselect: function() {
					$operatorProperties.hide();
					return true;
				},
				onLinkSelect: function(linkId) {
					$linkProperties.show();
					$linkColor.val($flowchart.flowchart('getLinkMainColor', linkId));
					return true;
				},
				onLinkUnselect: function() {
					$linkProperties.hide();
					return true;
				}
			});

			$operatorTitle.keyup(function() {
				var selectedOperatorId = $flowchart.flowchart('getSelectedOperatorId');
				if (selectedOperatorId != null) {
					$flowchart.flowchart('setOperatorTitle', selectedOperatorId, $operatorTitle.val());
				}
			});

			$linkColor.change(function() {
				var selectedLinkId = $flowchart.flowchart('getSelectedLinkId');
				if (selectedLinkId != null) {
					$flowchart.flowchart('setLinkMainColor', selectedLinkId, $linkColor.val());
				}
			});
			//--- end
			//--- operator and link properties
			//-----------------------------------------

			//-----------------------------------------
			//--- delete operator / link button
			//--- start
			$flowchart.parent().siblings('.delete_selected_button').click(function() {
				$flowchart.flowchart('deleteSelected');
			});
			//--- end
			//--- delete operator / link button
			//-----------------------------------------



			//-----------------------------------------
			//--- create operator button
			//--- start
			var operatorI = 0;
			$flowchart.parent().siblings('.create_operator').click(function() {
				var operatorId = 'created_operator_' + operatorI;
				var operatorData = {
					top: ($flowchart.height() / 2) - 30,
					left: ($flowchart.width() / 2) - 100 + (operatorI * 10),
					properties: {
						title: 'Operator ' + (operatorI + 3),
						inputs: {
							input_1: {
								label: 'Input 1',
							}
						},
						outputs: {
							output_1: {
								label: 'Output 1',
							}
						}
					}
				};

				operatorI++;

				$flowchart.flowchart('createOperator', operatorId, operatorData);

			});
			//--- end
			//--- create operator button
			//-----------------------------------------




			//-----------------------------------------
			//--- draggable operators
			//--- start
			//var operatorId = 0;
			var $draggableOperators = $('.draggable_operator');
			$draggableOperators.draggable({
				cursor: "move",
				opacity: 0.7,

				// helper: 'clone',
				appendTo: 'body',
				zIndex: 1000,

				helper: function(e) {
					var $this = $(this);
					var data = getOperatorData($this);
					return $flowchart.flowchart('getOperatorElement', data);
				},
				stop: function(e, ui) {
					var $this = $(this);
					var elOffset = ui.offset;
					var containerOffset = $container.offset();
					if (elOffset.left > containerOffset.left &&
						elOffset.top > containerOffset.top &&
						elOffset.left < containerOffset.left + $container.width() &&
						elOffset.top < containerOffset.top + $container.height()) {

						var flowchartOffset = $flowchart.offset();

						var relativeLeft = elOffset.left - flowchartOffset.left;
						var relativeTop = elOffset.top - flowchartOffset.top;

						var positionRatio = $flowchart.flowchart('getPositionRatio');
						relativeLeft /= positionRatio;
						relativeTop /= positionRatio;

						var data = getOperatorData($this);
						data.left = relativeLeft;
						data.top = relativeTop;

						$flowchart.flowchart('addOperator', data);
					}
				}
			});
			//--- end
			//--- draggable operators
			//-----------------------------------------


			//-----------------------------------------
			//--- save and load
			//--- start
			function Flow2Text() {
				var data = $flowchart.flowchart('getData');
				$('#flowchart_data').val(JSON.stringify(data, null, 2));
			}
			$('#get_data').click(Flow2Text);

			function Text2Flow() {
				var data = JSON.parse($('#flowchart_data').val());
				$flowchart.flowchart('setData', data);
			}
			$('#set_data').click(Text2Flow);

			/*global localStorage*/
			function SaveToLocalStorage() {
				if (typeof localStorage !== 'object') {
					alert('local storage not available');
					return;
				}
				Flow2Text();
				localStorage.setItem("stgLocalFlowChart", $('#flowchart_data').val());
			}
			$('#save_local').click(SaveToLocalStorage);

			function LoadFromLocalStorage() {
				if (typeof localStorage !== 'object') {
					alert('local storage not available');
					return;
				}
				var s = localStorage.getItem("stgLocalFlowChart");
				if (s != null) {
					$('#flowchart_data').val(s);
					Text2Flow();
				}
				else {
					alert('local storage empty');
				}
			}
			$('#load_local').click(LoadFromLocalStorage);
			//--- end
			//--- save and load
			//-----------------------------------------


		});

		var defaultFlowchartData = {
			operators: {
				operator1: {
					top: 20,
					left: 20,
					properties: {
						title: 'Operator 1',
						inputs: {},
						outputs: {
							output_1: {
								label: 'Output 1',
							}
						}
					}
				},
				operator2: {
					top: 80,
					left: 300,
					properties: {
						title: 'Operator 2',
						inputs: {
							input_1: {
								label: 'Input 1',
							},
							input_2: {
								label: 'Input 2',
							},
						},
						outputs: {}
					}
				},
			},
			links: {
				link_1: {
					fromOperator: 'operator1',
					fromConnector: 'output_1',
					toOperator: 'operator2',
					toConnector: 'input_2',
				},
			}
		};
		if (false) console.log('remove lint unused warning', defaultFlowchartData);
	</script>
        

    <!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->


</body>

<!-- Mirrored from designreset.com/cork/ltr/demo2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 13:08:48 GMT -->
</html>