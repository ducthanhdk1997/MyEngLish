$(document).ready(function(){
	var nameid;
	$(document).on('click','.repear',function(){
		var name = $(this).attr('name');
		$.get('getNameGroup/'+name,function(data)
		{
			$('#contentof'+name+'').text(data);
		})
	});

	$(document).on('click','.save',function(){
	var id = $(this).attr('name');
	var name = $('#contentof'+id+'').val();
	$.get('setNameGroup/'+id+'/'+name,function(data3){
		var data = JSON.parse(data3);
		alert(data.message);
		if(data.success==true)
		{
			$('#showcontent'+id+'').text(data.respond+'');
		}
		})
	});

	$(document).on('click','.delete',function(){
		nameid= $(this).attr('name');
	})

	$(document).on('click','.alert_delete',function(){
	var id = $(this).attr('name');
	$.get('deleteGroup/'+id,function(data){
		var data = JSON.parse(data);
		alert(data.message);
		if(data.success)
		{
			$('#'+nameid).hide();
		}

		})
	});
});