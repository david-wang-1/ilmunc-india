<?php
    include_once("function.php");
    include_once("config.php");

    getHeader("ILMUNC India | Account Recovery");
?>

        <style>
            .header-image {
                background-image: url("assets/headers/hotel-header.jpg");
                background-position-y: -100px;
            }
        </style>
        
        <!-- MODERNIZR -->
        <script src="libs/js/modernizr.js"></script>
    </head>
        <body onLoad="countdown()">


        <div class="header">
        <div class="logo-bar">
               <img src="assets/india-header-white.png" />
        </div>
        </div>
        <? getNavBar(); ?>
                <section class="content"> 
                <div class="row">
                    <h2>Account Recovery</h2>
                    <div class="main large-8 column">


<?

    if(count($_POST)>0) {
        $prefix = "";
        $lastname = "";
        $school_name = "";
        $acct_name = "";
        $acct_pass = "";

        if($_POST['type'] == 1) {

            $stmt = $mysqli->prepare("SELECT ind_prefix, ind_lastname, acct_name, acct_pass FROM individual NATURAL JOIN account WHERE individual.ind_email = ?");
            $stmt->bind_param('s',$_POST['rec_email']);
            $stmt->execute();
            $stmt->bind_result($prefix, $lastname, $account_name, $account_pass);
            $stmt->store_result();
            $count_rows = $stmt->num_rows;
        }
        else
        {
            $stmt = $mysqli->prepare("SELECT fa_prefix, fa_lastname, acct_name, acct_pass FROM facultyadvisor NATURAL JOIN account WHERE facultyadvisor.fa_email = ?");
            $stmt->bind_param('s',$_POST['rec_email']);
            $stmt->execute();
            $stmt->bind_result($prefix, $lastname, $account_name, $account_pass);
            $stmt->store_result();
            $count_rows = $stmt->num_rows;  
        }
            if($count_rows == 1) {
                
                $stmt->fetch();
                $stmt->close();
                $message = "Dear $prefix $lastname,\n \n".
                "You are receiving this email because someone requested the account information associated with this email address ".
                "using the password recovery form. Your account details are below:\n\n".
                "Account Name: $account_name\n".
                "Account Password: $account_pass\n\n".
                "To ensure the security of your account you are requested to change your password after logging onto your dashboard. ".
                "We look forward to seeing you in November!\n \n".
                "Best,\n".
                "ILMUNC India Team";

                $headers = 'From: ILMUNC India<do-not-reply@ilmunc-india.com>' . "\r\n" .
                'Reply-To: usg-ops@ilmunc-india.com' . "\r\n" .
                'Cc:' . "\r\n".
                'X-Mailer: PHP/' . phpversion() .
                'Content-Type: text/plain; charset="utf-8"';
                
                // In case any of our lines are larger than 70 characters, we should use wordwrap()
                //$message = wordwrap($message, 70);
                
                // Send
                $subject = 'ILMUNC India Password Recovery';
                $fa_email = $_POST['rec_email'];

                mail($fa_email, $subject, $message,$headers);

                ?>
                    <p>An email has been sent to the email address associated with your account. If you still are unable to access your account please feel free to email the Under-Secretary-General Operations at <a href="mailto:usg-ops@ilmunc-india.com">usg-ops@ilmunc-india.com</a></p><br>
                    <p><a href="login.php">Login</a></p>
            <?} else { ?>
                    <p>To recover your password, please enter 
                        <br>For Schools: One of the faculty advisor emails associated with that account.<br>
                            For Individual Delegates: Your email address associated with that account.</p>
                    <form id="formElem" action="<?=$_SERVER['PHP_SELF']; ?>" method="post">
                        <fieldset>
                        <input id="rec_email" type="email" name="rec_email" required placeholder="Faculty Advisor Email"/>
                        <label> Account Type
                            <select id="type" name="type">
                                                <option value="-1">Faculty</option>
                                                <option value="1">Individual</option>
                            </select>
                        </label>
                        <span class="errormsg">The email address entered is not associated with an account or may be associated with multiple accounts.</span>
                        </fieldset>
                        <input id="registerButton" value="Submit" type="submit" />
                    </form>
                    
        <?  }
    } else {
            
    
?>
        <p>To recover your password, please enter 
                        <br>For Schools: One of the faculty advisor emails associated with that account.<br>
                            For Individual Delegates: Your email address associated with that account.</p>
        <form id="formElem" action="<?=$_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset>
                <input id="rec_email" type="email" name="rec_email" required placeholder="Faculty Advisor Email"/>
                <label> Account Type
                    <select id="type" name="type">
                                        <option value="-1">Faculty</option>
                                        <option value="1">Individual</option>
                    </select>
                </label>
                </fieldset>
                <input id="registerButton" value="Submit" type="submit" />
                </form>
        
<?php
    } ?> </div> <?
    getAnnouncement(); ?>
                </div>
               </section> 
<?
    getFooter();
?>