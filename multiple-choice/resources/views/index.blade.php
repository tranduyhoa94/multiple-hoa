<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Target Material Design Bootstrap Admin Template</title>
     <!-- VENDOR CSS -->
	<link rel="stylesheet" href="templates/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="templates/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="templates/assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="templates/assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="templates/assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="templates/assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="templates/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="templates/assets/img/favicon.png">

   </head>
   <body>
      <div id="app"></div>
      <!-- /. WRAPPER  -->
      <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
      <!-- JS Scripts-->
      <!-- jQuery Js -->
      <script src="{!! asset('templates/assets/vendor/jquery/jquery.min.js') !!}"></script>
      <!-- Bootstrap Js -->
      <script src="{!! asset('templates/assets/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
      <script src="{!! asset('templates/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') !!}"></script>
      <!-- Metis Menu Js -->
      <script src="{!! asset('templates/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') !!}"></script>
      <!-- Morris Chart Js -->
      <script src="{!! asset('templates/assets/vendor/chartist/js/chartist.min.js') !!}"></script>
      <script src="{!! asset('templates/assets/scripts/klorofil-common.js') !!}"></script>
   </body>
</html>