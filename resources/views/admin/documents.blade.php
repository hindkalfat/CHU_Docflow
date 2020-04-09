@extends('layout.app')

@section('content')

<script>
        $(document).ready(function () {
            $('.addinput').click(function(){
                $(this).after( '<div class="addmeta row mb-4">'+
                                    '<div class="col">'+
                                        '<input type="text" class="form-control" placeholder="Intitulé">'+
                                    '</div>'+
                                    '<div class="col">'+
                                        '<select  class="form-control" data-width="fit">'+
                                            '<option>Type document</option>'+
                                            '<option>Ketchup</option>'+
                                            '<option>Relish</option>'+
                                            '<option>Onions</option>'+
                                        '</select>'+
                                    '</div>'+
                                '</div>')
            });
            $('#fadeupModal').on('hidden.bs.modal',function(){
                $('.addmeta').remove();
            });
        });
</script>

<div id="content" >
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
                                                
                                                    <select class="selectpicker mb-4" data-width="fit">
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
                                                    </div>
                                                
                                                <div class="table-responsive mb-4 mt-4">
                                                    <table id="zero-config" class="table table-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Nom document</th>
                                                                <th>Ajouté par</th>
                                                                <th>Date création</th>
                                                                <th>Nb versions</th>
                                                                <th>Date création</th>
                                                                <th>Droit d'accés</th>
                                                                <th class="no-content"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Tiger Nixon</td>
                                                                <td>System Architect</td>
                                                                <td>Edinburgh</td>
                                                                <td>61</td>
                                                                <td>2011/04/25</td>
                                                                <td>$320,800</td>
                                                                <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Garrett Winters</td>
                                                                <td>Accountant</td>
                                                                <td>Tokyo</td>
                                                                <td>63</td>
                                                                <td>2011/07/25</td>
                                                                <td>$170,750</td>
                                                                <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ashton Cox</td>
                                                                <td>Junior Technical Author</td>
                                                                <td>San Francisco</td>
                                                                <td>66</td>
                                                                <td>2009/01/12</td>
                                                                <td>$86,000</td>
                                                                <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Position</th>
                                                                <th>Office</th>
                                                                <th>Age</th>
                                                                <th>Start date</th>
                                                                <th>Salary</th>
                                                                <th></th>
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
                                            <div class="statbox widget box box-shadow">
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
                                                                <h5 class="modal-title">Modal Header</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                    
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInput1">Intitulé</label>
                                                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInput1">Description</label>
                                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                    </div>
                                                                    <a href="#" class="addinput">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                                    </a>
                                                            </div>
                                                            <div class="modal-footer md-button">
                                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                <button type="button" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content widget-content-area">
                                                    <div id="toggleAccordion">
                                                        <div class="card">
                                                        <div class="card-header" id="headingOne1">
                                                            <section class="mb-0 mt-0">
                                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne" aria-expanded="true" aria-controls="defaultAccordionOne">
                                                                Collapsible Group Item #1  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                            </section>
                                                        </div>
                
                                                        <div id="defaultAccordionOne" class="collapse show" aria-labelledby="headingOne1" data-parent="#toggleAccordion">
                                                            <div class="card-body">
                                                                <p class="">
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                                                
                                                                </p>
                                                                <div class="widget-content ">
                                                                    <span class="badge outline-badge-primary">Primary</span>
                                                                    <span class="badge outline-badge-info">Info</span>
                                                                    <span class="badge outline-badge-success">Success</span>
                                                                    <span class="badge outline-badge-secondary">Secondary</span>
                                                                    <span class="badge outline-badge-warning">Warning</span>
                                                                    <span class="badge outline-badge-danger">Danger</span>
                                                                    <span class="badge outline-badge-dark">Dark</span>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="card">
                                                        <div class="card-header" id="headingTwo1">
                                                            <section class="mb-0 mt-0">
                                                            <div role="menu" class="" data-toggle="collapse" data-target="#defaultAccordionTwo" aria-expanded="false" aria-controls="defaultAccordionTwo">
                                                                Collapsible Group Item #2  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                            </section>
                                                        </div>
                                                        <div id="defaultAccordionTwo" class="collapse" aria-labelledby="headingTwo1" data-parent="#toggleAccordion">
                                                            <div class="card-body">
                                                                <ul class="list-unstyled">
                                                                    <li><a href="javascript:void(0);" class="">Apple</a></li>
                                                                    <li><a href="javascript:void(0);" class="">Orange</a></li>
                                                                    <li><a href="javascript:void(0);" class="">Banana</a></li>
                                                                    <li><a href="javascript:void(0);" class="">list</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="card">
                                                        <div class="card-header" id="headingThree1">
                                                            <section class="mb-0 mt-0">
                                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionThree" aria-expanded="false" aria-controls="defaultAccordionThree">
                                                                Collapsible Group Item #3 <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                            </div>
                                                            </section>
                                                        </div>
                                                        <div id="defaultAccordionThree" class="collapse" aria-labelledby="headingThree1" data-parent="#toggleAccordion">
                                                            <div class="card-body">
                                                            <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                
                                                            <button class="btn btn-primary mt-4">Accept</button>
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
    </div>
</div>

@endsection