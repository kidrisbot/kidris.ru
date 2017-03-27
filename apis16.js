$(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
      var message = new Array(10);
      for (var i = 0; i < 10; i++) {
        message[i] = $("#ololo"+i).val()+'####'+ $("#token"+i).val()+'####'+ $("#id"+i).val();
      }
  


  
     // var message = $("#ololo").val();
          // alert(name0);
        $.ajax({url: '/api_comment', Type: 'POST',  data: {message:message}, success: function(result){
          if (result.code == 0) {
                    $("#ololo0").val('');
         // $('.fileinput').fileinput('clear');
                } 
           $('.ajax-content').html(result);
           //  $(".ajax-content").html(result.msg);
        }});
    });
 /*
$(document).ready(function () {
    $("#anon").ajaxForm({
            dataType: 'json',
            beforeSend: function () {
                $("#ololo0").attr('disabled', true);
                $("#anon").find('button[type="button"]').attr('disabled', true);
            },
            success: function (data) {
                if (data.code == 0) {
                    $("#ololo0").val('');
          $('.fileinput').fileinput('clear');
                } 
        
        $("#ajax_answer").html(data.msg);
        
            },
            error: function (xhr, ajaxOptions, thrownError) {
        $("#ajax_answer").html('<div class="alert alert-dismissable alert-danger" style="font-size: 50%"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Произошла ошибка при отправке сообщения:'+xhr.status+thrownError+'</b> Попробуйте еще раз.</div>');
            },
            complete: function (data) {
                $("#ololo0").removeAttr('disabled');
                $("#anon").find('button[type="button"]').removeAttr('disabled');
            }
    });
});
*/