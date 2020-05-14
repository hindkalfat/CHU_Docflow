@extends('layout.app')

@section('link')
@endsection

@section('script')
    <script src="{{asset('assets/js/apps/groupe.js')}}"></script>
@endsection

@section('content')

<div id="content" class="main-content">
        <div class="layout-px-spacing">                
            <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                <div class="col-lg-12">
                    <div class="widget-content searchable-container grid">

                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                                <form class="form-inline my-2 my-lg-0">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                        <input type="text" class="form-control product-search" id="input-search" placeholder="Search Contacts...">
                                    </div>
                                </form>
                            </div>

                            <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                <div class="d-flex justify-content-sm-end justify-content-center">
                                    <button class="btn btn-outline-primary mb-2">Nouveau</button>
                                    <svg id="btn-add-contact" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users-plus"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>                                   
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
                                                                {{ csrf_field() }}
                                                            <input type="hidden" id="idGroupe" name="idGroupe" value="">
                                                            <input name="IDG" type="hidden" id="c-ID" value="">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="contact-name">
                                                                        <i class="flaticon-user-11"></i>
                                                                        <input name="nomG" type="text" id="c-nom" class="form-control" placeholder="(*) Nom">
                                                                        <span class="validation-text"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <select name="userG[]" id="c-users" class="selectpicker form-control" multiple data-live-search="true" data-actions-box="true">
                                                                        @foreach ($users as $user)
                                                                            <option value="{{$user->id}}"> {{$user->nomU}} </option>
                                                                        @endforeach
                                                                        
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="btn-edit" class="float-left btn">Enregistrer</button>

                                                <button class="btn" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Annuler</button>

                                                <button id="btn-add" class="btn">Ajouter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="searchable-items grid">
                            @foreach ($groupes as $groupe)
                                <div class="items" id="items{{$groupe->idG}}">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                <input type="checkbox" class="new-control-input contact-chkbox">
                                                <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <div class="user-meta-info">
                                                 <p class="group-ID" data-ID="{{$groupe->idG}}"></p>
                                                <p class="user-name" data-name="{{ucfirst($groupe->nomG)}}"> {{ucfirst($groupe->nomG)}} </p>
                                                <p class="users-groupe" data-users="{{$groupe->users}}"></p>
                                            </div>
                                            <div class="layout-top-spacing">
                                                <ul class="list-inline badge-collapsed-img mb-0 mb-3">
                                                        <?php $var=1; ?>
                                                    @foreach ($groupe->users->take(3) as $user)
                                                        <li class="list-inline-item chat-online-usr">
                                                            <img alt="avatar" src="{{asset('assets/img/profile-2.jpg')}}" @if($var==1) class="ml-0" @endif>
                                                        </li>
                                                        <?php $var++; ?>
                                                    @endforeach
                                                    <li class="list-inline-item badge-notify mr-0">
                                                        <div class="notification">
                                                            @if ($groupe->users->count()-3 > 0)
                                                                <span class="badge badge-info badge-pill">+{{$groupe->users->count()-3}} more</span>
                                                            @endif
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye view"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            <svg id="idEdit{{$groupe->idG}}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 edit" ><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="modal" data-target="#exampleModal" data-id="{{$groupe->idG}}" data-nom="{{$groupe->nomG}}" class="feather feather-user-minus delete"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p class="modal-text">Voulez vous vraiment supprimer le groupe <b id="nomG"></b> </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Annuler</button>
                                            <form id="deleteF">
                                                {{ csrf_field() }}
                                                <input name="idG" type="hidden" id="idG">
                                                <button type="button" class="btn btn-primary dlt">Confirmer</button>
                                            </form>
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