<?php
include_once("function.php");
getHeader('ILMUNC India | Crisis Application');
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
<script src="libs/js/modernizr.js"> </script>
<script type="text/javascript">
function checkWordLen(wordLen, obj) {
	var len = obj.value.split(/[\s]+/);
	if(len.length > wordLen) {
		alert("Your answer is longer than "+wordLen+" words. Please reduce the length of your answer!");
	}
}
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
			<h2> ILMUNC India 2015 Crisis Committee Application </h2>
			<div class="main large-8 column">
				<script type="text/javascript">
				var submitted=false;
				</script>
				<iframe name="hidden_iframe" id="hidden_iframe"
				style="display:none;" onload="if(submitted)
				{window.location='http://www.ilmunc-india.com/thanks.php';}">
			</iframe>
			<form class="jotform-form" action="http://submit.myjotform.com/submit/51692473747567/" method="post" name="form_51692473747567" id="51692473747567" target="hidden_iframe" onsubmit="submitted=true;" accept-charset="utf-8">
				<input type="hidden" name="formID" value="51692473747567" />
				<div class="form-all">
					<p>The following application is for the two crisis committees at ILMUNC India.  In theses committees you will not be simulating countries, but instead characters from each cabinet. You will be able to develop and further the committee agenda through your own crisis notes that can be used to communicate with anyone in the outside world.  Your only limitation is your imagination! Crisis committees are usually the most advanced committees at ILMUNC India. While it will be incorporating elements of a crisis committee, the Security Council is not considered a crisis committee.  You can apply for the Security Council through our regular application process.</p>
					<fieldset>
						<legend>Applicant Information</legend>
						<div id="cid_3" class="form-input jf-required">
							<input type="text" placeholder="First Name"  class=" form-textbox validate[required]" data-type="input-textbox" id="input_3" name="q3_firstName" size="20" value="" />
						</div>
						<div id="cid_5" class="form-input jf-required">
							<input type="text" placeholder="Last Name"  class=" form-textbox validate[required]" data-type="input-textbox" id="input_5" name="q5_lastName" size="20" value="" />
						</div>
						<div id="cid_7" class="form-input jf-required">
							<input type="text" placeholder="Phone Number"  class=" form-textbox validate[required]" data-type="input-textbox" id="input_7" name="q7_phoneNumber" size="20" value="" />
						</div>
						<div id="cid_6" class="form-input jf-required">
							<input type="text" placeholder="Email Address"  class=" form-textbox validate[required, Email]" data-type="input-textbox" id="input_6" name="q6_emailAddress" size="20" value="" />
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
									<input type="radio" class="form-radio" id="input_12_0" name="q12_grade" value="9th" />
									<label for="input_12_0"> <p>9th</p> </label>
								</span>
								<span class="form-radio-item" style="clear:left;">
									<span class="dragger-item">
									</span>
									<input type="radio" class="form-radio" id="input_12_1" name="q12_grade" value="10th" />
									<label for="input_12_1"> <p>10th</p> </label>
								</span>
								<span class="form-radio-item" style="clear:left;">
									<span class="dragger-item">
									</span>
									<input type="radio" class="form-radio" id="input_12_2" name="q12_grade" value="11th" />
									<label for="input_12_2"> <p>11th</p> </label>
								</span>
								<span class="form-radio-item" style="clear:left;">
									<span class="dragger-item">
									</span>
									<input type="radio" class="form-radio" id="input_12_3" name="q12_grade" value="12th" />
									<label for="input_12_3"> <p>12th</p> </label>
								</span>
							</div>
						</div>
						<div id="cid_8" class="form-input jf-required">
							<input type="text" placeholder="School Name"  class=" form-textbox validate[required]" data-type="input-textbox" id="input_8" name="q8_schoolName" size="20" value="" />
						</div>
						<div id="cid_9" class="form-input jf-required">
							<input type="text" placeholder="City"  class=" form-textbox validate[required]" data-type="input-textbox" id="input_9" name="q9_city" size="20" value="" />
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

		<? getAnnouncement(); ?>

	</section>

	<? getFooter(); ?>

</body>
</html>
