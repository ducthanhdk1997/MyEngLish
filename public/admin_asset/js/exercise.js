$(document).ready(function(){
	$('#nop').click(function()
	{
		var sophan = $(".panel-default:last").attr('id');
		for(var i=1;i<=sophan;i++)
		{
			var socau = 0;
			var maxtrai = $('#phan'+i+'left'+' '+'.cautrai:last').attr('name');
			var maxphai = $('#phan'+i+'right'+' '+'.cauphai:last').attr('name');

			if(maxtrai>maxphai)
			{
				 socau = maxtrai;

			}
			else{
				 socau=maxphai;
			}
			for(var j = 1;j<=socau;j++)
			{
				var checkcau=0;
				if($('#cau-'+j+'-'+'a'+'-'+i+'').is(':checked')) 
				{ 
				continue;
				}
				else{
					checkcau=checkcau+1;
				}

				if($('#cau-'+j+'-'+'b'+'-'+i+'').is(':checked')) 
				{ 
				continue;
				}
				else{
					checkcau=checkcau+1;
				}

				if($('#cau-'+j+'-'+'c'+'-'+i+'').is(':checked')) 
				{ 
				continue;
				}
				else{
					checkcau=checkcau+1;
				}

				if($('#cau-'+j+'-'+'d'+'-'+i+'').is(':checked')) 
				{ 
				continue;
				}
				else{
					checkcau=checkcau+1;
				}
				if(checkcau==4)
				{
					alert('Câu thứ '+j+' của phần '+i+' chưa được chọn');
						return false;
				}

				
				
			}

		}
		

	})
	
});