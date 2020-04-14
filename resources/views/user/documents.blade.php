@extends('layout.app1')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing" id="cancel-row">
            <div class="col-lg-6">
                <!-- Fade in up modal -->
                <br>
                <button type="button" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#fadeupModal">Nouveau</button>
            </div>
            <div id="fadeupModal" class="modal animated fadeInUp custo-fadeInUp" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nouveau document</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                                <select class="selectpicker  mb-4" data-live-search="true" data-width="100%">
                                    <option>choisissez</option>
                                    @foreach ($typesDoc as $typeDoc)
                                        <option> {{$typeDoc->intituleTd}} </option>
                                    @endforeach
                                </select>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" placeholder="">
                                        <div class=" mt-1">
                                            <span class="badge outline-badge-dark">date Livraison
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" placeholder="">
                                        <div class=" mt-1">
                                            <span class="badge outline-badge-dark">signé par
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                


                                <div class="custom-file mb-4">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                        </div>
                        <div class="modal-footer md-button">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nom document</th>
                                    <th>Date création</th>
                                    <th>Date modification</th>
                                    <th>Action courante</th>
                                    <th>Nb versions</th>
                                    <th>Droit d'accés</th>
                                    <th class="no-content"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($docs as $doc)
                                   <tr>
                                        <td> {{$doc->nomD}} </td>
                                        <td> {{$doc->created_at->format('d/m/Y')}} </td>
                                        <td> {{$doc->updated_at->format('d/m/Y')}} </td>
                                        <td>  </td>
                                        <td>  </td>
                                        <td>  </td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" title="supprimer" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </td>
                                    </tr> 
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                        <th>Nom document</th>
                                        <th>Date création</th>
                                        <th>Date modification</th>
                                        <th>Action courante</th>
                                        <th>Nb versions</th>
                                        <th>Droit d'accés</th>
                                        <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@endsection