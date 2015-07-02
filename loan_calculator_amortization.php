<?php
function customError($errno, $errstr) {
	echo "<b>Error:</b> [$errno] $errstr";
}

set_error_handler("customError");

$filename = $_SERVER["PHP_SELF"];

if(!$_POST) { ?>
<!DOCTYPE html>
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
<!-- insert content here -->

<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Loan calculator and Amortization</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="loan_amount">Loan Amount</label>
  <div class="controls">
    <input id="loan_amount" name="loan_amount" type="text" placeholder="5000.00" class="input-medium">
    <p class="help-block">help</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="loan_term_yrs">Loan Term (Months)</label>
  <div class="controls">
    <input id="loan_term_yrs" name="loan_term_yrs" type="text" placeholder="60" class="input-small">
    <p class="help-block">help</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="start_date">Loan Start Date</label>
  <div class="controls">
    <input id="start_date" name="start_date" type="text" placeholder="December 12, 2015" class="input-large">
    <p class="help-block">help</p>
  </div>
</div>

</fieldset>
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