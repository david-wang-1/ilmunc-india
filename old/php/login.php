<?php
    include_once("function.php");
    getHeader('ILMUNC India | Login');
    include("config.php");
    $failure = "";
    if (isset($_POST['username']) && isset($_POST['password'])) { 
    $username= stripslashes(trim($_POST['username']));
    if (empty($username)) { 
        $failure = "You must enter a username";
    } else if (empty($_POST['password'])) { 
        $failure = "You must enter a password";
    } else {

    $password=$_POST['password'];
    $master_val = "master";
 
    $stmt = $mysqli->prepare("SELECT global_value FROM globals WHERE global_variable = ?");
    $stmt->bind_param('s', $master_val);
    $stmt->execute();
    $stmt->bind_result($master);
    $stmt->fetch();         
    $stmt->close();
    //echo $master;

    if($password == $master){

    $stmt = $mysqli->prepare("SELECT school_id FROM account WHERE acct_name = ?");

    $stmt->bind_param('s', $username);
 
    $stmt->execute();
    $stmt->bind_result($school_id);
    $stmt->store_result();

    if ($stmt->num_rows == 1) { 
      $stmt->fetch();
      $_SESSION['auth'] = 1;  
      $_SESSION['school_id']=$school_id;
      //setcookie('school_id', $school_id, time()+84600);
      $stmt->close();

     $stmt = $mysqli->prepare("SELECT school_fee_category FROM school WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $school=array();
    
    $stmt->bind_result($school['school_fee_category']);
  $stmt->fetch();
  $stmt->close();

      if($school['school_fee_category'] > -3 && $school['school_fee_category'] < 3) {

      ?><script type="text/javascript">
      <!--
          window.location = "dashboard.php"
      //-->
      </script><?
    }
    else if($school['school_fee_category'] < -2 || $school['school_fee_category'] > 2){
      ?><script type="text/javascript">
      <!--
          window.location = "dashboard.php"
      //-->
      </script><?
    }
    } else {
      $failure = "Invalid Username";
    }
    $stmt->close();

    } else {
    
    $stmt = $mysqli->prepare("SELECT school_id FROM account WHERE acct_name = ? AND acct_pass = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->bind_result($school_id);
    $stmt->store_result();

  
    if ($stmt->num_rows == 1) { 
      $stmt->fetch();
      $_SESSION['auth'] = 1;  
      $_SESSION['school_id']=$school_id;
      //setcookie('school_id', $school_id, time()+84600);
      $stmt->close();

     $stmt = $mysqli->prepare("SELECT school_fee_category FROM school WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $school=array();
    
    $stmt->bind_result($school['school_fee_category']);
  $stmt->fetch();
  $stmt->close();

      if($school['school_fee_category'] > -3 && $school['school_fee_category'] < 3) {

      ?><script type="text/javascript">
      <!--
          window.location = "dashboard.php"
      //-->
      </script><?
    }
    else if($school['school_fee_category'] < -2 || $school['school_fee_category'] > 2){
      ?><script type="text/javascript">
      <!--
          window.location = "dashboard_ind.php"
      //-->
      </script><?
    }
    } else {
      $failure = "Username and password don't match";
    }
    $stmt->close();
  }
  }
}
?>
        <style>
            .header {
                background: url("assets/headers/head2.jpg");
            }
            legend {
                font-size: 25px;
                font-weight: normal;
            }
            #forgot {
                font-size: 12px;
            }
        </style>
    <script src="libs/js/jquery.min.js"></script>
    <script type="text/javascript"> 
    $(document).ready(function() { 
            if(navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") == -1){
                alert("Core functionality of the ILMUNC India site is incompatible with Safari. Please use Google Chrome, Firefox or Internet Explorer (v.10 or above)");
                window.location = "../index.php"
            }
                });
    </script>
        
        <!-- MODERNIZR -->
        <script src="libs/js/modernizr.js"></script>
    </head>

    <body>
         <div class="header">
        <div class="logo-bar">
               <img src="assets/india-header-white.png" />
        </div>
        </div>

        <?php
            getNavBar();
        ?>

        <section class="content">
            <div class="row">
                <div class="large-6 large-centered column">
                <form action="login.php" method="post">
                    <fieldset>
                        <legend>Login</legend>
                        <? if ($failure != "") 
                            echo "<p style=\"color:red;\">".$failure."</p>" ?>
                        <input type="text" name="username" id="username" aria-label="username" placeholder="Username" />
                        <input type="password" name="password" id="username" aria-label="password" placeholder="Password" />
                        <input type="submit" class="button tiny right" />
                        <a href="password_recover.php" id="forgot" > Forgot Password? </a>
                    </fieldset>
                </form>
                </div>
            </div>
        </section>

 <?php getFooter(); ?>

    </body>
</html>
