  $(document).ajaxStart(function() { Pace.restart(); });
  $('#connection').click(function(){
  	$.ajax({ dataType: 'json',
  		data: {connect:this.value},
  		success: function(data){
  			if (data.id == 1) { }
  				$('#BlockAddComment').hide();
  			$('#BlockEditComment').show();
  			
  		}});
  });
  $('#disconnect').click(function(){
  	$.ajax({ dataType: 'json',
  		data: {disconnect:this.value},
  		success: function(data){
  			if (data.id == 2) { }
  				$('#BlockAddComment').show();
  			$('#BlockEditComment').hide();
  			
  		}});
  });
  
  $('#edit').click(function(){
  	var checkboxes = $('#formEdit').find('input[type="checkbox"]');
  	$.each( checkboxes, function( key, value ) {
  		if (value.checked === false) {
  			value.value = 0;
  		} else {
  			value.value = 1;
  		}
  		$(value).attr('type', 'hidden');
  	});
  	formData = 0;
  	$('#exampleInputFile').on('change',function() {
		 formData = new FormData(this);
	})
  //	photo = $('#exampleInputFile');
  	a = $('#formEdit').serializeArray();
  	$.ajax({ dataType: 'json',
  		data: {edit:this.value, a:a},
  		success: function(data){
  		//	if (data.id == 2) { }
  				
  				
  		}});
        $('#okey').html('<div class="callout callout-success"> <h4>Сохранено!</h4></div>');
    
  });

$(function () {




    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });


  });
/*
$(document).ready(function()
{
	$('#exampleInputFile').on('change',function() {
		alert('dsds');
	})
})
*/