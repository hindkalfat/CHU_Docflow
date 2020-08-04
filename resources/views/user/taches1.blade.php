@extends('layout.app1')

@section('link')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}">
<link href="{{asset('plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />

<style>
    .filtre{
        margin: 0 auto;
    }
    .fl{
        display: inline-block;
        padding: 10px;
    }
</style>
    
@endsection

@section('script')
    <script src="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
    <script>
        $('.bottom-right-unique').click(function() {
            Snackbar.show({
                text: 'Tâche affectée.',
                pos: 'bottom-right'
            });
        });
    </script>
@endsection

@section('content')
<script>
    $(document).ready(function() {
             if($('#basicFlatpickr').length > 0){
                var f1 = flatpickr(document.getElementById('basicFlatpickr'));
            }
            if($('#demo2').length > 0){
                $("#demo2").TouchSpin({
                    min: 0,
                    max: 1000000,
                    step: 0.1,
                    decimals: 2,
                    boostat: 5,
                    maxboostedstep: 10,
                    buttondown_class: "btn btn-outline-dark",
                    buttonup_class: "btn btn-outline-dark"
                });
            }
            if($('#timeFlatpickr').length > 0){
                $('#timeFlatpickr').each(function() {
                    var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        defaultDate: "00:00"
                    });
                });
            }
        });
</script>
<script>
    $(document).ready(function () {

        new dynamicBadgeNotification('allList');
        new dynamicBadgeNotification('completedList');
        new dynamicBadgeNotification('importantList');
        var $el = $('.all-list').fadeIn(); 
        $('#ct > div').not($el).hide();
        var $btns = $('.list-actions').click(function() {
            
            if (this.id == 'all-list') {
                var $el = $('.' + this.id).fadeIn();
                $('#ct > div').not($el).hide();
            } else if (this.id == 'todo-task-done') {
                var $el = $('.' + this.id).fadeIn();
                $('#ct > div').not($el).hide();
            } else if (this.id == 'todo-task-trash') {
                var $el = $('.' + this.id).fadeIn();
                $('#ct > div').not($el).hide();
            }else {
                var $el = $('.' + this.id).fadeIn();
                $('#ct > div').not($el).hide();
            }
            $btns.removeClass('active');
            $(this).addClass('active');  
        })

        $(".submitF").click(function() { 

            var type = $(this).attr('name');
            var id = $(this).attr('id').substring(1);
            $('#typeTache'+id).val(type)
            var form = $('#formT'+id);
            var data = new FormData(form[0]); 

            $.ajax({
                type:'POST',
                data:data,
                url:'/user/taches',
                cache: false,
                processData: false,
                contentType : false,
                success:function(data){
                    console.log(data)
                    $('#tache'+id).attr("class","todo-item todo-task-done")
                    $(".todo-item").parents('.todo-item').addClass('todo-task-done');
                    new dynamicBadgeNotification('completedList')
                    new dynamicBadgeNotification('allList');
                    $('#exampleModal'+data['idT']).modal('hide');
                    $('#task'+data['idT']).removeAttr('data-target');
                }
            });
        });

        $(".submitG").click(function() { 

            var type = $(this).attr('name');
            var id = $(this).attr('id').substring(1);
            $('#typeTache'+id).val(type)
            var form = $('#formG'+id);
            var data = new FormData(form[0]); 

            $.ajax({
                type:'POST',
                data:data,
                url:'/user/taches',
                cache: false,
                processData: false,
                contentType : false,
                success:function(data){
                    console.log(data)
                    $('#tacheT'+id).attr("class","todo-item todo-task-done")
                    $(".todo-item").parents('.todo-item').addClass('todo-task-done');
                    new dynamicBadgeNotification('completedList')
                    new dynamicBadgeNotification('allList');
                    $('#exampleModal'+data['idT']).modal('hide');
                    $('#taskT'+data['idT']).removeAttr('data-target');
                }
            });
        });

        
            /* if($('#basicFlatpickr').length > 0){
                var f1 = flatpickr(document.getElementById('basicFlatpickr'));
            }
            if($('input[name="demo2"]').length > 0){
                $("input[name='demo2']").TouchSpin({
                    min: 0,
                    max: 1000000,
                    step: 0.1,
                    decimals: 2,
                    boostat: 5,
                    maxboostedstep: 10,
                    buttondown_class: "btn btn-outline-dark",
                    buttonup_class: "btn btn-outline-dark"
                });
            }
            if($('.timeFlatpickr').length > 0){
                $('.timeFlatpickr').each(function() {
                    var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        defaultDate: "00:00"
                    });
                });
            }  */

        $(document).on("click",".todo-heading",function(){
            var btn_id = $(this).attr("id");
            var i=btn_id.substring(4,btn_id.length);
        });
        $("#exampleModal").on('show.bs.modal', function(event) {
                var b = $(event.relatedTarget).data('id');
        });
        
        $("#affecter").click(function() { 
            $('#idG').val($('#groupID').val())
            var data = $('#affecterU').serialize(); 
            $.ajax({
                type:'POST',
                data:data,
                url:'/user/affecter/tache',
                success:function(data){
                    var id = data.tache;
                    if (data.user == "mine") {
                        $('#tacheT'+id).attr("class","todo-item all-list aff")
                        $(".todo-item").parents('.todo-item').addClass('all-list aff');
                        $('#aff').css("display","block");
                        $('#taskT'+id).attr('data-target','#exampleModal'+id);
                        new dynamicBadgeNotification('importantList')
                        new dynamicBadgeNotification('allList');
                    }else{
                        $('#tacheT'+id).remove();
                        new dynamicBadgeNotification('importantList')
                        new dynamicBadgeNotification('allList');
                    }
                    $('#exampleModalGroup'+data.tache).modal('hide');
                    $('#affected').click();
                }
            })
        });

    });
</script>

<button hidden id="affected" class="btn btn-dark bottom-right-unique">Bottom right</button>
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="mail-box-container">
                    <div class="mail-overlay"></div>

                    <div class="tab-title">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                <h5 class="app-title">Liste des tâches</h5>
                            </div>

                            <div class="todoList-sidebar-scroll">
                                <div class="col-md-12 col-sm-12 col-12 mt-4 pl-0">
                                    <ul class="nav nav-pills d-block" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link list-actions active" id="all-list" data-toggle="pill" href="#pills-inbox" role="tab" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> Mes tâches <span class="todo-badge badge"></span></a>
                                        </li> 
                                        <li class="nav-item">
                                            <a class="nav-link list-actions" id="todo-task-important" data-toggle="pill" href="#pills-important" role="tab" aria-selected="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Groupe <span class="todo-badge badge"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link list-actions" id="todo-task-done" data-toggle="pill" href="#pills-sentmail" role="tab" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg> 
                                                Terminées <span class="todo-badge badge"></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="todo-inbox" class="accordion todo-inbox">
                        <div class="search">
                            <input type="text" class="form-control input-search" placeholder="Recherche tâche ...">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                        </div>
                
                        <div class="todo-box">
                            
                            <div id="ct" class="todo-box-scroll">
                                @foreach ($taches as $tache)
                                    <div id="tache{{$tache->idT}}" class="todo-item all-list">
                                        <div class="todo-item-inner">

                                            <div class="n-chk text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" class="new-control-input inbox-chkbox">
                                                </label>
                                            </div>

                                            <div class="todo-content">
                                                <h5 data-toggle="modal" data-target="#exampleModal{{$tache->idT}}" id="task{{$tache->idT}}" data-id="{{$tache->idT}}" class="todo-heading" data-todoHeading="{{$tache->action->nomA}}">{{$tache->action->nomA}}</h5>
                                                <p class="meta-date">{{$tache->created_at->format('d/m/Y')}}</p>
                                                @if($tache->action->directiveA)
                                                <p class="todo-text" data-todoHtml="<p>{{$tache->action->directiveA}}</p>" data-todoText='{"ops":[{"insert":"{{$tache->action->directiveA}}.\n"}]}'>{{$tache->action->directiveA}}.</p>
                                                @endif
                                            </div>

                                            <div class="priority-dropdown custom-dropdown-icon">
                                                <div class="dropdown p-dropdown">
                                                    @if ($tache->action->prioriteA == "Haute")
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item danger" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité haute</a>
                                                        </div>                                                    
                                                    @elseif($tache->action->prioriteA == "Faible")
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité faible</a>
                                                        </div>
                                                    @else
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item warning" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité moyenne</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="action-dropdown custom-dropdown-icon">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModal{{$tache->idT}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form id="formT{{$tache->idT}}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                    <input type="hidden" value="{{$tache->idT}}" id="idTache{{$tache->idT}}" name="idTache">
                                                    <input type="hidden" value="" id="typeTache{{$tache->idT}}" name="typeTache">
                                                    <div class="modal-body">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        <div class="compose-box">
                                                            <div class="compose-content container">
                                                                <h5>{{$tache->action->nomA}}</h5>  
                                                                <h6>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="orange" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                                    {{$tache->date_rappelT}}
                                                                    &nbsp;&nbsp;
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="red" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                                    {{$tache->date_echeanceT}}
                                                                </h6>
                                                                <br>
                                                                <h6>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                                    {{$tache->action->directiveA}}
                                                                </h6>
                                                                <br>
                                                                <div class="row">
                                                                    @foreach ( $tache->action->metadonnees as $meta) 
                                                                        @if($meta->typeM == 'Date')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mb-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div>
                                                                                <input id="basicFlatpickr" name="{{$meta->idM}}" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                                                            </div>                                                                      
                                                                        @elseif($meta->typeM == 'Heure')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mb-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div>
                                                                                <input name="{{$meta->idM}}" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control" type="time" placeholder="Select Time..">
                                                                            </div>
                                                                        @elseif($meta->typeM == 'Numérique')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mb-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div>
                                                                                <input id="demo2" name="{{$meta->idM}}" type="text" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control">
                                                                            </div>
                                                                        @else
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mb-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" name="{{$meta->idM}}" class="form-control" placeholder="{{$meta->libelleM}}">
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                <div class="attachment file-pdf">
                                                                    <div class="media">
                                                                        <div class="form-group">
                                                                            <div class=" col-md-12">
                                                                            <b> Version(s) récente(s): </b>
                                                                            </div>
                                                                            @if ($tache->versions_recentes())
                                                                                @foreach ( $tache->versions_recentes() as $tv) 
                                                                                <div class=" col-md-12">
                                                                                    <div class=" media-body">
                                                                                        <p class="file-name ">
                                                                                            <a class="container" onMouseOver="this.style.color='#e7515a'" onMouseOut="this.style.color='#515365'" href="{{asset('pdf/'.$tv->doc)}}" download="{{$tv->document->nomD}}_V{{$tv->numV}}"> 
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                                                                {{$tv->nomV}}
                                                                                            </a>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    {{-- @foreach ($tache->action->workflow->type_doc->metadonnees as $meta)
                                                                        <input type="text" id="valMeta" name="valMeta" value="{{$meta->typeM}}">
                                                                        @if( $meta->typeM == 'Date')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mt-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div><br/>
                                                                                <input id="basicFlatpickr" value="2019-09-04" class="metas form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                                                            </div>
                                                                            <script>
                                                                                var f1 = flatpickr(document.getElementById('basicFlatpickr'));
                                                                            </script>
                                                                        @elseif($meta->typeM  == 'Heure')
                                                                                <div class="form-group col-md-6">
                                                                                    <div class=" mt-1">
                                                                                        <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                        </span>
                                                                                    </div><br/>
                                                                                    <input id="timeFlatpickr" name="timeFlatpickr" class="timeFlatpickr metas form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                                                                </div>
                                                                        <script>
                                                                            var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
                                                                                enableTime: true,
                                                                                noCalendar: true,
                                                                                dateFormat: "H:i",
                                                                                defaultDate: "00:00"
                                                                            });
                                                                        </script>
                                                                        @elseif($meta->typeM  == 'Numérique')
                                                                                
                                                                                <div class="form-group col-md-6">
                                                                                    <div class=" mt-1">
                                                                                        <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                        </span>
                                                                                    </div><br/>
                                                                                    <input id="demo2" type="text" value="0" name="demo2" class="metas form-control">
                                                                                </div>
                                                                        <script>
                                                                            $("input[name='demo2']").TouchSpin({
                                                                                min: 0,
                                                                                max: 1000000,
                                                                                step: 0.1,
                                                                                decimals: 2,
                                                                                boostat: 5,
                                                                                maxboostedstep: 10,
                                                                                buttondown_class: "btn btn-outline-dark",
                                                                                buttonup_class: "btn btn-outline-dark"
                                                                            });
                                                                        </script>
                                                                        @elseif( $meta->typeM  == 'Enuméré')
                                                                                <div class="form-group col-md-6">
                                                                                    <div class=" mt-1">
                                                                                        <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                        </span>
                                                                                    </div><br/>
                                                                                    <input id="listeEnum" type="file" class="metas form-control-file" id="exampleFormControlFile1" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">                                   
                                                                                </div>
                                                                        @else
                                                                                <div class="form-group col-md-6">
                                                                                    <div class=" mt-1">
                                                                                        <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                        </span>
                                                                                    </div><br/>
                                                                                    <input type="text" class="form-control" placeholder="{{$meta->libelleM}}">
                                                                                </div>
                                                                        @endif
                                                                    @endforeach --}}
                                                                </div>
                                                                
                                                                @if ($tache->action->versionA==1)
                                                                    <div class="custom-file mb-4">
                                                                        <input required type="file" class="custom-file-input" id="customFile" name="versionTache">
                                                                        <label required class="custom-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Close</button>
                                                    @if ($tache->action->typeA == "Validation")
                                                        <button id="V{{$tache->idT}}" name="Valider" type="button" class="submitF btn btn-success">Valider</button>
                                                    @elseif($tache->action->typeA == "Approbation")
                                                        <button id="R{{$tache->idT}}" name="Rejeter" type="button" class="submitF btn btn-danger">Rejeter</button>
                                                        <button id="A{{$tache->idT}}" name="Accepter" type="button" class="submitF btn btn-success">Accepter</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach ($tachesAff as $tache)
                                    <div id="tache{{$tache->idT}}" class="todo-item all-list aff">
                                        <div class="todo-item-inner">

                                            <div class="n-chk text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" class="new-control-input inbox-chkbox">
                                                </label>
                                            </div>

                                            <div class="todo-content">
                                                <div class="row container">
                                                    <h5 data-toggle="modal" data-target="#exampleModal{{$tache->idT}}" id="task{{$tache->idT}}" data-id="{{$tache->idT}}" class="todo-heading" data-todoHeading="{{$tache->action->nomA}}">{{$tache->action->nomA}} </h5> <code>(Affectée)</code>
                                                </div>
                                                <p class="meta-date">Envoyé le:{{$tache->created_at->format('d/m/Y')}}</p>
                                                @if($tache->action->directiveA)
                                                <p class="todo-text" data-todoHtml="<p>{{$tache->action->directiveA}}</p>" data-todoText='{"ops":[{"insert":"{{$tache->action->directiveA}}.\n"}]}'>{{$tache->action->directiveA}}.</p>
                                                @endif
                                            </div>

                                            <div class="priority-dropdown custom-dropdown-icon">
                                                <div class="dropdown p-dropdown">
                                                    @if ($tache->action->prioriteA == "Haute")
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item danger" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité haute</a>
                                                        </div>                                                    
                                                    @elseif($tache->action->prioriteA == "Faible")
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité faible</a>
                                                        </div>
                                                    @else
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item warning" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité moyenne</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="action-dropdown custom-dropdown-icon">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModal{{$tache->idT}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form id="formT{{$tache->idT}}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                    <input type="hidden" value="{{$tache->idT}}" id="idTache{{$tache->idT}}" name="idTache">
                                                    <input type="hidden" value="" id="typeTache{{$tache->idT}}" name="typeTache">
                                                    <div class="modal-body">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        <div class="compose-box">
                                                            <div class="compose-content">
                                                                <h5>{{$tache->action->nomA}}</h5>  
                                                                <h6>{{$tache->action->directiveA}}</h6>
                                                                <div class="row">
                                                                    @foreach ( $tache->action->metadonnees as $meta) 
                                                                        @if($meta->typeM == 'Date')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mt-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div><br/>
                                                                                <input id="basicFlatpickr" name="{{$meta->idM}}" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                                                            </div>                                                                      
                                                                        @elseif($meta->typeM == 'Heure')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mt-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div><br/>
                                                                                <input name="{{$meta->idM}}" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control" type="time" placeholder="Select time..">
                                                                            </div>
                                                                        @elseif($meta->typeM == 'Numérique')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mt-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div><br/>
                                                                                <input id="demo2" name="{{$meta->idM}}" type="text" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control">
                                                                            </div>
                                                                        @else
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mt-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div><br/>
                                                                                <input type="text" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}"   name="{{$meta->idM}}" class="form-control" placeholder="{{$meta->libelleM}}">
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                <div class="attachment file-pdf">
                                                                    <div class="media">
                                                                        <div class="form-group">
                                                                            <div class=" col-md-12 mb-4">
                                                                            <b> Version(s) récente(s): </b>
                                                                            </div>
                                                                            @if ($tache->versions_recentes())
                                                                                @foreach ( $tache->versions_recentes() as $tv) 
                                                                                <div class=" col-md-12">
                                                                                    <div class=" media-body">
                                                                                        <p class="file-name ">
                                                                                            <a class="container" onMouseOver="this.style.color='#e7515a'" onMouseOut="this.style.color='#515365'" href="{{asset('pdf/'.$tv->doc)}}" download="{{$tv->document->nomD}}_V{{$tv->numV}}"> 
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                                                                {{$tv->nomV}}
                                                                                            </a>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                @if ($tache->action->versionA==1)
                                                                    <div class="custom-file mb-4">
                                                                        <input required type="file" class="custom-file-input" id="customFile" name="versionTache">
                                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Close</button>
                                                    @if ($tache->action->typeA == "Validation")
                                                        <button id="V{{$tache->idT}}" name="Valider" type="button" class="submitF btn btn-success">Valider</button>
                                                    @elseif($tache->action->typeA == "Approbation")
                                                        <button id="R{{$tache->idT}}" name="Rejeter" type="button" class="submitF btn btn-danger">Rejeter</button>
                                                        <button id="A{{$tache->idT}}" name="Accepter" type="button" class="submitF btn btn-success">Accepter</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                @foreach ($tachesT as $tacheT)
                                    <div id="tacheT{{$tacheT->idT}}" class="todo-item todo-task-done">
                                        <div class="todo-item-inner">

                                            <div class="n-chk text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" class="new-control-input inbox-chkbox">
                                                </label>
                                            </div>

                                            <div class="todo-content">
                                                <h5 data-toggle="modal" id="taskT{{$tacheT->idT}}" data-id="{{$tacheT->idT}}" class="todo-heading" data-todoHeading="{{$tacheT->action->nomA}}">{{$tacheT->action->nomA}}</h5>
                                                <p class="meta-date">{{$tacheT->created_at->format('d/m/Y')}}</p>
                                                @if($tacheT->action->directiveA)
                                                <p class="todo-text" data-todoHtml="<p>{{$tacheT->action->directiveA}}</p>" data-todoText='{"ops":[{"insert":"{{$tacheT->action->directiveA}}.\n"}]}'>{{$tacheT->action->directiveA}}.</p>
                                                @endif
                                            </div>

                                            <div class="priority-dropdown custom-dropdown-icon">
                                                <div class="dropdown p-dropdown">
                                                    @if ($tacheT->action->prioriteA == "Haute")
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item danger" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité haute</a>
                                                        </div>                                                    
                                                    @elseif($tacheT->action->prioriteA == "Faible")
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité faible</a>
                                                        </div>
                                                    @else
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item warning" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité moyenne</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="action-dropdown custom-dropdown-icon">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                                @foreach ($tachesG as $tacheT)
                                    <div id="tacheT{{$tacheT->idT}}" class="todo-item todo-task-important">
                                        <div class="todo-item-inner">

                                            <div class="n-chk text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" class="new-control-input inbox-chkbox">
                                                </label>
                                            </div>

                                            <div class="todo-content">
                                                <div class="row container">
                                                    <h5 data-toggle="modal" data-target="#exampleModalGroup{{$tacheT->idT}}" id="taskT{{$tacheT->idT}}" data-id="{{$tacheT->idT}}" class="todo-heading" data-todoHeading="{{$tacheT->action->nomA}}">{{$tacheT->action->nomA}}</h5> <code id="aff" style="display:none;">(Affectée)</code>
                                                </div>
                                                <p class="meta-date">{{$tacheT->created_at->format('d/m/Y')}}</p>
                                                @if($tacheT->action->directiveA)
                                                <p class="todo-text" data-todoHtml="<p>{{$tacheT->action->directiveA}}</p>" data-todoText='{"ops":[{"insert":"{{$tacheT->action->directiveA}}.\n"}]}'>{{$tacheT->action->directiveA}}.</p>
                                                @endif
                                            </div>

                                            <div class="priority-dropdown custom-dropdown-icon">
                                                <div class="dropdown p-dropdown">
                                                    @if ($tacheT->action->prioriteA == "Haute")
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item danger" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité haute</a>
                                                        </div>                                                    
                                                    @elseif($tacheT->action->prioriteA == "Faible")
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité faible</a>
                                                        </div>
                                                    @else
                                                        <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                            <a class="dropdown-item warning" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Priorité moyenne</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="action-dropdown custom-dropdown-icon">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalGroup{{$tacheT->idT}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Affecter la tâche à</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h6 class="modal-heading mb-4 mt-2">Membres du groupe</h6>
                                                    <select id="groupID" name="groupID" class="selectpicker" data-live-search="true" data-width="100%" required>
                                                        <option value="" disabled selected>choisissez</option>
                                                        @foreach ($tacheT->action->groupe->users as $user)
                                                            <option value="{{$user->id}}"> {{$user->nomU}}  {{$user->prenomU}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    <form id="affecterU" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="" name="idG" id="idG">
                                                        <input type="hidden" value="{{$tacheT->t_idA}}" name="idT" id="idT">
                                                        <input type="hidden" value="{{$tacheT->idT}}" name="tache">
                                                    </form>
                                                    <button type="button" class="btn btn-success" id="affecter">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModal{{$tacheT->idT}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form id="formG{{$tacheT->idT}}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                    <input type="hidden" value="{{$tacheT->idT}}" id="idTache{{$tacheT->idT}}" name="idTache">
                                                    <input type="hidden" value="" id="typeTache{{$tacheT->idT}}" name="typeTache">
                                                    <div class="modal-body">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        <div class="compose-box">
                                                            <div class="compose-content container">
                                                                <h5>{{$tacheT->action->nomA}}</h5>  
                                                                <h6>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="orange" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                                    {{$tacheT->date_rappelT}}
                                                                    &nbsp;&nbsp;
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="red" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                                    {{$tacheT->date_echeanceT}}
                                                                </h6>
                                                                <br>
                                                                <h6>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                                    {{$tacheT->action->directiveA}}
                                                                </h6>
                                                                <br>
                                                                <div class="row">
                                                                    @foreach ( $tacheT->action->metadonnees as $meta) 
                                                                        @if($meta->typeM == 'Date')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mb-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div>
                                                                                <input id="basicFlatpickr" name="{{$meta->idM}}" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                                                            </div>                                                                      
                                                                        @elseif($meta->typeM == 'Heure')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mb-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div>
                                                                                <input name="{{$meta->idM}}" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control" type="time" placeholder="Select Time..">
                                                                            </div>
                                                                        @elseif($meta->typeM == 'Numérique')
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mb-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div>
                                                                                <input id="demo2" name="{{$meta->idM}}" type="text" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control">
                                                                            </div>
                                                                        @else
                                                                            <div class="form-group col-md-6">
                                                                                <div class=" mb-1">
                                                                                    <span class="badge outline-badge-info">{{$meta->libelleM}}
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="{{$meta->idM}}" value="{{App\MetaDoc::where('_idM',$meta->idM)->orderBy('created_at', 'desc')->first()->valeur}}" class="form-control" placeholder="{{$meta->libelleM}}">
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                <div class="attachment file-pdf">
                                                                    <div class="media">
                                                                        <div class="form-group">
                                                                            <div class=" col-md-12">
                                                                            <b> Version(s) récente(s): </b>
                                                                            </div>
                                                                            @if ($tacheT->versions_recentes())
                                                                                @foreach ( $tacheT->versions_recentes() as $tv) 
                                                                                <div class=" col-md-12">
                                                                                    <div class=" media-body">
                                                                                        <p class="file-name ">
                                                                                            <a class="container" onMouseOver="this.style.color='#e7515a'" onMouseOut="this.style.color='#515365'" href="{{asset('pdf/'.$tv->doc)}}" download="{{$tv->document->nomD}}_V{{$tv->numV}}"> 
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                                                                {{$tv->nomV}}
                                                                                            </a>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                @if ($tacheT->action->versionA==1)
                                                                    <div class="custom-file mb-4">
                                                                        <input required type="file" class="custom-file-input" id="customFile" name="versionTache">
                                                                        <label required class="custom-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Close</button>
                                                    @if ($tacheT->action->typeA == "Validation")
                                                        <button id="V{{$tacheT->idT}}" name="Valider" type="button" class="submitG btn btn-success">Valider</button>
                                                    @elseif($tacheT->action->typeA == "Approbation")
                                                        <button id="R{{$tacheT->idT}}" name="Rejeter" type="button" class="submitG btn btn-danger">Rejeter</button>
                                                        <button id="A{{$tacheT->idT}}" name="Accepter" type="button" class="submitG btn btn-success">Accepter</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>                                    
                </div>
                
            </div>
        </div>

    </div>
</div>
@endsection