<?php
/*
Plugin Name: FA Calculators
Plugin URI: http://www.fullyaccountable.com
Description: This plugin contains calculators for the Fully Accountable Member's Area.
Author: Michael Miller
Author URI: http://michael-miller.org/
Version: 1.0.0

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

/* calcuation functions */

//$formatter = new \NumberFormatter('en_US', \NumberFormatter::PERCENT);

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
  
	return sprintf("%.2f%%", $a / $b * 100);
}

function quick_ratio($assets,$liabilities,$inventory)
{
	$a = $assets - $inventory;
    $c = gcd($a,$liabilities);

    return number_format((float)$liabilities/$c, 2, '.', '') . ':' . $a/$c;
}

function assets_ratio($a,$b)
{
    $c = gcd($a,$b);
    
    return number_format((int)$b/$c, 2, '.', '') . ':' . $a/$c;
}

/* display & processing forms*/

function display_ratio_form($first_label,$second_label) {
 echo    '<div class="loan_payment">
          <form class="form-horizontal" data-toggle="validator" method="post" action='.esc_url($_SERVER['REQUEST_URI']).'>
          <ul class="listing">
           <li class="clearfix">
               <div class="col-md-6 loan_txt"><div class="loan_txt1"><span class="numbering">1</span>'.$first_label.'</div></div>
               <div class="col-md-6">
               <input type="text" pattern="^[0-9\$,]*$" class="form-control inputbox list_form" id="first_field" name="first_field"  value="'.(isset($_POST["first_field"]) ? esc_attr( $_POST["first_field"]) : "").'" placeholder="$5,000" required>
               <span class="help-block with-errors">Round to the nearest dollar</span>
               </div>
           </li>
           
            <li class="clearfix">
               <div class="col-md-6 loan_txt"><div class="loan_txt1"><span class="numbering">2</span>'.$second_label.'</div></div>
               <div class="col-md-6">
               <input type="text" pattern="^[0-9\$,]*$" class="form-control inputbox list_form" id="second_field" name="second_field" value="'.(isset($_POST["second_field"]) ? esc_attr( $_POST["second_field"]) : "").'" placeholder="$3,000"  required>
               <span class="help-block with-errors">Round to the nearest dollar</span>
               </div>
           </li>
          </ul>
          <button id="submit" name="submit" class="caclt_bt">Calculate!</button>
         </form>
          <script type="text/javascript">
              $(document).ready(function(){
                $(".form-horizontal").submit(function(){
                  var first_field = $("input[name=\'first_field\']").val()
                  var second_field = $("input[name=\'second_field\']").val()
                  first_field = first_field.replace(\',\',\'\');
                  second_field = second_field.replace(\',\',\'\');
                  $("input[name=\'first_field\']").val(first_field.replace(\'$\',\'\'));
                  $("input[name=\'second_field\']").val(second_field.replace(\'$\',\'\'));
                });
              });
              </script>
         </div>';
}

function process_ratio_form($first_label,$second_label,$third_label,$pct = false){

    if (isset($_POST['submit'])) {
    
    //insert postback goodness here
    $first_field = $_POST['first_field'];
    $second_field = $_POST['second_field'];
    if(!$pct){
      $ratio = assets_ratio($second_field,$first_field);
    } else {
      $ratio = percent_ratio($first_field,$second_field);  
    }

    echo '<div class="loan_payment clearfix">
              <h4>Current Ratio</h4>
              <div class="col-xs-6 pay">
               <div class="payment">Your Inputs</div>
               <div class="pay_sec clearfix">
              <div class="col-xs-6 payment_de">
               <h5>'.$first_label.'</h5>
               <p class="ammount">'.$first_field.'</p>
              </div>
              
              <div class="col-xs-6 payment_de">
               <h5>'.$second_label.'</h5>
               <p class="ammount">'.$second_field.'</p>
              </div>
              </div>
              
              </div>
              
              <div class="col-xs-6 pay">
                   <div class="payment">Calculated Ratio</div>
                   <div class="pay_sec clearfix">
                  
                  
                  <div class="col-xs-12 payment_de">
                   <h5>'.$third_label.'</h5>
                   <p class="ammount"><span>'.$ratio.'</span>per month</p>
                  </div>
                  </div>
              
              </div>
         </div>
    ';  
    }
}

function display_allowable_form(){

    echo '
    <div class="loan_payment">
           <form id="allowable" data-toggle="validator" method="post" action="'.esc_url($_SERVER['REQUEST_URI']).'">
              <ul class="listing">
               <li class="clearfix">
                   <div class="col-md-6 loan_txt"><div class="loan_txt1"><span class="numbering">1</span>Ticket Average</div></div>
                   <div class="col-md-6">
                   <input type="text" id="ticket_average" pattern="^[0-9\.\$,]*$" name="ticket_average" class="form-control inputbox list_form" id="ticket_average" value="$150.00" required>
                   </div>
               </li>
               
                <li class="clearfix">
                   <div class="col-md-6 loan_txt"><div class="loan_txt1"><span class="numbering">2</span>Fulfillment (%)</div></div>
                   <div class="col-md-6">
                   <input type="text" id="fulfillment_pct" pattern="^[0-9\.%]*$"  name="fulfillment_pct" class="form-control inputbox list_form" id="fulfillment_pct" value="17%" required>
                   </div>
               </li>
               
                <li class="clearfix">
                   <div class="col-md-6 loan_txt"><div class="loan_txt1"><span class="numbering">3</span>Refunds (%)</div></div>
                   <div class="col-md-6">
                   <input type="text" id="refunds_pct" pattern="^[0-9\.%]*$"  name="refund_pct" class="form-control inputbox list_form" id="refunds_pct" value="15%" required>
                   </div>
               </li>
               
               
                <li class="clearfix">
                   <div class="col-md-6 loan_txt"><div class="loan_txt1"><span class="numbering">4</span>Merchant Fees (%) </div></div>
                   <div class="col-md-6">
                   <input type="text" id="fees_pct" pattern="^[0-9\.%]*$" name="fees_pct" class="form-control inputbox list_form" id="fees_pct" value="8%" required>
                   </div>
               </li>

               <li class="clearfix">
                   <div class="col-md-6 loan_txt"><div class="loan_txt1"><span class="numbering">4</span>Overhead (%) </div></div>
                   <div class="col-md-6">
                   <input type="text" id="overhead_pct" pattern="^[0-9\.%]*$" name="overhead_pct" class="form-control inputbox list_form" id="overhead_pct" value="30%" required>
                   </div>
               </li>
              
              </ul>
              <button name="submit" id="submit" class="caclt_bt">Calculate!</button> 
           </form>
         </div>
    ';

}

function process_allowable_form(){
    if (isset($_POST['submit'])) {


        $money_replace = array("$",",");
        $ticket_average = 0;
        $fulfillment_pct = 0;
        $refund_pct = 0;
        $fees_pct = 0;
        $overhead_pct = 0;
        $fulfillment_amt = 0;
        $refund_amt = 0;
        $fees_amt = 0;
        $overhead_amt = 0;
        $costs = 0;
        $suggested_media_spend_pct = 0.3;
        $suggested_media_spend_amt = 0;
        $your_remainder = 0;
        $your_pct = 0;
       

        $ticket_average = str_replace($money_replace,"",$_POST['ticket_average']);
        $fulfillment_pct = str_replace("%","",$_POST['fulfillment_pct']) / 100 ;
        $refund_pct = str_replace("%","",$_POST['refund_pct']) / 100 ;
        $fees_pct = str_replace("%","",$_POST['fees_pct']) / 100 ;
        $overhead_pct = str_replace("%","",$_POST['overhead_pct']) / 100 ;

        $fulfillment_amt = $ticket_average * $fulfillment_pct;
        $refund_amt = $ticket_average * $refund_pct;
        $fees_amt = $ticket_average * $fees_pct;
        $overhead_amt = $ticket_average * $overhead_pct;

        $costs = $fulfillment_amt + $refund_amt + $fees_amt + $overhead_amt;

        $suggested_media_spend_amt = $ticket_average * $suggested_media_spend_pct;

        $your_margin = $ticket_average - $costs;

        $your_pct = $your_margin / $ticket_average;


        echo '<div class="clearfix"></div>
        <div class="loan_payment clearfix">
          <h4>Your Allowable Media Spend:</h4>
          <div class="col-xs-6 pay">
           <div class="payment">Your costs per ticket:</div>
           <div class="pay_sec clearfix">
          <div class="col-xs-6 payment_de">
           <h5>Average Ticket Value</h5>
           <p class="ammount">$'.(isset($ticket_average) ? number_format($ticket_average,2,".",",") : "--").'</p>
           <hr>
           <h5>Fullfillment costs per ticket</h5>
           <p class="amount">$'.(isset($fulfillment_pct) ? number_format($fulfillment_amt,2,".",",") : "--").'</p>
           <hr>
           <h5>Refund Costs per ticket</h5>
           <p class="amount">$'.(isset($refund_pct) ? number_format($refund_amt,2,".",",") : "--").'</p>
          </div>
          
          <div class="col-xs-6 payment_de">
           <h5>Merchant Fees per ticket</h5>
           <p class="ammount">$'.(isset($fees_pct) ? number_format($fees_amt,2,".",",") : "--").'</p>
           <hr>
           <h5>Overhead Costs per ticket</h5>
           <p class="ammount">$'.(isset($overhead_pct) ? number_format($overhead_amt,2,".",",") : "--").'</p>
           <hr>
           <h5>Total Costs</h5>
           <p class="ammount">$'.(isset($overhead_pct) ? number_format($costs,2,".",",") : "--").'</p>
          </div>
          </div>
          
          </div>
          
          <div class="col-xs-6 pay">
           <div class="payment">Suggested Media Spend</div>
           <div class="pay_sec clearfix">
           <div class="col-xs-6 payment_de">
             <h5>Percentage</h5>
             <p class="ammount"><span>'.sprintf("%.2f%%", $suggested_media_spend_pct * 100).'</span></p>
           </div>          
          <div class="col-xs-6 payment_de">
           <h5>Amount:</h5>
           <p class="ammount"><span>$'.(isset($suggested_media_spend_amt) ? number_format($suggested_media_spend_amt,2,".",",") : "--").'</span>per ticket</p>
          </div>
          </div>
          <div class="payment">Your Maximum Media Spend</div>
           <div class="pay_sec clearfix">
           <div class="col-xs-6 payment_de">
             <h5>Percentage</h5>
             <p class="ammount"><span>'.sprintf("%.2f%%", $your_pct * 100).'</span></p>
           </div>          
          <div class="col-xs-6 payment_de">
           <h5>Amount:</h5>
           <p class="ammount"><span>$'.(number_format($your_remainder,2,".",",")).'</span>per ticket</p>
          </div>
          </div>
          
          </div>
         </div>';

    }
}

function fa_allowable_spend() {
    ob_start();
    display_allowable_form();
    process_allowable_form();
    return ob_get_clean();
}


function fa_current_ratio(){
    $first_label = "Your Current Assets";
    $second_label = "Your Current Liabilities";
    $third_label = "Your Current Ratio";

    ob_start();
    display_ratio_form($first_label,$second_label);
    process_ratio_form($first_label,$second_label,$third_label);
    return ob_get_clean();
}

function fa_debt_to_assets(){
    $first_label = "Your Total Assets";
    $second_label = "Your Total Debts";
    $third_label = "Your Debt to Assets Ratio";
    display_ratio_form($first_label,$second_label);
    process_ratio_form($first_label,$second_label,$third_label,$pct, true);
    ob_start();
    return ob_get_clean();

}

function fa_return_on_assets(){
    $first_label = "Your Net Income";
    $second_label = "Your Total Assets";
    $third_label = "Your Return on Assets Ratio";
    display_ratio_form($first_label,$second_label);
    process_ratio_form($first_label,$second_label,$third_label);
    ob_start();
    return ob_get_clean();
}

function fa_gross_profit(){
    $first_label = "Your Current Assets";
    $second_label = "Your Current Liabilities";
    $third_label = "Your Current Ratio";
    display_ratio_form($first_label,$second_label);
    process_ratio_form($first_label,$second_label,$third_label);
    ob_start();
    return ob_get_clean();
}

function fa_operating_profit_pct() {
    $first_label = "Your Operating Income";
    $second_label = "Your Sales";
    $third_label = "Operating Profit Percentage";
    display_ratio_form($first_label,$second_label);
    process_ratio_form($first_label,$second_label,$third_label, true);
    ob_start();
    return ob_get_clean();   
}

/** shortcodes to hook into WordPress **/
add_shortcode('current_ratio', 'fa_current_ratio');
add_shortcode('allowable_spend','fa_allowable_spend');
add_shortcode('debt_to_assets', 'fa_debt_to_assets');
add_shortcode('return_on_assets','fa_return_on_assets');
add_shortcode('gross_profit','fa_gross_profit');
add_shortcode('operating_profit','fa_operating_profit_pct');
