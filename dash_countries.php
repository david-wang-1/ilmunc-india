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
    <? getDashboardNav("countries"); ?>

    <section class="content">
        <div class="row">
            <div class="large-8 large-centered column">

                <?php

if(count($_POST) >= 5) {
    $school_id = $_POST['school_id'];
    $pref1 = $_POST["1"];
    $pref2 = $_POST["2"];
    $pref3 = $_POST["3"];
    $pref4 = $_POST["4"];
    $pref5 = $_POST["5"];
    $pref6 = $_POST["6"];
    $pref7 = $_POST["7"];
    $pref8 = $_POST["8"];
    $pref9 = $_POST["9"];
    $pref10 = $_POST["10"];

        $stmt = $mysqli->prepare("INSERT INTO countryprefs (
            school_id,
            pref1, pref2, pref3, pref4, pref5, pref6, pref7, pref8, pref9, pref10, registered)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,NOW()) 
            ON DUPLICATE KEY UPDATE 
            pref1 = '$pref1',
            pref2 = '$pref2',
            pref3 = '$pref3',
            pref4 = '$pref4',
            pref5 = '$pref5',
            pref6 = '$pref6',
            pref7 = '$pref7',
            pref8 = '$pref8',
            pref9 = '$pref9',
            pref10 = '$pref10'");

        $stmt->bind_param('dssssssssss',
            $school_id,
            $pref1, $pref2, $pref3, $pref4, $pref5, $pref6, $pref7, $pref8, $pref9, $pref10);

        $stmt->execute();
        $stmt->close(); 

?>
        
    <p>Thank you <? echo $school_name ?> for selecting your preferences. Your country selections have been saved. We look forward to seeing you during ILMUNC India 2015!</p>
    <p>To view your submitted preferences please click <a href="dash_countries.php">here</a>.</p>
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
    <p>Country selections for ILMUNC India 2015 have not yet opened. Check back on <?php echo $global["country_selection_open_date"]  ?>, <?php echo $global["year"]  ?> to make your selections!</p>
<?php
 } elseif ($global["country_selection"] == 2) { ?>
    <p>Country selections for ILMUNC India 2015 have been closed. In the meantime stay updated with ILMUNC India, and we hope to see you next year in <?php echo $global["year"]+1  ?>!</p>
<?php
 } else { ?>
                <h2 id="country-selection-header"> Country Selection </h2>
                <p></p>
                <p> Consider the <a href="./assets/matrix.pdf" target="_blank"> Country / Committee Matrix </a> when deciding country preferences.</p>
                    <p>Please note, you may only select the P5 nations (USA, UK, Russia, China, France) in your first or second preference, and you may only select Brazil, Germany, India, and Japan in your top four preferences (so if you select no P5 nations, you may list all four of those countries).</p>   
                    <p>This is enforced as there is always a high demand for these countries. We want to ensure that schools look into other country options to maximize the number of schools who get countries that they put down as their preferences. If you have any questions, please contact the Secretary-General at <a href="mailto:secgen@ilmunc-india.com">secgen@ilmunc-india.com</a>.</p> 
                    <p>Requesting preferences below does not guarantee that a school will be assigned one of those countries. While we do our absolute best to match schools with their preferences, this may not always be possible due to the large size of the conference. There are various factors we consider when making allotments including time of completed registration and country matches based on the number of delegates. To increase your chances of being assigned a country you are advised to register early and select countries which have sizes matching the size of your delegation or are close to the size of your delegation. Larger delegations are advised to look at combinations of two or more such countries.</p>
                    <br>
                    <p>To view a list of committees present, please visit the homepage and look under the committees tab. Every committee has a letter from the chair and a brief description of the topics being discussed.</p>
                <hr class="custom_hr"/>
                <p> If a student is interested in applying for a spot on one of our crisis committees, please have them submit the <a href="applications.php"> Crisis Committee Application </a>
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
while($i <= 10){
$stmt = $mysqli->prepare("SELECT country.country_name FROM `countryprefs` LEFT JOIN country ON country.country_id = countryprefs.pref".$i." WHERE countryprefs.school_id = ?");
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
    while($x <= 10){
        $preffs[$x] = "Please enter your country preference";
        $x++;
    }
}

?>
<form id="preference-form" method="post" action="<?=$_SERVER['PHP_SELF']; ?>">
<table id="country-selection">
    <tbody>
        <tr>
            <td> Preference 1* </td>
            <td class="country-preference"> 
                <span class="preference-hide" id="1"><?echo $preffs[1]?></span>
                <select class="country-select" id="1" name="1">
<?php
        // POPULATE DROP DOWN
        // specify in "SELECT" call...
        $stmt = $mysqli->prepare(                            "SELECT *
                            FROM country
                            WHERE open=0");
        $stmt->execute();
        $stmt->bind_result($id,$name,$val,$open,$xyz);
        while($stmt->fetch()) {
            echo '<option value="'.$id.'" ';
            echo 'name="'.$id.'" ';
            // maintains user selection if form has an error
            // so users don't have to re-enter their preferences
            
            if($_POST['1']==$id) {
                echo 'selected="selected"';
            }

            echo '>'.$name.'</option>';
        }

        $stmt->close();
        ?>
                </select>
            </td>
        </tr>
        <tr>
            <td> Preference 2* </td>
            <td class="country-preference"> 
                <span class="preference-hide" id="2"><?echo $preffs[2]?></span>
                <select class="country-select" id="2" name="2">
                                            <?php
        // POPULATE DROP DOWN
        // specify in "SELECT" call...
        $stmt = $mysqli->prepare(                            "SELECT *
                            FROM country
                            WHERE open=0");
        $stmt->execute();
        $stmt->bind_result($id,$name,$val,$open,$xyz);
        while($stmt->fetch()) {
            echo '<option value="'.$id.'" ';
            
            if($_POST['2']==$id) {
                echo 'selected="selected"';
            }

            echo '>'.$name.'</option>';
        }

        $stmt->close();
        ?>
                                        </select>
            </td>
        </tr>
        <tr>
            <td> Preference 3* </td>
        <td class="country-preference"> 
                <span class="preference-hide" id="3"><?echo $preffs[3]?></span>
                <select class="country-select" id="3" name="3">
                                            <?php
        // POPULATE DROP DOWN
        // specify in "SELECT" call...
        $stmt = $mysqli->prepare(                            "SELECT *
                            FROM country
                            WHERE open=0 and country_val<3");
        $stmt->execute();
        $stmt->bind_result($id,$name,$val,$open,$xyz);
        while($stmt->fetch()) {
            echo '<option value="'.$id.'" ';
            
            if($_POST['2']==$id) {
                echo 'selected="selected"';
            }

            echo '>'.$name.'</option>';
        }

        $stmt->close();
        ?>
                                        </select>
            </td>
        </tr>
        <tr>
            <td> Preference 4* </td>
            <td class="country-preference"> 
                <span class="preference-hide" id="4"><?echo $preffs[4]?></span>
                <select class="country-select" id="4" name="4">
                                            <?php
        // POPULATE DROP DOWN
        // specify in "SELECT" call...
        $stmt = $mysqli->prepare(                            "SELECT *
                            FROM country
                            WHERE open=0 and country_val<3");
        $stmt->execute();
        $stmt->bind_result($id,$name,$val,$open,$xyz);
        while($stmt->fetch()) {
            echo '<option value="'.$id.'" ';
            
            if($_POST['2']==$id) {
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
        $index = 5;
        // END AT 10th PREFERENCE
        while($index<=10) {
            ?> 
            <tr>
            <td> Preference <?php echo $index; ?>* </td>
            <td class="country-preference"> 
                <span class="preference-hide" id="<?=$index?>"><?echo $preffs[$index]?></span>
                <select class="country-select" id="<?=$index?>" name="<?=$index?>">
                                            <?php
        // POPULATE DROP DOWN
        // specify in "SELECT" call...
        $stmt = $mysqli->prepare(                            "SELECT *
                            FROM country
                            WHERE open=0 and country_val<1");
        $stmt->execute();
        $stmt->bind_result($id,$name,$val,$open,$xyz);
        while($stmt->fetch()) {
            echo '<option value="'.$id.'" ';
            
            if($_POST['2']==$id) {
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