$(document).ready(function(){
	$('.content').hide();
	$('.dong').hide();
	$('.xem').click(function(){

		var name = $(this).attr('name');
		$('#dong'+name+'').show();
		$(this).hide();
		$('#'+name).show();
	});

	$('.dong').click(function(){
		$(this).hide();
		var name = $(this).attr('name');
		$('#xem'+name+'').show();
		$('#'+name).hide();
	});
});