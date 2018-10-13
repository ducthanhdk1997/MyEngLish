$(document).ready(function(){

	$('.warning-content').hide();
	$('#group_class').change(function()
	{
		var IDGroup = $(this).val();
		$.get('/TTCM/Admin/classofassign/'+IDGroup,function(data){
			$('.list_class').html(data);
		})
	})

	$('#submit_form').click(function(){
		var content = $('#comment').val();
		
		if(content =='')
		{
			$('.warning-content').show();
			return false;
		}
	})
	
		
	


})