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
    m.find('#nomU').text(a);
    m.find("#idU").val(b);
  });

  $(".dlt").on('click', function(event) {
    event.preventDefault();
     var data = $('#deleteF').serialize(); 
      $.ajax({
          type:'POST',
          data:data,
          url:'/admin/delete/user',
          success:function(data){
            $(".delete").parents('.items').remove();
            $('#exampleModal').modal('hide');
          }
        }); 
    
  }); 
}

function addContact() {
  $("#btn-add").click(function() {
    

    var getParent = $(this).parents('.modal-content');

    var $_name = getParent.find('#c-nom');
    var $_prenom = getParent.find('#c-prenom');
    var $_ville = getParent.find('#c-ville');

    var $_email = getParent.find('#c-email');
    var $_profession = getParent.find('#c-profession');
    var $_phone = getParent.find('#c-phone');
    var $_location = getParent.find('#c-adresse');

    var $_getValidationField = document.getElementsByClassName('validation-text');
    var reg = /^.+@[^\.].*\.[a-z]{2,}$/;
    var phoneReg = /^\d*\.?\d*$/;

    var $_nameValue = $_name.val();
    var $_prenomValue = $_prenom.val();
    var $_villeValue = $_ville.val();
    var $_emailValue = $_email.val();
    var $_professionValue = $_profession.val();
    var $_phoneValue = $_phone.val();
    var $_locationValue = $_location.val();

    if ($_nameValue == "") {
      $_getValidationField[0].innerHTML = 'vueillez renseigner votre nom';
      $_getValidationField[0].style.display = 'block';
    } else {
      $_getValidationField[0].style.display = 'none';
    }

    if ($_prenomValue == "") {
      $_getValidationField[1].innerHTML = 'vueillez renseigner votre prenom';
      $_getValidationField[1].style.display = 'block';
    } else {
      $_getValidationField[1].style.display = 'none';
    }

    if ($_villeValue == "") {
      $_getValidationField[2].innerHTML = 'vueillez renseigner votre ville';
      $_getValidationField[2].style.display = 'block';
    } else {
      $_getValidationField[2].style.display = 'none';
    }
/*
    if ($_emailValue == "") {
      $_getValidationField[1].innerHTML = 'Email Id must be filled out';
      $_getValidationField[1].style.display = 'block';
    } else if((reg.test($_emailValue) == false)) {
      $_getValidationField[1].innerHTML = 'Invalid Email';
      $_getValidationField[1].style.display = 'block';
    } else {
      $_getValidationField[1].style.display = 'none';
    }

    if ($_phoneValue == "") {
      $_getValidationField[2].innerHTML = 'Invalid (Enter 10 Digits)';
      $_getValidationField[2].style.display = 'block';
    } else if((phoneReg.test($_phoneValue) == false)) {
      $_getValidationField[2].innerHTML = 'Please Enter A numeric value';
      $_getValidationField[2].style.display = 'block';
    } else {
      $_getValidationField[2].style.display = 'none';
    }
*/
    if ($_nameValue == "" || $_prenomValue == "" ||  $_villeValue == "" || $_emailValue == "" || (reg.test($_emailValue) == false) || $_phoneValue == "" || (phoneReg.test($_phoneValue) == false)) {
      return false;
    } 

    var data = $('#addContactModalTitle').serialize(); 

    $.ajax({
        type:'POST',
        data:data,
        url:'/admin/users',
        success:function(data){
          $html = '<div class="items">' +
                    '<div class="item-content">' +
                        '<div class="user-profile">' +

                            '<div class="n-chk align-self-center text-center">' +
                                '<label class="new-control new-checkbox checkbox-primary">' +
                                  '<input type="checkbox" class="new-control-input contact-chkbox">' +
                                  '<span class="new-control-indicator"></span>' +
                                '</label>' +
                            '</div>' +

                            '<img src="assets/img/90x90.jpg">' +
                            '<div class="user-meta-info">' +
                                '<p class="user-name" data-name='+ $_nameValue +'>'+ $_nameValue +'</p>' +
                                '<p class="user-prenom" data-prenom='+ $_prenomValue +'>'+ $_prenomValue +'</p>' +
                                '<p class="user-work" data-profession='+ $_professionValue +'>'+ $_professionValue +'</p>' +
                            '</div>' +
                        '</div>' +
                        '<div class="user-ville">' +
                            '<p class="info-title">Ville: </p>' +
                            '<p class="usr-ville" data-ville='+ $_villeValue +'>'+ $_villeValue +'</p>' +
                        '</div>' +
                        '<div class="user-email">' +
                            '<p class="info-title">Email: </p>' +
                            '<p class="usr-email-addr" data-email='+ $_emailValue +'>'+ $_emailValue +'</p>' +
                        '</div>' +
                        '<div class="user-location">' +
                            '<p class="info-title">Location: </p>' +
                            '<p class="usr-location" data-location='+ $_locationValue +'>'+ $_locationValue +'</p>' +
                        '</div>' +
                        '<div class="user-phone">' +
                            '<p class="info-title">Phone: </p>' +
                            '<p class="usr-ph-no" data-phone='+ $_phoneValue +'>'+ $_phoneValue +'</p>' +
                        '</div>' +
                        '<div class="action-btn">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 edit"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>'+
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="modal" data-target="#exampleModal" data-id="'+data.id+'" data-nom="'+$_nameValue+'" class="feather feather-user-minus delete"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>'
                        '</div>' +
                    '</div>' +
                '</div>';

            $(".searchable-items > .items-header-section").after($html);
            $('#addContactModal').modal('hide');
            var $_setNameValueEmpty = $_name.val('');
            var $_setPrenomValueEmpty = $_prenom.val('');
            var $_setVilleValueEmpty = $_ville.val('');
            var $_setEmailValueEmpty = $_email.val('');
            var $_setProfessionValueEmpty = $_profession.val('');
            var $_setPhoneValueEmpty = $_phone.val('');
            var $_setLocationValueEmpty = $_location.val('');

          deleteContact();
          editContact();
          checkall('contact-check-all', 'contact-chkbox');
        }
    });

    

      
  });  
}

$('#addContactModal').on('hidden.bs.modal', function (e) {
    var $_ID = document.getElementById('c-ID');
    var $_name = document.getElementById('c-nom');
    var $_prenom = document.getElementById('c-prenom');
    var $_ville = document.getElementById('c-ville');
    var $_email = document.getElementById('c-email');
    var $_profession = document.getElementById('c-profession');
    var $_phone = document.getElementById('c-phone');
    var $_location = document.getElementById('c-adresse');
    var $_getValidationField = document.getElementsByClassName('validation-text');

    var $_setIDValueEmpty = $_ID.value = '';
    var $_setNameValueEmpty = $_name.value = '';
    var $_setPrenomValueEmpty = $_prenom.value = '';
    var $_setVilleValueEmpty = $_ville.value = '';
    var $_setEmailValueEmpty = $_email.value = '';
    var $_setProfessionValueEmpty = $_profession.value = '';
    var $_setPhoneValueEmpty = $_phone.value = '';
    var $_setLocationValueEmpty = $_location.value = '';

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
    var $_ID = getParentItem.find('.user-ID');
    var $_name = getParentItem.find('.user-name');
    var $_prenom = getParentItem.find('.user-prenom');
    var $_ville = getParentItem.find('.usr-ville');
    var $_email = getParentItem.find('.usr-email-addr');
    var $_profession = getParentItem.find('.user-work');
    var $_phone = getParentItem.find('.usr-ph-no');
    var $_location = getParentItem.find('.usr-location');

    // Get Attributes
    var $_IDAttrValue = $_ID.attr('data-ID');
    var $_nameAttrValue = $_name.attr('data-name');
    var $_prenomAttrValue = $_prenom.attr('data-prenom');
    var $_villeAttrValue = $_ville.attr('data-ville');
    var $_emailAttrValue = $_email.attr('data-email');
    var $_professionAttrValue = $_profession.attr('data-profession');
    var $_phoneAttrValue = $_phone.attr('data-phone');
    var $_locationAttrValue = $_location.attr('data-location');

    // Get Modal Attributes
    var $_getModalIDInput = getModal.find('#c-ID');
    var $_getModalNameInput = getModal.find('#c-nom');
    var $_getModalPrenomInput = getModal.find('#c-prenom');
    var $_getModalVilleInput = getModal.find('#c-ville');
    var $_getModalEmailInput = getModal.find('#c-email');
    var $_getModalProfessionInput = getModal.find('#c-profession');
    var $_getModalPhoneInput = getModal.find('#c-phone');
    var $_getModalLocationInput = getModal.find('#c-adresse');

    // Set Modal Field's Value
    var $_setModalIDValue = $_getModalIDInput.val($_IDAttrValue);
    var $_setModalNameValue = $_getModalNameInput.val($_nameAttrValue);
    var $_setModalPrenomValue = $_getModalPrenomInput.val($_prenomAttrValue);
    var $_setModalVilleValue = $_getModalVilleInput.val($_villeAttrValue);
    var $_setModalEmailValue = $_getModalEmailInput.val($_emailAttrValue);
    var $_setModalProfessionValue = $_getModalProfessionInput.val($_professionAttrValue);
    var $_setModalPhoneValue = $_getModalPhoneInput.val($_phoneAttrValue);
    var $_setModalLocationValue = $_getModalLocationInput.val($_locationAttrValue);

    $('#addContactModal').modal('show');

    $("#btn-edit").off('click').click(function(){

      var getParent = $(this).parents('.modal-content');

      var $_getInputName = getParent.find('#c-nom');
      var $_getInputPrenom = getParent.find('#c-prenom');
      var $_getInputVille = getParent.find('#c-ville');
      var $_getInputNmail = getParent.find('#c-email');
      var $_getInputNccupation = getParent.find('#c-profession');
      var $_getInputNhone = getParent.find('#c-phone');
      var $_getInputNocation = getParent.find('#c-adresse');


      var $_nameValue = $_getInputName.val(); 
      var $_prenomValue = $_getInputPrenom.val();
      var $_villeValue = $_getInputVille.val();
      var $_emailValue = $_getInputNmail.val();
      var $_professionValue = $_getInputNccupation.val();
      var $_phoneValue = $_getInputNhone.val();
      var $_locationValue = $_getInputNocation.val();

       var data = $('#addContactModalTitle').serialize(); 

      $.ajax({
          type:'POST',
          data:data,
          url:'/admin/edit/user',
          success:function(data){
            var  setUpdatedNameValue = $_name.text($_nameValue);
            var  setUpdatedPrenomValue = $_prenom.text($_prenomValue);
            var  setUpdatedVilleValue = $_ville.text($_villeValue);
            var  setUpdatedEmailValue = $_email.text($_emailValue);
            var  setUpdatedProfessionValue = $_profession.text($_professionValue);
            var  setUpdatedPhoneValue = $_phone.text($_phoneValue);
            var  setUpdatedLocationValue = $_location.text($_locationValue);

            var  setUpdatedAttrNameValue = $_name.attr('data-name', $_nameValue);
            var  setUpdatedAttrPrenomValue = $_name.attr('data-prenom', $_prenomValue);
            var  setUpdatedAttrVilleValue = $_name.attr('data-ville', $_villeValue);
            var  setUpdatedAttrEmailValue = $_email.attr('data-email', $_emailValue);
            var  setUpdatedAttrProfessionValue = $_profession.attr('data-profession', $_professionValue);
            var  setUpdatedAttrPhoneValue = $_phone.attr('data-phone', $_phoneValue);
            var  setUpdatedAttrLocationValue = $_location.attr('data-location', $_locationValue);
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


getPrenomInput = document.getElementById('c-prenom');

getPrenomInput.addEventListener('input', function() {

  getPrenomInputValue = this.value;

  if (getPrenomInputValue == "") {
    $_getValidationField[1].innerHTML = 'Prenom Required';
    $_getValidationField[1].style.display = 'block';
  } else {
    $_getValidationField[1].style.display = 'none';
  }

})

getVilleInput = document.getElementById('c-ville');

getVilleInput.addEventListener('input', function() {

  getVilleInputValue = this.value;

  if (getVilleInputValue == "") {
    $_getValidationField[2].innerHTML = 'Ville Required';
    $_getValidationField[2].style.display = 'block';
  } else {
    $_getValidationField[2].style.display = 'none';
  }

})


getEmailInput = document.getElementById('c-email');

getEmailInput.addEventListener('input', function() {

    getEmailInputValue = this.value;

    if (getEmailInputValue == "") {
      $_getValidationField[1].innerHTML = 'Email Required';
      $_getValidationField[1].style.display = 'block';
    } else if((reg.test(getEmailInputValue) == false)) {
      $_getValidationField[1].innerHTML = 'Invalid Email';
      $_getValidationField[1].style.display = 'block';
    } else {
      $_getValidationField[1].style.display = 'none';
    }

})

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

})
