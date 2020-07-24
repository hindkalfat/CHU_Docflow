$(document).ready(function() {

  checkall('contact-check-all', 'contact-chkbox');

  $('#input-search').on('keyup', function() {
    var rex = new RegExp($(this).val(), 'i');
      $('.searchable-items .items:not(.items-header-section)').hide();
      $('.searchable-items .items:not(.items-header-section)').filter(function() {
          return rex.test($(this).text());
      }).show();
  });

  $('.view-grid').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */

    $(this).parents('.switch').find('.view-list').removeClass('active-view');
    $(this).addClass('active-view');

    $(this).parents('.searchable-container').removeClass('list');
    $(this).parents('.searchable-container').addClass('grid');

    $(this).parents('.searchable-container').find('.searchable-items').removeClass('list');
    $(this).parents('.searchable-container').find('.searchable-items').addClass('grid');

  });

  /* $('.feather-eye').on('click', function(event) {
    event.preventDefault();
    /* /* Act on the event 
    $(this).parents('.switch').find('.view-grid').removeClass('active-view');
    $(this).addClass('active-view');

    $(this).parents('.searchable-container').removeClass('grid');
    $(this).parents('.searchable-container').addClass('list');

    $(this).parents('.searchable-container').find('.searchable-items').removeClass('grid');
    $(this).parents('.searchable-container').find('.searchable-items').addClass('list'); 
    $("#profileModal").on('show.bs.modal', function(event) {
      var a = $(event.relatedTarget).data('nom');
      var m = $(this);
      m.find('.modal-title').text(a);
    });
  
  }); */

  $('#btn-add-contact').on('click', function(event) {
    $('#addContactModal #btn-add').show();
    $('#addContactModal #btn-edit').hide();
    $('#addContactModal').modal('show');
  })

function deleteContact() {
  $("#deleteConformation").on('show.bs.modal', function(event) {
    var a = $(event.relatedTarget).data('nom');
    var b = $(event.relatedTarget).data('id');
    var m = $(this);
    m.find('#nomG').text(a);
    m.find("#idG").val(b);
  });

  $("#dlt").on('click', function(event) {
    event.preventDefault();  
     var data = $('#deleteF').serialize(); 
      $.ajax({
          type:'POST',
          data:data,
          url:'/admin/delete/groupe',
          success:function(data){

            $(".delete").parents('#items'+data.idG).remove();
            $('#deleteConformation').modal('hide');
          }
        }); 
    
  }); 
}

function addContact() {
  $("#btn-add").click(function() {

    var getParent = $(this).parents('.modal-content');

    var $_nom = getParent.find('#c-nom');
    var $_users = getParent.find('#c-users');

    var $_getValidationField = document.getElementsByClassName('validation-text');
    var reg = /^.+@[^\.].*\.[a-z]{2,}$/;
    var phoneReg = /^\d*\.?\d*$/;

    var $_nomValue = $_nom.val();

    if ($_nomValue == "") {
      $_getValidationField[0].innerHTML = 'Nom must be filled out';
      $_getValidationField[0].style.display = 'block';
    } else {
      $_getValidationField[0].style.display = 'none';
    }

    if ($_nomValue == "") {
      return false;
    }
    var data = $('#addContactModalTitle').serialize(); 

    $.ajax({
        type:'POST',
        data:data,
        url:'/admin/groupes',
        success:function(data){
            var c=1;
            var x='';

            for(i=0;i<data["users"].length;i++){
              x= data["users"][i].id.toString()+','+x
            }

            $html = '<div class="items" id="items'+ data.groupe.idG +'">' +
            '<div class="item-content">' +
                '<div class="user-profile">' +
                    '<div class="n-chk align-self-center text-center">' +
                        '<label class="new-control new-checkbox checkbox-primary">' +
                          '<input type="checkbox" class="new-control-input contact-chkbox">' +
                          '<span class="new-control-indicator"></span>' +
                        '</label>' +
                    '</div>' +
                    '<div class="user-meta-info">' +
                        '<p class="user-name" data-name="'+ data.groupe.nomG+'">'+ data.groupe.nomG+'</p>' +
                        '<p class="users-groupe" data-users="'+x+'"></p>'+
                    '</div>' +
                    '<div class="layout-top-spacing">'+
                        '<ul id="avt'+ data.groupe.idG+'" class="list-inline badge-collapsed-img mb-0 mb-3">'+
                           //users
                           '<li class="list-inline-item badge-notify mr-0">'+
                                '<div class="notification" id="nbr'+ data.groupe.idG+'">'+
                                   
                                '</div>'+
                            '</li>'+
                        '</ul>'+
                    '</div>'+
                '</div>' +
                '<div class="action-btn">' +
                  '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye view" data-toggle="modal" data-target="#profileModal'+ data.groupe.idG+'"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>'+
                  '<svg id="idEdit'+ data.groupe.idG+'" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 edit" ><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>'+
                  '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="modal" data-target="#deleteConformation" data-id="'+ data.groupe.idG+'" data-nom="'+ data.groupe.nomG+'" class="feather feather-user-minus delete"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>'+
                '</div>' +
            '</div>' +
        '</div>'+
        '<div class="modal fade profile-modal" id="profileModal'+ data.groupe.idG+'" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">'+
            '<div class="modal-dialog modal-sm" role="document">'+
                '<div class="modal-content">'+
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+

                   ' <div class="modal-header justify-content-center" id="profileModalLabel">'+
                        '<div class="modal-profile mt-4">'+
                            '<h5 class="modal-title">'+ data.groupe.nomG+'</h5>'+
                        '</div>'+
                    '</div>'+
                    '<div class="modal-body text-center">'+
                            '<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">'+
                                '<li class="nav-item">'+
                                    '<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home'+ data.groupe.idG+'" role="tab" aria-controls="home" aria-selected="true">Membres</a>'+
                                '</li>'+
                            '</ul>'+
                            '<div class="tab-content" id="myTabContent">'+
                                '<div class="tab-pane fade show active" id="home'+ data.groupe.idG+'" role="tabpanel" aria-labelledby="home-tab">'+
                                    '<ul id="ul'+ data.groupe.idG+'" class="list-group list-group-media">'+
                                      //users  
                                    '</ul>'+
                                '</div>'+
                               ' <div class="tab-pane fade" id="profile'+ data.groupe.idG+'" role="tabpanel" aria-labelledby="profile-tab">'+
                                '</div>'+
                            '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

            $(".searchable-items > .items-header-section").after($html);
            var tmp = 1;
            $.each(data.usersAvt, function (i, item) {
              if(tmp==1){
                $('#avt'+data.groupe.idG).append(
                  '<li class="list-inline-item chat-online-usr">'+
                      '<img alt="avatar" src="http://localhost:8000/assets/img/avatar.jpg" class="ml-0">'+
                  '</li>'
                  );
              }else{
                $('#avt'+data.groupe.idG).append(
                  '<li class="list-inline-item chat-online-usr">'+
                      '<img alt="avatar" src="http://localhost:8000/assets/img/avatar.jpg">'+
                  '</li>'
                  );
              }
               tmp++; 
            });

            if(data.nbr > 0)
            {
              $('#nbr'+data.groupe.idG).append('<span class="badge badge-info badge-pill">+{{$groupe->users->count()-3}} more</span>')
            }

            for(i=0;i<data["users"].length;i++)
            {
              $('#ul'+data.groupe.idG).append(
                '<li class="list-group-item list-group-item-action">'+
                    '<div class="media">'+
                        '<div class="mr-3">'+
                            '<img alt="avatar" src="http://localhost:8000/assets/img/avatar.jpg" class="img-fluid rounded-circle">'+
                        '</div>'+
                        '<div class="media-body">'+
                            '<h6 class="tx-inverse">'+data["users"][i].nomU+' '+data["users"][i].prenomU+'</h6>'+
                            '<p class="mg-b-0">'+data["users"][i].professionU+'</p>'+
                        '</div>'+
                    '</div>'+
                '</li>'
              );
            }
            const containerJS = document.querySelector('.tab-content');
            document.querySelectorAll('.tab-content').forEach(containerJS => {
                new PerfectScrollbar(containerJS);
            });

            $('#addContactModal').modal('hide');

            var $_setNomValueEmpty = $_nom.val('');
            $('.bs-deselect-all').click();

          editContact();
          checkall('contact-check-all', 'contact-chkbox');
        }
    });

  });  
}

$('#addContactModal').on('hidden.bs.modal', function (e) {
    var $_nom = document.getElementById('c-nom');
    var $_getValidationField = document.getElementsByClassName('validation-text');

    var $_setNomValueEmpty = $_nom.value = '';
    $('.bs-deselect-all').click();

    for (var i = 0; i < $_getValidationField.length; i++) {
      e.preventDefault();
      $_getValidationField[i].style.display = 'none';
    }
})

function editContact() {
  $('.edit').on('click', function(event) {

    $('#addContactModal #btn-add').hide();
    $('#addContactModal #btn-edit').show();

    // Get Parents
    var getParentItem = $(this).parents('.items');
    var getModal = $('#addContactModal');

    // Get List Item Fields
    var $_name = getParentItem.find('.user-name');
    var $_users = getParentItem.find('.users-groupe');
    var $_ID = getParentItem.find('.group-ID');

    // Get Attributes
    var $_nameAttrValue = $_name.attr('data-name');
    var $_usersAttrValue = $_users.attr('data-users');
    var $_IDAttrValue = $_ID.attr('data-ID');
    
    // Get Modal Attributes
    var $_getModalNameInput = getModal.find('#c-nom');
    var $_getModalUsersInput = getModal.find('#c-users');
    var $_getModalIDInput = getModal.find('#c-ID');

    // Set Modal Field's Value
    var $_setModalIDValue = $_getModalIDInput.val($_IDAttrValue);
    var $_setModalNameValue = $_getModalNameInput.val($_nameAttrValue);
    var dataarray=$_usersAttrValue.split(",");
    $("#c-users").val(dataarray);
    $("#c-users").selectpicker("refresh");

    $('#addContactModal').modal('show');

    $("#btn-edit").off('click').click(function(){

      var getParent = $(this).parents('.modal-content');

      var $_getInputName = getParent.find('#c-nom');
      var $_getInputUsers = getParent.find('#c-users');
      

      var $_nameValue = $_getInputName.val();
      var $_usersValue = $_getInputUsers.val();

      var data = $('#addContactModalTitle').serialize(); 

      $.ajax({
          type:'POST',
          data:data,
          url:'/admin/edit/groupe',
          success:function(data){

            var  setUpdatedNameValue = $_name.text($_nameValue);
            var  setUpdatedUsersValue = $_users.text($_usersValue);
      
            var  setUpdatedAttrNameValue = $_name.attr('data-name', $_nameValue);
            var  setUpdatedAttrUsersValue = $_users.attr('data-users', $_usersValue);

            $('#ul'+$_IDAttrValue).empty();

            for(i=0;i<data["users"].length;i++)
            {
              $('#ul'+$_IDAttrValue).append(
                '<li class="list-group-item list-group-item-action">'+
                    '<div class="media">'+
                        '<div class="mr-3">'+
                            '<img alt="avatar" src="http://localhost:8000/assets/img/profile-1.jpg" class="img-fluid rounded-circle">'+
                        '</div>'+
                        '<div class="media-body">'+
                            '<h6 class="tx-inverse">'+data["users"][i].nomU+' '+data["users"][i].prenomU+'</h6>'+
                            '<p class="mg-b-0">'+data["users"][i].professionU+'</p>'+
                        '</div>'+
                    '</div>'+
                '</li>');
            }
            
            $('#addContactModal').modal('hide');
          }
        });
    });
  })
}

$(".delete-multiple").on("click", function() {
    var inboxCheckboxParents = $(".contact-chkbox:checked").parents('.items');   
      inboxCheckboxParents.remove();
});

deleteContact();
addContact();
editContact();

})


// Validation Process

var $_getValidationField = document.getElementsByClassName('validation-text');
var reg = /^.+@[^\.].*\.[a-z]{2,}$/;
var phoneReg = /^\d{10}$/;

getNameInput = document.getElementById('c-nom');

getNameInput.addEventListener('input', function() {

  getNameInputValue = this.value;

  if (getNameInputValue == "") {
    $_getValidationField[0].innerHTML = 'Name Required';
    $_getValidationField[0].style.display = 'block';
  } else {
    $_getValidationField[0].style.display = 'none';
  }

})


/* getDescriptionInput = document.getElementById('c-description');

getDescriptionInput.addEventListener('input', function() {

    getDescriptionInputValue = this.value;

    if (getDescriptionInputValue == "") {
      $_getValidationField[1].innerHTML = 'Description Required';
      $_getValidationField[1].style.display = 'block';
    } else if((reg.test(getDescriptionInputValue) == false)) {
      $_getValidationField[1].innerHTML = 'Invalid Description';
      $_getValidationField[1].style.display = 'block';
    } else {
      $_getValidationField[1].style.display = 'none';
    }

}) */
/* 
getPhoneInput = document.getElementById('c-phone');

getPhoneInput.addEventListener('input', function() {

  getPhoneInputValue = this.value;

  if (getPhoneInputValue == "") {
    $_getValidationField[2].innerHTML = 'Phone Number Required';
    $_getValidationField[2].style.display = 'block';
  } else if((phoneReg.test(getPhoneInputValue) == false)) {
    $_getValidationField[2].innerHTML = 'Invalid (Enter 10 Digits)';
    $_getValidationField[2].style.display = 'block';
  } else {
    $_getValidationField[2].style.display = 'none';
  }

}) */
