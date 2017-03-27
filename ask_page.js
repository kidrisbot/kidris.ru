function run2() {
 var count_vid = Number($('input:checkbox:checked').length);
   $('#ololo_vid').val(count_vid);
   
   if (Number($("#ololo_mus").val()) =='') { var count_mus = 0;}
   else { var count_mus = Number($("#ololo_mus").val()); }
   if (Number($("#ololo_opr").val()) =='') { var count_opr = 0;}
   else { var count_opr = Number($("#ololo_opr").val()); }
   if (Number($("#ololo_photo").val()) =='') { var count_photo = 0;}
   else { var count_photo = Number($("#ololo_photo").val()); }
   cout_all=count_vid+count_mus+count_opr+count_photo;
   var ololo_opr = Number($("#ololo_mus").val());
 if (count_vid>=10 || cout_all>=10) { 
  $("#result").html("Куда больше 10 приклеплений?");
  $('#confirm').prop('disabled', true);
 }
else {
    $('#confirm').prop('disabled', false);
   $("#result").html("");
  $('#advid').html(        "<td>"+ count_vid +" <i class='glyphicon glyphicon-film'></i></td>       <td></td>   "        );
      $('#tab_logic2').append('<tr id="ad'+(1+1)+'"></tr>');
}
 
}
  function run() {
    var i = 1;
    var count_music = Number($("#search_result_mu :selected").length);
    $('#ololo_mus').val(count_music);
     if (Number($("#ololo_vid").val()) =='') { var count_vid = 0;}
   else { var count_vid = Number($("#ololo_vid").val()); }
   if (Number($("#ololo_opr").val()) =='') { var count_opr = 0;}
   else { var count_opr = Number($("#ololo_opr").val()); }
   if (Number($("#ololo_photo").val()) =='') { var count_photo = 0;}
   else { var count_photo = Number($("#ololo_photo").val()); }
   cout_all=count_vid+count_music+count_opr+count_photo;

if (count_music>=10 || cout_all>=10) { 
  $("#result").html("Куда больше 10 приклеплений?");
 $('#confirm').prop('disabled', true);
 }
else {
  $("#result").html("");
  $('#confirm').prop('disabled', false);
   $('#ad'+i).html(        "<td>"+ count_music +" <i class='glyphicon glyphicon-music'></i></td>       <td>"+$("#search_result_mu :selected").text()+" </td>   "        );
      $('#tab_logic2').append('<tr id="ad'+(1+1)+'"></tr>');
      i++; 
    }


};
        
             $(document).ready(function(){
   
      var i=1;

      $('#ques').on('change', function ()
    {   
      if (($('#ques').val() == '')) {
       //$("#result").append(" ");
       if (($('#name1').val() == '')) {
          $('#adop').html( "<td> <i class='glyphicon glyphicon-list'></i></td>       <td> опрос </td>");
          var count_opr = 1;
    $('#ololo_opr').val(count_opr);
     if (Number($("#ololo_vid").val()) =='') { var count_vid = 0;}
   else { var count_vid = Number($("#ololo_vid").val()); }
   if (Number($("#ololo_mus").val()) =='') { var count_mus = 0;}
   else { var count_mus = Number($("#ololo_mus").val()); }
   if (Number($("#ololo_photo").val()) =='') { var count_photo = 0;}
   else { var count_photo = Number($("#ololo_photo").val()); }
   cout_all=count_vid+count_mus+count_opr+count_photo;
        //  $('#tab_logic2').append('<tr id="ad'+(1+1)+'"></tr>');
        if (cout_all>=10) { 
  $("#result").html("Куда больше 10 приклеплений?");
 $('#confirm').prop('disabled', true);
 } else {$('#confirm').prop('disabled', false);}
       }
     }
    });
     
     $("#add_row").click(function(){
      if (i<10) { 
        
      $('#addr'+i).html(        "<td>"+ (i+1) +"</td>       <td><input name='name[]'  id='name[]'  type='text'  class='form-control input-md'  /> </td>   "
        );
      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
    }
  });
     $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
     });

});
$(document).ready(function()
{
    $('#basicUploadFile').on('change', function ()
    {   
        var count_photo = this.files.length ;
    $('#ololo_photo').val(count_photo);
     if (Number($("#ololo_vid").val()) =='') { var count_vid = 0;}
   else { var count_vid = Number($("#ololo_vid").val()); }
   if (Number($("#ololo_mus").val()) =='') { var count_mus = 0;}
   else { var count_mus = Number($("#ololo_mus").val()); }
   if (Number($("#ololo_opr").val()) =='') { var count_opr = 0;}
   else { var count_opr= Number($("#ololo_opr").val()); }
   cout_all=count_vid+count_mus+count_opr+count_photo;
        if (this.files.length >10 || cout_all>=10) {
         $('#result').append(' Куда больше 10 приклеплений?');
       $('#confirm').prop('disabled', true);}
         else {
          $('#confirm').prop('disabled', false);
           for (var i = 0; i < this.files.length; i++)
        {
            $('#result').append(this.files[i].name + '<br> ');
        } 
         }
        
    });
});