<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="APPIINO - Admin Panel" name="description">
		<meta content="infodat" name="author">
		<meta name="keywords" content="APPIINOadmin panel"/>
		@include('admin.layouts.custom-head')
	</head>
	<body class="h-100vh" style="background-color: #4EC3CC">
	<div class="box">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>
		@yield('content')
		@include('admin.layouts.custom-footer-scripts')
	</body>
</html>
