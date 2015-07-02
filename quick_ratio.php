<?php
function customError($errno, $errstr) {
	echo "<b>Error:</b> [$errno] $errstr";
}

set_error_handler("customError");

$filename = $_SERVER["PHP_SELF"];

$formatter = new \NumberFormatter('en_US', \NumberFormatter::PERCENT);

//custom functions:

function gcd($a, $b) {
    $_a = abs($a);
    $_b = abs($b);

    while ($_b != 0) {
        $remainder = $_a % $_b;
        $_a = $_b;
        $_b = $remainder;
    }

    return $a;
}

function percent_ratio($a,$b) {
	return $formatter->format($a/$b);
}

function quick_ratio($assets,$liabilities,$inventory)
{
	$a = $assets - $inventory;
    $c = gcd($a,$liabilities);

    return number_format((float)$liabilities/$c, 2, '.', '') . ':' . $a/$c;
}

if(!$_POST) { ?>
<!DOCTYPE html>
<html>
<head>
	<title>current ratio calculator</title>
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
	<fieldset>

	    <!-- Form Name -->
	    <legend>Acid Test Ratio Calculator</legend>

	    <!-- Text input-->
	    <div class="control-group">
	      <label class="control-label" for="assets">Your Current Assets</label>
	      <div class="controls">
	        <input id="assets" name="assets" type="text" placeholder="($)" class="input-large">
	        <p class="help-block">help</p>
	      </div>
	    </div>

		<!-- Text input-->
	    <div class="control-group">
	      <label class="control-label" for="liabilities">Your Current Inventory</label>
	      <div class="controls">
	        <input id="liabilities" name="liabilities" type="text" placeholder="($)" class="input-large">
	        <p class="help-block">help</p>
	      </div>
	    </div>


	    <!-- Text input-->
	    <div class="control-group">
	      <label class="control-label" for="liabilities">Your Current Liabilities</label>
	      <div class="controls">
	        <input id="liabilities" name="liabilities" type="text" placeholder="($)" class="input-large">
	        <p class="help-block">help</p>
	      </div>
	    </div>

	    <!-- Button -->
	    <div class="control-group">
	      <label class="control-label" for="submit">Calculate Your Current Ratio</label>
	      <div class="controls">
	        <button id="submit" name="submit" class="btn btn-success">Calculate</button>
	      </div>
	    </div>

    </fieldset>
</form>
</div>
 <div class="row">
        <p>You'll find the numbers you need to calculate your company's current ratio on the balance sheet of your latest financial statement.</p>
        <ol>
            <li>Enter your total current assets.</li>
            <li>Enter your total current liabilities</li>
            <li>Press "calculate"</li>
        </ol>
        <p>Now you know where you stand and have a basis for comparison with previous years. Changes in a company's current ratio over a period of years can point out problems and successes. A declining current ratio could be pointing to financial
        problems. An improving ratio could be the result of a brighter financial picture or an overstocked warehouse (inventory is considered an asset). The key here is to find out why a ratio has changed. fullyaccountable.com can help.</p>
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
	$assets = $_POST['assets'];
	$liabilities = $_POST['liabilities'];
	$inventory = $POST['inventory'];
	echo quick_ratio($liabilities,$assets, $inventory);

}
