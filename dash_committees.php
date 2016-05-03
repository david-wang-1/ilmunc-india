<?php 
include_once("function.php");
include_once("config.php");
include_once("function-auth.php");
if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
  header("Location: login.php");
}
getHeader("ILMUNC India | Committees ");

getDashStyle();
    $school_id = $_SESSION['school_id'];
?>
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
    <? getDashboardNav("committees"); ?>

    <section class="content">
        <div class="row">
            <div class="large-8 large-centered column">

                <?php

    $stmt = $mysqli->prepare("SELECT ind_firstname,ind_lastname,ind_prefix,ind_phone,ind_email,ind_add1,ind_add2,ind_city,ind_state,ind_country,ind_postalcode FROM individual WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $individual=array();
    
    $stmt->bind_result($individual['ind_firstname'],$individual['ind_lastname'],$individual['ind_prefix'],$individual['ind_phone'],$individual['ind_email'],$individual['ind_add1'],$individual['ind_add2'],$individual['ind_city'],$individual['ind_state'],$individual['ind_country'],$individual['ind_postalcode']);
    $stmt->fetch();
    $stmt->close();

        $stmt = $mysqli->prepare("SELECT school_name,school_address1,school_address2,school_city,school_state,school_postalcode,
        school_country,school_delegation_size,school_num_fa,school_attend_ilmunc,school_fee_category,invoice,school_registered FROM school WHERE school_id = ?");
        $stmt->bind_param('d', $school_id);
        $stmt->execute();
        $school=array();
        $stmt->bind_result($school['school_name'],$school['school_address1'],$school['school_address2'],$school['school_city'],$school['school_state'],        $school['school_postalcode'],$school['school_country'],$school['school_delegation_size'],$school['school_num_fa'],$school['school_attend_ilmunc'],$school['school_fee_category'],$school['invoice'],$school['school_registered']);
        $stmt->fetch();
        $stmt->close();

        if($school['school_fee_category'] > -3 && $school['school_fee_category'] < 3) {
        ?><script type="text/javascript">
          <!--
              window.location = "dashboard.php"
          //-->
          </script><?php
    } else { }

if(count($_POST) >= 5) {
    $school_id = $_POST['school_id'];
    $pref1 = $_POST["1"];
    $pref2 = $_POST["2"];
    $pref3 = $_POST["3"];
    $pref4 = $_POST["4"];
    $pref5 = $_POST["5"];

        $stmt = $mysqli->prepare("INSERT INTO indpreffs (
            school_id,
            pref1, pref2, pref3, pref4, pref5, registered)
            VALUES (?,?,?,?,?,?, NOW()) 
            ON DUPLICATE KEY UPDATE 
            school_id = '$school_id',
            pref1 = '$pref1',
            pref2 = '$pref2',
            pref3 = '$pref3',
            pref4 = '$pref4',
            pref5 = '$pref5',
            registered = NOW() ");

        $stmt->bind_param('dsssss',
            $school_id,
            $pref1, $pref2, $pref3, $pref4, $pref5);

        $stmt->execute();
        $stmt->close(); 

?>
        
    <p>Thank you <? echo $individual['ind_firstname'] ?> for selecting your preferences. Your country selections have been saved. We look forward to seeing you during ILMUNC India 2015!</p>
    <p>To view your submitted preferences please click <a href="dash_committees.php">here</a>.</p>
    </div> <!-- 1 END of B -->
<?php
    } else { //---CLOSED if(array_key_exists...






    $stmt = $mysqli->prepare(        "SELECT global_variable,
                global_value 
        FROM globals");
    $stmt->execute();
    $stmt->bind_result($var,$val);
    $global = array();
    while($stmt->fetch()) {
        $global[$var] = $val;
    }

    $stmt->close();
    
    if($global["country_selection"] == 0) {
        ?>
    <p>Committee selections for ILMUNC India 2015 have not yet opened. Check back on <?php echo $global["country_selection_open_date"]  ?>, <?php echo $global["year"]  ?> to make your selections!</p>
<?php
 } elseif ($global["country_selection"] == 2) { ?>
    <p>Committee selections for ILMUNC India 2015 have been closed. In the meantime stay updated with ILMUNC India, and we hope to see you next year in <?php echo $global["year"]+1  ?>!</p>
<?php
 } else { ?>
                <h2 id="country-selection-header"> Committee Selection </h2>
                <p></p>
                    <p>Welcome! Please indicate your committee preferences below! We will be notifying committee assignments on a rolling basis.</p>
                  <p>If you have any questions, please contact the Secretary-General at <a href="mailto:secgen@ilmunc-india.com">secgen@ilmunc-india.com</a></p> 
                    <p>Additionally, requested preferences do not guarantee an assignment of the top listed choice as there are many delegates and choices to accommodate</p>
                <p>To view a list of committees present, please visit the homepage and look under the committees tab. Every committee has a letter from the chair and a brief description of the topics being discussed.</p>
                <style>
    #preference-form {
        display: initial;
    }
    #preference-submit {
        margin-top: 10px;
    }
</style>
<?
$i = 1;
$preffs = array();
while($i <= 5){
$stmt = $mysqli->prepare("SELECT committee.committee_name FROM `indpreffs` LEFT JOIN committee ON committee.committee_id = indpreffs.pref".$i." WHERE indpreffs.school_id = ?");
$stmt->bind_param('d', $school_id);
    $stmt->execute();
    $stmt->bind_result($pref);
    $global = array();
    while($stmt->fetch()) {
        $preffs[$i] = $pref;
    }
    $i++;

    $stmt->close();
}
if(count($preffs) == 0){
    $x = 1;
    while($x <= 5){
        $preffs[$x] = "Please enter your committee preference";
        $x++;
    }
}

?>
<form id="preference-form" method="post" action="<?=$_SERVER['PHP_SELF']; ?>">
<table id="country-selection">
    <tbody>
        <?php
        $index = 1;
        // END AT 10th PREFERENCE
        while($index<=5) {
            ?> 
            <tr>
            <td> Preference <?php echo $index; ?>* </td>
            <td class="country-preference"> 
                <span class="preference-hide" id="<?=$index?>"><?echo $preffs[$index]?></span>
                <select class="country-select" id="<?=$index?>" name="<?=$index?>">
                                            <?php
        // POPULATE DROP DOWN
        // specify in "SELECT" call...
        $stmt = $mysqli->prepare("SELECT *
                            FROM committee
                            WHERE iscrisis=0");
        $stmt->execute();
        $stmt->bind_result($id,$name,$val);
        while($stmt->fetch()) {
            echo '<option value="'.$id.'" ';
            
            if($_POST[$i]==$id) {
                echo 'selected="selected"';
            }

            echo '>'.$name.'</option>';
        }

        $stmt->close();
        ?>
                                        </select>
            </td>
        </tr>                 

<?php
            $index++;
            // INCREMENT.
        }

        // CLOSE WHILE LOOP
        ?>
    </tbody>
</table>
<input type="hidden" id="school_id" name="school_id" <?php echo "value=\"".$school_id."\""; ?>>
<input type="submit" id="country-form-submit" style="visibility: hidden;" value="Submit" >
<div class="edit">
    <a id="edit-preference"> Edit Selections </a>
    <a id="preference-submit" class="button tiny hidden" data-target-button="country-form-submit" data-target-form="preference-form"> Submit </a>
</div>
</form>
<?php 
} } ?>
                <hr class="custom_hr"/>
            </div>
        </div>
    </section>
    <?php getFooter() ?>
</body>
<script src="js/dashboard.js"></script> 
</html>