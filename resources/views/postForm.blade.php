<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="{{route('postForm')}}" method="POST">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<input type="text" name="hoten">
		<input type="submit">
	</form>
</body>
</html>