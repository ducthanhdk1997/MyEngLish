$(document).ready(function(){
	$('.alert-email').hide();
	$('.alert-name').hide();
	$('.submit').click(function(){
		$('.alert-email').hide();
		$('.alert-name').hide();
		var email = $('#email').val();
		var name = $('#name').val();
		


		var checkError=0;
		if(name =='')
		{
			$('.alert-name').show();
			checkError=1;
		}
		if(email=='')
		{
			$('.alert-email').show();
			checkError=1;
		}
		return checkError==0;


	});

	$('#upimage').change(function(){
		var files = document.getElementById('upimage').files;
        var avatar = files[0];
        var data = new FormData();
        data.append('avatar', avatar);
        $.ajax({
            url: "/TTCM/Admin/Profile/Ajax",
            processData: false,
            contentType: false,
            data,
            type: 'post',
            success: function(data2) {
                var data2 = JSON.parse(data2);
                if (data2.success) {
                	alert('Avatar đã được cập nhật thành công!');
                	location.reload();
                } else alert(data2.message);
            }
        });

	});
})