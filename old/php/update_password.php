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
    <? getDashboardNav("dashboard"); ?>

    <section class="content">
        <div class="row">
            <div class="large-8 large-centered column">
                <table> 
       				<tr><td><h3> Change Password </h3></td><td></td></tr>
	<?
	
	function isBlank($value) {
		return !preg_match("/[a-zA-Z0-9]+/",$value) || $value=="";
	}
	$errors = array();
	if(count($_POST)>2) {
		$fa_oldpassword = $_POST['old_passworda'];
		$fa_password = $_POST['passworda'];
		$fa_password_confirm = $_POST['password_c'];
		if(isBlank($fa_oldpassword)) {
			$errors['old_passworda'] = "Please enter your current password.";
		}
		if(isBlank($fa_password)) {
			$errors['passworda'] = "Please enter a new password.";
		}
		if($fa_password != $fa_password_confirm) {
			$errors['password_c'] = "Passwords don't match. Please retype.";
		}

		$stmt = $mysqli->prepare("SELECT acct_pass FROM account WHERE school_id = ?");
		$stmt->bind_param('d', $school_id);
		$stmt->execute();
		$stmt->bind_result($pass);
		$stmt->fetch();
		$stmt->close();
		if($pass != $fa_oldpassword) {
			$errors['old_passworda'] = "Incorrect current password.";
		}
			
		if(count($errors) == 0) {
			
			$stmt = $mysqli->prepare("UPDATE account SET acct_pass = ? WHERE school_id = ?");
			$stmt->bind_param('sd', $fa_password, $school_id);
			$stmt->execute();
			$stmt->close();
			?>
						<tr>
                    	<td><span> Password changed successfully.</span><br>
                    	<span><a href="dashboard.php">Back</a></span>
                    	</td>
                    	<td></td>
                    </tr>
			
			<?

			$fa_emails;

			$stmt = $mysqli->prepare("SELECT fa_email FROM facultyadvisor WHERE school_id = ?");
		$stmt->bind_param('d', $school_id);
		$stmt->execute();
		$stmt->bind_result($pass1);
		while($stmt->fetch()) {

			$fa_emails .= $pass1.",";
		}
		$stmt->close();
		//$fa_emails = 'dhrupad.bhardwaj93@gmail.com';

			$message = "Dear Faculty Advisor, \n \n".
						"Your account password was changed. The change happened from the following IP address : ".$_SERVER["REMOTE_ADDR"]."\n \n".
						"If this change was not done by you or one of your colleagues please contact the Under-Secretary-General Operations at usg-ops@ilmunc-india.com immediately so that we can secure your account. Otherwise please ignore this email. \n \n".
						"Regards, \n".
						"ILMUNC India Team";

        $headers = 'From: ILMUNC India <do-not-reply@ilmunc-india.com>' . "\r\n" .
        'Cc:' . "\r\n";
  'X-Mailer: PHP/' . phpversion() .
  '\r\n Content-Type: text/plain; charset="UTF-8"';
  mail($fa_emails,"Password Change Detected",$message,$headers);

		} else {
			displayForm($errors);
		}
	} else {
		displayForm($errors);
	}
	
	function displayForm($errors) { ?>

                        <tr>
                        <form id="updatepassword" action="<?=$_SERVER['PHP_SELF']; ?>" method="post">
                        <td> 
								<span><input type="password" required name="old_passworda" id="old_passworda" placeholder="Current Password"/></span><br>
								<span id="old_passworda_error" class="errormsg"><? if($errors&&array_key_exists('old_passworda',$errors)) { echo $errors['old_passworda'];}?></span><br>
								<span><input type="password" required name="passworda" id="passworda" placeholder="New Password"/></span><br>
								<span id="passworda_error" class="errormsg"><? if($errors&&array_key_exists('passworda',$errors)) { echo $errors['passworda'];}?></span><br>
								<span><input type="password" required name="password_c" id="password_c" placeholder="Repeat New Password"/></span><br>
								<span id="password_c_error" class="errormsg"><? if($errors&&array_key_exists('password_c',$errors)) { echo $errors['password_c'];}?></span><br>
								<!--<input id="old_passworda" <? if($errors&&array_key_exists('old_passworda',$errors)) { echo 'class="error"';} ?> name="old_passworda" type="password" AUTOCOMPLETE=OFF />
								<span id="old_passworda_error" class="errormsg"><? if($errors&&array_key_exists('old_passworda',$errors)) { echo $errors['old_passworda'];}?></span>
								<label for="passworda">New Password</label>
								<input id="passworda" <? if($errors&&array_key_exists('passworda',$errors)) { echo 'class="error"';} ?> name="passworda" type="password" AUTOCOMPLETE=OFF />
								<span id="passworda_error" class="errormsg"><? if($errors&&array_key_exists('passworda',$errors)) { echo $errors['passworda'];}?></span>
								<label for="password_c">Confirm New Password</label>
								<input id="password_c" <? if($errors&&array_key_exists('password_c',$errors)) { echo 'class="error"';} ?> name="password_c" type="password" AUTOCOMPLETE=OFF />
								<span id="password_c_error" class="errormsg"><? if($errors&&array_key_exists('password_c',$errors)) { echo $errors['password_c'];}?></span>-->
							
                        </td>
                        <td> 
                            <input type="submit" value="Submit" />
                        </td>
                        </form>
                    </tr>
                    <tr><td><span><a href="dashboard.php">Back</a></span></td><td></td></tr>


		
	<?} ?> </table>
		</div>
        </div>
    </section>
    <?php getFooter() ?>
</body>
</html>
<?
			$mysqli->close();
		?>