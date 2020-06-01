@extends('layout.app')

@section('link')
<link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script>
        $('.bottom-right').click(function() {
            Snackbar.show({
                text: 'veuillez importer un fichier excel.',
                pos: 'bottom-right'
            });
        });
    </script>
    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>

    
@endsection

@section('content')


<script>
    function myFunction(cpt) {
        var x = document.getElementById("TtypeM"+cpt).value;
        if(x=="Enuméré")
        {
            var c=$('#x').val();
            $('.lst'+cpt).each(function() {
                $(this).remove();
            });
            $('.addmeta'+cpt).append(
                                    '<div class="form-group col-lg-12 layout-top-spacing lst'+cpt+'">'+
                                        '<input id="listeEnum'+cpt+'" type="file" name="testF'+c+'" class=" listeEnum form-control-file" id="exampleFormControlFile1" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">'+                                   
                                    '</div>'
                                );
                                
            $('#x').val(c*1+1);
        }
        else{
            $('.lst'+cpt).each(function() {
                $(this).remove();
            });
        }
            
    }
</script>

<script>
        $(document).ready(function () {
            $('.addinput').click(function(){
                var cpt = $('#cpt').val()*1;
                $(this).after( '<hr/>'+
                                '<div class="metaslist addmeta'+cpt+' row mb-4">'+
                                    '<div class="col-lg-6">'+
                                        '<input id="TlibelleM" type="text" class=" TlibelleM form-control" placeholder="Intitulé">'+
                                    '</div>'+
                                    '<div class="col-lg-6">'+
                                        '<select onchange="myFunction('+cpt+')" id="TtypeM'+cpt+'"  class="TtypeM form-control" data-width="fit">'+
                                            '<option>Type document</option>'+
                                            '<option value="Date" >Date</option>'+
                                            '<option value="Heure" >Heure</option>'+
                                            '<option value="Texte" >Texte</option>'+
                                            '<option value="Numérique" >Numérique</option>'+
                                            '<option value="Enuméré" >Enuméré</option>'+
                                        '</select>'+
                                    '</div>'+
                                '</div>');
                $('#cpt').val(cpt*1+1);
            });
            
            $('#fadeupModal').on('hidden.bs.modal',function(){
                $('.metaslist').remove();
                $('#libelleM').val('');
                $('#typeM').val('');
                $('#listeM').val('');
                $('#intituléT').val('');
                $('#description').val('');
                $('#x').val(0);
            });


            $("#addType").submit(function(e){
                e.preventDefault();
                var path=$('#listeEnum').val(); /* 
                if( path )
                { *//* 
                    if(path.search(".xlsx") > 0 || path.search(".xls") > 0)
                    { */
                        //libelle
                        var inputs = $(".TlibelleM");
                        var l='';
                        for(var i = 0; i < inputs.length; i++){
                            l = $(inputs[i]).val() + ',' + l; 
                        }
                        $('#libelleM').val(l)

                        //type
                        var inputs = $(".TtypeM");
                        var t='';
                        var j=0;
                        var inputsl = $(".listeEnum");
                        console.log(inputsl)
                        var ls=''; 
                        for(var i = 0; i < inputs.length; i++){
                            var id = $(inputs[i]).attr("id");
                            var idT=id.substring(6,id.length);
                            if($(inputs[i]).children("option:selected").val() == "Type document")
                                t = '' + ',' + t
                            else
                            {
                                t = $(inputs[i]).children("option:selected").val() + ',' + t; 
                                if($('#listeEnum'+idT).length > 0)
                                {
                                    ls = $(inputsl[j]).attr('name') + ',' + ls;
                                    j++;
                                }
                                else
                                {
                                    ls = '' + ',' + ls;
                                }      
                            }
                        }
                        $('#typeM').val(t) 
                        $('#listeM').val(ls) 
                        
                        var form = $(this);
                        var data = new FormData(form[0]);
                        $.ajax({
                            type:'POST',
                            data:data,
                            url:'/admin/documents',
                            cache: false,
                            processData: false,
                            contentType : false,
                            success:function(data){
                                var intitule=data.type.intituleTd;
                                if(data.type.descriptionTd)
                                    var desc = data.type.descriptionTd;
                                else
                                    var desc = "Aucune desription disponible";
                                $('#fadeupModal').modal('hide');
                                $('#toggleAccordion').append(
                                    '<div class="card">'+
                                        '<div class="card-header" id="headingOne1">'+
                                            '<section class="mb-0 mt-0">'+
                                            '<div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne'+data.type.idTd+'" aria-expanded="true" aria-controls="defaultAccordionOne'+data.type.idTd+'">'
                                                +intitule+'<div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>'+
                                            '</div>'+
                                            '</section>'+
                                        '</div>'+

                                        '<div id="defaultAccordionOne'+data.type.idTd+'" class="collapse" aria-labelledby="headingOne1" data-parent="#toggleAccordion">'+
                                            '<div class="card-body">'+
                                                '<p class="">'+
                                                    desc+
                                                '</p>'+
                                                '<div id="widget-content'+data.type.idTd+'" class="widget-content container">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                )
                                for(i=0;i<data["metas"].length;i++)
                                {
                                    $('#widget-content'+data["metas"][i].m_idTd).append(
                                        '<span class="badge outline-badge-primary">'+ 
                                                data["metas"][i].libelleM+
                                        '</span>'+'&nbsp;'  
                                    );
                                }
                            }
                        });   
                   /* } 
                    else{
                        $('#notif').click();
                    } 
                }else{
                    //libelle
                    var inputs = $(".TlibelleM");
                    var l='';
                    for(var i = 0; i < inputs.length; i++){
                        l = $(inputs[i]).val() + ',' + l; 
                    }
                    $('#libelleM').val(l)

                    //type
                    var inputs = $(".TtypeM");
                    var t='';
                    for(var i = 0; i < inputs.length; i++){
                        t = $(inputs[i]).children("option:selected").val() + ',' + t; 
                    }
                    $('#typeM').val(t) 

                    //liste
                    var inputs = $(".listeEnum");
                    var taille = $(".TtypeM");
                    var ls='';
                    for(var i = 0; i < taille.length; i++){
                        ls = $(inputs[i]).val() + ',' + ls; 
                        alert(ls)
                        alert(i)
                    }
                    $('#listeM').val(ls)
                    
                    var data = $('#addType').serialize(); 
                    $.ajax({
                        type:'POST',
                        data:data,
                        url:'/admin/documents',
                        success:function(data){
                            var intitule=data.type.intituleTd;
                            var desc = data.type.descriptionTd;
                            $('#fadeupModal').modal('hide');
                            $('#toggleAccordion').append(
                                '<div class="card">'+
                                    '<div class="card-header" id="headingOne1">'+
                                        '<section class="mb-0 mt-0">'+
                                        '<div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne'+data.type.idTd+'" aria-expanded="true" aria-controls="defaultAccordionOne'+data.type.idTd+'">'
                                            +intitule+'<div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>'+
                                        '</div>'+
                                        '</section>'+
                                    '</div>'+

                                    '<div id="defaultAccordionOne'+data.type.idTd+'" class="collapse" aria-labelledby="headingOne1" data-parent="#toggleAccordion">'+
                                        '<div class="card-body">'+
                                            '<p class="">'+
                                                desc+
                                            '</p>'+
                                            '<div id="widget-content'+data.type.idTd+'" class="widget-content container">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            )
                            for(i=0;i<data["metas"].length;i++)
                            {
                                $('#widget-content'+data["metas"][i].m_idTd).append(
                                    '<span class="badge outline-badge-primary">'+ 
                                            data["metas"][i].libelleM+
                                    '</span>'+'&nbsp;'  
                                );
                            }
                        }
                    }); 
                } */
            });
        });
</script>

<div id="content" >
    <input type="hidden" id="cpt" value="0">
    <input type="hidden" id="x" value="0">
    <button hidden id="notif" class="btn btn-dark bottom-right">Bottom right</button>
    <div class="container col-lg-12 col-12 ">
        <div class="col-lg-12 col-12 ">
            <div class="row layout-top-spacing">
                <div id="tabsLine" class="col-lg-12 col-12 ">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area underline-content">
                            
                            <ul class="nav nav-tabs  mb-3" id="lineTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="underline-profile-tab" data-toggle="tab" href="#underline-profile" role="tab" aria-controls="underline-profile" aria-selected="false">Types documents</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="underline-home-tab" data-toggle="tab" href="#underline-home" role="tab" aria-controls="underline-home" aria-selected="true">Documents</a>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="lineTabContent-3">
                                <div class="tab-pane fade " id="underline-home" role="tabpanel" aria-labelledby="underline-home-tab">
                                    <div class="row" id="cancel-row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="widget-content widget-content-area br-6">
                                                
                                                {{-- <select class="selectpicker mb-4" data-width="fit">
                                                    <option>Type document</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                    <option>Onions</option>
                                                </select>
                                                <div class="input-group mb-4">
                                                    <div class="form-group mb-0">
                                                        <input id="basicFlatpickr" value="2019-09-04" class="macl form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <input id="basicFlatpickr" value="2019-09-04" class=" macl form-control flatpickr flatpickr-input " type="text" placeholder="Select Date..">
                                                    </div>  
                                                    
                                                </div> 
                                                    <div class="">                                                
                                                        <label class="switch s-primary  mb-4 mr-2">
                                                            <input type="checkbox" checked>
                                                            <span class="slider"></span>
                                                        </label>
                                                    </div> --}}
                                                
                                                <div class="table-responsive mb-4 mt-4">
                                                    <table id="zero-config" class="table table-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Nom document</th>
                                                                <th>Ajouté par</th>
                                                                <th>Date création</th>
                                                                <th>Nb versions</th>
                                                                <th>Etat document</th>
                                                                <th>Droit d'accés</th>
                                                                <th class="no-content"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($docs as $doc)
                                                            <tr>
                                                                <td> {{$doc->nomD}} </td>
                                                                <td> {{$doc->user->nomU}} </td>
                                                                <td> {{$doc->created_at->format('d/m/Y')}} </td>
                                                                <td> {{$doc->versions->count()}} </td>
                                                                <td> {{$doc->etatD}}  </td>
                                                                <td>  </td>
                                                                <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Nom document</th>
                                                                <th>Ajouté par</th>
                                                                <th>Date création</th>
                                                                <th>Nb versions</th>
                                                                <th>Date création</th>
                                                                <th>Droit d'accés</th>
                                                                <th class="no-content"></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                            
                                    </div>
                                         
                                </div>
                                <div class="tab-pane fade show active" id="underline-profile" role="tabpanel" aria-labelledby="underline-profile-tab">
                
                                    <div class="row layout-top-spacing">
                                        <div class="col-lg-12 layout-spacing">
                                            <div class="statbox widget box">
                                                <div id="accordionBasic" class="widget-header">
                                                    <div class=" row">
                                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                            <br>
                                                            <button type="button" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#fadeupModal">Nouveau</button>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div id="fadeupModal" class="modal animated fadeInUp custo-fadeInUp" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Nouveau type</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                </button>
                                                            </div>
                                                            <form id="addType" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                                <div class="modal-body">

                                                                        <input type="hidden" id="libelleM" name="libelleM" value="">
                                                                        <input type="hidden" id="typeM" name="typeM" value="">
                                                                        <input type="hidden" id="listeM" name="listeM" value="">
                                                                        <div class="form-group">
                                                                            <input name="intituleT" id="intituléT" type="text" class="form-control" id="exampleFormControlInput1" value="" placeholder="(*) Intitulé">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea name="description" id="description" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
                                                                        </div>
                                                                        <a href="#" class="addinput row container">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle mb-4"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                                            &nbsp;<h6 style="color:#1b55e2;">  Ajouter une métadonnée</h6> 
                                                                        </a>
                                                                </div>
                                                                <div class="modal-footer md-button">
                                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Annuler</button>
                                                                    <button id="valider" type="submit" class="btn btn-primary">Valider</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content widget-content-area">
                                                    <div id="toggleAccordion">
                                                        <?php $var=1; ?>
                                                        @foreach ($typesDoc as $typeDoc)
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne1">
                                                                <section class="mb-0 mt-0">
                                                                <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne{{$var}}" aria-expanded="true" aria-controls="defaultAccordionOne{{$var}}">
                                                                        {{$typeDoc->intituleTd}}<div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                                </div>
                                                                </section>
                                                            </div>
                            
                                                            <div id="defaultAccordionOne{{$var}}" class="collapse" aria-labelledby="headingOne1" data-parent="#toggleAccordion">
                                                                <div class="card-body">
                                                                    <p class="">
                                                                        @if($typeDoc->descriptionTd)
                                                                            {{$typeDoc->descriptionTd}}
                                                                        @else
                                                                            Aucune desription disponible
                                                                        @endif
                                                                    </p>
                                                                    <div class="widget-content container">
                                                                        @foreach ($typeDoc->metadonnees as $metadonnee)
                                                                            <span class="badge outline-badge-primary"> {{$metadonnee->libelleM}} </span>
                                                                        @endforeach
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $var++; ?>
                                                        @endforeach
                                                        
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

@endsection