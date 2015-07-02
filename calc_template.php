<?php
function customError($errno, $errstr) {
	echo "<b>Error:</b> [$errno] $errstr";
}

set_error_handler("customError");

$filename = $_SERVER["PHP_SELF"];

if(!$_POST) { ?>
<<!DOCTYPE html>
<html>
<head>
	<title>Calculator Name</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<!-- FuelUX library-->
	<link href="//www.fuelcdn.com/fuelux/3.6.3/css/fuelux.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
<div class="row">
<form class="form-horizontal" method="post" action="<?= $filename ?>">
<!-- insert content here -->

</form>
</div>
</div>
<!-- jQuery minified -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- FuelUX library js -->
<script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
</body>
</html>

<?php

} else {

	//insert postback goodness here
}