
 $('.ajax').click(function(){
  var id = this.id; cnt
  var message = $("#ololo"+id).val();
   var cnt = $("#"+id).val();
    $.ajax({ dataType: 'json',
            data: {message:message, id:id, cnt:cnt},
      success: function(data){
      //  if (data.id == 2) { }
        
          
          
      },
    error: function() {
        

    }});
   alert('Комментарий отправлен!');
    $('.result-'+id).html('<div class="callout callout-success"> <h4>Отправлено!</h4></div>');
    
  });
