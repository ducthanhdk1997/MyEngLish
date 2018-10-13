$(document).ready(function(){
	$('.editcontent').hide();
	$('.alert_dialog').hide();
	var name;
	var isCanel=1;
	var isXoa=1;
	$(document).on('click','.repear',function(){

		if(isCanel==1 )
		{
			name = $(this).attr('name');
			
			$('#showcontent'+name+'').hide();
			$('#dropdown'+name+'').hide();
			$('#editcontent'+name+'').show();
			$('.alert_dialog').hide();
			isCanel=0;
			isXoa=0;
		}
	})

	$(document).on('click','.cancel',function(){
		$('#showcontent'+name+'').show();
		$('#dropdown'+name+'').show();
		$('#editcontent'+name+'').hide();
		isCanel=1;
		isXoa=1;
	})

		$(document).on('click','.save',function(){
		$('#showcontent'+name+'').show();
		$('#dropdown'+name+'').show();
		$('#editcontent'+name+'').hide();
		isCanel=1;
		isXoa=1;
	})

	$(document).on('click','.delete',function(){
		if(isXoa==1)
		{
			var id = $(this).attr('name');
			// var id = $(this).attr('name');
			$('#alert'+id+'').show();
			$('#showcontent'+name+'').show();
			$('#dropdown'+name+'').show();
			$('#editcontent'+name+'').hide();
			isCanel=1;
			isXoa=0;
		}
	})

	$(document).on('click','.alert_cancel',function(){
		var id = $(this).attr('name');
		$('#alert'+id+'').hide();
		isXoa=1;
	})

	$(document).on('click','.alert_delete',function(){
		var id = $(this).attr('name');
		$('#alert'+id+'').hide();
		isXoa=1;
	})


})