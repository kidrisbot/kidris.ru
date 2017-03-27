$(function(){
    
    //Живой поиск
    $('#who_music').bind("change keyup input click", function() {
        if(this.value.length >= 2){
            $.ajax({
                type: 'post',
                url: "search_music.php", //Путь к обработчику
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

