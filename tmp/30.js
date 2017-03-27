$(function(){
	$('.form-background').submit(function(e){
		e.preventDefault();
		
		var $input = $(this).children(".uploadimage");
		var fd = new FormData;
		fd.append('img',$input.prop('files')[0]);
		fd.append('do','background');
		fd.append('group_id',$(this).children("#backgroundSetIdGroup").val());
		
		
		$.ajax({
			url:'http://kidris.ru/dash',
			data:fd,
			processData:false,
			contentType:false,
			type:'POST',
			success:function(data){
				alert(data);
			}
		});
	});
});