<?php
    include_once("function.php");
    include_once("config.php");
    include_once("function-auth.php");
    
    if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
        header("Location: login.php");
    }

    $school_id = $_SESSION['school_id'];
    $stmt = $mysqli->prepare("SELECT school_name,school_address1,school_address2,school_city,school_state,school_postalcode,
        school_country,school_delegation_size,school_num_fa,school_attend_ilmunc,school_fee_category,invoice,school_registered FROM school WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $school=array();
    $stmt->bind_result($school['school_name'],$school['school_address1'],$school['school_address2'],$school['school_city'],$school['school_state'],        $school['school_postalcode'],$school['school_country'],$school['school_delegation_size'],$school['school_num_fa'],$school['school_attend_ilmunc'],$school['school_fee_category'],$school['invoice'],$school['school_registered']);
    $stmt->fetch();
    $stmt->close();

    $sc_name = $school['school_name'];
    $o_fa= $school['school_num_fa'];
    $o_del = $school['school_delegation_size'];
    
    if($school['school_fee_category'] > -3 && $school['school_fee_category'] < 3) {
    } else    {
        ?><script type="text/javascript">
          <!--
              window.location = "dashboard_ind.php"
          //-->
          </script><?php }

          getHeader("ILMUNC India | Dashboard "); 

          getDashStyle();
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
        <? getDashboardNav("dashboard"); ?>
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
                <h2> <?php echo stripslashes($school['school_name']); ?> Delegation Manager</h2>
                <h3> Important Notes! </h3>
                <ul id="notes"> 
                    <li><i class="fa fa-exclamation-circle"></i>  The deadline for Priority Registrations is <b>September 30th</b>. All payments must be made in full before that date for countries to be assigned. For a full list of all fees and dates, please click <a href="fees.php">here</a>. </li>
                    <li><i class="fa fa-exclamation-circle"></i>  Remember to submit your country preferences <a href="dash_countries.php">here</a>. </li>
                    <li><i class="fa fa-exclamation-circle"></i>  Please review the faculty advisor agreement <a href="./assets/fa-agreement.pdf">here</a>. </li>
                    <li><i class="fa fa-exclamation-circle"></i>  To change / update your password, please click <a href="update_password.php">here</a>. </li>
                </ul>

                <h3> School Info </h3>
                <table> 
                    <tr>
                        <th> School </th>
                        <td> 
                            <span id="school_name"> <?php echo stripslashes($school['school_name']); ?> </span>
                            <form id="school-form" method="post" action="ajax/update_name.php">
                                <input name="school_name" id="school_name" type="text" />
                                <input type="hidden" id="school_id" name="school_id" <?php echo "value=\"".$school_id."\""; ?>>
                                <input type="submit" id="name-form-submit" style="visibility: hidden;" value="Submit" >
                            </form>
                        </td>
                        <td class="button-td"> 
                            <a class="edit button tiny" data-target-form="school-form" data-target-info="school_name"> Edit </a>
                            <a class="button tiny hidden submit" data-target-form="school-form" data-target-button="name-form-submit"> Submit </a>
                        </td>
                    </tr>
                    <tr>
                        <th> Address </th>
                        <td> 
                             <span id="address-hide">
                                 <span id="street"><?php echo stripcslashes($school['school_address1']); ?></span><br>
                                 <span id="area"><?php echo stripcslashes($school['school_address2']); ?></span><br>
                                 <span id="city"><?php echo stripcslashes($school['school_city']); ?></span>
                                 <span id="state"><?php echo stripcslashes($school['school_state']); ?></span>
                                 <span id="zip"><?php echo $school['school_postalcode']; ?></span> <br> 
                                 <span id="country"><?php echo stripcslashes($school['school_country']); ?></span>
                                <!--<p> Will you be staying at the conference hotel? </p>
                                 <span id="country"> Yes </span>-->
                             </span>
                             <form id="address-form" method="post" action="ajax/update_address.php">
                                 <input type="text" id="street" name="street" placeholder="Street" />
                                 <input type="text" id="area" name="area" placeholder="Area" />
                                 <input type="text" id="city" name="city" placeholder="City" />
                                 <input type="text" id="state" name="state" placeholder="State" />
                                 <input type="text" id="zip" name="zip" placeholder="Zip Code" />
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
                                 <input type="hidden" id="school_id" name="school_id" <?php echo "value=\"".$school_id."\""; ?>>
                                 <input type="submit" id="address-form-submit" style="visibility: hidden;" value="Submit" >
                             </form>
                        </td>
                        <td class="button-td"> 
                            <a class="edit button tiny" data-target-form="address-form" data-target-info="street area city state zip country address-hide"> Edit </a>
                            <a class="button tiny hidden submit" data-target-form="address-form" data-target-button="address-form-submit"> Submit </a>
                        </td>
                    </tr>
                    <tr>
                        <th> Delegation </th>
                        <td> 
                            <span id="delegation-hide"> 
                                <span id="students"><?php echo $school['school_delegation_size']; ?></span> students with 
                                <span id="advisors"><?php echo $school['school_num_fa']; ?></span>  advisors 
                            </span>
                            <form id="delegation-form" method="post" action="ajax/update_numbers.php">
                                <input type="number" name="students" id="students" placeholder="Number of Students" />
                                <input type="number" min="1" name="advisors" id="advisors" placeholder="Number of Advisors" />
                                <input type="hidden" name="name" id="name" <?php echo "value=\"".$sc_name."\""; ?>>
                                <input type="hidden" name="old_advisors" id="old_advisors" <?php echo "value=\"".$o_fa."\""; ?>>
                                <input type="hidden" name="old_students" id="old_students" <?php echo "value=\"".$o_del."\""; ?>>
                                <input type="hidden" id="school_id" name="school_id" <?php echo "value=\"".$school_id."\""; ?>>
                                <input type="submit" id="numbers-form-submit" style="visibility: hidden;" value="Submit" >
                            </form>
                        </td>
                        <td class="button-td"> 
                            <a class="edit button tiny" data-target-form="delegation-form" data-target-info="students advisors delegation-hide"> Edit </a>
                            <a class="button tiny hidden submit" data-target-form="delegation-form" data-target-button="numbers-form-submit"> Submit </a>
                        </td>
                    </tr>
                    <tr>
                        <th> Hotel Transfers </th>
                        <td> 
                            <span id="school_attend_ilmunc"> <?php 
                                if ($school['school_attend_ilmunc'] == 0) {
                                    echo 'None';
                                }
                                else if ($school['school_attend_ilmunc'] == 1) {
                                    echo 'Bus';
                                }
                                else if ($school['school_attend_ilmunc'] == 2) {
                                    echo 'Train';
                                }
                                else if ($school['school_attend_ilmunc'] == 3) {
                                    echo 'Flight';
                                }
                           ?> </span>
                            <form id="transfer-form" method="post" action="ajax/update_transfer.php">
                                Do you require a transfer to the hotel? If so, how will you be arriving? <br />
                                <select id="school_attend_ilmunc" name="school_attend_ilmunc">
                                    <option value="0">None</option>
                                    <option value="1">Bus</option>
                                    <option value="2">Train</option>
                                    <option value="3">Flight</option>
                                </select>
                                <input type="hidden" id="school_id" name="school_id" <?php echo "value=\"".$school_id."\""; ?>>
                                <input type="submit" id="transfer-form-submit" style="visibility: hidden;" value="Submit" >
                            </form>
                        </td>
                        <td class="button-td"> 
                            <a class="edit button tiny" data-target-form="transfer-form" data-target-info="school_attend_ilmunc"> Edit </a>
                            <a class="button tiny hidden submit" data-target-form="transfer-form" data-target-button="transfer-form-submit"> Submit </a>
                        </td>
                    </tr>
                </table>
                <?php
    $c_spots_given = array();
    $stmt = $mysqli->prepare("SELECT country.country_id, COUNT(delegate.country_id) FROM (school_country LEFT JOIN country ON country.country_id = school_country.country_id) LEFT JOIN delegate ON delegate.country_id = country.country_id WHERE school_country.school_id=? GROUP BY country.country_id");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $stmt->bind_result($cid, $ccount);
    $country_opt = "";
    while($stmt->fetch()) {
        $c_spots_given[$cid] = $ccount;
    }

    $stmt->close();
    $stmt = $mysqli->prepare("SELECT country.country_id,country.country_name, SUM(committee_country.num_delegates) FROM (school_country LEFT JOIN country ON country.country_id = school_country.country_id) LEFT JOIN committee_country ON committee_country.country_id = country.country_id WHERE school_country.school_id=? GROUP BY country.country_id");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $stmt->bind_result($countries['country_id'],$countries['country_name'],$countries['num_delegates']);
    $country_opt = "";
    while($stmt->fetch()) {
        $unassigned = $countries['num_delegates'] - $c_spots_given[$countries['country_id']];
        $country_opt .= "<tr><td>".$countries["country_name"]."</td><td>".$countries['num_delegates']."</td><td>".$unassigned."</td></tr>";
    }

    $stmt->close();
    $stmt = $mysqli->prepare("SELECT count(school_id) as assignments FROM school_country WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $stmt->bind_result($num_assignments);
    $stmt->fetch();
    $stmt->close();
    ?>
                <h3 class="text-center"> Delegation Summary </h3>
                <h4> Assignments </h4>
                <?php if($num_assignments > 0) { ?>
                <table>
                    <thead> 
                        <tr>
                            <th> Country / Position </th>
                            <th> Number of Seats </th>
                            <td> Unassigned </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $country_opt; ?>
                    </tbody>
                </table><?php
        $stmt = $mysqli->prepare("SELECT del_firstname,del_lastname,del_email,country_name,committee_name FROM delegate LEFT JOIN committee ON 
                delegate.committee_id = committee.committee_id 
                LEFT JOIN country ON country.country_id = delegate.country_id WHERE delegate.school_id=?");
        $stmt->bind_param('d', $school_id);
        $stmt->execute();
        $dels = array();
        $stmt->bind_result($dels['del_firstname'],$dels['del_lastname'],$dels['email'],$dels['country_name'],$dels['committee_name']);
        ?>
            <h4> Delegates </h4>
                <table class="delegates">
                    <thead> 
                        <tr>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Country / Position </th>
                            <th> Committee </th>
                            <th> Email </th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
        while($stmt->fetch()) {
            echo "<tr><td>".htmlspecialchars(stripslashes($dels['del_firstname']),ENT_QUOTES)."</td>
                                    <td>".htmlspecialchars(stripslashes($dels['del_lastname']),ENT_QUOTES)."</td><td>".$dels['country_name']."</td>
                                    <td>".$dels['committee_name']."</td><td>".htmlspecialchars(stripslashes($dels['email']),ENT_QUOTES)."</td></tr>";
        }

        $stmt->close();
        ?>
                    </tbody>
                </table>
                <div class="edit">
                    <a class="text-centered" href="delegation.php#delegates"> Edit Delegates </a>
                </div>  <?php } else { ?>
            <p>Sorry, but you have not been assigned a country/position. Please remember that deposits must be submitted by the due date for you to be included in that round of country assignments. To submit your preferences please submit them <a href="dash_countries.php">here</a>.  A list of due dates can be viewed <a href="./fees.php">here</a>.</p>
            <?php
    }

    $stmt = $mysqli->prepare("SELECT fa_firstname,fa_lastname,fa_prefix,fa_phone,fa_email,fa_room FROM facultyadvisor WHERE school_id = ?");
    $stmt->bind_param('d', $school_id);
    $stmt->execute();
    $fas=array();
    $stmt->bind_result($fas['fa_firstname'],$fas['fa_lastname'],$fas['fa_prefix'],$fas['fa_phone'],$fas['fa_email'],$fas['room']);
    ?>
                <h4> Advisors </h4>
                <table>
                    <thead>
                        <tr>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Prefix </th>
                            <th> Phone </th>
                            <th> Email </th>
                            <th> Room Preference </th>
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
                                <td>".htmlspecialchars(stripslashes($fas['fa_email']),ENT_QUOTES)."</td><td>".$room."</td></tr>";
    }

    $stmt->close();
    ?>
                    </tbody>
                </table>
                <div class="edit">
                    <a class="text-centered" href="delegation.php#advisors"> Edit Advisors </a>
                </div>
                <hr class="custom_hr"/>
                </div>
            </div>
        </section>
        <?php getFooter(); ?>
        <!-- DASHBOARD FUNCTIONALITY -->
        <script src="js/dashboard.js"></script> 
    </body>
</html>