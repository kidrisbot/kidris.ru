 function GetAnswer(){
    $("#loading").show();
var arr = new Array(10);
arr[0] = $("#desc").val();
arr[1] = $("#hashtag").val();
arr[2] = $("#file").val();
    $.ajax({
      async: false,
      url: "api.php",
      type: "GET",
      data: {arr:arr},
   
      success: function(data){
        $(".result").html(data);
        $("#loading").hide();
      },
      error: function(){
        alert("error!");
        $("#loading").hide();
      }
    });
  }
