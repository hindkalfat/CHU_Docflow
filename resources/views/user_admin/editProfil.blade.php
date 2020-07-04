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
<link rel="stylesheet" type="text/css" href="{{asset('plugins/dropify/dropify.min.css')}}">
<link href="{{asset('assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<script src="{{asset('plugins/dropify/dropify.min.js')}}"></script>
<script src="{{asset('plugins/blockui/jquery.blockUI.min.js')}}"></script>
<!-- <script src="plugins/tagInput/tags-input.js')}}"></script> -->
<script src="{{asset('assets/js/users/account-settings.js')}}"></script>
@endsection

@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">                
            
        <div class="account-settings-container layout-top-spacing">
            <form action="{{ route('edit') }}" method="post">
                    {{ csrf_field() }}
                <div class="account-content">
                    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div id="general-info" class="section general-info">
                                    <div class="info">
                                        <h6 class="">Informations personnelles</h6>
                                        <div class="row">
                                            <div class="col-lg-11 mx-auto">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-12 col-md-4">
                                                        <div class="upload mt-4 pr-md-4">
                                                            <input type="file" id="input-file-max-fs" class="dropify" data-default-file="assets/img/user-profile.jpeg" data-max-file-size="2M" />
                                                            <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                        <div class="form">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="fullName">Nom:</label>
                                                                        <input type="text" class="form-control mb-4" id="fullName" placeholder="Nom" name="nomU" value="{{$user->nomU}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="fullName">Prenom</label>
                                                                        <input type="text" class="form-control mb-4" id="fullName" placeholder="Prenom" name="prenomU" value="{{$user->prenomU}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="profession">Profession</label>
                                                                <input type="text" class="form-control mb-4" id="profession" placeholder="Profession" name="professionU" value="{{$user->professionU}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div id="work-platforms" class="section work-platforms">
                                    <div class="info">
                                        <h5 class="">Coordonnées</h5>
                                        <div class="row">
                                            <div class="col-md-11 mx-auto">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="country">Ville</label>
                                                            <input type="text" class="form-control mb-4" id="ville" placeholder="Ville" name="villeU" value="{{$user->villeU}}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address">Addresse</label>
                                                            <input type="text" class="form-control mb-4" id="address" placeholder="Address" name="adresseU" value="{{$user->adresseU}}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email personnel</label>
                                                            <input type="text" class="form-control mb-4" id="email" placeholder="Email personnel" name="emailPersoU" value="{{$user->emailPersoU}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Numéro de téléphone</label>
                                                            <input type="text" class="form-control mb-4" id="phone" placeholder="Numéro de téléphone" name="numTelU" value="{{$user->numTelU}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="fullName">Service</label>
                                                            <input type="text" class="form-control mb-4" id="service" placeholder="Service" name="serviceU" value="{{$user->serviceU}}">
                                                        </div>
                                                    </div>                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="fullName">Centre</label>
                                                            <input type="text" class="form-control mb-4" id="centre" placeholder="Centre" name="centreU" value="{{$user->centreU}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div id="social" class="section social">
                                <div class="info">
                                    <h5 class="">Compte</h5>
                                    <div class="row">
    
                                        <div class="col-md-11 mx-auto">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group social-linkedin mb-3">
                                                        <div class="input-group-prepend mr-3">
                                                            <span class="input-group-text" id="linkedin">                                        
                                                                <img src="http://localhost:8000/assets/img/logo2.svg" class="navbar-logo" style="width:21px; height:24px;" alt="logo">
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="linkedin" name="email" value="{{$user->email}}">
                                                    </div>
                                                </div>
    
                                                <div class="col-md-6">
                                                    <div class="input-group social-tweet mb-3">
                                                        <input placeholder="Mot de passe actuel" id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                                    </div>
                                                </div> 
                                                
                                                <div class="col-md-6">
                                                    <div class="input-group social-tweet mb-3">
                                                        <input placeholder="Nouveau mot de passe" id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                                    </div>
                                                </div> 
    
                                                <div class="col-md-6">
                                                    <div class="input-group social-tweet mb-3">
                                                        <input placeholder="Confirmez le nouveau mot de passe" id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
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
                <br/> <br/>
    
                <div class="account-settings-footer">
                    
                    <div class="as-footer-container">
    
                        <button id="multiple-reset" class="btn btn-warning">Effacer tout</button>
                        <div class="blockui-growl-message">
                            <i class="flaticon-double-check"></i>&nbsp; Enregistrement en cours
                        </div>
                        <button type="submit" id="multiple-messages" class="btn btn-primary">Enregistrer</button>
    
                    </div>
    
                </div>
            </form>
            
        </div>

    </div>
</div>
<!--  END CONTENT AREA  -->
@endsection