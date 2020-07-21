@if (Auth::user()->roles->pluck('nomR')->contains("user") )
    @php
    $ext = 'app1';
    @endphp   
@elseif (Auth::user()->roles->pluck('nomR')->contains("admin") )
    @php
    $ext = 'app';
    @endphp
@endif

@extends('layout.'.$ext)

@section('link')
    <link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/apps/invoice.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/elements/avatar.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script>
		const psl = new PerfectScrollbar('.invoice-inbox');
		const pst = new PerfectScrollbar('.table-body');
	</script>
    <script src="{{asset('js/pdf/jquery.media.js')}}"></script>
    <script src="{{asset('js/pdf/pdf-active-1.js')}}"></script>
    <script>
        $('.bottom-right-unique').click(function() {
            Snackbar.show({
                text: 'Document archivé.',
                pos: 'bottom-right'
            });
		});
    </script>
    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
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
    <script>
        $(document).ready(function () {
            $("#exampleModalCenter").on('show.bs.modal', function(event) {
                var a = $(event.relatedTarget).data('valeur');
                var cpt = 1;
                $('#valMeta').empty()
                $( a ).each(function( index ) {
                    $('#valMeta').append(
                        '<tr class="table-default">'+
                            '<td class="text-center">'+cpt+'</td>'+
                            '<td>'+this.valeur+'</td>'+
                            '<td>'+this.nomU+' '+this.prenomU+'</td>'+
                            '<td>'+this.created_at+'</td>'+
                        '</tr>'
                    )
                    cpt++;
                });
                
            });

            //archiver
            $("#btn-arch").click(function() {
                event.preventDefault();
                var data = $('#archiver').serialize(); 
                $.ajax({
                    type:'POST',
                    data:data,
                    url:'/user/document/archiver',
                    success:function(data){
                        $("#etatD").text('Archivé')
                        $('#archive').click();
                        $('#btn-arch').remove();
                    }
                });
            });
        });
    </script>
@endsection

@section('content')
<!--  BEGIN CONTENT AREA  -->
<button hidden id="archive" class="btn btn-dark bottom-right-unique">Bottom right</button>

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
                                        @if($doc->etatD == 'actif')
                                        <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                            <div class="company-info">
                                                <form id="archiver" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="{{$doc->idD}}" name="docArchi" id="docArchi">
                                                </form>
                                                <a href="#" id="btn-arch" class="row">
                                                    <p class="inv-brand-name">Archiver</p> &nbsp;
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"  class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                        
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
                                            <p class="inv-list-number"><span class="inv-title">Etat du document: </span><span class="inv-number" id="etatD">{{ucfirst($doc->etatD)}} </span></p>
                                            <p class="inv-list-number"><span class="inv-title">Droits du document : </span><span class="inv-number" id="etatD">{{ucfirst($doc->droitD)}} </span></p>
                                            <p class="inv-list-number"><span class="inv-title" id="actCr">Action(s) courante(s): </span>
                                            @foreach ($encours as $act)
                                                <span class="inv-number">
                                                    {{$act->action->nomA}} -
                                                </span>
                                            @endforeach</p>
                                        </div>
                                        <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                            <p class="inv-list-number"><span class="inv-title">Nombre de version(s) : </span> <span class="inv-number"> {{$versions->count()}} </span></p>
                                            <p class="inv-list-number"><span class="inv-title">Date de création : </span> <span class="inv-number">20 Aug 2019</span></p>
                                            <p class="inv-list-number"><span class="inv-title">Date de modification: </span> <span class="inv-number">26 Aug 2019</span></p>
                                        </div>
                                    </div>

                                    <div class="row inv--product-table-section" >
                                        <div class="col-12 table-body" style="max-height:209px; overflow:auto;">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
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
                                                                @if ( $version->numV == '1')
                                                                    <td>{{$version->document->user->nomU}} {{$version->document->user->prenomU}}</td>
                                                                @else
                                                                    <td > {{ App\User::find(App\UserTache::where('_idV',$version->idV)->pluck('_idU')->first())->nomU }} {{ App\User::find(App\UserTache::where('_idV',$version->idV)->pluck('_idU')->first())->prenomU }} </td>
                                                                @endif
                                                                <td >    
                                                                    <a class="container" onMouseOver="this.style.color='#e7515a'" onMouseOut="this.style.color='#515365'" href="{{asset('pdf/'.$version->doc)}}" download="{{$version->document->nomD}}_V{{$version->numV}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a>
                                                                    <a class="container" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye" id="eye{{$version->idV}}"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
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
                                                                <h6 class=" inv-title">Métadonnées:</h6>
                                                            </div>
                                                            <div style="margin-left:50px;">
                                                                <div class="row align-self-center">
                                                                    @foreach ($metas as $meta)
                                                                        <a href="#" data-toggle="modal" @if(App\MetaDoc::join('users_taches','metas_docs._idUT','users_taches.idUT')->join('users','users_taches._idU','users.id')->where('_idM',$meta->idM)->count()>0) data-target="#exampleModalCenter" @endif  data-valeur="{{App\MetaDoc::join('users_taches','metas_docs._idUT','users_taches.idUT')->join('users','users_taches._idU','users.id')->where('_idM',$meta->idM)->get()}}">
                                                                            <h6 class="inv-list-number"> {{$meta->libelleM}}:  <span class="inv-title">{{App\MetaDoc::where('_idM',$meta->idM)->latest()->first()->valeur}} </span> | </h6>
                                                                        </a>
                                                                    @endforeach
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>
                                            <div class="inv--payment-info">
                                                <div class="row">
                                                    <div class="col-sm-6 col-6">
                                                        <div class="col-sm-6 col-6">
                                                            <h6 class=" inv-title">Contributeurs:</h6>
                                                        </div>
                                                        <div style="margin-left:50px;">
                                                            <div class="avatar--group">
                                                                <div class="avatar">
                                                                    <img alt="avatar" src="{{asset('assets/img/profile-12.jpg')}}" class="rounded-circle  bs-tooltip" data-original-title="{{$doc->user->nomU }} {{$doc->user->prenomU }}" />
                                                                </div> 
                                                                @foreach ($contributeursU as $usr)
                                                                    <div class="avatar">
                                                                        <img alt="avatar" src="{{asset('assets/img/profile-12.jpg')}}" class="rounded-circle  bs-tooltip" data-original-title="{{$usr->nomU }} {{$usr->prenomU }}" />
                                                                    </div>            
                                                                @endforeach
                                                                @if ($contributeursUG)
                                                                    @foreach ($contributeursUG as $usr)
                                                                        <div class="avatar">
                                                                            <img alt="avatar" src="{{asset('assets/img/profile-12.jpg')}}" class="rounded-circle  bs-tooltip" data-original-title="{{$usr->nomU }} {{$usr->prenomU }}" />
                                                                        </div>            
                                                                    @endforeach
                                                                @endif
                                                                {{-- <div class="avatar">
                                                                    <span class="avatar-title rounded-circle  bs-tooltip" data-original-title="Alan Green">AG</span>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($droitsG->count()>0)
                                                        <div class="col-sm-6 col-6">
                                                            <h6 class=" inv-title">Groupes:</h6>
                                                            <div style="margin-left:50px;">
                                                                <div class="avatar--group">
                                                                    @foreach ($droitsG as $droitG)
                                                                        <div class="avatar">
                                                                            <span class="avatar-title rounded-circle  bs-tooltip" data-original-title="{{$droitG->nomG}}"> {{substr($droitG->nomG,0,2)}} </span>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    
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
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Historique des valeurs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table mb-4 contextual-table">
                        <thead>
                            <tr class="">
                                <th class="text-center">#</th>
                                <th>Valeur</th>
                                <th>Ajoutée par</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="valMeta">
                        </tbody>
                    </table>
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