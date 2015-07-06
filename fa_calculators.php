<?php
/*
Plugin Name: FA Calculators
Plugin URI: http://www.fullyaccountable.com
Description: This is a test plugin.
Author: Michael Miller
Author URI: http://michael-miller.org/
Version: 0.0.1

Test WordPress Plugin
Copyright (C) 2015 Michael Miller (millermichael76@gmail.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

$formatter = new \NumberFormatter('en_US', \NumberFormatter::PERCENT);

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

function liability_assets_ratio($a,$b)
{
    $c = gcd($a,$b);

    return number_format((float)$b/$c, 2, '.', '') . ':' . $a/$c;
}

function current_ratio_form() {
    echo '<form class="form-horizontal" method="post" action='.esc_url($_SERVER['REQUEST_URI']).'">';
    echo '<fieldset>';
    echo '<legend>Current Ratio Calculator</legend>';
    echo '<!-- Current Assets -->';
    echo '<div class="control-group">';
    echo '<label class="control-label" for="assets">Your Current Assets</label>';        
    echo '<div class="controls">';
    echo '<input id="assets" name="assets" type="text" placeholder="($)" value="'.(isset($_POST["assets"]) ? esc_attr( $_POST["assets"]) : "").'" class="input-large">';
    echo '</div></div>';
    echo '<!-- Liabilities-->';
    echo '<div class="control-group">';
    echo '<label class="control-label" for="liabilities">Your Current Liabilities</label>';
    echo '<div class="controls">';
    echo '<input id="liabilities" name="liabilities" type="text" placeholder="($)" class="input-large">';
    echo '</div></div>';
    echo '<!-- Button -->';
    echo '<div class="control-group">';
    echo '<label class="control-label" for="submit">Calculate Your Current Ratio</label>';
    echo '<div class="controls">';
    echo '<button id="ratio_submit" name="submit" class="btn btn-success">Calculate</button>';
    echo '</div></div>';
    echo '</fieldset>';
    echo '</form>';
}

function process_ratio_form(){

    if (isset($_POST['submit'])) {
    
    //insert postback goodness here
    $assets = $_POST['assets'];
    $liabilities = $_POST['liabilities'];
    $current_ratio = liability_assets_ratio($liabilities,$assets);

    echo '<form>';
    echo '<fieldset>';
    echo '<!-- Current Ratio -->';
    echo '<div class="control-group">';
    echo '<label class="control-label" for="current_ratio">Your Current Ratio is:</label>';
    echo '<div class="controls">';
    echo '<input id="current_ratio" name="current_ratio" type="text" value="'.$current_ratio.'" class="input-large">';
    echo '</div></div>';
    echo '</fieldset>';
    echo '</form>';
    
    }
}

function fa_current_ratio(){
    ob_start();
    process_ratio_form();
    current_ratio_form();
    return ob_get_clean();
}

add_shortcode('current_ratio', 'fa_current_ratio');