$(document).ready(function(){

	$('#group_class').change(function()
	{
		var IDGroup = $(this).val();
		var IDStyle = $('#style_exer').val();
		
		$.get('classofassign/'+IDGroup,function(data){
			$('.list_class').html(data);
			$('.editcontent').hide();
		})

		$.get('exerofassign/'+IDStyle+'/'+IDGroup,function(data2){
			
			$('#exer').html(data2);
			// $('.editcontent').hide();
		})
	})

	$('#style_exer').change(function(){
		var IDStyle = $(this).val();
		var IDGroup = $('#group_class').val();

		$.get('exerofassign/'+IDStyle+'/'+IDGroup,function(data2){

			$('#exer').html(data2);
			// $('.editcontent').hide();
		})
	})
})