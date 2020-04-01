<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CHU Docflow</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:400,600,700')}}" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link href="{{asset('assets/css/apps/contacts.css')}}" rel="stylesheet" type="text/css" />

	<title>Home</title>

	<!-- jQuery & jQuery UI are required -->
	<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
	<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>

	<!-- Flowchart CSS and JS -->
	<link rel="stylesheet" href="{{asset('css/jquery.flowchart.css')}}">
	<script src="{{asset('js/jquery.flowchart.js')}}"></script>
	<link href="{{asset('assets/css/apps/invoice.css')}}" rel="stylesheet" type="text/css" />


	<script>
		function showmodal() {
			console.log(document.getElementById("addContactModal"))
			document.getElementById("addContactModal").showModal();
		}
	</script>

	<style>
		.flowchart-example-container {
			width: 800px;
			height: 400px;
			background: white;
			border: 1px solid #BBB;
			margin-bottom: 10px;
		}

		
		#start_end {
			height: 50px;
			width: 50px;
			background-color: #555;
			border-radius: 50%;
		} 

		#condition {
		  height: 50px;
		  width: 50px;
		  background-color: #7FDBFF;
		  transform: rotate(45deg);
		}  
	</style>
</head>

<body>
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
        {{-- <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="row">

                            <div class="col-xl-12  col-md-12">

                                <div class="mail-box-container">
                                    <div class="mail-overlay"></div>

                                    <div class="tab-title">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-12 mail-categories-container">
                                                <div class="mail-sidebar-scroll">
                                                    <div class="draggable_operators">
                                                        

                                                        <ul class="nav nav-pills d-block" id="pills-tab" role="tablist">
															<li class="nav-item">
																<div id="start_end" class="draggable_operator" data-nb-inputs="1" data-nb-outputs="0"></div>
															</li>
															<li class="nav-item">
																<div id="action" class="draggable_operator" data-nb-inputs="1" data-nb-outputs="0"></div>
															</li> 
                                                            <li class="nav-item">
                                                                <div class="draggable_operators_divs">
                                                                    <div id="condition" class="draggable_operator" data-nb-inputs="1" data-nb-outputs="2"></div>
                                                                </div>                                                                    
                                                            </li>
                                                        </ul>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                                                    <div class="add-contact-box">
                                                        <div class="add-contact-content">
                                                            <form id="addContactModalTitle">
                                                                <div class="custom-file mb-4">
																	<input type="text" id="c-name" class="form-control" placeholder="Nom">
																	<span class="validation-text"></span>
																</div>
																
																<div class="row">
																	<div class="form-group col-md-6">
																		<input type="text" id="c-name" class="form-control" placeholder="Délais">
																		<span class="validation-text"></span>
																	</div>
																	<div class="form-group col-md-6">
																		<input type="text" id="c-email" class="form-control" placeholder="opt">
																		<span class="validation-text"></span>
																	</div>
																</div>

                                                                <div class="custom-file mb-4">
                                                                    <input type="text" id="c-occupation" class="form-control" placeholder="Responsable">
                                                                </div>

                                                                <div class="custom-file mb-4">
																	<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="btn-edit" class="float-left btn">Save</button>

                                                    <button class="btn" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>

                                                    <button id="btn-add" class="btn">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="mailbox-inbox" class="accordion mailbox-inbox">
    
                                            <div class="action-center">
                                                <div class="">
                                                    <div class="n-chk">
                                                            <h4>Flowchart</h4>
                                                            <div id="chart_container">
                                                                <div class="flowchart-example-container" id="flowchartworkspace"></div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div> --}}
		
		<!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
			<div class="layout-px-spacing">
				<div class="row invoice layout-top-spacing">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="app-hamburger-container">
							<div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu chat-menu d-xl-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
						</div>
						<div class="doc-container">
							<div class="tab-title">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-12">
										<ul class="nav nav-pills inv-list-container d-block" id="pills-tab" role="tablist">
										</ul>
									</div>
								</div>
							</div>

							<div class="invoice-container">
								<div class="invoice-inbox">
								</div>

							</div>
							
						</div>

					</div>
				</div>
			</div>
		</div>
		<!--  END CONTENT AREA  -->


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
						label: ' ' 
					};
				}
				for (i = 0; i < nbOutputs; i++) {
					data.properties.outputs['output_' + i] = {
						label: ' ' 
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

			/* $('.flowchart-operator').dblclick(function(){
				 console.log($('.flowchart-operator'))
				$("#addContactModal").modal("show");
			});*/
 
			$flowchart.flowchart({
				onOperatorSelect: function(operatorId) {
					alert("b")
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
								label: '',
							}
						},
						outputs: {
							output_1: {
								label: '',
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
			var option;//

			$draggableOperators.draggable({
				cursor: "move",
				opacity: 0.7,

				// helper: 'clone',
				appendTo: 'body',
				zIndex: 1000,

				helper: function(e) {
					var $this = $(this);
					var data = getOperatorData($this);
					option=$this[0].id;//
					return $flowchart.flowchart('getOperatorElement', data, option);
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

						$flowchart.flowchart('addOperator', data, option);
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
						title: '',
						inputs: {},
						outputs: {
							output_1: {
								label: '',
							}
						}
					}
				},
				operator2: {
					top: 80,
					left: 300,
					properties: {
						title: '',
						inputs: {
							input_1: {
								label: '',
							},
							input_2: {
								label: '',
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
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>

</html>
