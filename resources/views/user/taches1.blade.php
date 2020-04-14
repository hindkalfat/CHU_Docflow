@extends('layout.app1')

@section('link')

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

@section('content')
<script>
    $(document).ready(function () {
        $('#task').click(function(){
            $('#taskModal').modal('show');
        });
        var x=0;

        $('.aa').click(function(){
            var btn_id = $(this).attr("id");
            var i=btn_id.substring(7,btn_id.length);
            if(x==0)
            {
                $('.iconefl'+i).attr('fill','yellow');
                x=1;
            }
            else{
                $('.iconefl'+i).attr('fill','none');
                x=0;
            }
        });
        $('.aa').hover(function () {
  $('.aa').popover({
    container: 'body'
  })
})

    });
</script>
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
                                            <a class="nav-link list-actions active" id="all-list" data-toggle="pill" href="#pills-inbox" role="tab" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> En cours <span class="todo-badge badge"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link list-actions" id="todo-task-done" data-toggle="pill" href="#pills-sentmail" role="tab" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg> 
                                                Terminées <span class="todo-badge badge"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link list-actions" id="todo-task-important" data-toggle="pill" href="#pills-important" role="tab" aria-selected="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Groupe <span class="todo-badge badge"></span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link list-actions" id="todo-task-trash" data-toggle="pill" href="#pills-trash" role="tab" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> Importantes</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="todo-inbox" class="accordion todo-inbox">
                        <div class="search">
                            <input type="text" class="form-control input-search" placeholder="Search Here...">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                        </div>

                        <div class="search row layout-px-spacing">
                            <div class="col-9"></div>
                            <div class="row filtre container col-3">
                                <div class="fl"> <a class="aa btn-popover-primary mb-2 rounded" data-placement="top" id="iconefl1" href="#" role="button" data-toggle="popover" data-trigger="hover" data-content="Groupe"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconefl1 feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> </a> </div>                       
                                <div class="fl"> <a class="aa" id="iconefl2" href="#" role="button" data-placement="top" data-toggle="popover" data-trigger="hover" data-content="Urgent"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconefl2 feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg> </a> </div>                      
                                <div class="fl"> <a class="aa " id="iconefl3" href="#" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconefl3 feather feather-star fav-note"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></a></div>
                            </div>
                        </div>
                
                        <div class="todo-box">
                            
                            <div id="ct" class="todo-box-scroll">
                                @foreach ($taches as $tache)
                                    <div class="todo-item all-list">
                                        <div class="todo-item-inner">

                                            <div class="todo-content container">
                                                <a class="todo-heading" id="task" href=""> <h5> {{$tache->action->nomA}} </h5> </a>
                                                <p class="meta-date">{{$tache->created_at->format('d/m/Y')}}</p>
                                                <p class="todo-text">{{$tache->action->directiveA}}</p>
                                            </div>

                                            <div class="priority-dropdown custom-dropdown-icon">
                                                <div class="dropdown p-dropdown">
                                                    <a class="dropdown-toggle warning" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                        <a class="dropdown-item danger" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> High</a>
                                                        <a class="dropdown-item warning" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Middle</a>
                                                        <a class="dropdown-item primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> Low</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            <div class="compose-box">
                                                <div class="compose-content">
                                                    <h5 class="task-heading"></h5>
                                                    <p class="task-text">
                                                            <div class="attachment file-pdf">
                                                                    <div class="media">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                                        <div class="media-body">
                                                                            <p class="file-name">Confirm File</p>
                                                                            <p class="file-size">450kb</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Visualiser le document</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="attachment file-pdf">
                                                
                                                <div class="media">
                                                    <div class="row">
                                                        <div class="form-group col-md-5">
                                                            Version récente:
                                                        </div>
                                                        <div class="form-group col-md-7">
                                                            <div class="row media-body">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                                <p class="file-name">Commande de médicaments</p>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" placeholder="">
                                                    <div class=" mt-1">
                                                        <span class="badge outline-badge-dark">date Livraison
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" placeholder="">
                                                    <div class=" mt-1">
                                                        <span class="badge outline-badge-dark">signé par
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="custom-file mb-4">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal"> Annuler</button>
                                            <button type="button" class="btn btn-warning">Sauvegarder</button>
                                            <button type="button" class="btn btn-success">Valider</button>
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