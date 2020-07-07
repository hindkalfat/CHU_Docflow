@extends('Messagerie.app')

@section('script')
    <script>
        $(document).ready(function () {
            $('#btn-send').click(function(){
                alert($('.ql-editor').text())
                /* $('#msg').val($('.ql-editor').html())
                $('#sendForm').submit(); */
            });
        });
    </script>
@endsection

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="row">

                    <div class="col-xl-12  col-md-12">

                        <div class="mail-box-container">
                            <div class="mail-overlay"></div>

                            <div class="tab-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12 text-center mail-btn-container">
                                        <a id="btn-compose-mail" class="btn btn-block" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12 mail-categories-container">

                                        <div class="mail-sidebar-scroll">

                                            <ul class="nav nav-pills d-block" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link list-actions active" id="mailInbox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> <span class="nav-names">Boite de réception</span> <span class="mail-badge badge"></span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link list-actions" id="sentmail"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg> <span class="nav-names"> Messages envoyés</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link list-actions" id="draft"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> <span class="nav-names">Brouillons</span> <span class="mail-badge badge"></span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link list-actions" id="trashed"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="nav-names">Corbeille</span></a>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="mailbox-inbox" class="accordion mailbox-inbox">

                                <div class="search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                    <input type="text" class="form-control input-search" placeholder="Search Here...">
                                </div>
                        
                                <div class="message-box">
                                    
                                    <div class="message-box-scroll" id="ct">                                            

                                        @foreach ($messages as $message)
                                            <div class="mail-item mailInbox supp{{$message->idM}}">
                                                <div class="animated animatedFadeInUp fadeInUp" id="mailHeadingTwelve">
                                                    <div class="mb-0">
                                                        <div class="mail-item-heading private collapsed"  data-toggle="collapse" role="navigation" data-target="#mailCollapseTwo{{$message->idM}}" aria-expanded="false">
                                                            <div class="mail-item-inner">
    
                                                                <div class="d-flex">
                                                                    <div class="n-chk text-center">
                                                                    </div>
                                                                    <div class="f-head">
                                                                        <img src="assets/img/profile-34.jpg" class="user-profile" alt="avatar">
                                                                    </div>
                                                                    <div class="f-body">
                                                                        <div class="meta-mail-time">
                                                                            <p class="user-email" data-mailTo="{{$message->sender->id}}">{{$message->sender->nomU}} {{$message->sender->prenomU}}</p>
                                                                        </div>
                                                                        <div class="meta-title-tag">
                                                                            <p class="mail-content-excerpt" data-mailDescription='{"ops":[{"insert":"{{$message->content}}"}]}'>
                                                                                @if ($message->medias->count()>0)
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip attachment-indicator"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                                                                @endif
                                                                                <span class="mail-title" data-mailTitle="{{$message->sujet}}">{{$message->sujet}} - </span> {{$message->content}}
                                                                            </p>
                                                                            <p class="meta-time align-self-center">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if ($message->medias)
                                                                <div class="attachments">
                                                                    @foreach ($message->medias as $media)
                                                                        <span class="">{{$media->fileName}}</span>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                        @endforeach

                                        @foreach ($msgEnvoyés as $message)
                                            <div class="mail-item sentmail">
                                                <div class="animated animatedFadeInUp fadeInUp" id="mailHeadingSix">
                                                    <div class="mb-0">
                                                        <div class="mail-item-heading collapsed"  data-toggle="collapse" role="navigation" data-target="#mailCollapseThree{{$message->idM}}" aria-expanded="false">
                                                            <div class="mail-item-inner">
    
                                                                <div class="d-flex">
                                                                    <div class="n-chk text-center">
                                                                    </div>
                                                                    <div class="f-body">
                                                                        <div class="meta-mail-time">
                                                                            <p class="user-email" data-mailTo="{{$message->receiver->id}}">{{$message->receiver->nomU}} {{$message->receiver->prenomU}}</p>
                                                                        </div>
                                                                        <div class="meta-title-tag">
                                                                            <p class="mail-content-excerpt" data-mailDescription='{"ops":[{"insert":"{{$message->content}}"}]}'><span class="mail-title" data-mailTitle="{{$message->sujet}}">{{$message->sujet}} - </span>{{$message->content}}.</p>
                                                                            <p class="meta-time align-self-center">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach ($corbeilles as $message)
                                            <div class="mail-item trashed">
                                                <div class="animated animatedFadeInUp fadeInUp" id="mailHeadingTen">
                                                    <div class="mb-0">
                                                        <div class="mail-item-heading collapsed"  data-toggle="collapse" role="navigation" data-target="#mailCollapseTen" aria-expanded="false">
                                                            <div class="mail-item-inner">
    
                                                                <div class="d-flex">
                                                                    <div class="n-chk text-center">
                                                                    </div>
                                                                    <div class="f-head">
                                                                        <img src="assets/img/profile-13.jpg" class="user-profile" alt="avatar">
                                                                    </div>
                                                                    <div class="f-body">
                                                                        <div class="meta-mail-time">
                                                                            <p class="user-email" data-mailTo="{{$message->receiver->id}}">{{$message->receiver->nomU}} {{$message->receiver->prenomU}}</p>
                                                                        </div>
                                                                        <div class="meta-title-tag">
                                                                            <p class="mail-content-excerpt" data-mailDescription='{"ops":[{"insert":"{{$message->content}}"}]}'><span class="mail-title" data-mailTitle="{{$message->sujet}}">{{$message->sujet}} - </span>{{$message->content}}.</p>
                                                                            <p class="meta-time align-self-center">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach ($brouillons as $message)
                                            <div class="mail-item draft">
                                                <div class="animated animatedFadeInUp fadeInUp" id="mailHeadingFour">
                                                    <div class="mb-0">
                                                        <div class="mail-item-heading private collapsed"  data-toggle="collapse" role="navigation" data-target="#mailCollapseFour" aria-expanded="false">
                                                            <div class="mail-item-inner">
    
                                                                <div class="d-flex">
                                                                    <div class="n-chk text-center">
                                                                    </div>
                                                                    <div class="f-body" data-mailfrom="info@mail.com" data-mailto="{{$message->receiver->id}}" data-mailcc="">
                                                                        <div class="meta-mail-time">
                                                                            <p class="user-email" data-mailTo="{{$message->receiver->id}}">{{$message->receiver->nomU}} {{$message->receiver->prenomU}}</p>
                                                                        </div>
                                                                        <div class="meta-title-tag">
                                                                            <p class="mail-content-excerpt" data-maildescription='{"ops":[{"insert":"{{$message->content}}"}]}'><span class="mail-title" data-mailTitle="{{$message->sujet}}">{{$message->sujet}} - </span>{{$message->content}}.</p>
                                                                            <p class="meta-time align-self-center">{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </div>

                                <div class="content-box">
                                    <div class="d-flex msg-close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left close-message"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                        <h2 class="mail-title" data-selectedMailTitle=""></h2>
                                    </div>

                                    @foreach ($messages as $message)
                                        <div id="mailCollapseTwo{{$message->idM}}" class="collapse" type="mailInbox" aria-labelledby="mailHeadingTwo" data-parent="#mailbox-inbox">
                                            <div class="mail-content-container sentmail" data-mailfrom="info@mail.com" data-mailto="alan@mail.com" data-mailcc="">
                                                <input type="hidden" id="type{{$message->idM}}" value="mailInbox">
                                                <div class="d-flex justify-content-between mb-3">
                                                    <div class="d-flex user-info">
                                                        <div class="f-body">
                                                            <div class="meta-title-tag">
                                                                <h4 class="mail-usr-name" data-mailtitle="{{$message->sujet}}">{{$message->receiver->nom}} {{$message->receiver->prenom}}</h4>
                                                            </div>
                                                            <div class="meta-mail-time">
                                                                <p class="user-email" data-mailto="{{$message->receiver->id}}">{{$message->receiver->email}}</p>
                                                                <p class="mail-content-meta-date current-recent-mail">{{$message->created_at->format('d/m/Y')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="action-btns">
                                                        <form action="{{url('supprimer')}}" method="post" id="deleteF{{$message->idM}}">
                                                            {!! csrf_field() !!}
                                                            <input type="hidden" value="{{$message->idM}}" name="msg_dlt">
                                                        </form>
                                                        <a href="javascript:void(0);" id="{{$message->idM}}" class="dropdown-item action-delete" data-toggle="tooltip" data-placement="top" data-original-title="Supprimer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <p class="mail-content" data-mailTitle="{{$message->sujet}}" data-maildescription='{"ops":[{"insert":"{{$message->content}}"}]}'> {!!  $message->message    !!}. </p>

                                                @if ($message->medias->count()>0)
                                                    <div class="attachments">
                                                        <h6 class="attachments-section-title">Attachments</h6>
                                                        @foreach ($message->medias as $media)
                                                            <div class="attachment file-pdf">
                                                                <div class="media">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                                    <div class="media-body">
                                                                        <p class="file-name">{{$media->fileName}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
    
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach 

                                    @foreach ($msgEnvoyés as $message)
                                        <div id="mailCollapseThree{{$message->idM}}" class="collapse" aria-labelledby="mailHeadingThree" data-parent="#mailbox-inbox">
                                            <div class="mail-content-container sentmail" data-mailfrom="{{$message->sender->email}}" data-mailto="{{$message->receiver->id}}" data-mailcc="">

                                                <div class="d-flex justify-content-between">

                                                    <div class="d-flex user-info">
                                                        <div class="f-head">
                                                            <img src="assets/img/profile-16.jpg" class="user-profile" alt="avatar">
                                                        </div>
                                                        <div class="f-body">
                                                            <div class="meta-title-tag">
                                                                <h4 class="mail-usr-name" data-mailtitle="{{$message->sujet}}">{{$message->receiver->nom}} {{$message->receiver->prenom}}</h4>
                                                            </div>
                                                            <div class="meta-mail-time">
                                                                <p class="user-email" data-mailto="{{$message->receiver->id}}">{{$message->receiver->email}}</p>
                                                                <p class="mail-content-meta-date current-recent-mail">{{$message->created_at->format('d/m/Y')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <p class="mail-content" data-mailTitle="{{$message->sujet}}" data-maildescription='{"ops":[{"insert":"{{$message->content}}"}]}'> {!!  $message->message    !!}. </p>

                                                @if ($message->medias->count()>0)
                                                    <div class="attachments">
                                                        <h6 class="attachments-section-title">Attachments</h6>
                                                        @foreach ($message->medias as $media)
                                                            <div class="attachment file-pdf">
                                                                <div class="media">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                                    <div class="media-body">
                                                                        <p class="file-name">{{$media->fileName}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
    
                                                    </div>
                                                @endif
                                                

                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="composeMailModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        <div class="compose-box">
                                            <div class="compose-content">
                                                <form method="post" id="sendForm" action="{{url('envoyer')}}" enctype="multipart/form-data">
                                                    {!! csrf_field() !!}

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex mb-4 mail-form">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                                    <select class="" id="m-to" name="destinataire">
                                                                        <option value="" disabled selected>Destinataire</option>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{$user->id}}">{{$user->email}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="validation-text"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mb-4 mail-subject">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                                        <div class="w-100">
                                                            <input type="text" id="m-subject" placeholder="Objet" class="form-control" name="sujet">
                                                            <span class="validation-text"></span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex">
                                                        <input type="file" class="form-control-file" id="mail_File_attachment" name="files[]" multiple="multiple">
                                                    </div>

                                                    <input type="hidden" name="message" id="msg">
                                                    <input type="hidden" name="messageTxt" id="msgTxt">

                                                    <div id="editor-container">

                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="btn-save" class="btn float-left"> Enregistrer</button>

                                        <button class="btn" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>

                                        <button id="btn-send" class="btn"> Envoyer</button>
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
@endsection