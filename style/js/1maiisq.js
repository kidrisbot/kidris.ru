function background(groupId) {
	background = $('#'+groupId).val();
    $.post("/dash",
        {
            do: 'background',
            group_id: groupId,
			background_url: background
        }).done(function(data) {
            location.reload();
        });
}
function descrip(groupId) {
	descrip = $('#'+groupId).val();
    $.post("/dash",
        {
            do: 'descrip',
            group_id: groupId,
			backgroun_url: descrip
        }).done(function(data) {
            location.reload();
        });
}
function connectGroup(groupId) {
    $.post("/dash",
        {
            do: 'connect',
            group_id: groupId
        }).done(function(data) {
                location.reload();
        });
}

function disconnectGroup(groupId) {
    $.post("/dash",
        {
            do: 'disconnect',
            group_id: groupId
        }).done(function(data) {
            location.reload();
        });
}

$(document).ready(function () {
    $("#ask").ajaxForm({
            dataType: 'json',
            beforeSend: function () {
                $("#message").attr('disabled', true);
                $("#ask").find('button[type="submit"]').attr('disabled', true);
            },
            success: function (data) {
                if (data.code == 0) {
                    $("#message").val('');
					
                } 
				
				$("#ajax_answer").html(data.msg);
				$("#token").val(data.token);
            },
            error: function (xhr, ajaxOptions, thrownError) {
				$("#ajax_answer").html('<div class="alert alert-dismissable alert-danger" style="font-size: 50%"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Произошла ошибка при отправке сообщения:'+xhr.status+thrownError+'</b> Попробуйте еще раз.</div>');
            },
            complete: function (data) {
                $("#message").removeAttr('disabled');
                $("#ask").find('button[type="submit"]').removeAttr('disabled');
            }
    });
	
	$("#polls").ajaxForm({
                dataType: 'json',
            beforeSend: function () {
                $(".win_input").attr('disabled', true);
				$("#attach_polls").attr('disabled', true);
            },
            success: function (data) {
                if (data.code == 0) {
					$("#attach_polls_id").val(data.polls_id);
                    $("#ajax_answer_polls").html(data.msg);
					$("#attach_polls_on").hide()
					$("#attach_polls_off").show()
                } else {
					$(".win_input").removeAttr('disabled');
					$("#attach_polls").removeAttr('disabled');
				}
				
				$("#ajax_answer_polls").html(data.msg);
				$("#token").val(data.token);
            },
            error: function (xhr, ajaxOptions, thrownError) {
				$("#ajax_answer_polls").html('<div class="alert alert-dismissable alert-danger" style="font-size: 100%"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Произошла ошибка при создании вопроса:'+xhr.status+thrownError+'</b> Попробуйте еще раз.</div>');
            },
            complete: function (data) {
                
            }
    });
	
	return false;
});

function show(state)
{
	document.getElementById('window').style.display = state;
	document.getElementById('wrap').style.display = state;
}

function attach_delete_polls() {
	$("#attach_polls_on").show()
	$("#attach_polls_off").hide()
	
	$(".win_input").removeAttr('disabled');
	$("#attach_polls").removeAttr('disabled');
	
	$("#attach_polls_id").val('');
	
	$(".win_input").val('');
	$("#attach_polls_id").val('');
	
	$("#ajax_answer_polls").html('');
}
(function($) {

	$.fn.charCount = function(options){
	  
		// default configuration properties
		var defaults = {	
			allowed: 140,		
			warning: 25,
			css: 'counter',
			counterElement: 'span',
			cssWarning: 'warning',
			cssExceeded: 'exceeded',
			counterText: ''
		}; 
			
		var options = $.extend(defaults, options); 
		
		function calculate(obj){
			var count = $(obj).val().length;
			var available = options.allowed - count;
			if(available <= options.warning && available >= 0){
				$(obj).next().addClass(options.cssWarning);
			} else {
				$(obj).next().removeClass(options.cssWarning);
			}
			if(available < 0){
				$(obj).next().addClass(options.cssExceeded);
			} else {
				$(obj).next().removeClass(options.cssExceeded);
			}
			$(obj).next().html(options.counterText + available);
		};
				
		this.each(function() {  			
			$(this).after('<'+ options.counterElement +' class="' + options.css + '">'+ options.counterText +'</'+ options.counterElement +'>');
			calculate(this);
			$(this).keyup(function(){calculate(this)});
			$(this).change(function(){calculate(this)});
		});
	  
	};

})(jQuery);

(function($) { $(document).ready(function(){	
		
		$("#message").charCount({
			allowed: 700,		
			warning: 100,
			counterText: 'Символов осталось: '	
		});
	});
                    }) (jQuery);