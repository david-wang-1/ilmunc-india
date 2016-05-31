<?php 
    include_once("function.php");
    include_once("config.php");
    include_once("function-auth.php");
    if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
      header("Location: login.php");
    }
getHeader("ILMUNC India | Delegation ");
$school_id = $_SESSION['school_id'];
    $stmt = $mysqli->prepare("SELECT SUM(committee_country.num_delegates) FROM (school_country LEFT JOIN country ON country.country_id = school_country.country_id) LEFT JOIN committee_country ON committee_country.country_id = country.country_id WHERE school_country.school_id=? GROUP BY country.country_id");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $stmt->bind_result($delegates);
    $max_delegates = 0;
    while($stmt->fetch()){
        $max_delegates += $delegates;
    }
    $stmt->close();
?>
        <style>
            .hidden {
                display: none;
            } 
            h3 {
                padding-top: 50px;
            }
            table {
                width: 100%;
                margin: 0;
            }
            .text-right {
                text-align: right;
            }
            input.button {
                margin-bottom: 0;
            }
            th.remove {
                text-align: center;
            }
            .remove-del {
                text-align: center;
                color: #C43700;
                cursor: pointer;
            }
            .remove-fa {
                text-align: center;
                color: #C43700;
                cursor: pointer;
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
        $(".remove-fa").click(function() {
                if(confirm("Would you like to delete this Faculy Advisor ?")){
                $(this).parent().hide();
                var children = $(this).parent().children();
                $.post("ajax/delete_fa.php", { fname: children[0].innerHTML, lname: children[1].innerHTML } );
            }
        });
        $(".remove-del").click(function() {
            if(confirm("Would you like to delete this Delegate ?")){
                $(this).parent().hide();
                var children = $(this).parent().children();
                $.post("ajax/delete_delegate.php", { fname: children[0].innerHTML, lname: children[1].innerHTML } );
            }
        });
        $("#country").change(function() {
            $("#committee").load("ajax/get_country_committees.php", { id: $("#country").val(), school_id: <?echo $_SESSION['school_id'];?>});
        });
    });
    </script>
    </head>

    <body>

        <? getDashboardNav("delegation"); ?>

        <!--
        <div class="header-image">
                <div class="flex-container">
                    <img src="assets/ilmunc-india.min.png" />
                </div>
            </div>
        </div>
        -->

        <section class="content">
            <div class="row">
                <div class="large-8 large-centered column">
                <h2> Delegation Editor </h2>
                <?
                    $stmt = $mysqli->prepare("SELECT country.country_id,country.country_name, SUM(committee_country.num_delegates) FROM (school_country LEFT JOIN country 
        ON country.country_id = school_country.country_id) LEFT JOIN committee_country ON committee_country.country_id = country.country_id
        WHERE school_country.school_id=? GROUP BY country.country_id");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $stmt->bind_result($countries['country_id'],$countries['country_name'],$countries['num_delegates']);
    $country_opt = "";
    while($stmt->fetch()) {
        $country_opt .= "<option value=".$countries["country_id"].">".$countries["country_name"]." (".$countries['num_delegates'].")</option>";
    }
    $stmt->close();
    
    $stmt = $mysqli->prepare("SELECT count(school_id) as assignments FROM school_country WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $stmt->bind_result($num_assignments);
    $stmt->fetch();
    $stmt->close();
    
    $stmt = $mysqli->prepare("SELECT count(school_id) as num_delegates FROM delegate WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $stmt->bind_result($num_delegates);
    $stmt->fetch();
    $stmt->close();
    
    ?>

                <h3 id="delegates"> Delegates </h4>
                <? if($num_assignments > 0) { 
    $stmt = $mysqli->prepare("SELECT del_firstname,del_lastname,del_email,country_name,committee_name,del_head FROM delegate LEFT JOIN committee ON 
        delegate.committee_id = committee.committee_id 
        LEFT JOIN country ON country.country_id = delegate.country_id WHERE delegate.school_id=?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $dels = array();
    $c_assigns = array();
    $stmt->bind_result($dels['del_firstname'],$dels['del_lastname'],$dels['email'],$dels['country_name'],$dels['committee_name'],$dels['head']);
    ?>
            <p>Total Number of Delegates: <span id='num_delegates'><? echo $num_delegates ?></span></p>
            <p>Maximum Number of Delegates: <span id='max_delegates'><? echo $max_delegates ?></span></p>
                <table class="delegates">
                    <thead> 
                        <tr>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Country / Position </th>
                            <th> Committee </th>
                            <th> Email </th>
                            <th> Head Del </th>
                            <th class="remove"> Remove </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
            while($stmt->fetch()) {
                $headel = "Yes";
                if($dels['head'] == 0){
                    $headel = "No";
                }
                $c_assigns[$dels['country_name']] += 1;
                echo "<tr><td>".htmlspecialchars(stripslashes($dels['del_firstname']),ENT_QUOTES)."</td>
                    <td>".htmlspecialchars(stripslashes($dels['del_lastname']),ENT_QUOTES)."</td><td>".$dels['country_name']."</td>
                    <td>".$dels['committee_name']."</td><td>".htmlspecialchars(stripslashes($dels['email']),ENT_QUOTES)."</td><td>".$headel."</td><td class=\"remove-del\"><i class=\"fa fa-times-circle\"></i></td></tr>";
            }
            $stmt->close();
            ?>
                    </tbody>
                </table>
                <? 
                if($num_delegates >= $max_delegates) {
                    ?> <p></p>
                    <p>You have already added the maximum number of delegates registered for your delegation into the system. You may add more delegates on your <a href="dashboard.php">Dashboard</a>. Please note that the secretariat will only allow you to add additional delegates if there are available country positions and only if the fees for the delegates are paid in full. For more information about fees and due dates, please check the <a href="fees.php">fees</a> page.</p>
                    <?
                } else {
                    $stmt = $mysqli->prepare("SELECT country.country_id,country.country_name, SUM(committee_country.num_delegates) FROM (school_country LEFT JOIN country 
                    ON country.country_id = school_country.country_id) LEFT JOIN committee_country ON committee_country.country_id = country.country_id
                    WHERE school_country.school_id=? GROUP BY country.country_id");
                $stmt->bind_param('d', $school_id);
                $stmt->execute();
                $stmt->bind_result($countries['country_id'],$countries['country_name'],$countries['num_delegates']);
                $country_opt = "";
                while($stmt->fetch()) {
                    if($countries['num_delegates'] - $c_assigns[$countries["country_name"]] != 0){
                    $country_opt .= "<option value=".$countries["country_id"].">".$countries["country_name"]." (".($countries['num_delegates'] - $c_assigns[$countries["country_name"]]).")</option>";
                    }
                }
    $stmt->close();

                ?>
                <form action="ajax/insert_delegate.php" method="post">
                    <fieldset>
                        <legend> Add a Delegate </legend>
                        <input type="text" name="fname" id="fname" placeholder="First Name" required/> 
                        <input type="text" name="lname" id="lname" placeholder="Last Name" required/> 
                        <input type="hidden" id="school_id" name="school_id" <?echo "value=\"".$school_id."\"";?>>
                        <label> Head Delegate
                            <select name="head" id="head">
                                <option value="1"> Yes </option>
                                <option value="0"> No </option>
                            </select>
                        </label>
                        <label> Country or Position
                            <select name="country" id="country">
                                <option value=0>---Select a Country/Crisis Position</option><? echo $country_opt ?>
                            </select>
                        </label>
                        <label> Committee
                            <select name="committee" id="committee">
                            </select>
                        </label>
                        <input type="email" name="email" id="email" placeholder="Email" required/>
                        <input type="text" name="phone" id="phone" placeholder="Phone Number" required/> 
                        <input type="submit" class="button tiny right" value="Submit"/>
                    </fieldset>
                </form><? 
            }
        }
             else { ?> 
            <p>Sorry, but you can't add delegates into the system until you have received your country assignments. The first round of country assignments will be released on July 31st. Please remember that all payments must be made and necessary information must be submitted by this date for you to be included in that round of country assignments. For more details, please review the <a href = "fees.php">Registration Policies</a> page.</p>
            <? } 


                $stmt = $mysqli->prepare("SELECT fa_firstname,fa_lastname,fa_prefix,fa_phone,fa_email,fa_room FROM facultyadvisor WHERE school_id = ?");
                $stmt->bind_param('d', $school_id);
                $stmt->execute();
                $fas=array();
                $stmt->bind_result($fas['fa_firstname'],$fas['fa_lastname'],$fas['fa_prefix'],$fas['fa_phone'],$fas['fa_email'],$fas['room']);
                
    ?>

                <h3 id="advisors"> Advisors </h3>
                <table>
                    <thead>
                        <tr>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Prefix </th>
                            <th> Phone </th>
                            <th> Email </th>
                            <th> Room Preference </th>
                            <th class="remove"> Remove </th>
                        </tr>
                    </thead>
                    <tbody>
            <?php 
                while($stmt->fetch()) {
                    $room = "Single";
                    if($fas['room'] == 1){
                        $room = "Double";
                    }
                    echo "<tr><td>".htmlspecialchars(stripslashes($fas['fa_firstname']),ENT_QUOTES)."</td><td>".htmlspecialchars(stripslashes($fas['fa_lastname']),ENT_QUOTES)."</td>
                        <td>".htmlspecialchars(stripslashes($fas['fa_prefix']),ENT_QUOTES)."</td><td>".htmlspecialchars(stripslashes($fas['fa_phone']),ENT_QUOTES)."</td>
                        <td>".htmlspecialchars(stripslashes($fas['fa_email']),ENT_QUOTES)."</td><td>".$room."</td><td class=\"remove-fa\"> <i class=\"fa fa-times-circle\"></i></td></tr>";
                }
                $stmt->close();
            ?>
                    </tbody>
                </table>

                <form action="ajax/insert_fa.php" method="post">
                    <fieldset>
                        <legend> Add an Advisor </legend>
                        <input type="text" name="fname" id="fname" placeholder="First Name" required/> 
                        <input type="text" name="lname" id="lname" placeholder="Last Name" required/> 
                        <input type="hidden" id="school_id" name="school_id" <?echo "value=\"".$school_id."\"";?>>
                        <label> Prefix
                            <select name="prefix" id="prefix">
                                    <option value="Mr." selected>Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Dr.">Dr.</option>
                            </select>
                        </label>
                        <label> Hotel Room Preference
                            <select name="hotel" id="hotel">
                                    <option value="0" selected>Single</option>
                                    <option value="1">Double</option>
                            </select>
                        </label>
                        <input type="text" name="phone" id="phone" placeholder="Phone" required/> 
                        <input type="email" name="email" id="email" placeholder="Email" required/> 
                        <input type="submit" class="button tiny right" value="Submit"/>
                    </fieldset>
                </form>

                </div>
            </div>
        </section>


<? getFooter() ?>

    </body>
</html>
