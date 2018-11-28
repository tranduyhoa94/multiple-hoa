<?php
	$token = $data['access_token'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ config('app.name') }}</title>
	<script>
	    window.opener.postMessage({ token: "{{ $token }}" }, "{{ url('/') }}")
	    window.close()
	</script>
</head>
<body>
</body>
</html>