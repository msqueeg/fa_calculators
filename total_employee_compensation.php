<?php
function customError($errno, $errstr) {
	echo "<b>Error:</b> [$errno] $errstr";
}

set_error_handler("customError");

$filename = $_SERVER["PHP_SELF"];

if(!$_POST) { ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Calculator</title>
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
<div class="container-fluid fuelux">
	<div class="row">
		<form class="form-horizontal" method="post" action="<?= $filename ?>">
			<fieldset>

				<legend>Income</legend>

				<div class="form-group">
				  <label class="col-md-4 control-label" for="gross_annual_income">Gross Annual Income</label>  
				  <div class="col-md-4">
				  <input id="gross_annual_income" name="gross_annual_income" type="text" placeholder="($)" class="form-control input-md" required="">
				  <span class="help-block">enter your gross annual income</span>  
				  </div>
				</div>

				<div class="form-group">
				  <label class="col-md-4 control-label" for="daily_wage">Daily Wage</label>  
				  <div class="col-md-4">
				  <input id="daily_wage" name="daily_wage" type="text" placeholder="($)" class="form-control input-md">
				  <span class="help-block">used for calculating the value of time-off benefits. Auto-calculated based on gross annual income. Override if necessary.</span>  
				  </div>
				</div>

			</fieldset>

			<fieldset>

				<legend>Time Off Benefits</legend>

				<div class="form-group">
					<label class="col-md-4 control-label" for="vacation">Vacation Days / year</label>
					<div class="col-md-4">
						<input id="vacation" name="vacation" type="number" placeholder="(0 to 365)" class="form-control input-md">
						<span class="help-block">enter the whole days of vacation per year</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="holidays">Paid holidays / year</label>
					<div class="col-md-4">
						<input id="holidays" name="holidays" type="number" placeholder="(0 to 365)" class="form-control input-md">
						<span class="help-block">enter the whole days of holidays per year</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="pto">Personal &amp; sick days / year</label>
					<div class="col-md-4">
						<input id="pto" name="pto" type="number" placeholder="(0 to 365)" class="form-control input-md">
						<span class="help-block">enter the whole days of personal and/or sick days per year</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="break_min">Break Minutes / day</label>
					<div class="col-md-4">
						<input id="break_min" name="break_min" type="number" placeholder="(0 to 360)" class="form-control input-md">
						<span class="help-block">enter the number of minutes of break time per work day</span>
					</div>
				</div>

			</fieldset>

			<fieldset>
	
				<legend>Government Benefits</legend>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="workers_comp">Worker's Compensation (percentage of Salary)</label>
					<div class="col-md-4">
						<input id="workers_comp" name="workers_comp" type="number" placeholder="(%)" class="form-control input-md">
						<span class="help-block">0% to 100%</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="unemployment">Unemployment Insurance / year</label>
					<div class="col-md-4">
						<input id="unemployment" name="unemployment" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

			</fieldset>

			<fieldset>

				<legend>Insurance Benefits</legend>

				<div class="form-group">
					<label class="col-md-4 control-label" for="medical">Medical / month</label>
					<div class="col-md-4">
						<input id="medical" name="medical" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="life">Life Insurance / month</label>
					<div class="col-md-4">
						<input id="life" name="life" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="disability">Disability / month</label>
					<div class="col-md-4">
						<input id="disability" name="disability" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="dental">Dental / month</label>
					<div class="col-md-4">
						<input id="dental" name="dental" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="supplemental">Supplemental / month</label>
					<div class="col-md-4">
						<input id="supplemental" name="supplemental" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="other">Other / month</label>
					<div class="col-md-4">
						<input id="other" name="other" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

			</fieldset>

			<fieldset>

				<legend>Annual Retirement Benefits</legend>

				<div class="form-group">
					<label class="col-md-4 control-label" for="retire_401k">401(k)/403(b)/Other employer contribution (percentage of salary)</label>
					<div class="col-md-4">
						<input id="retire_401k" name="retire_401k" type="number" placeholder="(%)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="retire_employer">Retirement account employer contributions / year</label>
					<div class="col-md-4">
						<input id="retire_employer" name="retire_employer" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

			</fieldset>

			<fieldset>

				<legend>Other Monthly Fringe Benefits</legend>

				<div class="form-group">
					<label class="col-md-4 control-label" for="parking">Parking</label>
					<div class="col-md-4">
						<input id="parking" name="parking" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="tuition">CE / Tuition</label>
					<div class="col-md-4">
						<input id="tuition" name="tuition" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label" for="gym">Gym Membership</label>
					<div class="col-md-4">
						<input id="gym" name="gym" type="number" placeholder="($)" class="form-control input-md">
						<span class="help-block">help</span>
					</div>
				</div>

			</fieldset>

			<fieldset>

				<!-- Button (Double) -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="submit">Calculate your Total Employee Compensation</label>
			  <div class="col-md-8">
			    <button id="submit" name="submit" class="btn btn-success">View Total Compensation</button>
			    <button id="cancel" name="cancel" class="btn btn-danger">Clear the Form</button>
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

/*
	protected $gross_annual_income;
	protected $daily_wage;
	protected $vacation;
	protected $holidays;
	protected $pto;
	protected $break_min;
	protected $workers_comp;
	protected $unemployment;
	protected $medical;
	protected $life;
	protected $disability;
	protected $dental;
	protected $supplemental;
	protected $other;
	protected $retire_401k;
	protected $retire_employer;
	protected $parking;
	protected $tuition;
	protected $gym;
*/

	} else {
				$formatter = new \NumberFormatter('en_US', \NumberFormatter::PERCENT);
				$gross_annual_income = $_POST['gross_annual_income'];
				$daily_wage = (int) ($_POST['daily_wage'] ?:$gross_annual_income / 260);
				
				$vacation = $_POST['vacation'];
				$vacation_value = $vacation * $daily_wage;
				$vacation_pct = $vacation_value / $gross_annual_income;

				$holidays = $_POST['holidays'] ?: 7;

				$pto = $_POST['pto'] ?: 14;

				$break_min = $_POST['break_min'] ?: 20;

				$workers_comp = $_POST['workers_comp'] ?: .15;
				$workers_comp_value = $gross_annual_income * $workers_comp;

				$unemployment = $_POST['unemployment'] ?: 7;

				$medical = $_POST['medical'] ?: 7;
				$medical_yearly = $medical * 12;

				$life = $_POST['life'] ?: 7;
				$life_yearly = $life * 12;

				$disability = $_POST['disability'] ?: 7;
				$disability_yearly = $disability * 12;

				$dental = $_POST['dental'] ?: 7;
				$dental_yearly = $dental * 12;

				$supplemental = $_POST['supplemental'] ?: 7;
				$supplemental_yearly = $supplemental * 12;

				$other = $_POST['other'] ?: 7;
				$other_yearly = $other * 12;

				$retire_401k = $_POST['retire_401k'] ?: .03;
				$retire_401k_value = $gross_annual_income * $retire_401k;

				$retire_employer = $_POST['retire_employer'] ?: 7;

				$parking = $_POST['parking'] ?: 7;

				$tuition = $_POST['tuition'] ?: 7;

				$gym = $_POST['gym'] ?: 7;

				$total = $workers_comp_value + $unemployment + $medical_yearly + $life_yearly + $disability_yearly + $dental_yearly + $supplemental_yearly + $other_yearly + $retire_401k_value + $retire_employer + $parking + $tuition + $gym;
				$total_pct = $total / $gross_annual_income;

		echo "
		In addition to your salary, your employer pays $".$total." in benefits comprising ".$formatter->format($total_pct)." of your salary.
		<ul>
		<li>Gross Annual Income: ".$gross_annual_income."</li>
		<li>Daily Wage : ".$daily_wage."</li>
		<li>Vacation Days Per Year : ".$vacation."</li>
		<li>Value of Vacation Days : ".$vacation_value."</li>
		<li> Pct of Salary : ".$formatter->format($vacation_pct)."</li>
		<li> Holidays : ".$holidays."</li>
		<li> Sick Days : ".$pto."</li>
		<li> Break Minutes : ".$break_min."</li>
		<li> Worker's Comp : ".$workers_comp."</li>
		<li> Unemployment : ".$unemployment."</li>
		<li> Medical : ".$medical."</li>
		<li> Life Insurance : ".$life."</li>
		<li> Disability : ".$disability."</li>
		<li> Dental : ".$dental."</li>
		<li> Supplemental : ".$supplemental."</li>
		<li> Other Insurance : ".$other."</li>
		<li> Retirement : ".$formatter->format($retire_401k)."</li>
		<li> Retirement Other ".$retire_employer."</li>
		<li> Parking : ".$parking."</li>
		<li> Supplemental : ".$tuition."</li>
		<li> Gym : ".$gym."</li>
		</ul>
		";


}