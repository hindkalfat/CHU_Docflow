@extends('layout.app')

@section('script')
    <script src="{{asset('assets/js/apps/contact.js')}}"></script>
@endsection

@section('content')

<div id="content" class="main-content">
        <div class="layout-px-spacing">                
            <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                <div class="col-lg-12">
                    <div class="widget-content searchable-container list">

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
                                    <svg id="btn-add-contact" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>

                                    <div class="switch align-self-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list view-list active-view"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid view-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
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
                                                                {{ csrf_field() }}
                                                            <div class="row">
                                                                <input name="IDU" type="hidden" id="c-ID" value="">
                                                                <div class="col-md-6">
                                                                    <div class="contact-name">
                                                                        <i class="flaticon-user-11"></i>
                                                                        <input name="nomU" type="text" id="c-nom" class="form-control" placeholder="(*) Nom">
                                                                        <span class="validation-text"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="contact-name">
                                                                        <i class="flaticon-user-11"></i>
                                                                        <input name="prenomU" type="text" id="c-prenom" class="form-control" placeholder="Prenom">
                                                                        <span class="validation-text"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="contact-name">
                                                                        <i class="flaticon-user-11"></i>
                                                                        <input name="villeU" type="text" id="c-ville" class="form-control" placeholder="(*) Ville (Travail)">
                                                                                <span class="validation-text"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="contact-name">
                                                                        <i class="flaticon-user-11"></i>
                                                                        <input name="adresseU" type="text" id="c-adresse" class="form-control" placeholder="Adresse">
                                                                        <span class="validation-text"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
        
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-user-11"></i>
                                                                            <input name="numTelU" type="text" id="c-phone" class="form-control" placeholder="N° téléphone">
        {{--                                                                     <span class="validation-text"></span>
         --}}                                                                </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-mail-26"></i>
                                                                            <input name="emailPersoU" type="text" id="c-email" class="form-control" placeholder="Email personnel">
        {{--                                                                     <span class="validation-text"></span>
         --}}                                                                </div>
                                                                    </div>
                                                                </div>
        
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="contact-location">
                                                                            <i class="flaticon-location-1"></i>
                                                                            <input name="professionU" type="text" id="c-profession" class="form-control" placeholder="Profession">
        {{--                                                                     <span class="validation-text"></span>
         --}}                                                                </div>
                                                                    </div>
                                                                </div>
        
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-user-11"></i>
                                                                            <input name="centreU" type="text" id="c-centre" class="form-control" placeholder="Centre">
        {{--                                                                     <span class="validation-text"></span>
         --}}                                                                </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-mail-26"></i>
                                                                            <input name="serviceU" type="text" id="c-service" class="form-control" placeholder="Service">
                                                                             <span class="validation-text"></span>
                                                                         </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-user-11"></i>
                                                                            <input name="email" type="email" class="form-control" placeholder="Email">
        {{--                                                                     <span class="validation-text"></span>
            --}}                                                                </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-mail-26"></i>
                                                                                <input name="password" type="password" class="form-control" placeholder="Mot de passe">
                                                                                <span class="validation-text"></span>
                                                                            </div>
                                                                    </div>
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
                            </div>
                        </div>

                        <div class="searchable-items list">
                            <div class="items items-header-section">
                                <div class="item-content">
                                    <div class="">
                                        <div class="n-chk align-self-center text-center">
                                            <label class="new-control new-checkbox checkbox-primary">
                                              <input type="checkbox" class="new-control-input" id="contact-check-all">
                                              <span class="new-control-indicator"></span>
                                            </label>
                                        </div>
                                        <h4>Name</h4>
                                    </div>
                                    <div class="user-ville">
                                        <h4>Ville</h4>
                                    </div>
                                    <div class="user-email">
                                        <h4>Email</h4>
                                    </div>
                                    <div class="user-location">
                                        <h4 style="margin-left: 0;">Location</h4>
                                    </div>
                                    <div class="user-phone">
                                        <h4 style="margin-left: 3px;">Phone</h4>
                                    </div>
                                    <div class="action-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2  delete-multiple"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </div>
                                </div>
                            </div>
                            @foreach ($users as $user)
                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                <input type="checkbox" class="new-control-input contact-chkbox">
                                                <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="{{asset('assets/img/profile-15.jpg')}}" alt="avatar">
                                            <div class="user-meta-info">
                                                <p class="user-ID" data-ID="{{$user->id}}"></p>
                                                <p class="user-name" data-name="{{$user->nomU}}">{{$user->nomU}}</p>
                                                <p class="user-prenom" data-prenom="{{$user->prenomU}}">{{$user->prenomU}}</p>
                                                <p class="user-work" data-profession="{{$user->professionU}}">{{$user->professionU}}</p>
                                            </div>
                                        </div>
                                        <div class="user-ville">
                                            <p class="info-title">Ville: </p>
                                            <p class="usr-ville" data-ville="{{$user->villeU}}">{{$user->villeU}}</p>
                                        </div>
                                        <div class="user-email">
                                            <p class="info-title">Email: </p>
                                            <p class="usr-email-addr" data-email="alan@mail.com">alan@mail.com</p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title">Location: </p>
                                            <p class="usr-location" data-location="{{$user->adresseU}}">{{$user->adresseU}}</p>
                                        </div>
                                        <div class="user-phone">
                                            <p class="info-title">Phone: </p>
                                            <p class="usr-ph-no" data-phone="+1 (070) 123-4567">+1 (070) 123-4567</p>
                                        </div>
                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 edit"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="modal" data-target="#exampleModal" data-id="{{$user->id}}" data-nom="{{$user->nomU}}" class="feather feather-user-minus delete"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p class="modal-text">Voulez vous vraiment supprimer l'utilisateur <b id="nomU"></b> </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Annuler</button>
                                            <form id="deleteF">
                                                {{ csrf_field() }}
                                                <input name="idU" type="text" id="idU">
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