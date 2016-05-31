<?php 
include_once("function.php");
include_once("config.php");
include_once("function-auth.php");
if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
  header("Location: login.php");
}
getHeader("ILMUNC India | Billing "); 
$school_id = $_SESSION['school_id'];
    $stmt = $mysqli->prepare("SELECT school_name,school_address1,school_address2,school_city,school_state,school_postalcode,
        school_country,school_delegation_size,school_num_fa,school_attend_ilmunc,school_fee_category,invoice,school_registered FROM school WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $school=array();
    $stmt->bind_result($school['school_name'],$school['school_address1'],$school['school_address2'],$school['school_city'],$school['school_state'],        $school['school_postalcode'],$school['school_country'],$school['school_delegation_size'],$school['school_num_fa'],$school['school_attend_ilmunc'],$school['school_fee_category'],$school['invoice'],$school['school_registered']);
    $stmt->fetch();
    $stmt->close();

    $stmt = $mysqli->prepare("SELECT ind_firstname,ind_lastname,ind_prefix,ind_phone,ind_email,ind_add1,ind_add2,ind_city,ind_state,ind_country,ind_postalcode FROM individual WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $individual=array();
    
    $stmt->bind_result($individual['ind_firstname'],$individual['ind_lastname'],$individual['ind_prefix'],$individual['ind_phone'],$individual['ind_email'],$individual['ind_add1'],$individual['ind_add2'],$individual['ind_city'],$individual['ind_state'],$individual['ind_country'],$individual['ind_postalcode']);
    $stmt->fetch();
    $stmt->close();

    if($school['school_fee_category'] > -3 && $school['school_fee_category'] < 3) {
        ?><script type="text/javascript">
          <!--
              window.location = "billing.php"
          //-->
          </script><?php
    } else { }

?>

<style>
.hidden {
    display: none;
}
table {
    width: 100%;
    margin: 0;
}
h3 {
    margin-top: 50px;
}
h4 {
    margin-top: 30px;
}
h6 {
    color: #000000;
    font-family: "Open Sans";
    font-weight: normal;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 0px;
    text-rendering: optimizeLegibility;
}
.text-right {
    text-align: right;
}
#notes {
    list-style: none;
    margin-left: 0;
    padding-left: 0.75em;
}
.country-select {
    display: none;
}
.button-td {
    text-align: right;
}
.button-td a {
    margin: 0;
}
form input:first-child, form select:first-child {
    margin: 0 !important;
}
table td form input, table td form select {
    margin: 10px 0 !important;
}
#total {
    font-weight: bold;
}
</style>
<!-- MODERNIZR -->
<script src="libs/js/modernizr.js"></script>
<script src="libs/js/jquery.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function() { 
    if(navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") == -1){
        alert("Core functionality of the ILMUNC India site is incompatible with Safari. Please use Google Chrome, Firefox or Internet Explorer (v.10 or above)");
        window.location = "../index.php"
    }
});
</script>
</head>
<body>
    <? getDashboardNav("billing_ind"); ?>

    <section class="content">
        <div class="row">
            <div class="large-8 large-centered column">
                <h2> Billing Summary </h2>
                <table>
                    <thead>
                        <tr><td colspan="5" colspan="5" style='text-align:center' id="heading">DUES</td></tr>
                        <tr>
                            <th> Date </th>
                            <th> Transaction </th>
                            <th> Quantity </th>
                            <th> Rate </th>
                            <th class="text-right"> Amount </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $stmt = $mysqli->prepare("SELECT global_variable,global_value FROM globals");
                        $stmt->execute();
                        $stmt->bind_result($var,$val);
                        $global = array();
                        while($stmt->fetch()) {
                            $global[$var] = $val;
                        }

                        $stmt->close();
                        $delegate_fee_total = 0;
                        if($school['school_country'] == "India"){
                        $delegate_fee_total = $global["school_del_early_inr"]*$school['school_delegation_size'];
                        echo "<tr><td>".date("m/d/Y",strtotime($school['school_registered']))."</td><td>Fee for Delegates</td><td>".$school['school_delegation_size']."</td><td>INR ".$global["school_del_early_inr"]."</td><td style='text-align:right'>INR ".$global["school_del_early_inr"]*$school['school_delegation_size']."</td></tr>";
                        $total = $delegate_fee_total + $global["school_fa_single_inr"]*$school['school_num_fa'];
                        echo "<tr><td colspan=\"5\" colspan=\"5\" style='text-align:right' id=\"total\">Total Due: INR ".$total."</td></tr>";
                        ?><tr><td colspan="5" colspan="5" style='text-align:center' id="heading"><b>PAYMENTS MADE</b></td></tr><?
                        $stmt = $mysqli->prepare("SELECT pay_date,pay_remarks,pay_amt FROM payment WHERE school_id = ? ORDER BY pay_date ASC");
                        $stmt->bind_param('d', $school_id);
                        $stmt->execute();
                        $payments = array();
                        $stmt->bind_result($payments['pay_date'],$payments['pay_remarks'],$payments['pay_amt']);
                        while($stmt->fetch()) {
                            echo "<tr><td>".$payments['pay_date']."</td><td><i>".$payments['pay_remarks']."</i></td><td colspan=\"5\" style='text-align:right'>INR ".$payments['pay_amt']."</td></tr>";
                            $total = $total - $payments['pay_amt'];
                        }

                        echo "<tr><td colspan=\"5\" colspan=\"5\" style='text-align:right' id=\"total\">Balance Remaining: INR ".$total."</td></tr>";
                        } else {

                        $delegate_fee_total = $global["school_del_early_usd"]*$school['school_delegation_size'];
                        echo "<tr><td>".date("m/d/Y",strtotime($school['school_registered']))."</td><td>Fee for Delegates</td><td>".$school['school_delegation_size']."</td><td>USD ".$global["school_del_early_usd"]."</td><td style='text-align:right'>USD ".$global["school_del_early_usd"]*$school['school_delegation_size']."</td></tr>";
                        $total = $delegate_fee_total + $global["school_fa_single_usd"]*$school['school_num_fa'];
                        echo "<tr><td colspan=\"5\" colspan=\"5\" style='text-align:right' id=\"total\">Total Due: USD ".$total."</td></tr>";
                        ?><tr><td colspan="5" colspan="5" style='text-align:center' id="heading"><b>PAYMENTS MADE</b></td></tr><?
                        $stmt = $mysqli->prepare("SELECT pay_date,pay_remarks,pay_amt FROM payment WHERE school_id = ? ORDER BY pay_date ASC");
                        $stmt->bind_param('d', $school_id);
                        $stmt->execute();
                        $payments = array();
                        $stmt->bind_result($payments['pay_date'],$payments['pay_remarks'],$payments['pay_amt']);
                        while($stmt->fetch()) {
                            echo "<tr><td>".$payments['pay_date']."</td><td><i>".$payments['pay_remarks']."</i></td><td colspan=\"5\" style='text-align:right'>USD ".$payments['pay_amt']."</td></tr>";
                            $total = $total - $payments['pay_amt'];
                        }

                        echo "<tr><td colspan=\"5\" colspan=\"5\" style='text-align:right' id=\"total\">Balance Remaining: USD ".$total."</td></tr>";

                        }?>
                    </tbody>
                </table>
                <br />
                <h2> Payment Options </h2>
                <br />
                <?php 
                if($school['school_country'] == "India"){ echo
                "<div class=\"content active\" id=\"panel1\">
                    <ul class=\"accordion\" data-accordion>
                        <li class=\"accordion-navigation\">
                            <a href=\"#panel1a\">Pay by Cheque</a>
                            <div id=\"panel1a\" class=\"content\">
                                <h6>Delegations must send a single cheque in the total amount of the delegation. The check should be made payable to \"Worldview Education Services Pvt. Ltd- ILMUNC India\". Please ensure that you write the name of your school and ILMUNC India on the envelope or the back of the check. Checks must be mailed to</h6> 
                                <br />
                                <h6>ILMUNC India </h6>
                                <h6>409/411- Block II, WhiteHouse, </h6>
                                <h6>Greenlands, Begumpet, Hyderabad - 500016</h6>
                                <h6>Andhra Pradesh, India.</h6>
                                <h6>Ph- 040-64630095 ,040-64630058</h6>
                            </li>
                        <li class=\"accordion-navigation\">
                            <a href=\"#panel1b\">Wire Transfer</a>
                            <div id=\"panel1b\" class=\"content\">
                                <h6>Account Name : Worldview Education Services Pvt Ltd - ILMUNC India</h6>
                                <h6>Account Number : 915020021429917</h6>
                                <h6>IFSC Code : UTIB0000030</h6>
                                <h6>Bank Name : Axis Bank</h6>
                                <h6>Branch : Jubilee Hills</h6>
                            </li>
                        <li class=\"accordion-navigation\">
                            <a href=\"#panel1c\">Demand Draft</a>
                            <div id=\"panel1c\" class=\"content\">
                                <h6>Account Name : Worldview Education Services Pvt Ltd - ILMUNC India </h6>
                                <h6>Account Number : 915020021429917</h6>
                            </li>
                    </ul>
                </div>";}
                 
                else { echo
                    "<div class=\"content active\" id=\"panel1\">
                    <ul class=\"accordion\" data-accordion>
                        <li class=\"accordion-navigation\">
                            <a href=\"#panel1a\">Online Payment</a>
                            <div id=\"panel1a\" class=\"content\">
                            <h6>Online payments are processed through PayPal. Kindly note that there will be a 3% surcharge on all online payments. Please click on the link below to proceed.</h6>
                            <form style = \"margin-left: 210px; margin-right: 210px; margin-top:20px;\" action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">
                                <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
                                <input type=\"hidden\" name=\"business\" value=\"santosh.vallabh@gmail.com\">
                                <input type=\"hidden\" name=\"item_name\" value=\"ILMUNC India International Delegate Registation Fees\">
                                <input type=\"hidden\" name=\"tax\" value=\"";?><?php echo (0.03 * $total);?><?php echo"\">
                                <input type=\"hidden\" name=\"quantity\" value=\"1\">
                                <input type=\"hidden\" name=\"no_note\" value=\"1\">
                                <input type=\"hidden\" name=\"currency_code\" value=\"USD\">
                                <input type=\"hidden\" name=\"amount\" value=\"";?><?php echo $total;?><?php echo"\">
                                <input type=\"image\" name=\"submit\" border=\"0\"
                                src=\"./assets/payment.png\"
                                alt=\"PayPal - The safer, easier way to pay online\">
                            </form>
                            </li>
                        <li class=\"accordion-navigation\">
                            <a href=\"#panel1b\">Pay by Cheque</a>
                            <div id=\"panel1b\" class=\"content\">
                                <h6>Delegations must send a single cheque in the total amount of the delegation. The check should be made payable to The Trustees of the University of Pennsylvania. Please ensure that you write the name of your school and ILMUNC India on the envelope or the back of the check. All checks must be in US dollars. Checks must be mailed to</h6> 
                                <br /><h6>P.O Box 31826</h6>
                                <h6>228 S.40th Street</h6>
                                <h6>Philadelphia PA</h6>
                                <h6>United States - 19104</h6>
                            </li>
                    </ul>
                </div>";
                 } ?>
            </div>
        </div>
    </section>
    <?php getFooter() ?>
</body>
</html>