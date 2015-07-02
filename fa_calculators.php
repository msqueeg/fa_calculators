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

function liability_assets_ratio($a,$b)
{
    $c = gcd($a,$b);

    return number_format((float)$b/$c, 2, '.', '') . ':' . $a/$c;
}

