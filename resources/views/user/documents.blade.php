@extends('layout.app1')

@section('link')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}">
    <link href="{{asset('plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link href="{{asset('assets/css/apps/scrumboard.css')}}" rel="stylesheet" type="text/css" />

    <script>
        $(document).ready(function () {

            //select2
            var ss = $(".basic").select2({
                tags: true,
            });
            $(".placeholder").select2({
                placeholder: "Type du document",
                allowClear: true
            });
            $(".placeholde").select2({
                placeholder: "Etat du document ",
                allowClear: true
            });
            //

            $("#deleteConformation").on('show.bs.modal', function(event) {
                var a = $(event.relatedTarget).data('nom');
                var b = $(event.relatedTarget).data('id');
                var m = $(this);
                m.find('#nomD').text(a);
                m.find("#idD").val(b);
            });

            $('#deleteConformation').on('hidden.bs.modal', function (e) {
                $('#password').val('');
                $('#mdp').css("display","none");
            });

            $("#dlt").on('click', function(event) {
                event.preventDefault();
                $('#inp_password').val($('#password').val())
                var table = $('#zero-config').DataTable();
                var data = $('#deleteF').serialize(); 
                $.ajax({
                    type:'POST',
                    data:data,
                    url:'/user/delete/document',
                    success:function(data){
                       if(data.success == "deleted"){
                            table
                            .row( $('#items'+data.id) )
                            .remove()
                            .draw();
                            /* $('#items'+data.id).remove();
                            table.state.save(); */
                            $('#deleteConformation').modal('hide');
                       }else{
                            $('#mdp').css("display","block");
                       }
                       
                    }
                    }); 
                
            });

            $('#fadeupModal').on('hidden.bs.modal', function (e) {
                $('#typeDoc').val("choisissez").change();;
                $('#metashow').empty();
            });
            
            $('#typeDoc').change(function(){
                $('#metashow').empty();
                var id = $('#typeDoc').val();
                var data = {
                    'id': $('#typeDoc').val(), _token: '{{csrf_token()}}' 
                };
                $.ajax({
                    type:'POST',
                    data:data,
                    url:'/metas',
                    success:function(data){
                        $.each(data, function () {
                            console.log(this)
                            if(this.typeM == 'Date'){
                                $('#metashow').append(
                                    '<div class="form-group col-md-6">'+
                                        '<div class=" mt-1">'+
                                            '<span class="badge outline-badge-info">'+this.libelleM+
                                            '</span>'+
                                        '</div><br/>'+
                                        '<input id="basicFlatpickr" name="'+this.idM+'" value="2019-09-04" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">'+
                                    '</div>'
                                );
                                var f1 = flatpickr(document.getElementById('basicFlatpickr'));
                            }else if(this.typeM == 'Heure'){
                                $('#metashow').append(
                                    '<div class="form-group col-md-6">'+
                                        '<div class=" mt-1">'+
                                            '<span class="badge outline-badge-info">'+this.libelleM+
                                            '</span>'+
                                        '</div><br/>'+
                                        '<input id="timeFlatpickr" name="'+this.idM+'" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">'+
                                    '</div>'
                                );
                                var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
                                    enableTime: true,
                                    noCalendar: true,
                                    dateFormat: "H:i",
                                    defaultDate: "00:00"
                                });
                            }else if(this.typeM == 'Numérique'){
                                $('#metashow').append(
                                    
                                    '<div class="form-group col-md-6">'+
                                        '<div class=" mt-1">'+
                                            '<span class="badge outline-badge-info">'+this.libelleM+
                                            '</span>'+
                                        '</div><br/>'+
                                        '<input id="demo2" name="'+this.idM+'" type="text" value="0" class="form-control">'+
                                    '</div>'
                                );
                                $("input[name='"+this.idM+"']").TouchSpin({
                                    min: 0,
                                    max: 1000000,
                                    step: 0.1,
                                    decimals: 2,
                                    boostat: 5,
                                    maxboostedstep: 10,
                                    buttondown_class: "btn btn-outline-dark",
                                    buttonup_class: "btn btn-outline-dark"
                                });
                            }else if(this.typeM == 'Enuméré'){
                                $('#metashow').append(
                                    '<div class="form-group col-md-6">'+
                                        '<div class=" mt-1">'+
                                            '<span class="badge outline-badge-info">'+this.libelleM+
                                            '</span>'+
                                        '</div><br/>'+
                                        '<input id="listeEnum" name="'+this.idM+'" type="file" class="form-control-file" id="exampleFormControlFile1" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">'+                                   
                                    '</div>'
                                );
                            }else{
                                $('#metashow').append(
                                    '<div class="form-group col-md-6">'+
                                        '<div class=" mt-1">'+
                                            '<span class="badge outline-badge-info">'+this.libelleM+
                                            '</span>'+
                                        '</div><br/>'+
                                        '<input type="text" name="'+this.idM+'" class="form-control" placeholder="'+this.libelleM+'">'+
                                    '</div>'
                                );
                            }
                        });
                    }
                });
            });

            //add doc
            $("#addDoc").submit(function(e){
                e.preventDefault();
                var path=$('#listeEnum').val(); 
                if( path )
                {
                    if(path.search(".xlsx") > 0 || path.search(".xls") > 0)
                    {
                        var form = $(this);
                        var data = new FormData(form[0]); 
                        $.ajax({
                            type:'POST',
                            data:data,
                            url:'/user/documents',
                            cache: false,
                            processData: false,
                            contentType : false,
                            success:function(data){
                                /* var dateC = new Date(data.document.created_at);
                                var dateU = new Date(data.document.updated_at);
                                var datecreated_at = dateC.getDate() + "/" +(dateC.getMonth() + 1) + "/" + dateC.getFullYear();
                                var dateupdated_at = dateU.getDate() + "/" +(dateU.getMonth() + 1) + "/" + dateU.getFullYear();
                                
                                $('#bodyDoc').after(
                                    '<tr role="row">'+
                                        '<td>'+ data.document.nomD+'</td>'+
                                        '<td>'+ datecreated_at +'</td>'+
                                        '<td>'+ dateupdated_at +'</td>'+
                                        '<td>  </td>'+
                                        '<td>  </td>'+
                                        '<td>  </td>'+
                                        '<td style="width:114px;">'+
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>'+
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>'+
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" title="supprimer" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>'+
                                        '</td>'+
                                    '</tr>'
                                ); */
                                $('#fadeupModal').modal('hide');
                                window.location = "/user/document/"+data.document.idD;
                            }
                        });  
                    }
                    else{
                        $('#notif').click();
                    } 
                }else{
                    var form = $(this);
                    var data = new FormData(form[0]); 
                    $.ajax({
                        type:'POST',
                        data:data,
                        url:'/user/documents',
                        cache: false,
                        processData: false,
                        contentType : false,
                        success:function(data){
                           /*  var dateC = new Date(data.document.created_at);
                            var dateU = new Date(data.document.updated_at);
                            var datecreated_at = dateC.getDate() + "/" +(dateC.getMonth() + 1) + "/" + dateC.getFullYear();
                            var dateupdated_at = dateU.getDate() + "/" +(dateU.getMonth() + 1) + "/" + dateU.getFullYear();
                            
                            $(
                                '<tr role="row" style="width:114px;">'+
                                    '<td>'+ data.document.nomD+'</td>'+
                                    '<td>'+ datecreated_at +'</td>'+
                                    '<td>'+ dateupdated_at +'</td>'+
                                    '<td>  </td>'+
                                    '<td>  </td>'+
                                    '<td>  </td>'+
                                    '<td class="row">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" title="supprimer" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>'+
                                    '</td>'+
                                '</tr>'
                            ).appendTo($('#bodyDoc'));
                            $('.dataTables_empty').remove(); */
                            $('#fadeupModal').modal('hide');
                            window.location = "/user/document/"+data.document.idD;
                        }
                    });
                }
            });
        });
    </script>
@endsection

@section('script')
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('plugins/select2/custom-select2.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        $('.bottom-right').click(function() {
            Snackbar.show({
                text: 'veuillez importer un fichier excel.',
                pos: 'bottom-right'
            });
        });
    </script>
    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>

    <script type="text/javascript"> //SEARCH
        $('#search').on('keyup',function(){
            $valueT=$('#typeD').val();
            $value=$(this).val();
            $valueE = $('#etatD').val();
            $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'search':$value , 'typeD':$valueT, 'etatD':$valueE},
            success:function(data){

                $('#zero-config').DataTable().clear().draw();

                $.each(data.docs, function (i, item) {
                    var dateC = new Date(item.created_at);
                    var datecreated_at = dateC.getDate() + "/" +(dateC.getMonth() + 1) + "/" + dateC.getFullYear();

                    var dateU = new Date(item.updated_at);
                    var dateupdated_at = dateU.getDate() + "/" +(dateU.getMonth() + 1) + "/" + dateU.getFullYear();

                    var table_rows = 
                                        '<tr id="items'+item.idD+'" role="row">'+
                                            '<td>'+ item.nomD+'</td>'+
                                            '<td>'+ datecreated_at+' </td>'+
                                            '<td>'+ dateupdated_at +'</td>'+
                                            '<td> '+ item.nomU+' '+ item.prenomU+' </td>'+
                                            '<td> '+ item.etatD+' </td>'+
                                            '<td id="drt'+item.idD+'">  </td>'+
                                            '<td style="width:114px;">'+
                                                '<a  href=" {!! asset("user/document/'+item.idD+'") !!} "> '+                                          
                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>'+
                                                '</a>'+  
                                                '&nbsp;<a  href="#">'+
                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" title="supprimer" class="feather feather-x-circle table-cancel" data-toggle="modal" data-target="#deleteConformation" data-id="'+ item.idD+'" data-nom="'+ item.nomD+'"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>'+
                                                '</a>'+                                       
                                            '</td>'+
                                        '</tr>'
                                    ;
                    
                    if (item.droitD== "privé"){
                        var droit =
                            '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>&nbsp;'+
                            item.droitD;
                          
                    }else{
                        var droit =
                        '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> &nbsp;'+
                            item.droitD;
                    }
                    $('#zero-config').DataTable().rows.add($(table_rows)).draw();
                    $('#zero-config').DataTable().cell($('#drt'+item.idD)).data(droit).draw();
                });
            }
            });
        })

        $('#typeD').on('change',function(){
            $value=$(this).val();
            $valueM=$('#search').val();
            $valueE = $('#etatD').val();
            $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'typeD':$value , 'search':$valueM, 'etatD':$valueE},
            success:function(data){
                $('#zero-config').DataTable().clear().draw();

                $.each(data.docs, function (i, item) {
                    var dateC = new Date(item.created_at);
                    var datecreated_at = dateC.getDate() + "/" +(dateC.getMonth() + 1) + "/" + dateC.getFullYear();

                    var dateU = new Date(item.updated_at);
                    var dateupdated_at = dateU.getDate() + "/" +(dateU.getMonth() + 1) + "/" + dateU.getFullYear();

                    var table_rows = 
                                        '<tr id="items'+ item.idD+'" role="row">'+
                                            '<td>'+ item.nomD+'</td>'+
                                            '<td>'+ datecreated_at+' </td>'+
                                            '<td>'+ dateupdated_at +'</td>'+
                                            '<td> '+ item.nomU+' '+ item.prenomU+' </td>'+
                                            '<td> '+ item.etatD+' </td>'+
                                            '<td id="drt'+item.idD+'">  </td>'+
                                            '<td style="width:114px;">'+
                                                '<a  href=" {!! asset("user/document/'+item.idD+'") !!} "> '+                                          
                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>'+
                                                '</a>'+ 
                                                '&nbsp;<a  href="#">'+
                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" title="supprimer" class="feather feather-x-circle table-cancel" data-toggle="modal" data-target="#deleteConformation" data-id="'+ item.idD+'" data-nom="'+ item.nomD+'"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>'+
                                                '</a>'+                                        
                                            '</td>'+
                                        '</tr>'
                                    ;
                    if (item.droitD== "privé"){
                        var droit =
                            '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>&nbsp;'+
                            item.droitD;
                          
                    }else{
                        var droit =
                        '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> &nbsp;'+
                            item.droitD;
                    }
                    $('#zero-config').DataTable().rows.add($(table_rows)).draw();
                    $('#zero-config').DataTable().cell($('#drt'+item.idD)).data(droit).draw();
                });
            }
            });
        })

        $('#etatD').on('change',function(){
            $value=$(this).val();
            $valueM=$('#search').val();
            $valueT=$('#typeD').val();
            $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'etatD':$value,'typeD':$valueT , 'search':$valueM},
            success:function(data){
                $('#zero-config').DataTable().clear().draw();
                $.each(data.docs, function (i, item) {
                    var dateC = new Date(item.created_at);
                    var datecreated_at = dateC.getDate() + "/" +(dateC.getMonth() + 1) + "/" + dateC.getFullYear();
                    
                    var dateU = new Date(item.updated_at);
                    var dateupdated_at = dateU.getDate() + "/" +(dateU.getMonth() + 1) + "/" + dateU.getFullYear();

                    var table_rows = 
                                        '<tr id="items'+ item.idD+'" role="row">'+
                                            '<td>'+ item.nomD+'</td>'+
                                            '<td>'+ datecreated_at+' </td>'+
                                            '<td>'+ dateupdated_at +'</td>'+
                                            '<td> '+ item.nomU+' '+ item.prenomU+' </td>'+
                                            '<td> '+ item.etatD+' </td>'+
                                            '<td id="drt'+item.idD+'">  </td>'+
                                            '<td style="width:114px;">'+
                                                '<a  href=" {!! asset("user/document/'+item.idD+'") !!} "> '+                                          
                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>'+
                                                '</a>'+  
                                                '&nbsp;<a  href="#">'+
                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" title="supprimer" class="feather feather-x-circle table-cancel" data-toggle="modal" data-target="#deleteConformation" data-id="'+ item.idD+'" data-nom="'+ item.nomD+'"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>'+
                                                '</a>'+                                       
                                            '</td>'+
                                        '</tr>'
                                    ;
                    if (item.droitD== "privé"){
                        var droit =
                            '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>&nbsp;'+
                            item.droitD;
                          
                    }else{
                        var droit =
                        '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> &nbsp;'+
                            item.droitD;
                    }
                    $('#zero-config').DataTable().rows.add($(table_rows)).draw();
                    $('#zero-config').DataTable().cell($('#drt'+item.idD)).data(droit).draw();
                });
            }
            });
        })
    </script>

    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    //END SEARCH
    </script>

@endsection

@section('content')
<button hidden id="notif" class="btn btn-dark bottom-right">Bottom right</button>
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
                            <b> <h5 class="modal-title">Nouveau document</h5></b>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <form id="addDoc" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <p>Droit d'accés</p>
                                    <select id="grp" name="grp[]" class="selectpicker form-control" multiple data-live-search="true" data-actions-box="true">
                                        @foreach ($groupes as $groupe)
                                            <option value="{{$groupe->idG}}"> {{$groupe->nomG}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p>Type document</p>
                                    <select id="typeDoc" name="typeDoc" class="selectpicker" data-live-search="true" data-width="100%" required>
                                        <option value="" disabled selected>choisissez</option>
                                        @foreach ($typesDoc as $typeDoc)
                                            <option value="{{$typeDoc->idTd}}"> {{$typeDoc->intituleTd}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <p>Nom document</p>
                                    <input name="nomD" type="text" name="txt" placeholder="Nom..." class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <p>Titre document <code>Optionnel</code></p>
                                    <input name="titreD" type="text" name="txt" placeholder="Titre..." class="form-control">
                                </div>

                                <div class="row" id="metashow">
                                </div>
                                
                                <div class="custom-file-container" data-upload-id="myFirstImage">
                                    <label>Supprimer le fichier <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file" >
                                        <input required id="file" name="file" type="file" class="custom-file-container__custom-file__custom-file-input" accept="file/*">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                            <div class="modal-footer md-button">
                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Annuler</button>
                                <button id="valider" type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="form-row mb-4">
                        <div class="col">
                            <select id="typeD" name="typeD" class="form-control tagging placeholder " multiple="multiple">
                                @foreach ($typesDoc as $typeDoc)
                                    <option value="{{$typeDoc->idTd}}">{{$typeDoc->intituleTd}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input id="search" name="search" type="text" class="form-control" id="exampleFormControlInput1" value="" placeholder="Recherche métadonnée">
                        </div>
                        <div class="col">
                            <select id="etatD" name="etatD" class="form-control tagging placeholde" multiple="multiple">
                                <option value="actif">actif</option>
                                <option value="archive">archivé</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nom document</th>
                                    <th>Date création</th>
                                    <th>Date modification</th>
                                    <th>Ajouté par</th>
                                    <th>Etat document</th>
                                    <th>Droit d'accés</th>
                                    <th class="no-content"></th>
                                </tr>
                            </thead>
                            <tbody id="bodyDoc">
                                @foreach ($docs as $doc)
                                   <tr id="items{{$doc->idD}}">
                                        <td> {{$doc->nomD}} </td>
                                        <td> {{$doc->created_at->format('d/m/Y')}} </td>
                                        <td> {{$doc->updated_at->format('d/m/Y')}} </td>
                                        <td> {{$doc->user->nomU}} {{$doc->user->prenomU}} </td>
                                        <td> {{$doc->etatD}} </td>
                                        @if ($doc->droitD == "privé")
                                            <td> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                                {{$doc->droitD}}
                                            </td>
                                        @else
                                            <td>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                                {{$doc->droitD}}
                                            </td>
                                        @endif
                                        
                                        <td>
                                            <a  href=" {{url('user/document/'.$doc->idD)}} ">                                            
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </a>
{{--                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
 --}}                                            <a  href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" title="supprimer" class="feather feather-x-circle table-cancel" data-toggle="modal" data-target="#deleteConformation" data-id="{{$doc->idD}}" data-nom="{{$doc->nomD}}"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                            </a>
                                        </td>
                                    </tr> 
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom document</th>
                                    <th>Date création</th>
                                    <th>Date modification</th>
                                    <th>Ajouté par</th>
                                    <th>Etat document</th>
                                    <th>Droit d'accés</th>
                                        <th></th>
                                </tr>
                            </tfoot>
                        </table>
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
                                        <p class="">Pour supprimer le document: <b id="nomD"></b>, vous devez confirmer votre mot de passe.</p>
                                        
                                        <div class="col layout-top-spacing">
                                            <div class="input-group ">
                                                <input placeholder="Mot de passe" id="password" type="password" class="form-control" name="password" autocomplete="current-password">
                                            </div>
                                        </div>
                                        <h6 class="container" id="mdp" style="display: none; color:red;">Mot de passe incorrect</h6>
                                        <code class="container">Attention! Cette action annule tout le workflow</code> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-dismiss="modal">Annuler</button>
                                        <form id="deleteF">
                                            {{ csrf_field() }}
                                            <input name="idD" type="hidden" id="idD">
                                            <input id="inp_password" type="hidden" name="inp_password">
                                            <button type="button" class="btn btn-danger dlt" id="dlt">Confirmer</button>
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