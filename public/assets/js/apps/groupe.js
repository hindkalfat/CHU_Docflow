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

  $('.view-list').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
    $(this).parents('.switch').find('.view-grid').removeClass('active-view');
    $(this).addClass('active-view');

    $(this).parents('.searchable-container').removeClass('grid');
    $(this).parents('.searchable-container').addClass('list');

    $(this).parents('.searchable-container').find('.searchable-items').removeClass('grid');
    $(this).parents('.searchable-container').find('.searchable-items').addClass('list');
  });

  $('#btn-add-contact').on('click', function(event) {
    $('#addContactModal #btn-add').show();
    $('#addContactModal #btn-edit').hide();
    $('#addContactModal').modal('show');
  })

function deleteContact() {
  $("#exampleModal").on('show.bs.modal', function(event) {
    var a = $(event.relatedTarget).data('nom');
    var b = $(event.relatedTarget).data('id');
    var m = $(this);
    m.find('#nomG').text(a);
    m.find("#idG").val(b);
  });

  $(".dlt").on('click', function(event) {
    event.preventDefault();
     var data = $('#deleteF').serialize(); 
      $.ajax({
          type:'POST',
          data:data,
          url:'/admin/delete/groupe',
          success:function(data){

            $(".delete").parents('#items'+data.idG).remove();
            $('#exampleModal').modal('hide');
          }
        }); 
    
  }); 
}

function addContact() {
  $("#btn-add").click(function() {

    var getParent = $(this).parents('.modal-content');

    var $_nom = getParent.find('#c-nom');

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
            $html = '<div class="items">' +
            '<div class="item-content">' +
                '<div class="user-profile">' +

                    '<div class="n-chk align-self-center text-center">' +
                        '<label class="new-control new-checkbox checkbox-primary">' +
                          '<input type="checkbox" class="new-control-input contact-chkbox">' +
                          '<span class="new-control-indicator"></span>' +
                        '</label>' +
                    '</div>' +
                    '<div class="user-meta-info">' +
                        '<p class="user-name" data-name="'+ $_nomValue +'">'+ data.groupe.nomG +'</p>' +
                    '</div>' +
                    '<div class="layout-top-spacing">'+
                        '<ul class="list-inline badge-collapsed-img mb-0 mb-3">'+
                              '<li class="list-inline-item chat-online-usr">'+
                                  '<img alt="avatar" src="{{asset("assets/img/profile-2.jpg")}}" if($var==1) class="ml-0" endif>'+
                              '</li>'+
                            '<li class="list-inline-item badge-notify mr-0">'+
                                '<div class="notification">'+
                                        '<span class="badge badge-info badge-pill">+{{$groupe->users->count()-3}} more</span>'+
                                '</div>'+
                            '</li>'+
                        '</ul>'+
                    '</div>'+
                '</div>' +
                '<div class="action-btn">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 edit"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>'+
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-minus delete"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>'
                '</div>' +
            '</div>' +
        '</div>';

            $(".searchable-items > .items-header-section").after($html);
            $('#addContactModal').modal('hide');

            var $_setNomValueEmpty = $_nom.val('');

          deleteContact();
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
    var $_setModalUsersValue = $_getModalUsersInput.val($_usersAttrValue);

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
            var  setUpdatedUsersValue = $_userse.text($_usersValue);
      
            var  setUpdatedAttrNameValue = $_name.attr('data-name', $_nameValue);
            var  setUpdatedAttrUsersValue = $_users.attr('data-users', $_nameValue);
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
