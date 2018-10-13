$(document).ready(function(){
	var nameid;
	$('.newstyle_exer').hide();

	// $(document).on('click','.btnNewStyle',function(){
	// 	$('.newstyle_exer').show();
	// 	$('.newStyle').html('<button type="button" class="btn btn-primary btnSavestyle">Thêm</button>');
	// })


	// $(document).on('click','.btnSavestyle',function(){
	// 	$('.newstyle_exer').hide();
	// 	$('.newStyle').html('<button type="button" class="btn btn-primary btnNewStyle">Thêm kiểu</button>');
	// })

	$(document).on('click','.repear',function(){
		var name = $(this).attr('name');
		$.get('getNameExer/'+name,function(data)
		{
			$('#contentof'+name+'').text(data);
		})
	});

	$('#group_class').change(function()
	{
		var IDGroup = $(this).val();
		var IDStyle = $('#style_exer').val();
		$.get('getexer/'+IDStyle+'/'+IDGroup,function(data){
			$('.list_exer').html(data);
			$('.editcontent').hide();
			$('.alert_dialog').hide();
		})

	})

	$('#style_exer').change(function(){
		var IDStyle = $(this).val();
		var IDGroup = $('#group_class').val();
		$.get('getexer/'+IDStyle+'/'+IDGroup,function(data2){
			$('.list_exer').html(data2);
			$('.editcontent').hide();
			$('.alert_dialog').hide();
		})
	})


	$(document).on('click','.save',function(){
	var id = $(this).attr('name');
	var name = $('#contentof'+id+'').val();
	$.get('setNameExer/'+id+'/'+name,function(data3){
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
	});

	$(document).on('click','.alert_delete',function(){
		var id = $(this).attr('name');
		$.get('deleteExer/'+id,function(data){
			var data = JSON.parse(data);
			alert(data.message);
			if(data.success)
			{
				$('#'+nameid).hide();
			}
		})
	});

	
})