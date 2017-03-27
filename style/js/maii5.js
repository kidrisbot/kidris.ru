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
					$("#message").removeAttr('disabled');
					$('.fileinput').fileinput('clear');
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
	return false;
});