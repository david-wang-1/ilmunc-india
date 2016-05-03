<?php 
include_once("function.php");
include_once("config.php");
include_once("function-auth.php");
if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
  header("Location: login.php");
}
getHeader("ILMUNC India | Applications "); 
$school_id = $_SESSION['school_id'];
$stmt = $mysqli->prepare("SELECT school_name,school_address1,school_address2,school_city,school_state,school_postalcode,
    school_country,school_delegation_size,school_num_fa,school_attend_ilmunc,school_fee_category,invoice,school_registered FROM school WHERE school_id = ?");
$stmt->bind_param('d', $school_id);
$stmt->execute();
$school=array();
$stmt->bind_result($school['school_name'],$school['school_address1'],$school['school_address2'],$school['school_city'],$school['school_state'],        $school['school_postalcode'],$school['school_country'],$school['school_delegation_size'],$school['school_num_fa'],$school['school_attend_ilmunc'],$school['school_fee_category'],$school['invoice'],$school['school_registered']);
$stmt->fetch();
$stmt->close();

if($school['school_fee_category'] > -3 && $school['school_fee_category'] < 3) {
} else    {
    ?><script type="text/javascript">
    <!--
    window.location = "applications_ind.php"
          //-->
          </script><?php }
          for ($i=1; $i < 6; $i++) { 
              $ipr_email = $_POST["ipr_nom".$i];
              $ipr_fname = $_POST["ipr_fname".$i];
              $ipr_lname = $_POST["ipr_lname".$i];
              $message = '<html>
              <body>
              <div style="width: 500px;margin: 0px auto;"><a href="#"><img style="width: 550px;" src="http://www.ilmunc-india.com/assets/ilmunc-india-black.jpg" alt="" /></a></div>
              <p>Dear '.$ipr_fname.' '.$ipr_lname.',</p>
              <p>It is my distinct pleasure to inform you that your school\'s faculty advisor has nominated you to apply for the position of <b>International Press Reporter</b> for the Ivy League Model United Nations Conference India 2015.</p>
              <p>As you might know, this is a very competitive and much desired position and it is truly an honor to be chosen to apply. To apply for the position, please click on the button below.</p>
              <div style="width: 200px;margin: 0px auto;"><a href="http://www.ilmunc-india.com/ip.php"><img style="width: 150px; height: 50px;"src="http://www.spartanburghumane.org/myimages/applynow.jpg" alt="" /></a></div>
              <p>Once again, congratulations on being nominated to apply from your school and we look forward to reading your application! If you ever have any questions or concerns, I urge you to contact me at usg-ops@ilmunc-india.com or to call our team at +91 40 64630095.</p>
              <p>On behalf of the ILMUNC India secretariat and organizing committee, I cannot wait to welcome you to New Delhi this November!</p>
              <p>Warm Regards,</p>
              <p>Dhruv Agarwal<br />
              Under-Secretary-General Operations<br />
              ILMUNC India 2015</p>
              <p>P: +1 267-912-8714<br />
              W: www.ilmunc-india.com<br />
              F: www.facebook.com/ilmuncindia<br />
              E: usg-ops@ilmunc-india.com</p>
              </body>
              </html>';

              $message = wordwrap($message, 70);
              $headers  = 'MIME-Version: 1.0' . "\r\n";
              $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
              // Additional headers
              $headers .= 'From: ILMUNC India <usg-ops@ilmunc-india.com>' . "\r\n" .
              'Reply-To: usg-ops@ilmunc-india.com' . "\r\n" .
              'Cc: ' . "\r\n";
              // Send
              $subject = '[ILMUNC India] International Press Reporter Nomination';
              mail($ipr_email, $subject, $message, $headers);


              $ipp_email = $_POST["ipp_nom".$i];
              $ipp_fname = $_POST["ipp_fname".$i];
              $ipp_lname = $_POST["ipp_lname".$i];
              $message = '<html>
              <body>
              <div style="width: 500px;margin: 0px auto;"><a href="#"><img style="width: 550px;" src="http://www.ilmunc-india.com/assets/ilmunc-india-black.jpg" alt="" /></a></div>
              <p>Dear '.$ipp_fname.' '.$ipp_lname.',</p>
              <p>It is my distinct pleasure to inform you that your school\'s faculty advisor has nominated you to apply for the position of <b>International Press Photographer</b> for the Ivy League Model United Nations Conference India 2015.</p>
              <p>As you might know, this is a very competitive and much desired position and it is truly an honor to be chosen to apply. To apply for the position, please click on the link below.</p>
              <div style="width: 200px;margin: 0px auto;"><a href="http://www.ilmunc-india.com/ipp.php"><img style="width: 150px; height: 50px;"src="http://www.spartanburghumane.org/myimages/applynow.jpg" alt="" /></a></div>
              <p>Once again, congratulations on being nominated to apply from your school and we look forward to reading your application! If you ever have any questions or concerns, I urge you to contact me at usg-ops@ilmunc-india.com or to call our team at +91 40 64630095.</p>
              <p>On behalf of the ILMUNC India secretariat and organizing committee, I cannot wait to welcome you to New Delhi this November!</p>
              <p>Warm Regards,</p>
              <p>Dhruv Agarwal<br />
              Under-Secretary-General Operations<br />
              ILMUNC India 2015</p>
              <p>P: +91 40 64630095<br />
              W: www.ilmunc-india.com<br />
              F: www.facebook.com/ilmuncindia<br />
              E: usg-ops@ilmunc-india.com</p>
              </body>
              </html>';

              $message = wordwrap($message, 70);
              $headers  = 'MIME-Version: 1.0' . "\r\n";
              $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
              // Additional headers
              $headers .= 'From: ILMUNC India <usg-ops@ilmunc-india.com>' . "\r\n" .
              'Reply-To: usg-ops@ilmunc-india.com' . "\r\n" .
              'Cc: ' . "\r\n";
              // Send
              $subject = '[ILMUNC India] International Press Photographer Nomination';
              mail($ipp_email, $subject, $message, $headers);


              $cri_email = $_POST["cri_nom".$i];
              $cri_fname = $_POST["cri_fname".$i];
              $cri_lname = $_POST["cri_lname".$i];
              $message = '<html>
              <body>
              <div style="width: 500px;margin: 0px auto;"><a href="#"><img style="width: 550px;" src="http://www.ilmunc-india.com/assets/ilmunc-india-black.jpg" alt="" /></a></div>
              <p>Dear '.$cri_fname.' '.$cri_lname.',</p>
              <p>It is my distinct pleasure to inform you that your school\'s faculty advisor has chosen you to apply as a delegate for one of the <b>Crisis Committees</b> of the Ivy League Model United Nations Conference India 2015.</p>
              <p>As you might know, this is a very competitive and much desired position and it is truly an honor to be chosen to apply. To apply for the position, please click on the link below.</p>
              <div style="width: 200px;margin: 0px auto;"><a href="http://www.ilmunc-india.com/crisis.php"><img style="width: 150px; height: 50px;"src="http://www.spartanburghumane.org/myimages/applynow.jpg" alt="" /></a></div>
              <p>Once again, congratulations on being nominated to apply from your school and we look forward to reading your application! If you ever have any questions or concerns, I urge you to contact me at usg-ops@ilmunc-india.com or to call our team at +91 40 64630095.</p>
              <p>On behalf of the ILMUNC India secretariat and organizing committee, I cannot wait to welcome you to New Delhi this November!</p>
              <p>Warm Regards,</p>
              <p>Dhruv Agarwal<br />
              Under-Secretary-General Operations<br />
              ILMUNC India 2015</p>
              <p>P: +1 267-912-8714<br />
              W: www.ilmunc-india.com<br />
              F: www.facebook.com/ilmuncindia<br />
              E: usg-ops@ilmunc-india.com</p>
              </body>
              </html>';

              $message = wordwrap($message, 70);
              $headers  = 'MIME-Version: 1.0' . "\r\n";
              $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
              // Additional headers
              $headers .= 'From: ILMUNC India <usg-ops@ilmunc-india.com>' . "\r\n" .
              'Reply-To: usg-ops@ilmunc-india.com' . "\r\n" .
              'Cc: ' . "\r\n";
              // Send
              $subject = '[ILMUNC India] Crisis Committee Nomination';
              mail($cri_email, $subject, $message, $headers);
          }
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
        <? getDashboardNav("applications"); ?>

        <section class="content">
            <div class="row">
                <div class="large-8 large-centered column">

                    <h2> Applications </h2>
                    <ul class="small-block-grid-2 large-block-grid-3">
                        <li><a data-reveal-id="crisis">
                            <img class="portrait" src="./assets/crisis.jpg" />
                        </a>
                        <a data-reveal-id="crisis"><h4 style="margin-bottom: 0px; text-align: center;"> Crisis Applications </h4></a>
                    </li>
                    <li><a data-reveal-id="reporter">
                        <img class="portrait" src="./assets/ipr.jpg" />
                    </a>
                    <a data-reveal-id="reporter"><h4 style="margin-bottom: 0px; text-align: center;"> IP Reporter </h4></a>
                </li>
                <li><a data-reveal-id="photographer">
                    <img class="portrait" src="./assets/ipp.jpg" />
                </a>
                <a data-reveal-id="photographer"><h4 style="margin-bottom: 0px; text-align: center;"> IP Photographer </h4></a>
            </li>
        </ul>
        <div class="person reveal-modal" data-reveal aria-hidden="true" id="crisis">
            <form action="<?=$_SERVER['PHP_SELF']; ?>" method="post" onSubmit="alert('Thank you! Your nominees have been invited to apply.');">
                <a href="#" style="color: #000000;" class="close-reveal-modal">x</a>
                <h4>Crisis Committee Delegate Nominations</h4>
                <p>You can invite <b>upto 5</b> students to apply for the Crisis Committees.</p>
                <table style="border: solid 0px #ddd">
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                </tr>
                <tr>
                    <td><input type="text" name="cri_fname1" id="cri_fname1" aria-label="first-name" placeholder="Nominee 1 First Name" /></td>
                    <td><input type="text" name="cri_lname1" id="cri_lname1" aria-label="last-name" placeholder="Nominee 1 Last Name" /></td>
                    <td><input type="email" name="cri_nom1" id="cri_nom1" aria-label="primary-email" placeholder="Nominee 1 Email" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="cri_fname2" id="cri_fname2" aria-label="first-name" placeholder="Nominee 2 First Name" /></td>
                    <td><input type="text" name="cri_lname2" id="cri_lname1" aria-label="last-name" placeholder="Nominee 2 Last Name" /></td>
                    <td><input type="email" name="cri_nom2" id="cri_nom2" aria-label="primary-email" placeholder="Nominee 2 Email" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="cri_fname3" id="cri_fname3" aria-label="first-name" placeholder="Nominee 3 First Name" /></td>
                    <td><input type="text" name="cri_lname3" id="cri_lname3" aria-label="last-name" placeholder="Nominee 3 Last Name" /></td>
                    <td><input type="email" name="cri_nom3" id="cri_nom3" aria-label="primary-email" placeholder="Nominee 3 Email" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="cri_fname4" id="cri_fname4" aria-label="first-name" placeholder="Nominee 4 First Name" /></td>
                    <td><input type="text" name="cri_lname4" id="cri_lname4" aria-label="last-name" placeholder="Nominee 4 Last Name" /></td>
                    <td><input type="email" name="cri_nom4" id="cri_nom4" aria-label="primary-email" placeholder="Nominee 4 Email" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="cri_fname5" id="cri_fname5" aria-label="first-name" placeholder="Nominee 5 First Name" /></td>
                    <td><input type="text" name="cri_lname5" id="cri_lname5" aria-label="last-name" placeholder="Nominee 5 Last Name" /></td>
                    <td><input type="email" name="cri_nom5" id="cri_nom5" aria-label="primary-email" placeholder="Nominee 5 Email" /></td>
                </tr>
            </table>
            <div style="margin-top: 10px;" id="submit">
                <input type="submit" class="button" value="Submit" /> 
            </div>
        </form>
    </div>
        <div class="person reveal-modal" data-reveal aria-hidden="true" id="reporter">
            <form action="<?=$_SERVER['PHP_SELF']; ?>" method="post" onSubmit="alert('Thank you! Your nominees have been invited to apply.');">
                <a href="#" style="color: #000000;" class="close-reveal-modal">x</a>
                <h4>International Press Reporter Nominations</h4>
                <p>You can invite <b>upto 5</b> students to apply for the role of International Press Reporter.</p>
                <table style="border: solid 0px #ddd">
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                </tr>
                <tr>
                    <td><input type="text" name="ipr_fname1" id="ipr_fname1" aria-label="first-name" placeholder="Nominee 1 First Name" /></td>
                    <td><input type="text" name="ipr_lname1" id="ipr_lname1" aria-label="last-name" placeholder="Nominee 1 Last Name" /></td>
                    <td><input type="email" name="ipr_nom1" id="ipr_nom1" aria-label="primary-email" placeholder="Nominee 1 Email" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="ipr_fname2" id="ipr_fname2" aria-label="first-name" placeholder="Nominee 2 First Name" /></td>
                    <td><input type="text" name="ipr_lname2" id="ipr_lname1" aria-label="last-name" placeholder="Nominee 2 Last Name" /></td>
                    <td><input type="email" name="ipr_nom2" id="ipr_nom2" aria-label="primary-email" placeholder="Nominee 2 Email" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="ipr_fname3" id="ipr_fname3" aria-label="first-name" placeholder="Nominee 3 First Name" /></td>
                    <td><input type="text" name="ipr_lname3" id="ipr_lname3" aria-label="last-name" placeholder="Nominee 3 Last Name" /></td>
                    <td><input type="email" name="ipr_nom3" id="ipr_nom3" aria-label="primary-email" placeholder="Nominee 3 Email" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="ipr_fname4" id="ipr_fname4" aria-label="first-name" placeholder="Nominee 4 First Name" /></td>
                    <td><input type="text" name="ipr_lname4" id="ipr_lname4" aria-label="last-name" placeholder="Nominee 4 Last Name" /></td>
                    <td><input type="email" name="ipr_nom4" id="ipr_nom4" aria-label="primary-email" placeholder="Nominee 4 Email" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="ipr_fname5" id="ipr_fname5" aria-label="first-name" placeholder="Nominee 5 First Name" /></td>
                    <td><input type="text" name="ipr_lname5" id="ipr_lname5" aria-label="last-name" placeholder="Nominee 5 Last Name" /></td>
                    <td><input type="email" name="ipr_nom5" id="ipr_nom5" aria-label="primary-email" placeholder="Nominee 5 Email" /></td>
                </tr>
            </table>
            <div style="margin-top: 10px;" id="submit">
                <input type="submit" class="button" value="Submit" /> 
            </div>
        </form>
    </div>
    <div class="person reveal-modal" data-reveal aria-hidden="true" id="photographer">
        <form action="<?=$_SERVER['PHP_SELF']; ?>" method="post" onSubmit="alert('Thank you! Your nominees have been invited to apply.');">
            <a href="#" style="color: #000000;" class="close-reveal-modal">x</a>            
            <h4>International Press Photographer Nominations</h4>
            <p>You can invite <b>upto 5</b> students to apply for the role of International Press Photographer.</p>
            <table style="border: solid 0px #ddd">
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
            </tr>
            <tr>
                <td><input type="text" name="ipp_fname1" id="ipp_fname1" aria-label="first-name" placeholder="Nominee 1 First Name" /></td>
                <td><input type="text" name="ipp_lname1" id="ipp_lname1" aria-label="last-name" placeholder="Nominee 1 Last Name" /></td>
                <td><input type="email" name="ipp_nom1" id="ipp_nom1" aria-label="primary-email" placeholder="Nominee 1 Email" /></td>
            </tr>
            <tr>
                <td><input type="text" name="ipp_fname2" id="ipp_fname2" aria-label="first-name" placeholder="Nominee 2 First Name" /></td>
                <td><input type="text" name="ipp_lname2" id="ipp_lname1" aria-label="last-name" placeholder="Nominee 2 Last Name" /></td>
                <td><input type="email" name="ipp_nom2" id="ipp_nom2" aria-label="primary-email" placeholder="Nominee 2 Email" /></td>
            </tr>
            <tr>
                <td><input type="text" name="ipp_fname3" id="ipp_fname3" aria-label="first-name" placeholder="Nominee 3 First Name" /></td>
                <td><input type="text" name="ipp_lname3" id="ipp_lname3" aria-label="last-name" placeholder="Nominee 3 Last Name" /></td>
                <td><input type="email" name="ipp_nom3" id="ipp_nom3" aria-label="primary-email" placeholder="Nominee 3 Email" /></td>
            </tr>
            <tr>
                <td><input type="text" name="ipp_fname4" id="ipp_fname4" aria-label="first-name" placeholder="Nominee 4 First Name" /></td>
                <td><input type="text" name="ipp_lname4" id="ipp_lname4" aria-label="last-name" placeholder="Nominee 4 Last Name" /></td>
                <td><input type="email" name="ipp_nom4" id="ipp_nom4" aria-label="primary-email" placeholder="Nominee 4 Email" /></td>
            </tr>
            <tr>
                <td><input type="text" name="ipp_fname5" id="ipp_fname5" aria-label="first-name" placeholder="Nominee 5 First Name" /></td>
                <td><input type="text" name="ipp_lname5" id="ipp_lname5" aria-label="last-name" placeholder="Nominee 5 Last Name" /></td>
                <td><input type="email" name="ipp_nom5" id="ipr_nom5" aria-label="primary-email" placeholder="Nominee 5 Email" /></td>
            </tr>
        </table>
        <div style="margin-top: 10px;" id="submit">
            <input type="submit" class="button" value="Submit" onSubmit="alert('Thank you! Your nominees have been invited to apply.');"/> 
        </div>
    </form>
</div>
<!--            <h3> Crisis Committee </h3>
                <p>Crisis Committee applications have not been released yet. Please check again when the applications are live!</p> 
                <h3> International Press </h3>
                <p>Applications for International Press have not been released yet. Please check again when the applications are live!</p> -->
                <br />
				<p>If you have any questions please contact the secretariat at <a href = "mailto:info@ilmunc-india.com">info@ilmunc-india.com</a>.</p>
          
       </div>
   </div>
</section>
<?php getFooter() ?>
</body>
</html>