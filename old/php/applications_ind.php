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

$stmt = $mysqli->prepare("SELECT ind_firstname,ind_lastname,ind_phone,ind_email,ind_city FROM individual WHERE school_id = ?");
$stmt->bind_param('d', $school_id);
$stmt->execute();
$ind=array();
$stmt->bind_result($ind['ind_firstname'],$ind['ind_lastname'],$ind['ind_phone'],$ind['ind_email'],$ind['ind_city']);
$stmt->fetch();
$stmt->close();

if($school['school_fee_category'] > -3 && $school['school_fee_category'] < 3) {
    ?><script type="text/javascript">
    <!--
    window.location = "applications.php"
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
    table td form input, table td form select {
        margin: 10px 0 !important;
    }
    #total {
        font-weight: bold;
    }
    </style>
    <!-- MODERNIZR -->
    <script type="text/javascript">
function checkWordLen(wordLen, obj) {
    var len = obj.value.split(/[\s]+/);
    if(len.length > wordLen) {
        alert("Your answer is longer than "+wordLen+" words. Please reduce the length of your answer!");
    }
}
</script>
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
    <? getDashboardNav("applications_ind"); ?>

    <section class="content">
        <div class="row">
            <div class="large-8 large-centered column">

                <h2> Applications </h2>
                <ul class="small-block-grid-2 large-block-grid-3">
                    <li><a onclick="document.getElementById('crisis').style.display = 'block'; document.getElementById('reporter').style.display = 'none'; document.getElementById('photographer').style.display = 'none';">
                        <img class="portrait" src="./assets/crisis.jpg" />
                    </a>
                    <a onclick="document.getElementById('crisis').style.display = 'block'; document.getElementById('reporter').style.display = 'none'; document.getElementById('photographer').style.display = 'none';"><h4 style="margin-bottom: 0px; text-align: center;"> Crisis Applications </h4></a>
                </li>
                <li><a onclick="document.getElementById('reporter').style.display = 'block'; document.getElementById('crisis').style.display = 'none'; document.getElementById('photographer').style.display = 'none';">
                    <img class="portrait" src="./assets/ipr.jpg" />
                </a>
                <a onclick="document.getElementById('reporter').style.display = 'block'; document.getElementById('crisis').style.display = 'none'; document.getElementById('photographer').style.display = 'none';"><h4 style="margin-bottom: 0px; text-align: center;"> IP Reporter </h4></a>
            </li>
            <li><a onclick="document.getElementById('photographer').style.display = 'block'; document.getElementById('reporter').style.display = 'none'; document.getElementById('crisis').style.display = 'none';">
                <img class="portrait" src="./assets/ipp.jpg" />
            </a>
            <a onclick="document.getElementById('photographer').style.display = 'block';document.getElementById('reporter').style.display = 'none'; document.getElementById('crisis').style.display = 'none';"><h4 style="margin-bottom: 0px; text-align: center;"> IP Photographer </h4></a>
        </li>
    </ul>
    <div style="display:none" id="crisis">
        <h4>Crisis Committee Application</h4> 
        
    <form class="jotform-form" action="http://submit.myjotform.com/submit/51692473747567/" method="post" name="form_51692473747567" id="51692473747567" target="hidden_iframe" onsubmit="submitted=true;" accept-charset="utf-8">
        <input type="hidden" name="formID" value="51692473747567" />
        <div class="form-all">
            <p>The following application is for the two crisis committees at ILMUNC India.  In theses committees you will not be simulating countries, but instead characters from each cabinet. You will be able to develop and further the committee agenda through your own crisis notes that can be used to communicate with anyone in the outside world.  Your only limitation is your imagination! Crisis committees are usually the most advanced committees at ILMUNC India. While it will be incorporating elements of a crisis committee, the Security Council is not considered a crisis committee.  You can apply for the Security Council through our regular application process.</p>
            <fieldset>
                <legend>Applicant Information</legend>
                <div id="cid_3" class="form-input jf-required">
                    <input type="text" placeholder="First Name"   class=" form-textbox validate[required]" data-type="input-textbox" id="input_3" name="q3_firstName" size="20" value="<? echo $ind['ind_firstname'] ?>" />
                </div>
                <div id="cid_5" class="form-input jf-required">
                    <input type="text" placeholder="Last Name"  class=" form-textbox validate[required]" data-type="input-textbox" id="input_5" name="q5_lastName" size="20" value="<? echo $ind['ind_lastname'] ?>" />
                </div>
                <div id="cid_7" class="form-input jf-required">
                    <input type="text" placeholder="Phone Number"  class=" form-textbox validate[required]" data-type="input-textbox" id="input_7" name="q7_phoneNumber" size="20" value="<? echo $ind['ind_phone'] ?>" />
                </div>
                <div id="cid_6" class="form-input jf-required">
                    <input type="text" placeholder="Email Address"  class=" form-textbox validate[required, Email]" data-type="input-textbox" id="input_6" name="q6_emailAddress" size="20" value="<? echo $ind['ind_email'] ?>" />
                </div>
                <div id="cid_12" class="form-input jf-required">
                    <div class="form-single-column">
                        <span class="form-radio-item" style="clear:left;">
                            <span class="dragger-item">
                            </span>
                            <input style="display: none;" type="radio" class="form-radio" />
                            <label style="margin-left: 0px;" class="form-label form-label-left form-label-auto" id="label_12" for="input_12"> <p>Grade</p> </label>
                        </span>
                        <span class="form-radio-item" style="clear:left;">
                            <span class="dragger-item">
                            </span>
                            <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_0" name="q12_grade" value="9th" />
                            <label for="input_12_0"> <p>9th</p> </label>
                        </span>
                        <span class="form-radio-item" style="clear:left;">
                            <span class="dragger-item">
                            </span>
                            <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_1" name="q12_grade" value="10th" />
                            <label for="input_12_1"> <p>10th</p> </label>
                        </span>
                        <span class="form-radio-item" style="clear:left;">
                            <span class="dragger-item">
                            </span>
                            <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_2" name="q12_grade" value="11th" />
                            <label for="input_12_2"> <p>11th</p> </label>
                        </span>
                        <span class="form-radio-item" style="clear:left;">
                            <span class="dragger-item">
                            </span>
                            <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_3" name="q12_grade" value="12th" />
                            <label for="input_12_3"> <p>12th</p> </label>
                        </span>
                    </div>
                </div>
                <div id="cid_8" class="form-input jf-required">
                    <input type="text" placeholder="School Name"  class=" form-textbox validate[required]" data-type="input-textbox" id="input_8" name="q8_schoolName" size="20" value="<? echo $school['school_name'] ?>" />
                </div>
                <div id="cid_9" class="form-input jf-required">
                    <input type="text" placeholder="City"  class=" form-textbox validate[required]" data-type="input-textbox" id="input_9" name="q9_city" size="20" value="<? echo $ind['ind_city'] ?>" />
                </div>
            </fieldset>
            <fieldset>
                <legend>General Questions</legend>
                <label class="form-label form-label-left form-label-auto" id="label_18" for="input_18">
                    <p>Committee Preference 1</p>
                </label>
                <div id="cid_18" class="form-input jf-required">
                    <select class="form-dropdown validate[required]" id="input_18" name="q18_committeePreference">
                        <option value="">  </option>
                        <option value="Constellis and Syrian Government 2020"> Constellis and Syrian Government 2020 </option>
                        <option value="Reconstructing Russia"> Reconstructing Russia </option>
                    </select>
                </div>
                <label class="form-label form-label-left form-label-auto" id="label_19" for="input_19">
                    <p>Committee Preference 2</p>
                </label>
                <div id="cid_19" class="form-input jf-required">
                    <select class="form-dropdown validate[required]" id="input_19" name="q19_committeePreference19">
                        <option value="">  </option>
                        <option value="Constellis and Syrian Government 2020"> Constellis and Syrian Government 2020 </option>
                        <option value="Reconstructing Russia"> Reconstructing Russia </option>
                    </select>
                </div>
                <label class="form-label form-label-left form-label-auto" id="label_20" for="input_20">
                    <p>Please list out your past Model United Nations or debate experience. (Max: 150 Words)</p>
                </label>
                <div id="cid_20" class="form-input jf-required">
                    <textarea id="input_20" style="background-color: #FFF !important;" class="form-textarea validate[required]" name="q20_pleaseList20" cols="40" rows="6" onkeyup="checkWordLen(150, this);"></textarea>
                </div>
                <label class="form-label form-label-left form-label-auto" id="label_10" for="input_10">
                    <p>Why are you an ideal delegate for a crisis committee? (Max: 200 Words)</p>
                </label>
                <div id="cid_10" class="form-input jf-required">
                    <textarea id="input_10" class="form-textarea validate[required]" name="q10_whyAre" cols="40" rows="6" onkeyup="checkWordLen(200, this);"></textarea>
                </div>
            </fieldset>
            <p>The following questions are designed to test your creativity and critical thinking skills. While we hope you enjoy answering these questions and we encourage you to have fun with them, please note that they are extremely important for the application process. Crisis committees at ILMUC India are concentric around a delegate’s ability to think on his feet and think creatively! The following questions are designed to test your creativity and critical thinking skills. While we hope you enjoy answering these questions and we encourage you to have fun with them, please note that they are extremely important for the application process. Crisis committees at ILMUC India are concentric around a delegate’s ability to think on his feet and think creatively! The following questions are designed to test your creativity and critical thinking skills. While we hope you enjoy answering these questions and we encourage you to have fun with them!</p>
            <fieldset>
                <legend>Critical Thinking Questions</legend>
                <label class="form-label form-label-left form-label-auto" id="label_15" for="input_15">
                    <p>In order to understand your critical thinking, guesstimate how many speeding tickets are given in India/New Delhi in one month? Explain your answer. (Max: 250 Words)</p>
                </label>
                <div id="cid_15" class="form-input jf-required">
                    <textarea id="input_15" class="form-textarea validate[required]" name="q15_inOrder" cols="40" rows="6" onkeyup="checkWordLen(250, this);"></textarea>
                </div>
                <label class="form-label form-label-left form-label-auto" id="label_16" for="input_16">
                    <p>You’re at ILMUNC India for a weekend. You’re magically able to attain any superpower that you want for that weekend. What superpower would you choose and what would you do with it? (Max: 250 Words)</p>
                </label>
                <div id="cid_16" class="form-input jf-required">
                    <textarea id="input_16" class="form-textarea validate[required]" name="q16_youreAt" cols="40" rows="6" onkeyup="checkWordLen(250, this);"></textarea>
                </div>
                <label class="form-label form-label-left form-label-auto" id="label_17" for="input_17">
                    <p>A penguin wearing a tuxedo walks into your committee room. What does he say and why is he there? (Max: 250 Words)</p>
                </label>
                <div id="cid_17" class="form-input jf-required">
                    <textarea id="input_17" class="form-textarea validate[required]" name="q17_aPenguin" cols="40" rows="6" onkeyup="checkWordLen(250, this);"></textarea>
                </div>
            </fieldset>
            <p> Please make sure that there are no errors in the form before pressing "Submit". </p>
            <p>In case you have any questions please feel free to email us at <a href="mailto: info@ilmunc-india.com">info@ilmunc-india.com</a>.</p>
            <div id="cid_2" class="form-input-wide">
                <div class="form-buttons-wrapper">
                    <button id="input_2" type="submit" class="form-submit-button">
                        Submit
                    </button>
                </div>
            </div>
            <li style="display:none">
                Should be Empty:
                <input type="text" name="website" value="" />
            </li>
        </div>
        <input type="hidden" id="simple_spc" name="simple_spc" value="51692473747567" />
        <script type="text/javascript">
        document.getElementById("si" + "mple" + "_spc").value = "51692473747567-51692473747567";
        </script>
    </form> 
</div>
<div style="display:none" id="reporter">
    <h4>International Press Reporter Application</h4>

<form class="jotform-form" action="http://submit.myjotform.com/submit/51682208989570/" method="post" enctype="multipart/form-data" name="form_51682208989570" id="51682208989570" target="hidden_iframe" onsubmit="submitted=true;" accept-charset="utf-8">
    <input type="hidden" name="formID" value="51682208989570" />
    <div class="form-all">
        <fieldset>
            <legend>Applicant Information</legend>
            <div id="cid_3" class="form-input jf-required">
                <input type="text"  aria-required="true" required="" placeholder="First Name" class=" form-textbox validate[required]" data-type="input-textbox" id="input_3" name="q3_firstName" size="20" value="<? echo $ind['ind_firstname'] ?>" />
            </div>
            <div id="cid_5" class="form-input jf-required">
                <input type="text"  aria-required="true" required="" placeholder="Last Name" class=" form-textbox validate[required]" data-type="input-textbox" id="input_5" name="q5_lastName" size="20" value="<? echo $ind['ind_lastname'] ?>" />
            </div>
            <div id="cid_7" class="form-input jf-required">
                <input type="text"  aria-required="true" required="" placeholder="Phone Number" class=" form-textbox validate[required]" data-type="input-textbox" id="input_7" name="q7_phoneNumber" size="20" value="<? echo $ind['ind_phone'] ?>" />
            </div>
            <div id="cid_6" class="form-input jf-required">
                <input type="text"  aria-required="true" required="" placeholder="Email Address" class=" form-textbox validate[required, Email]" data-type="input-textbox" id="input_6" name="q6_emailAddress" size="20" value="<? echo $ind['ind_email'] ?>" />
            </div>
            <div id="cid_12" class="form-input jf-required">
                <div class="form-single-column">
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input style="display: none;" type="radio" class="form-radio" />
                        <label style="margin-left: 0px;" class="form-label form-label-left form-label-auto" id="label_12" for="input_12"> <p>Grade</p> </label>
                    </span>
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_0" name="q12_grade" value="9th" />
                        <label for="input_12_0"> <p>9th</p> </label>
                    </span>
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_1" name="q12_grade" value="10th" />
                        <label for="input_12_1"> <p>10th</p> </label>
                    </span>
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_2" name="q12_grade" value="11th" />
                        <label for="input_12_2"> <p>11th</p> </label>
                    </span>
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_3" name="q12_grade" value="12th" />
                        <label for="input_12_3"> <p>12th</p> </label>
                    </span>
                </div>
            </div>
            <div id="cid_8" class="form-input jf-required">
                <input type="text"  aria-required="true" required="" placeholder="School Name" class=" form-textbox validate[required]" data-type="input-textbox" id="input_8" name="q8_schoolName" size="20" value="<? echo $school['school_name'] ?>" />
            </div>
            <div id="cid_9" class="form-input jf-required">
                <input type="text"  aria-required="true" required="" placeholder="City" class=" form-textbox validate[required]" data-type="input-textbox" id="input_9" name="q9_city" size="20" value="<? echo $ind['ind_city'] ?>" />
            </div>
        </fieldset>
        <fieldset>
            <legend>Applicantion Questions</legend>
            <div id="cid_14" class="form-input jf-required">
                <div class="form-single-column">
                    <span class="form-checkbox-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input style="display: none;" type="checkbox" />
                        <label style="margin-left: 0px;" class="form-label form-label-left form-label-auto" id="label_14" for="input_14">
                            <p>Position Applying For</p>
                        </label>                                
                    </span>
                    <span class="form-checkbox-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="checkbox" class="form-checkbox validate[required]" id="input_14_0" name="q14_positionApplying[]" value="Reporter" />
                        <label for="input_14_0"> <p>Reporter</p> </label>
                    </span>
                    <span class="form-checkbox-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="checkbox" class="form-checkbox validate[required]" id="input_14_1" name="q14_positionApplying[]" value="Editor-In-Chief" />
                        <label for="input_14_1"> <p>Editor-In-Chief</p> </label>
                    </span>
                </div>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_13" for="input_13">
                <p>What social media #hashtag describes your life?</p>
            </label>
            <div id="cid_13" class="form-input jf-required">
                <input type="text" aria-required="true" required="" class=" form-textbox validate[required]" data-type="input-textbox" id="input_13" name="q13_whatSocial" size="20" value="" />
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_10" for="input_10">
                <p>Please list all past experience participating in the International Press or positions related to journalism? (Max: 300 Words)</p>
            </label>
            <div id="cid_10" class="form-input jf-required">
                <textarea id="input_10" onkeyup="checkWordLen(300, this);" aria-required="true" required="" class="form-textarea validate[required]" name="q10_pleaseList" cols="40" rows="6"></textarea>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_15" for="input_15">
                <p>Think about your favorite food. Use every ingredient used to make that dish in a short story or essay. It can be about any topic. (Max: 500 Words)</p>
            </label>
            <div id="cid_15" class="form-input jf-required">
                <textarea id="input_15" onkeyup="checkWordLen(500, this);" aria-required="true" required="" class="form-textarea validate[required]" name="q15_thinkAbout" cols="40" rows="6"></textarea>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_16" for="input_16">
                <p>Describe your work ethic. (Max: 250 Words)</p>
            </label>
            <div id="cid_16" class="form-input jf-required">
                <textarea id="input_16" onkeyup="checkWordLen(250, this);" aria-required="true" required="" class="form-textarea validate[required]" name="q16_describeYour" cols="40" rows="6"></textarea>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_17" for="input_17">
                <p>What skills do you have that would make you suitable for this role? (Max: 250 Words)</p>
            </label>
            <div id="cid_17" class="form-input jf-required">
                <textarea id="input_17" onkeyup="checkWordLen(250, this);" aria-required="true" required="" class="form-textarea validate[required]" name="q17_whatSkills" cols="40" rows="6"></textarea>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_4" for="input_4">
                <p>Please attach an essay that you have previously written on a topic of importance to you. (Max: 1000 Words)</p>
            </label>
            <div id="cid_4" class="form-input jf-required">
                <input class="form-upload validate[required]" aria-required="true" required="" type="file" id="input_4" name="q4_pleaseAttach" file-accept="pdf, doc, docx, xls, xlsx, csv, txt, rtf, html, zip, mp3, wma, mpg, flv, avi, jpg, jpeg, png, gif" file-maxsize="1024" file-minsize="0" file-limit="0" />
            </div>
        </fieldset>
        <p> Please make sure that there are no errors in the form before pressing "Submit". </p>
        <p>In case you have any questions please feel free to email us at <a href="mailto: info@ilmunc-india.com">info@ilmunc-india.com</a>.</p>
        <div id="cid_2" class="form-input-wide">
            <div class="form-buttons-wrapper">
                <button id="input_2" type="submit" class="form-submit-button">
                    Submit
                </button>
            </div>
        </div>
        <li style="display:none">
            Should be Empty:
            <input type="text" name="website" value="" />
        </li>
    </div>
    <input type="hidden" id="simple_spc" name="simple_spc" value="51682208989570" />
    <script type="text/javascript">
    document.getElementById("si" + "mple" + "_spc").value = "51682208989570-51682208989570";
    </script>
</form>
</div>

<div style="display:none" id="photographer">
    <h4>International Press Photographer Application</h4>
    
<form class="jotform-form" action="//submit.myjotform.com/submit/51732886183564/" method="post" target="hidden_iframe" onsubmit="submitted=true;" name="form_51732886183564" id="51732886183564" accept-charset="utf-8">
    <input type="hidden" name="formID" value="51732886183564" />
    <div class="form-all">
        <fieldset>
            <legend>Applicant Information</legend>
            <div id="cid_3" class="form-input jf-required">
                <input type="text"  aria-required="true" required=""  placeholder="First Name" class=" form-textbox validate[required]" data-type="input-textbox" id="input_3" name="q3_firstName" size="20" value="<?echo $ind['ind_firstname']?>" />
            </div>
            <div id="cid_5" class="form-input jf-required">
                <input type="text"  aria-required="true" required=""  placeholder="Last Name" class=" form-textbox validate[required]" data-type="input-textbox" id="input_5" name="q5_lastName" size="20" value="<?echo $ind['ind_lastname']?>" />
            </div>
            <div id="cid_7" class="form-input jf-required">
                <input type="text"  aria-required="true" required=""  placeholder="Phone Number" class=" form-textbox validate[required]" data-type="input-textbox" id="input_7" name="q7_phoneNumber" size="20" value="<?echo $ind['ind_phone']?>" />
            </div>
            <div id="cid_6" class="form-input jf-required">
                <input type="text"  aria-required="true" required=""  placeholder="Email Address" class=" form-textbox validate[required, Email]" data-type="input-textbox" id="input_6" name="q6_emailAddress" size="20" value="<?echo $ind['ind_email']?>" />
            </div>
            <div id="cid_12" class="form-input jf-required">
                <div class="form-single-column">
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input style="display: none;"type="radio" class="form-radio" />
                        <label> <p>Grade</p> </label>
                    </span>
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_0" name="q12_grade" value="9th" />
                        <label id="label_input_12_0" for="input_12_0"> <p>9th</p> </label>
                    </span>
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_1" name="q12_grade" value="10th" />
                        <label id="label_input_12_1" for="input_12_1"> <p>10th</p> </label>
                    </span>
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_2" name="q12_grade" value="11th" />
                        <label id="label_input_12_2" for="input_12_2"> <p>11th</p> </label>
                    </span>
                    <span class="form-radio-item" style="clear:left;">
                        <span class="dragger-item">
                        </span>
                        <input type="radio" aria-required="true" required="" class="form-radio" id="input_12_3" name="q12_grade" value="12th" />
                        <label id="label_input_12_3" for="input_12_3"> <p>12th</p> </label>
                    </span>
                </div>
            </div>
            <div id="cid_8" class="form- input jf-required">
                <input type="text"  aria-required="true" required=""  placeholder="School Name" class=" form-textbox validate[required]" data-type="input-textbox" id="input_8" name="q8_schoolName" size="20" value="<?echo $school['school_name']?>" />
            </div>
            <div id="cid_9" class="form-input jf-required">
                <input type="text"  aria-required="true" required=""  placeholder="City" class=" form-textbox validate[required]" data-type="input-textbox" id="input_9" name="q9_city" size="20" value="<?echo $ind['ind_city']?>" />
            </div>
        </fieldset>
        <fieldset>
            <legend>Applicantion Questions</legend>
            <label class="form-label form-label-left form-label-auto" id="label_10" for="input_10">
                <p>Please list all your past photography experience at Model UN Conferences.</p>
            </label>
            <div id="cid_10" class="form-input jf-required">
                <textarea aria-required="true" required=""   id="input_10" class="form-textarea validate[required]" name="q10_pleaseList" cols="40" rows="6"></textarea>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_15" for="input_15">
                <p>Please list all your past experience as a photographer outside of Model UN Conferences.</p>
            </label>
            <div id="cid_15" class="form-input jf-required">
                <textarea aria-required="true" required=""   id="input_15" class="form-textarea validate[required]" name="q15_pleaseList15" cols="40" rows="6"></textarea>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_16" for="input_16">
                <p>Please list all the photography awards/accolades you have received if any.</p>
            </label>
            <div id="cid_16" class="form-input jf-required">
                <textarea id="input_16" class="form-textarea validate[required]" name="q16_pleaseList16" cols="40" rows="6"></textarea>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_17" for="input_17">
                <p>Why do you want to be a photographer for ILMUNC India 2015?</p>
            </label>
            <div id="cid_17" class="form-input jf-required">
                <textarea aria-required="true" required=""   id="input_17" class="form-textarea validate[required]" name="q17_whyDo" cols="40" rows="6"></textarea>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_18" for="input_18">
                <p>At ILMUNC India 2015, a lot of important events will be occurring simultaneously, which you along with other photographers will be required to document. How do you plan to organize yourself in order to document all the happenings of the conference?</p>
            </label>
            <div id="cid_18" class="form-input jf-required">
                <textarea aria-required="true" required=""   id="input_18" class="form-textarea validate[required]" name="q18_atIlmunc" cols="40" rows="6"></textarea>
            </div>
            <label class="form-label form-label-left form-label-auto" id="label_13" for="input_13">
                <p>Please attach a link to your online portfolio, or a place where we can find samples of your photography if available.</p>
            </label>
            <div id="cid_13" class="form-input jf-required">
                <input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="input_13" name="q13_pleaseAttach13" size="20" value="" />
            </div>
        </fieldset>
        <p> Please make sure that there are no errors in the form before pressing "Submit". </p>
        <p>In case you have any questions please feel free to email us at <a href="mailto: info@ilmunc-india.com">info@ilmunc-india.com</a>.</p>                    
        <div id="cid_2" class="form-input-wide">
            <div class="form-buttons-wrapper">
                <button id="input_2" type="submit" class="form-submit-button">
                    Submit
                </button>
            </div>
        </div>
        <li style="display:none">
            Should be Empty:
            <input type="text" name="website" value="" />
        </li>
    </div>
    <input type="hidden" id="simple_spc" name="simple_spc" value="51732886183564" />
    <script type="text/javascript">
    document.getElementById("si" + "mple" + "_spc").value = "51732886183564-51732886183564";
    </script>
</form>
</div>



<!-- 
<h3> Crisis Committee </h3>
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