@extends('layout.app1')

@section('link')
    <link href="{{asset('assets/css/apps/invoice.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/elements/avatar.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script>
		const psl = new PerfectScrollbar('.invoice-inbox');
	</script>
    <script src="{{asset('js/pdf/jquery.media.js')}}"></script>
    <script src="{{asset('js/pdf/pdf-active-1.js')}}"></script>
    <script>
        $(document).on("click",".feather-eye",function(){
            var type = $(this).attr('name');
            var id = $(this).attr('id').substring(3);

            var fileName = $('#lienpdf'+id).val(); 
            var ext = (/[.]/.exec(fileName)) ? /[^.]+$/.exec(fileName)[0] : undefined;

            if(ext == 'pdf'){
                var href='http://localhost:8000/pdf/'+$('#lienpdf'+id).val();
                var src='http://localhost:8000/pdf/'+$('#lienpdf'+id).val();
                $('#media').attr('href', href);
                $('#frame').attr('src',src); 
                $('#exampleModal').modal('show');
            }
            else if(ext == 'jpg' || ext == 'png' || ext == 'jpeg'){
                $('#lienIMG').attr('src','http://localhost:8000/pdf/'+fileName);
                $('#exampleModalIMG').modal('show');
            }else{
                alert("ce type n'est pas traité")
            }
            
        });
    </script>
@endsection

@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row invoice layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="doc-container">

                    <div class="invoice-container" style="width:100%;">
                        <div class="invoice-inbox">
                                
                            <div class="invoice-00001">
                                <div class="content-section  animated animatedFadeInUp fadeInUp">

                                    <div class="row inv--head-section">

                                        <div class="col-sm-6 col-12">
                                            <h3 class="in-heading"> {{ucfirst($doc->nomD)}} </h3>
                                        </div>
                                        <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                            <div class="company-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-pull-request"><circle cx="18" cy="18" r="3"></circle><circle cx="6" cy="6" r="3"></circle><path d="M13 6h3a2 2 0 0 1 2 2v7"></path><line x1="6" y1="9" x2="6" y2="21"></line></svg>
                                                <h5 class="inv-brand-name">Workflow</h5>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row inv--detail-section">

                                        <div class="col-sm-7 align-self-center">
                                            <p class="inv-list-number"> <span class="inv-title">Type du document: </span> <span class="inv-number">{{$doc->type_doc->intituleTd}} </span></p>
                                        </div>
                                        <div class="col-sm-5 align-self-center  text-sm-right order-sm-0 order-1">
                                            <p class="inv-list-number"><span class="inv-title">Ajouté par: </span><span class="inv-number">{{$doc->user->nomU}} {{$doc->user->prenomU}} </span></p>
                                        </div>
                                        
                                        <div class="col-sm-7 align-self-center">
                                            <p class="inv-list-number"><span class="inv-title">Titre du document: </span><span class="inv-number">{{ucfirst($doc->titreD)}} </span></p>
                                            <p class="inv-list-number"><span class="inv-title">Etat du document: </span><span class="inv-number">{{ucfirst($doc->etatD)}} </span></p>
                                            <p class="inv-list-number"><span class="inv-title">Action(s) courante(s): </span>
                                            @foreach ($actionC as $a)
                                                <span class="inv-number">
                                                    {{$a->nomA}}
                                                </span>
                                            @endforeach</p>
                                        </div>
                                        <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                            <p class="inv-list-number"><span class="inv-title">Nombre de version(s) : </span> <span class="inv-number"> {{$versions->count()}} </span></p>
                                            <p class="inv-list-number"><span class="inv-title">Date de création : </span> <span class="inv-number">20 Aug 2019</span></p>
                                            <p class="inv-list-number"><span class="inv-title">Date de modification: </span> <span class="inv-number">26 Aug 2019</span></p>
                                        </div>
                                    </div>

                                    <div class="row inv--product-table-section">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="">
                                                        <tr>
                                                            <th scope="col">N° version</th>
                                                            <th scope="col">Date d'ajout</th>
                                                            <th  scope="col">Ajouté par</th>
                                                            <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($versions as $version)
                                                           <tr>
                                                                <td> {{$version->numV}} </td>
                                                                <td>{{$version->created_at}}</td>
                                                                <td ></td>
                                                                <td >    
                                                                    <a href="{{asset('pdf/'.$version->doc)}}" download="{{$version->document->nomD}}_V{{$version->numV}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye" id="eye{{$version->idV}}"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                                    <input type="hidden" id="lienpdf{{$version->idV}}" value="{{$version->doc}}">
                                                                </td>
                                                            </tr> 
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="inv--payment-info">
                                                <div class="row">
                                                    <div class="col-sm-12 col-12">
                                                        <h6 class=" inv-title">Contributeurs:</h6>
                                                    </div>
                                                    <div style="margin-left:50px;">
                                                        <div class="avatar--group">
                                                            @foreach ($doc->type_doc->workflow->actions as $action)
                                                                @if (App\Action::find($action->idA)->user)
                                                                    <div class="avatar">
                                                                        <img alt="avatar" src="{{asset('assets/img/profile-12.jpg')}}" class="rounded-circle  bs-tooltip" data-original-title="{{App\Action::find($action->idA)->user->nomU }} {{App\Action::find($action->idA)->user->prenomU }}" />
                                                                    </div>
                                                                @elseif(App\Action::find($action->idA)->groupe)
                                                                    @foreach (App\Action::find($action->idA)->groupe->users as $user)
                                                                        <div class="avatar">
                                                                            <img alt="avatar" src="{{asset('assets/img/profile-12.jpg')}}" class="rounded-circle  bs-tooltip" data-original-title="{{$user->nomU}} {{$user->prenomU}}" />
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                            {{-- <div class="avatar">
                                                                <span class="avatar-title rounded-circle  bs-tooltip" data-original-title="Alan Green">AG</span>
                                                            </div> --}}
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

            </div>
        </div>
    </div>
</div>

<!-- Modal PDF -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:540px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <div id="liensPDF" class="pdf-viewer-area pdf-single-pro">
                    <a class="media" href="{{asset('mamunur.pdf')}}"></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal IMG -->
<div class="modal fade" id="exampleModalIMG" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img class="d-block w-100" src="" id="lienIMG" alt="">
            </div>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->
@endsection