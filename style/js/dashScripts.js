function background(groupId) {
	background = $('#group_fon'+groupId).val();
	
	if ($("#background_block").prop("checked")) {
		block = 1;
	} else {
		block = 0;
	}
	
    $.post("/dash",
        {
            do: 'background',
            group_id: groupId,
			background_url: background,
			show_block: block
        }).done(function(data) {
            location.reload();
        });
        text = $('#group_text'+groupId).val();
    $.post("/dash",
        {
            do: 'descrip',
            group_id: groupId,
			group_text: text
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

function next(groupId) {
    $.post("/stats",
        {
            do: 'next',
            group_id: groupId
        }).done(function(data) {
            location.reload();
        });
}
function previous(groupId) {
    $.post("/stats",
        {
            do: 'previous',
            group_id: groupId
        }).done(function(data) {
            location.reload();
        });
}
function banned(groupId) {
    $.post("/stats",
        {
            do: 'banned',
            group_id: groupId
        }).done(function(data) {
            location.reload();
        });
}

