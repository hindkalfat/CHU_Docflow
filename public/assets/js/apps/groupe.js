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
            $(".delete").parents('.items').remove();
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
                                '<h3 class="user-nom" data-nom='+ $_nomValue +'>'+ $_nomValue +'</h3>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';

            $(".searchable-items > .items-header-section").after($html);
            $('#addContactModal').modal('hide');

            var $_setNomValueEmpty = $_nom.val('');
            var $_setDescriptionValueEmpty = $_description.val('');

          deleteContact();
          editContact();
          checkall('contact-check-all', 'contact-chkbox');
        }
    });

  });  
}

$('#addContactModal').on('hidden.bs.modal', function (e) {
    var $_nom = document.getElementById('c-nom');
    var $_description = document.getElementById('c-description');
    var $_getValidationField = document.getElementsByClassName('validation-text');

    var $_setNomValueEmpty = $_name.value = '';
    var $_setDescValueEmpty = $_description.value = '';

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
    var $_description = getParentItem.find('.usr-description-addr');
    var $_occupation = getParentItem.find('.user-work');
    var $_phone = getParentItem.find('.usr-ph-no');
    var $_location = getParentItem.find('.usr-location');

    // Get Attributes
    var $_nameAttrValue = $_name.attr('data-name');
    var $_descriptionAttrValue = $_description.attr('data-description');
    var $_occupationAttrValue = $_occupation.attr('data-occupation');
    var $_phoneAttrValue = $_phone.attr('data-phone');
    var $_locationAttrValue = $_location.attr('data-location');

    // Get Modal Attributes
    var $_getModalNameInput = getModal.find('#c-name');
    var $_getModalDescriptionInput = getModal.find('#c-description');
    var $_getModalOccupationInput = getModal.find('#c-occupation');
    var $_getModalPhoneInput = getModal.find('#c-phone');
    var $_getModalLocationInput = getModal.find('#c-location');

    // Set Modal Field's Value
    var $_setModalNameValue = $_getModalNameInput.val($_nameAttrValue);
    var $_setModalDescriptionValue = $_getModalDescriptionInput.val($_descriptionAttrValue);
    var $_setModalOccupationValue = $_getModalOccupationInput.val($_occupationAttrValue);
    var $_setModalPhoneValue = $_getModalPhoneInput.val($_phoneAttrValue);
    var $_setModalLocationValue = $_getModalLocationInput.val($_locationAttrValue);

    $('#addContactModal').modal('show');

    $("#btn-edit").off('click').click(function(){

      var getParent = $(this).parents('.modal-content');

      var $_getInputName = getParent.find('#c-name');
      var $_getInputNmail = getParent.find('#c-description');
      var $_getInputNccupation = getParent.find('#c-occupation');
      var $_getInputNhone = getParent.find('#c-phone');
      var $_getInputNocation = getParent.find('#c-location');


      var $_nameValue = $_getInputName.val();
      var $_descriptionValue = $_getInputNmail.val();
      var $_occupationValue = $_getInputNccupation.val();
      var $_phoneValue = $_getInputNhone.val();
      var $_locationValue = $_getInputNocation.val();

      var  setUpdatedNameValue = $_name.text($_nameValue);
      var  setUpdatedDescriptionValue = $_description.text($_descriptionValue);
      var  setUpdatedOccupationValue = $_occupation.text($_occupationValue);
      var  setUpdatedPhoneValue = $_phone.text($_phoneValue);
      var  setUpdatedLocationValue = $_location.text($_locationValue);

      var  setUpdatedAttrNameValue = $_name.attr('data-name', $_nameValue);
      var  setUpdatedAttrDescriptionValue = $_description.attr('data-description', $_descriptionValue);
      var  setUpdatedAttrOccupationValue = $_occupation.attr('data-occupation', $_occupationValue);
      var  setUpdatedAttrPhoneValue = $_phone.attr('data-phone', $_phoneValue);
      var  setUpdatedAttrLocationValue = $_location.attr('data-location', $_locationValue);
      $('#addContactModal').modal('hide');
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

getNameInput = document.getElementById('c-name');

getNameInput.addEventListener('input', function() {

  getNameInputValue = this.value;

  if (getNameInputValue == "") {
    $_getValidationField[0].innerHTML = 'Name Required';
    $_getValidationField[0].style.display = 'block';
  } else {
    $_getValidationField[0].style.display = 'none';
  }

})


getDescriptionInput = document.getElementById('c-description');

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
