<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CHU Docflow</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:400,600,700')}}" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link href="{{asset('assets/css/apps/contacts.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{asset('https://use.fontawesome.com/releases/v5.13.0/css/all.css')}}" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

	<!-- jQuery & jQuery UI are required -->
	<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
	<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>

	<!-- Flowchart CSS and JS -->
	<link rel="stylesheet" href="{{asset('css/jquery.flowchart.css')}}">
	<script src="{{asset('js/jquery.flowchart.js')}}"></script>
	<link href="{{asset('assets/css/apps/invoice.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/editors/quill/quill.snow.css')}}">
    <link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />

	<style>
		.flowchart-example-container {
			
			height: 521px;
			width: 1070px;
			background: white;
			margin-bottom: 10px;
		}
		
		#opstart{
			height: 50px;
			width: 50px;
			background-color: #8dbf42;
			border-radius: 50%;
		}
		
		#opend {
			height: 50px;
			width: 50px;
			background-color: #e7515a;
			border-radius: 50%;
		}

		#opaction {
			width: 100px;
			height: 50px;
			background: #6AD4FE;
		}

		#opemail {
			width: 100px;
			height: 50px;
			background: #FEBB55;
		}

		#opcondition {
		  height: 50px;
		  width: 50px;
		  background-color: #3b3f5c;
		  transform: rotate(45deg);
		} 
		
	</style>
</head>

<body class="alt-menu sidebar-noneoverflow">

    <!--  BEGIN NAVBAR  -->
    @include('menus.navbar')
    <!--  END NAVBAR  -->

	<!--  BEGIN MAIN CONTAINER  -->
	<button hidden id="notif" class="btn btn-dark bottom-right">Bottom right</button>
	<button hidden id="notifUnique" class="btn btn-dark bottom-right-unique">Bottom right</button>
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('menus.sideMenu_admin')
        <!--  END SIDEBAR  -->
		
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
										<div class="search container layout-top-spacing">
												<svg id="supp" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete_selected_button"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
												<svg data-toggle="modal" data-target="#exampleModalCenter" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
										</div>
										<ul class="nav nav-pills inv-list-container d-block" id="pills-tab" role="tablist">
											<li class=" container nav-item layout-top-spacing">
												<div id="start" disabled="false" class="draggable_operator" data-nb-inputs="0" data-nb-outputs="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#8dbf42" stroke="#8dbf42" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>Début</div>
											</li>

											<li class=" container nav-item ">
												<div id="end" class="draggable_operator" data-nb-inputs="1" data-nb-outputs="0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#e7515a" stroke="#e7515a" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>Fin</div>
											</li>

											<li class=" container nav-item ">
												<div id="action" class="draggable_operator" data-nb-inputs="1" data-nb-outputs="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1b55e2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>Tâche</div>
											</li>

											<li class=" container nav-item ">
												<div id="email" class=" container row 	draggable_operator" data-nb-inputs="1" data-nb-outputs="1"><h4><i class="far fa-envelope" style="color:#e2a03f"></i></h4>&nbsp; Email</div>
											</li>

											<li class=" container nav-item ">
												<div id="condition" class=" container row draggable_operator" data-nb-inputs="1" data-nb-outputs="1"><h4><i style="transform:rotate(90deg);" class="fas fa-code-branch"></i></h4>&nbsp; Condition</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="invoice-container">
								<div class="invoice-inbox" >
									
									<div id="chart_container">
										<div class="flowchart-example-container" id="flowchartworkspace"></div>
									</div>
									<form id="formData" action="{{url('admin/successeurs')}}" method="post">
										{{ csrf_field() }}
										<input type="hidden" id="getData" name="getData" value="">
										<input type="hidden" id="idWf" name="idWf" value="">
									</form>
									
									<form class="mt-0" id="addWf">
										{{ csrf_field() }}
										<input type="hidden" name="typeDoc" class="form-control mb-4" id="typeDocform" >
										<input type="hidden" name="nomWf" class="form-control mb-4" id="nomWfform" >
										<textarea hidden class="form-control" name="descWf" id="messageform" rows="3"></textarea>
									</form>

								</div>

							</div>
							
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- Confirmation Modal saveWF-->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle">Enregistrer le workflow</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
						</button>
					</div>
					<div class="modal-body">
						<p class="modal-text">Voulez vous vraiment enregistrer ce workflow </p>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Annuler</button>
						<button id="saveWorkflow" type="button" class="btn btn-primary dlt">Confirmer</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal saveWF -->
		<div data-keyboard="false" data-backdrop="static" class="modal fade" id="saveWF" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">

				<div class="modal-header" id="loginModalLabel">
					<h5 class="modal-title">Créer nouveau workflow</h5>
				</div>
				<div class="modal-body">
					<form id="form-addWF" method="POST">
							{{ csrf_field() }}
						<div class="form-group">
							<select id="typeDoc" name="typeDocUnique" class="selectpicker" data-live-search="true" data-width="100%">
								<option value="" disabled selected>Type document</option>
								@foreach ($typesDoc as $typeDoc)
									<option value="{{$typeDoc->idTd}}"> {{$typeDoc->intituleTd}} </option>
								@endforeach
							</select>										
						</div>
						<div class="form-group">
							<input type="text" name="nomWf" class="form-control mb-4" id="nomWf" placeholder="Nom du workflow">
						</div>
						<div class="form-group">
							<textarea class="form-control" name="descWf" id="exampleFormControlTextarea" rows="3" placeholder="Description"></textarea>
						</div>
						<button id="btn-addWF" type="submit" class="btn btn-success  mt-2 mb-2 btn-block">Enregistrer</button>
					</form>
				</div>
				</div>
			</div>
		</div>

		<!-- Modal addAction-->
		<div class="modal fade" id="addAction" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
						<div class="add-contact-box">
							<div class="add-contact-content">
								<form id="addContactModalTitle">
									<div class="custom-file mb-4">
										<input id="nomAct" type="text" class="form-control" placeholder="Nom action">
									</div>
									<div class="custom-file mb-4">
										<select id="act_idU" name="responsableA" class="selectpicker" data-live-search="true" data-width="100%">
											<option value="" disabled selected >Responsable</option>
											@foreach ($users as $user)
												<option value="{{$user->id}}"> {{$user->nomU}} {{$user->prenomU}} </option>
											@endforeach
										</select>
									</div>
									<div class="custom-file mb-4">
										<select id="act_idG" name="responsableA" class="selectpicker" data-live-search="true" data-width="100%">
											<option value="" disabled selected >Groupe</option>
											@foreach ($groupes as $groupe)
												<option value="{{$groupe->id}}"> {{$groupe->nomG}} </option>
											@endforeach
										</select>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<input id="date_limiteAct" type="text" class="form-control" placeholder="Délais">
										</div>
										<div class="form-group col-md-6">
											<select id="opt_limiteAct" name="optRA" class="selectpicker" >
												<option value="" disabled selected>Option délais</option>
												<option value="j" >jour(s)</option>
												<option value="h" >heure(s)</option>
												<option value="m" >minute(s)</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<input id="date_rappelAct" type="text" class="form-control" placeholder="Délais rappel">
										</div>
										<div class="form-group col-md-6">
											<select id="opt_rappelAct" name="optRA" class="selectpicker" >
												<option value="" disabled selected>Option délais</option>
												<option value="j" >jour(s)</option>
												<option value="h" >heure(s)</option>
												<option value="m" >minute(s)</option>
											</select>
										</div>
									</div>
									<div class="custom-file mb-4">
										<div class="n-chk">
											<label>Priorité:</label>
											<label class="new-control new-radio new-radio-text radio-classic-default">
												<input type="radio" class="new-control-input" value="Faible" name="custom-radio-5-priorite">
												<span class="new-control-indicator"></span><span class="new-radio-content">Faible</span>
											</label>
											<label class="new-control new-radio new-radio-text radio-classic-primary">
												<input type="radio" class="new-control-input" value="Moyenne" name="custom-radio-5-priorite" checked>
												<span class="new-control-indicator"></span><span class="new-radio-content">Moyenne</span>
											</label>
											<label class="new-control new-radio new-radio-text radio-classic-secondary">
												<input type="radio" class="new-control-input" value="Haute" name="custom-radio-5-priorite">
												<span class="new-control-indicator"></span><span class="new-radio-content">Haute</span>
											</label>
										</div>
									</div>
									<div class="custom-file mb-4">
										<p class="">Type de tâche</p>
										<div class="col-sm-12 col-12 input-fields">
											<div class="n-chk">
												<label class="new-control new-radio radio-primary">
													<input type="radio" class="new-control-input" value="1" name="custom-radio-1-version" checked="checked">
													<span class="new-control-indicator"></span>Avec entrée
												</label>
												<label class="new-control new-radio radio-primary">
													<input type="radio" class="new-control-input" value="0" name="custom-radio-1-version">
													<span class="new-control-indicator"></span>Sans entrée
												</label>
											</div>
											<div class="n-chk">
												<label class="new-control new-radio radio-primary">
													<input type="radio" class="new-control-input" value="Approbation" name="custom-radio-1-typeA">
													<span class="new-control-indicator"></span>Approbation
												</label>
												<label class="new-control new-radio radio-primary">
													<input type="radio" class="new-control-input" value="Validation" name="custom-radio-1-typeA" checked="checked">
													<span class="new-control-indicator"></span>Validation
												</label>
											</div>
										</div>
									</div>
									<div class="custom-file mb-4">
										<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Annuler</button>
						<button id="btn-add" class="btn btn-success">Valider</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal SendEmail-->
		<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
						<div class="add-contact-box">
							<div class="add-contact-content">
								<form id="addContactModalTitle">
									<div class="row mb-4">
										<div class="col-sm-12 col-12 input-fields">
											<div class="n-chk">
												<label class="new-control new-radio radio-primary">
													<input type="radio" class="new-control-input radio" name="custom-radio-1-email" value="Interne" checked="checked">
													<span class="new-control-indicator"></span>Interne
												</label>
												<label class="new-control new-radio radio-primary">
													<input type="radio" class="new-control-input radio" name="custom-radio-1-email" value="Externe">
													<span class="new-control-indicator"></span>Externe
												</label>
											</div>
										</div>
									</div>
									<div class="custom-file mb-4 dest">
										<select id="destI" name="responsableA" class="selectpicker" data-live-search="true" data-width="100%">
											<option value="" disabled selected >Destinataire</option>
											@foreach ($users as $user)
												<option value="{{$user->id}}"> {{$user->nomU}} {{$user->prenomU}}: {{$user->email}} </option>
											@endforeach
										</select>
									</div>
									<div class="custom-file mb-4">
										<input id="destE" disabled type="text" class="form-control" placeholder="Email destinataire (externe)">
									</div>
									<div class="custom-file mb-4">
										<input id="objetAct" type="text" class="form-control" placeholder="Objet">
									</div>
									<div class="custom-file mb-4">
										<div class="statbox box box-shadow">
											<div class="widget-content widget-content-area">
												<div id="editor-container">
													<h1>This is a heading text...</h1>
													<br/>
													<p> Lorem </p>
												</div>
			
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Annuler</button>
						<button id="btn-add-email" class="btn btn-success">Valider</button>
					</div>
				</div>
			</div>
		</div>
		<!--  END CONTENT AREA  -->

	<script type="text/javascript">
		/* global $ */
		$(document).ready(function() {
			$('#saveWF').modal('show');

			var $flowchart = $('#flowchartworkspace');
			var $container = $flowchart.parent();
			var x=0;

			// Apply the plugin on a standard, empty div...
			$flowchart.flowchart({
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
			var $operatorTitle = $('#nomAct');
			var $linkColor = $('#link_color');
			var i=0;
			var opId;
			var called = 0;

 
			$flowchart.flowchart({
				onOperatorSelect: function(operatorId) {

					var links = $flowchart.flowchart('getLinksFrom', operatorId);
					$.each(links, function(){
						//alert(this.toOperator)
					});

					opId = operatorId;
					/* $('#btn-add').click(function(){
						var nomA=$('#nomA').val();
						$('#test'+opId).val(nomA);
						$("#addAction").modal("hide");
					}); */
					i++;
					if(i==2){
						$('#nomAct').val('');
						$('#exampleFormControlTextarea1').val('');
						$('#date_limiteAct').val('');
						$('#date_rappelAct').val('');
						if(!$flowchart.flowchart('getOperatorTitle', opId).includes("Email")
						  && !$flowchart.flowchart('getOperatorTitle', opId).includes("Fin")
						  && !$flowchart.flowchart('getOperatorTitle', opId).includes("Début")
						  && !$flowchart.flowchart('getOperatorTitle', opId).includes("Condition"))	
							$("#addAction").modal("show");
						else if($flowchart.flowchart('getOperatorTitle', opId).includes("Email"))
							$("#sendEmail").modal("show");
						i=0;
					}
					$operatorProperties.show();
					$operatorTitle.val($flowchart.flowchart('getOperatorTitle', operatorId));
					return true;
				},
				onOperatorUnselect: function() {
					i--;
					$operatorProperties.hide();
					return true;
				},
				onLinkSelect: function(linkId) {
					console.log($flowchart.flowchart('getOperatorData', linkId))
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
					///$('#action.flowchart-operator').css("width","auto");
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
			$('.delete_selected_button').click(function() {
				var idDelete = $flowchart.flowchart('getSelectedOperatorId')
				
				if( idDelete != null && $flowchart.flowchart('getOperatorTitle', idDelete).includes("Début"))
				{
					x--;
				}
				$flowchart.flowchart('deleteSelected');
			});
			//--- end
			//--- delete operator / link button
			//-----------------------------------------

			//type act -version-
			$('input[type=radio][name=custom-radio-1-version]').change(function() {
				if (this.value == 'Avec') {
					$('#versionA'+opId).val(this.value);
				}
				else if (this.value == 'Sans') {
					$('#versionA'+opId).val(this.value);
				}
			});

			//type act -approbation-
			$('input[type=radio][name=custom-radio-1-typeA]').change(function() {
				if (this.value == 'Approbation') {
					$('#typeA'+opId).val(this.value);
				}
				else if (this.value == 'Validation') {
					$('#typeA'+opId).val(this.value);
				}
			});

			//type act -priorite-
			$('input[type=radio][name=custom-radio-5-priorite]').change(function() {
				if (this.value == 'Faible') {
					$('#prioriteA'+opId).val(this.value);
				}
				else if (this.value == 'Moyenne') {
					$('#prioriteA'+opId).val(this.value);
				}
				else if (this.value == 'Haute') {
					$('#prioriteA'+opId).val(this.value);
				}
			});

			$('#btn-add').click(function() {
				$("#addAction").modal("hide");
				$('#nomA'+opId).val($('#nomAct').val());
				$('#directiveA'+opId).val($('#exampleFormControlTextarea1').val());
				$('#responsableA'+opId).val($('#responsableAct').val());
				$('#prioriteA'+opId).val($('#prioriteAct').val());
				$('#date_limiteA'+opId).val($('#date_limiteAct').val());
				$('#opt_limiteA'+opId).val($('#opt_limiteAct').val());
				$('#date_rappelA'+opId).val($('#date_rappelAct').val());
				$('#opt_rappelA'+opId).val($('#opt_rappelAct').val());
				$('#a_idG'+opId).val($('#act_idG').val());
				$('#a_idU'+opId).val($('#act_idU').val());				
			});

			//Email
			$('input[type=radio][name=custom-radio-1-email]').change(function() {
				if (this.value == 'Interne') {
					$('#destE').val('');
					$('#destE').attr('disabled', 'disabled');
					$('#destI').removeAttr("disabled");
					$('.selectpicker').selectpicker('refresh');
				}
				else if (this.value == 'Externe') {
					$('#destI').val('');
					$('#destE').removeAttr("disabled");
					$('#destI').attr('disabled', 'disabled');
					$('.selectpicker').selectpicker('refresh');
				}
			});

			$('#btn-add-email').click(function() {
				$("#sendEmail").modal("hide");
				$('#objetA'+opId).val($('#objetAct').val());
				$('#messageA'+opId).val(quill.root.innerHTML);
				$('#a_destinataireU'+opId).val($('#destI').val());
				$('#destinataireIA'+opId).val($('#destE').val());				
			});

			$("#form-addWF").submit(function(e){
				e.preventDefault();
				var data = $('#form-addWF').serialize(); 
                $.ajax({
                    type:'POST',
                    data:data,
                    url:'/admin/unique',
                    success:function(data){
						if(data.success == "unique")
						{
							$("#saveWF").modal("hide");
							$('#typeDocform').val($('#typeDoc').val());
							$('#nomWfform').val($('#nomWf').val());
							$('#messageform').val($('#exampleFormControlTextarea').val());
						}
						else{
							$('#notifUnique').click();
						}
					}
                }); 
			});

			ajax_recaller = function(forms){
				var id = forms[called].attr("id").substring(10);
				alert("id "+id)
				$.ajax({
					type: "POST",
					data: forms[called].serialize(),                             // to submit fields at once
					success: function(data) {
						called++;                                                                 // this will serve as a key
						
						if(called < forms.length) {
							ajax_recaller(forms);                                            // call the ajax function again
						} 
						else {
							called=0;
							$("#exampleModalCenter").modal("hide");
							var data = $flowchart.flowchart('getData');
							var data1 = JSON.stringify(data, null, 2);
							$('#getData').val(data1);
							$('#formData').submit();
						}
					
					}
				
				});
				
			}

			$('#saveWorkflow').click(function(){
				$("#addWf").submit();
			});

			//add WF
            $("#addWf").submit(function(e){
				e.preventDefault();
				var data = $('#addWf').serialize(); 
				var i=0;
				var forms = new Array();
				$(".monform").each(function(){
					forms[i] = $(this);
					i++;
				});
                $.ajax({
                    type:'POST',
                    data:data,
                    url:'/admin/addWf',
                    success:function(data){
						var text ='{!! csrf_field() !!}';
						$(text).insertBefore( $( ".inpt" ) );
						$("#monform").attr('action','/admin/test');
						//$("#formAction").attr('action','/admin/test');
						
						$('.inptwf').val(data.workflow.idWf);
						$('#idWf').val(data.workflow.idWf);
						ajax_recaller(forms);
                    }
                });   
			});

			//-----------------------------------------
			//--- create operator button
			//--- start
			var operatorI = 0;
			$('.create_operator').click(function() {
				var operatorId = 'created_operator_' + operatorI;
				var operatorData = {
					top: ($flowchart.height() / 2) - 30,
					left: ($flowchart.width() / 2) - 100 + (operatorI * 10),
					properties: {
						title: '',
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
				var option = 'action';
				$flowchart.flowchart('createOperator', operatorId, operatorData, option);

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
			var cpt=0;

			$draggableOperators.draggable({
				cursor: "move",
				opacity: 0.7,

				// helper: 'clone',
				appendTo: 'body',
				zIndex: 1000,

				helper: function(e) {
					var $this = $(this);
					var data = getOperatorData($this);
					console.log(data)
					option=$this[0].id;//
					return $flowchart.flowchart('getOperatorElement', data, option, 0);
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
						if(option == "start")
						{
							if(x==0)
							{
								x++;
								$flowchart.flowchart('addOperator', data, option);
							}
							else{
								$('#notif').click();
							}
						}
						else
							$flowchart.flowchart('addOperator', data, option);
						cpt++;
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
	<script src="{{asset('assets/js/apps/invoice.js')}}"></script>
	<script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
	
	<script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
    <script src="{{asset('plugins/editors/quill/custom-quill.js')}}"></script>
	<script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
	<script>
		$('.bottom-right').click(function() {
            Snackbar.show({
                text: 'Il existe déja un état initial.',
                pos: 'bottom-right'
            });
		});
		$('.bottom-right-unique').click(function() {
            Snackbar.show({
                text: 'Ce type de document a déja un workflow.',
                pos: 'bottom-right'
            });
        });
	</script>

	<script>
		const ps = new PerfectScrollbar('.invoice-inbox');
		const pslist = new PerfectScrollbar('.inv-list-container');
	</script>


</body>

</html>
