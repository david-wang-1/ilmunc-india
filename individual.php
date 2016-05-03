<?php
    include_once("function.php");
    include("config.php");
    getHeader('ILMUNC India | Individual Registration');
?>
        <style>
            .header-image {
                background-image: url("assets/headers/hotel-header.jpg");
                background-position-y: -100px;
            }

            #submit {
                width: 100%;
                text-align: center;
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

    <body onLoad="countdown()">
        
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
                <h2> ILMUNC India 2015 Individual Registration Form </h2>
<?

    function notNum($value) {
        return !preg_match("/^[0-9]+$/",$value) || preg_match("/[ ]+/",$value);
    }
    function length($value) {
        return strlen($value);
    }
    if(count($_POST)>12) {
        //a form is being submitted
        
        //-----------------------------------------------------------
        /* Use the following variable to set the registration period.
        1 = waived desposit
        2 = normal fees 
        
        A negative number is used to indicate the school registration period and the fact that it is waitlisted.
        */
        
        $reg_period = -3;
        //-----------------------------------------------------------
        
        //this keeps track of errors
        
        $errors = array();
        
        $fa_username = $_POST['usernamea'];
        $stmt = $mysqli->prepare("SELECT acct_name FROM account WHERE acct_name = ?");
        $stmt->bind_param('s', $fa_username);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0) {
            $errors['usernamea'] = "Username already exists, please choose another.";
        }
        $stmt->close();


        //primary informatio query
        $fa_firstname = $_POST['fa_firstname'];
        $fa_lastname = $_POST['fa_lastname'];
        $fa_prefix = $_POST['fa_prefix'];
        $fa_phone = $_POST['fa_phone_number'];
        // if(!preg_match("/^[0-9+]{10,13}$/",$fa_phone)) {
        //     $errors['fa_phone_number'] = "Please enter a valid 10 - 12 digit phone number.";
        // }
        $fa_email = $_POST['fa_mailmsg'];
        if(!preg_match("/[a-zA-Z0-9._%+-]+@(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}/",$fa_email)) {
            $errors['fa_mailmsg'] = "Please enter a valid email address.";
        }
        $deladdress1 = $_POST['deladdress1'];
        $deladdress2 = $_POST['deladdress2'];
        $delcity = $_POST['delcity'];
        $delstate = $_POST['delstate'];
        $delpostalcode = $_POST['delzip'];
        $delcountry = $_POST['delcountry'];
        //school query
        $school_name = $_POST['name'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $postalcode = $_POST['zip'];
        $country = $_POST['country'];

        $del_attended = $_POST['mun_attended'];

        $prize1 = $_POST['prize1'];
        $prize2 = $_POST['prize2'];
        $prize3 = $_POST['prize3'];
        
        $fa_password = $_POST['passworda'];
        $fa_vpassword = $_POST['password_c'];

        if($fa_password != $fa_vpassword)
        {
            $errors['password_c'] = "Passwords do not match. Please retype.";
        }

        $delsize = 1;
        
        if(count($errors) == 0) {

            $experience = "See delegate awards in Individual";
            $num_fa = 0;

            $stmt = $mysqli->prepare("INSERT INTO school (school_name,school_address1,school_address2,school_city,school_state,
                school_postalcode,school_country,school_delegation_size,school_num_fa, school_fee_category, school_registered,school_ip,school_exp)
                VALUES (?,?,?,?,?,?,?,?,?,?,NOW(),?,?)");
            $stmt->bind_param('sssssssdddss', $school_name,$address1,$address2,$city,$state,$postalcode,$country,$delsize,$num_fa,$reg_period,$_SERVER["REMOTE_ADDR"],$experience);
            $stmt->execute();
            
            $school_id = $mysqli->insert_id;
            if($school_id == 0) {
                die("Form submission had a fatal error. Please go back and try again.");
            }
            $stmt->close();
            
            
            
            $stmt = $mysqli->prepare("INSERT INTO individual (school_id,ind_firstname,ind_lastname,ind_prefix,ind_phone,ind_email,ind_add1,ind_add2,ind_city,ind_state,ind_postalcode,ind_country,num_attended,prize1,prize2,prize3)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('dsssssssssssssss', $school_id,$fa_firstname,$fa_lastname,$fa_prefix,$fa_phone,$fa_email,$deladdress1,$deladdress2,$delcity,$delstate,$delpostalcode,$delcountry,$del_attended,$prize1,$prize2,$prize3);
            $stmt->execute();
            $stmt->close();
            
            //account query
        
            $stmt = $mysqli->prepare("INSERT INTO account (acct_name,acct_pass,school_id,p_hash)
                VALUES (?,?,?,?)");
            $stmt->bind_param('ssds', $fa_username,$fa_password,$school_id,md5($fa_password));
            $stmt->execute();
            $stmt->close(); 
            
            
            $stmt = $mysqli->prepare("SELECT global_variable,global_value FROM globals");
            $stmt->execute();
            $stmt->bind_result($var,$val);
        
            $global = array();
            while($stmt->fetch()) {
                $global[$var] = $val;
            }
            $stmt->close();
            
            $school_text = "";
            // The message

                $triple_fee = $global['ind_in_hotel_triple'];
                $double_fee = $global['ind_in_hotel_double'];
                $single_fee = $global['ind_in_hotel_single'];
            
            $message = '<html>
<body>
<div style="width: 500px;margin: 0px auto;"><a href="#"><img style="width: 550px;" src="http://www.ilmunc-india.com/assets/ilmunc-india-black.jpg" alt="" /></a></div>
  <p>Dear '.$fa_prefix.' '.$fa_lastname.',</p>

<p>Thank you for registering for the Ivy League Model United Nations Conference India! We cannot be more excited to welcome you to the conference in New Delhi this November! This email serves as a confirmation that we have received your registration. We do require you to finish a few more steps to ensure your spot at the conference.</p>

<p>You can now login to our website using the credentials that you entered while registering. You can click on the login tab on the far right of the website or go to www.ilmunc-india.com/login.php. If at anytime you forget your password, you can reset it by clicking on the “forgot password” link on the login page. You can also change your password at anytime after logging in.</p>

<p><b>Review your Details</b></p>

<p>Logging in will take you to the dashboard where you will be able to view your personal information, information about your school and committee assignments once they become available to you. Ensure that the information you have entered is correct including your personal information and your school information. Also ensure that you go through the individual delegate agreement thoroughly. By registering and attending the conference you have agreed to abide by this agreement. </p>

<p><b>Entering Committee Preferences</b></p>

<p>By clicking on the Committees tab on the top menu, you will be taken to a page where you can enter your committee preferences. Please ensure that you read the information provided on that page before entering your country preferences. You will be able to change your preferences until the Priority Registration period ends. </p>

<p><b>Payment</b></p>

<p>The billing tab will show you the total amount that needs to be paid to complete your registration for the conference. It also has instructions on how to complete payments. Please note that your registration is not completed until all payments have been received. Failure to complete payments may result in you being moved to the waitlist. Countries and committees will only be allocated once a full payment has been made. Remember to review our registration policies at http://www.ilmunc-india.com/fees.php If you have any problems with payments please email president@ilmunc-india.com for domestic delegates and secgen@ilmunc-india.com for international delegates.</p>

<p>Once again, thank you for registering and welcome to the ILMUNC India family! If you ever have any questions or concerns, I urge you to contact me at secgen@ilmunc-india.com or to call our team at +91 40 64630095.</p>

<p>On behalf of the ILMUNC India secretariat and organizing committee, I cannot wait to welcome you to New Delhi this November!</p>

<p>Warm Regards,</p>
<p>Santosh Vallabhaneni<br />
Secretary-General<br />
ILMUNC India 2015</p>
<p>P: +91 40 64630095<br />
W: www.ilmunc-india.com<br />
F: www.facebook.com/ilmuncindia<br />
E: secgen@ilmunc-india.com</p>
</body>
</html>';
            
            $message = wordwrap($message, 70);
            

            $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: ILMUNC India <secgen@ilmunc-india.com>' . "\r\n" .
            'Reply-To: secgen@ilmunc-india.com' . "\r\n" .
            'Cc: ' . "\r\n";
            
            // In case any of our lines are larger than 70 characters, we should use wordwrap()
            //$message = wordwrap($message, 70);
            
            // Send
            $subject = '[ILMUNC India] Individual Registration Confirmation';
            
            mail($fa_email, $subject, $message,$headers);

            //Secretariat Message

            $sec_message = '<html>
<body>
  <p>Dear Secretariat Member,</p>
<p>A new individual delegate has registered for ILMUNC India 2015. Please find the details of the delegate below:</p>
<p><b>Delegate Information</b> <br />
Delegate Name: '.$fa_prefix.' '.$fa_firstname.' '.$fa_lastname.'<br />
Delegate Address: '.$deladdress1.', '.$deladdress2.', '.$delcity.', '.$delstate.', '.$delpostalcode.'<br />
Delegate Country: '.$delcountry.'<br />
Delegate Phone: '.$fa_phone.'<br />
Delegate Email: '.$fa_email.'</p>
<p><b>School Information</b> <br />
School Name: '.$school_name.'<br />
School Address: '.$address1.', '.$address2.', '.$city.', '.$state.', '.$postalcode.'<br />
School Country: '.$country.'</p>
<p><b>Past Experience</b> <br />
Number of MUN Conferences attended: '.$del_attended.'<br />
Top 3 Prizes won: '.$prize1.'; '.$prize2.'; '.$prize3.'</p>
<p>Best,<br />
Dhruv Agarwal<br />
Under Secretary-General Operations<br />
ILMUNC India 2015</p>
<p>P: +1 267-912-8714<br />
E: usg-ops@ilmunc-india.com<br />
W: www.ilmunc-india.com</p>
</body>
</html>';

$sec_message = wordwrap($sec_message, 70);
            

            $sec_headers  = 'MIME-Version: 1.0' . "\r\n";
$sec_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$sec_headers .= 'From: Under Secretary-General Operations <usg-ops@ilmunc-india.com>' . "\r\n" .
            'Reply-To: usg-ops@ilmunc-india.com' . "\r\n" .
            'Cc: ' . "\r\n";
            
            // In case any of our lines are larger than 70 characters, we should use wordwrap()
            //$message = wordwrap($message, 70);
            
            // Send
            $sec_subject = '[ILMUNC India] New Individual Delegate Registration';

            mail('secgen@ilmunc-india.com', $sec_subject, $sec_message,$sec_headers);
            mail('dirgen@ilmunc-india.com', $sec_subject, $sec_message,$sec_headers);
            mail('president@ilmunc-india.com', $sec_subject, $sec_message,$sec_headers);
            mail('usg-ops@ilmunc-india.com', $sec_subject, $sec_message, $sec_headers);
            ?>
                
                    <div class="main large-8 column">
            <p style="font-size:11.5pt;">Thank you for registering! An email has been sent with confirmation. <br>If you encounter any technical difficulties, please email the Under-Secretary-General Operations at <a href="mailto:usg-ops@ilmunc-india.com">usg-ops@ilmunc-india.com</a>.</p><br>
                <a href="../login.php"><p>Sign In here</p></a>
                </div>
            
<?
        } else {

            displayForm($errors);
    
        }
        
    } else {
    
        displayForm();
    
    }
    
    function displayForm($errors=null) {
    

?> 
                    <div class="main large-8 column">
                        <h3 style="text-align: center;"> Registrations are now closed!</h3>
                <p>In case you have any questions, please feel free to reach out to us at <a href="mailto: secgen@ilmunc-india.com">secgen@ilmunc-india.com</a>.</p>
                
                    <!-- <form action="<?=$_SERVER['PHP_SELF']; ?>" method="post">
                        <fieldset>
                            <legend>Delegate Information</legend>
                            <input type="text" required name="fa_firstname" id="fa_firsname" aria-label="primary-first-name" placeholder="First Name" />
                            <input type="text" required name="fa_lastname" id="fa_lastname" aria-label="primary-last-name" placeholder="Last Name" />
                            <label> Prefix
                                <select name="fa_prefix" id="fa_prefix">
                                    <option> Mr. </option>
                                    <option> Ms. </option>
                                </select>
                            </label>
                            <input type="text" required name="deladdress1" id="deladdress1" aria-label="deladdress1" placeholder="Address Line 1" />
                            <input type="text" name="deladdress2" id="deladdress2" aria-label="deladdress2" placeholder="Address Line 2" />
                            <input type="text" required required name="delcity" id="delcity" aria-label="delcity" placeholder="City" />
                            <input type="text" required name="delstate" id="delstate" aria-label="delstate" placeholder="State" />
                            <input type="text" required name="delzip" id="delzip" aria-label="delzip" placeholder="Zip/Postal Code" />
                            <select id="delcountry" name="delcountry">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Ã�land Islands">Ã�land Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                            <input type="text" required name="fa_phone_number" id="fa_phone_number" aria-label="primary-phone" placeholder="Phone Number" />
                            <?// if ($errors['fa_phone_number'] != "") 
                            //echo "<p style=\"color:red;\">".$errors['fa_phone_number']."</p>" ?>
                            <input type="email" required name="fa_mailmsg" id="fa_mailmsg" aria-label="primary-email" placeholder="Email" />
                            <? if ($errors['fa_mailmsg'] != "") 
                            echo "<p style=\"color:red;\">".$errors['fa_mailmsg']."</p>" ?>
                        </fieldset>
                        <fieldset>
                            <legend>School Information</legend>
                            <input type="text" required name="name" id="name" aria-label="school-name" placeholder="School Name"/>
                            <input type="text" required name="address1" id="address1" aria-label="school-address-1" placeholder="Address Line 1" />
                            <input type="text" name="address2" id="address2" aria-label="school-address-2" placeholder="Address Line 2" />
                            <input type="text" required name="city" id="city" aria-label="school-city" placeholder="City" />
                            <input type="text" required name="state" id="state" aria-label="school-state" placeholder="State" />
                            <input type="text" required name="zip" id="zip" aria-label="school-zip" placeholder="Zip/Postal Code" />
                            <select id="country" name="country">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Ã�land Islands">Ã�land Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory">Palestinian Territory</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="South Sudan">South Sudan</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                        </fieldset>
                        <fieldset>
                            <legend>Past Experience</legend>
                            <input type="number" name="mun_attended" id="mun_attended" required aria-label="conferences-attended" placeholder="Number of Conferences Attended" />
                            <p> Please list the top 3 awards you have recieved below. This includes positions on the secretariat of other conferences and chair positions etc. </p>
                            <input type="text" name="prize1" id="prize1" aria-label="award-1" placeholder="Award 1" />
                            <input type="text" name="prize2" id="prize2" aria-label="award-2" placeholder="Award 2" />
                            <input type="text" name="prize3" id="prize3" aria-label="award-3" placeholder="Award 3" />
                        </fieldset>
                        <fieldset>
                            <legend>New Account Information</legend>
                            <p> Please enter the details below. A new account will be created once you have accepted the terms and conditions and pressed register. </p>
                            <input type="text" required name="usernamea" id="usernamea" aria-label="username" placeholder="Username" />
                            <? if ($errors['usernamea'] != "") 
                            echo "<p style=\"color:red;\">".$errors['usernamea']."</p>" ?>
                            <input type="password" required name="passworda" id="passworda" aria-label="password" placeholder="Password" />
                            <input type="password" required name="password_c" id="password_c" aria-label="confirm-password" placeholder="Confirm Password" />
                            <? if ($errors['password_c'] != "") 
                            echo "<p style=\"color:red;\">".$errors['password_c']."</p>" ?>
                        </fieldset>
                        <fieldset>
                            <legend> Individual Delegate Contract </legend>
                            <div>
                                <iframe width="100%" height="300px" src="assets/indi-agreement-full.pdf"></iframe>
                            </div>
                            <label> 
                                <input type="checkbox" required name="agree" id="agree" aria-label="contract" />  I acknowledge that I have read this individual delegate agreement, understand the expectations and obligations, and commit to fulfilling my obligations as an individual delegate in ILMUNC India 2015.
                            </label>
                        </fieldset>
                        <p> <b> Please note that ILMUNC India 2015 is only open to high-school students. You must be a student of Grade 7 - 12 as of November 26, 2015 to be eligible to apply. Registrations received from personnel not in this category will be disregarded. </b></p>
                        <p> Please make sure that there are no errors in the form before pressing "Register". </p>
                        <div id="submit">
                            <input type="submit" class="button" value="Register" /> 
                        </div>
                    </form> -->
                </div>
                
                    <? } getAnnouncement(); ?>
            
        </section>

<? getFooter(); ?>

    </body>
</html>
