$(document).ready(function()
{
	var nameid;
	$(document).on('click','.repear',function(){
		var name = $(this).attr('name');
		console.log(name);
		$.get('getAnser/'+name,function(data)
		{
			$('#contentof'+name+'').text(data.toUpperCase());
		})
	});

	$(document).on('click','.save',function(){
	var id = $(this).attr('name');
	var name = $('#contentof'+id+'').val();
	var socau = $('#showcontent'+id+'').attr('name');
	$.get('setAnser/'+id+'/'+name,function(data3){
		var data = JSON.parse(data3);
		alert(data.message);
		if(data.success==true)
		{
			var anser = data.respond;
			$('#showcontent'+id+'').text('Câu'+socau+':'+anser.toUpperCase());
		}
		})
	});

	$(document).on('click','.delete',function(){
		nameid= $(this).attr('name');
	});

	$(document).on('click','.alert_delete',function(){
		var id = $(this).attr('name');
		$.get('deleteAnser/'+id,function(data){
			var data = JSON.parse(data);
			alert(data.message);
			if(data.success)
			{
				$('#'+nameid).hide();
			}
		})
	});
});


