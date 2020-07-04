$(document).ready(function(){
    $('#framework').multiselect({
     nonSelectedText: 'Select Framework',
     enableFiltering: true,
     enableCaseInsensitiveFiltering: true,
     buttonWidth:'400px'
    });
    
    $('#framework_form').on('submit', function(event){
     event.preventDefault();
     var form_data = $(this).serialize();
     $.ajax({
      url:"insert.php",
      method:"POST",
      data:form_data,
      success:function(data)
      {
       $('#framework option:selected').each(function(){
        $(this).prop('selected', false);
       });
       $('#framework').multiselect('refresh');
       alert(data);
      }
     });
    });
    
    
   });