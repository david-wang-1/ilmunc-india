<?php
include_once("function.php");
getHeader('ILMUNC India | International Press Photographer Application');
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
			<h2> ILMUNC India 2015 International Press Photographer Application </h2>
			<div class="main large-8 column">
				<script type="text/javascript">
				var submitted=false;
				</script>
				<iframe name="hidden_iframe" id="hidden_iframe"
				style="display:none;" onload="if(submitted)
				{window.location='http://www.ilmunc-india.com/thanks.php';}">
			</iframe>
			<form class="jotform-form" action="//submit.myjotform.com/submit/51732886183564/" method="post" target="hidden_iframe" onsubmit="submitted=true;" name="form_51732886183564" id="51732886183564" accept-charset="utf-8">
				<input type="hidden" name="formID" value="51732886183564" />
				<div class="form-all">
					<fieldset>
						<legend>Applicant Information</legend>
						<div id="cid_3" class="form-input jf-required">
							<input type="text" aria-required="true" required=""  placeholder="First Name" class=" form-textbox validate[required]" data-type="input-textbox" id="input_3" name="q3_firstName" size="20" value="" />
						</div>
						<div id="cid_5" class="form-input jf-required">
							<input type="text" aria-required="true" required=""  placeholder="Last Name" class=" form-textbox validate[required]" data-type="input-textbox" id="input_5" name="q5_lastName" size="20" value="" />
						</div>
						<div id="cid_7" class="form-input jf-required">
							<input type="text" aria-required="true" required=""  placeholder="Phone Number" class=" form-textbox validate[required]" data-type="input-textbox" id="input_7" name="q7_phoneNumber" size="20" value="" />
						</div>
						<div id="cid_6" class="form-input jf-required">
							<input type="text" aria-required="true" required=""  placeholder="Email Address" class=" form-textbox validate[required, Email]" data-type="input-textbox" id="input_6" name="q6_emailAddress" size="20" value="" />
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
									<input type="radio" class="form-radio" id="input_12_0" name="q12_grade" value="9th" />
									<label id="label_input_12_0" for="input_12_0"> <p>9th</p> </label>
								</span>
								<span class="form-radio-item" style="clear:left;">
									<span class="dragger-item">
									</span>
									<input type="radio" class="form-radio" id="input_12_1" name="q12_grade" value="10th" />
									<label id="label_input_12_1" for="input_12_1"> <p>10th</p> </label>
								</span>
								<span class="form-radio-item" style="clear:left;">
									<span class="dragger-item">
									</span>
									<input type="radio" class="form-radio" id="input_12_2" name="q12_grade" value="11th" />
									<label id="label_input_12_2" for="input_12_2"> <p>11th</p> </label>
								</span>
								<span class="form-radio-item" style="clear:left;">
									<span class="dragger-item">
									</span>
									<input type="radio" class="form-radio" id="input_12_3" name="q12_grade" value="12th" />
									<label id="label_input_12_3" for="input_12_3"> <p>12th</p> </label>
								</span>
							</div>
						</div>
						<div id="cid_8" class="form-input jf-required">
							<input type="text" aria-required="true" required=""  placeholder="School Name" class=" form-textbox validate[required]" data-type="input-textbox" id="input_8" name="q8_schoolName" size="20" value="" />
						</div>
						<div id="cid_9" class="form-input jf-required">
							<input type="text" aria-required="true" required=""  placeholder="City" class=" form-textbox validate[required]" data-type="input-textbox" id="input_9" name="q9_city" size="20" value="" />
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

		<? getAnnouncement(); ?>

	</section>

	<? getFooter(); ?>

</body>
</html>
