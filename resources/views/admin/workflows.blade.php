@extends('layout.app')

@section('link')
<link href="{{asset('assets/css/apps/scrumboard.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $("#deleteConformation").on('show.bs.modal', function(event) {
            var a = $(event.relatedTarget).data('nom');
            var b = $(event.relatedTarget).data('id');
            var m = $(this);
            m.find('#nomD').text(a);
            m.find("#idD").val(b);
        });
        $("#dlt").on('click', function(event) {
            event.preventDefault();
            var table = $('#zero-config').DataTable();
            var data = $('#deleteF').serialize(); 
            $.ajax({
                type:'POST',
                data:data,
                url:'/admin/delete/workflow',
                success:function(data){
                    table
                    .row( $('#items'+data.id) )
                    .remove()
                    .draw();
                    $('#deleteConformation').modal('hide');
                    
                }
                }); 
            
        });
    });
</script>
    
@endsection

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing" id="cancel-row">
            
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type document</th>
                                    <th>N° documents</th>
                                    <th>Description</th>
                                    <th>Date création</th>
                                    <th class="no-content"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($workflows as $workflow)
                                    <tr id="items{{$workflow->idWf}}">
                                        <td> {{$workflow->nomWf}} </td>
                                        <td>{{$workflow->type_doc->intituleTd}}</td>
                                        <td>{{$workflow->type_doc->documents->count()}}</td>
                                        <td>{{$workflow->descriptionWf}}</td>
                                        <td>{{$workflow->created_at->format('d/m/Y')}}</td>
                                        @if($workflow->type_doc->documents->count() == 0 || $workflow->type_doc->documents->where('etatD','archivé')->count()>0)
                                            <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel" data-toggle="modal" data-target="#deleteConformation" data-id="{{$workflow->idWf}}" data-nom="{{$workflow->nomWf}}"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></td>
                                        @else 
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type document</th>
                                    <th>N° documents</th>
                                    <th>Description</th>
                                    <th>Date création</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal dlt doc -->

            <div class="modal fade" id="deleteConformation" tabindex="-1" role="dialog" aria-labelledby="deleteConformationLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" id="deleteConformationLabel">
                        <div class="modal-header">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </div>
                            <h5 class="modal-title" id="exampleModalLabel">Suppression du document?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="">Voulez vous vraiment supprimer le workflow: <b id="nomD"></b>?.</p> 
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">Annuler</button>
                            <form id="deleteF">
                                {{ csrf_field() }}
                                <input name="idD" type="hidden" id="idD">
                                <button type="button" class="btn btn-danger dlt" id="dlt">Confirmer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection