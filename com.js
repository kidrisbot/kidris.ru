function openbox(id, addid){
  display = document.getElementById(id).style.display;
  classs = document.getElementById(addid).class;

  if(display=='none'){
   document.getElementById(id).style.display='block';
   document.getElementById(addid).className  = 'btn btn-warning';
 }else{
   document.getElementById(id).style.display='none';
   document.getElementById(addid).className  = 'btn btn-default';
 }
}
  function run2() {
    var count_vid = Number($('input:checkbox:checked').length); //<h4 class="modal-title" id="memberModalLabel">The attachment of the poll64010</h4>
    if ( count_vid == 2 ) { $("#memberModalLabel").attr("disabled"); 
      $("input:checkbox").attr("disabled", true); 
      $("input:checkbox:checked").attr("disabled", false); 
    }
    alert(count_vid);
  }
    
$(document).ready(function () {

  $('#memberModal').modal('hide');
   var count_id = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
  //работа с видео

 
  //$('#captcha').click(function() {$('#memberModal').modal('hide')});
  //работа с фото, если фото есть то идет айди, для счетчика можно
   $('.photofile').change(function(){
    var c =count_id[this.id];
    if (this.name == 'image')
    if (c == 2) { alert('Лимит!')}
    else {c = c+1;}
      console.log(this);
      alert(c)
  });
  
  //работа с опросом
  var index = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];
  $('.delinterview').click(function()
  {
    var id = this.id.split('_');
    index[id[2]]=1;
    $("#interview-" + id[1]).hide();
    $("#tab_logic_" + id[2]).html('<tbody><tr id="ques"><td>Вопрос:</td><td><input type="text" name="ques" id="ques" placeholder="Введите вопрос..." class="form-control"></td></tr><tr id="addr_' + id[1] + '_0"><td>1 </td><td><input type="text" name="name[]" id="name[]" class="form-control"></td></tr><tr id="addr_' + id[1] + '_1"></tr></tbody> ');
  });
  $('.add_row').click(function()
  {
    var id = this.id.split('_');
    if (index[id[2]]<10) 
    {
      $('#addr_' + id[1] + '_' + index[id[2]]).html("<td>"+ (index[id[2]]+1) +"</td>       <td><input name='name[]'  id='name[]'  type='text'  class='form-control input-md'  /> </td>   ");  
      $('#tab_logic_'+id[2]).append('<tr id="addr_'+ id[1] +'_'+(index[id[2]]+1)+'"></tr>');
      index[id[2]]++;
      if (index[id[2]]==10) $( "#"+id[0]+"_"+id[1]+"_"+id[2] ).attr( "disabled", true );
    } 
  });
  $('.delete_row').click(function(){
    var id = this.id.split('_');
    if(index[id[2]]>1){
      $("#addr_"+ id[1] + '_' + (index[id[2]]-1)).html('');
      index[id[2]]--;
    }
  });




});
$('#captcha').click(function(){
    var captcha = grecaptcha.getResponse();
$('#captcha').attr('id', 'value');
     $.ajax({
    url: 'api',
   dataType: 'json',
    data: {captcha:captcha},
    success: function(result) {
      if (result.code == 1) {
        $('#memberModal').modal('hide');
      }
      if (result.code == 2) {
          alert('Обновите страницу');
      }
    },
    error: function() {
      alert('Попробуйте нажать еще раз)');
    }

});
     });
 $('.ajax').click(function(){
  var id = this.id;
  var message = $("#ololo"+id).val();
    $.ajax({ dataType: 'json',
      data: {message:message, id:id},
      success: function(data){
      //  if (data.id == 2) { }
        $('.result-'+id).html(result);
          
          
      },
    error: function() {
        

    }});
    $('.result-'+id).html('<div class="callout callout-success"> <h4>Отправлено!</h4></div>');
    
  });

// $('.ajax').click(function(){
//  // var photo =  $("#fileinput_"+id).val(); ///КАК??????
//   $.ajax({
//     dataType: 'json',
//     data: {message:message},
//     success: function(result) {
//         // if (result.code == 0) {
//         //         $("#ololo"+id).val('');
//         //         $('.fileinput').fileinput('clear');
//         //       } 
//         //       $("#ololo"+id).val('');
//         //       $('.fileinput').fileinput('clear');
//         //       $('.ajax-content').html(result);
//         //    //  $(".ajax-content").html(result.msg);
//         //    $("#ololo"+id).attr('disabled', false);
//         //    $("#"+id).find('button[type="button"]').attr('disabled', false);
//         // 
//         // $("#ololo"+id).attr('disabled', false);
//         // $('#'+id).attr('disabled', false);
//         // $('#fileinput_'+id).fileinput('clear');
//       }
  
//     });
  
// });





$(function(){
    
    //Живой поиск
    $('#who_music').bind("change keyup input click", function() {
        if(this.value.length >= 2){
            $.ajax({
                type: 'post',
                url: "http://kidris.ru/search_music.php", //Путь к обработчику
                data: {'music':this.value},
                response: 'text',
                success: function(data){
                    $("#search_result_music").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
        }
    })
    
    $("#search_result_music").hover(function(){
        $("#who_music").blur(); //Убираем фокус с input
    })
    
    //При выборе результата поиска, прячем список и заносим выбранный результат в input
    $("#search_result_music").on("click", "li", function(){
        s_user = $(this).text();
        //$(".who_music").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
        $("#search_result_music").fadeOut();
    })

});
$(function(){
    
    //Живой поиск
    $('#who_film').bind("change keyup input click", function() {
        if(this.value.length >= 2){
            $.ajax({
                type: 'post',
                url: "search.php", //Путь к обработчику
                data: {'film':this.value},
                response: 'text',
                success: function(data){
                    $("#search_result_film").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
        }
    })
    
    $("#search_result_film").hover(function(){
        $("#who_film").blur(); //Убираем фокус с input
    })
    
    //При выборе результата поиска, прячем список и заносим выбранный результат в input
    $("#search_result_film").on("click", "li", function(){
        s_user = $(this).text();
        //$(".who_film").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
        $("#search_result_film").fadeOut();
    })

});
