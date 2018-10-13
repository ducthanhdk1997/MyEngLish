$(document).ready(function(){

	$('.warning-user').hide();
	$('.warning-pass').hide();
	$('#group_class').change(function()
	{
		var IDGroup = $(this).val();
		$.get('/TTCM/Admin/classofassign/'+IDGroup,function(data){
			$('.list_class').html(data);
		})
	})

	$('#submit_form').click(function(){
		var username = $('#username').val();
		var password = $('#password').val();
		if(username =='')
		{
			$('.warning-user').show();
			return false;
		}
		if(password =='')
		{
			$('.warning-pass').show();
			return false;
		}
	})
	
		
	


})