<?php
include_once("function.php");
getHeader('ILMUNC India | Assistant Director Application');
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
        <h2> ILMUNC India 2015 Assistant Director Application </h2>
        <div class="main large-8 column">
            <h3 style="text-align: center;"> Applications are now closed!</h3>
                <p>We thank you for your interest in ILMUNC India 2015! If you are still interested in being a part of the conference, consider registering as a delegate. The registration for individual delegates can be found <a href="individual.php">here</a>.</p>
                <p>In case you have any questions, please feel free to reach out to us at <a href="mailto: secgen@ilmunc-india.com">secgen@ilmunc-india.com</a>.</p>
                
            <!--<script type="text/javascript">
            var submitted=false;
            </script>
            <iframe name="hidden_iframe" id="hidden_iframe"
            style="display:none;" onload="if(submitted)
            {window.location='http://www.ilmunc-india.com/thanks.php';}">
        </iframe>
        <form action="https://docs.google.com/forms/d/135LRo4aYv4pSbxUjAFdMLbEll9cbg_C2aNzaUYih3qQ/formResponse" method="POST" id="ss-form" target="hidden_iframe" onsubmit="submitted=true;">
            <fieldset>
                <legend>Applicant Information</legend>
                <div class="ss-form-question errorbox-good" role="listitem">
                    <div dir="ltr" class="ss-item ss-item-required ss-text"><div class="ss-form-entry">
                        <label class="ss-q-item-label" for="entry_1806311742">
                            <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                            <input type="text" placeholder="First Name" name="entry.1806311742" value="" class="ss-q-short" id="entry_1806311742" dir="auto" aria-label="First Name  " aria-required="true" required="" title="">
                            <div class="error-message" id="1817310668_errorMessage"></div>

                        </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                        <div dir="ltr" class="ss-item ss-item-required ss-text"><div class="ss-form-entry">
                            <label class="ss-q-item-label" for="entry_559139005">
                                <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                <input type="text" placeholder="Last Name" name="entry.559139005" value="" class="ss-q-short" id="entry_559139005" dir="auto" aria-label="Last Name  " aria-required="true" required="" title="">
                                <div class="error-message" id="1006120052_errorMessage"></div>

                            </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                            <div dir="ltr" class="ss-item ss-item-required ss-text"><div class="ss-form-entry">
                                <label class="ss-q-item-label" for="entry_1308047245">
                                    <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                    <input type="text" placeholder="Email Address" name="entry.1308047245" value="" class="ss-q-short" id="entry_1308047245" dir="auto" aria-label="Email  Please enter a valid email address!" aria-required="true" required="" pattern=".*@.*" title="Please enter a valid email address!">

                                </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                <div dir="ltr" class="ss-item ss-item-required ss-text"><div class="ss-form-entry">
                                    <label class="ss-q-item-label" for="entry_1740396478">
                                        <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                        <input type="number" placeholder="Phone Number" name="entry.1740396478" value="" class="ss-q-short" id="entry_1740396478" dir="auto" aria-label="Phone Number  Must be a number greater than 0" aria-required="true" required="" step="any" title="Must be a number greater than 0">

                                    </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                    <div dir="ltr" class="ss-item ss-item-required ss-text"><div class="ss-form-entry">
                                        <label class="ss-q-item-label" for="entry_2093882500">
                                            <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                            <input type="text" placeholder="School Name" name="entry.2093882500" value="" class="ss-q-short" id="entry_2093882500" dir="auto" aria-label="School Name  " aria-required="true" required="" title="">
                                            <div class="error-message" id="1117202706_errorMessage"></div>

                                        </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                        <div dir="ltr" class="ss-item ss-item-required ss-text"><div class="ss-form-entry">
                                            <label class="ss-q-item-label" for="entry_1429475437">
                                                <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                <input type="text" placeholder="City" name="entry.1429475437" value="" class="ss-q-short" id="entry_1429475437" dir="auto" aria-label="City  " aria-required="true" required="" title="">
                                                <div class="error-message" id="1005098020_errorMessage"></div>

                                            </div></div></div> 
                                        </fieldset>
                                        <fieldset>
                                            <legend>Application Question</legend>
                                            
                                            <div class="ss-form-question errorbox-good" role="listitem">
                                                <div dir="ltr" class="ss-item ss-item-required ss-select"><div class="ss-form-entry">
                                                    <label class="ss-q-item-label" for="entry_1267309499"><div class="ss-q-title"><p>Committee (Preference 1)</p>
                                                        <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                    </div>
                                                    <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                    <select name="entry.1267309499" id="entry_1267309499" aria-label="Committee (Preference 1)  " aria-required="true" required=""><option value=""></option>
                                                        <option value="DISEC">DISEC</option> <option value="SPECPOL">SPECPOL</option> <option value="Legal">Legal</option> <option value="Historical UNHRC">Historical UNHRC</option> <option value="UNODC">UNODC</option> <option value="Constellis and Syrian Government 2020">Constellis and Syrian Government 2020</option> <option value="Security Council">Security Council</option> <option value="Reconstructing Russia">Reconstructing Russia</option></select>
                                                    </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                                    <div dir="ltr" class="ss-item ss-item-required ss-select"><div class="ss-form-entry">
                                                        <label class="ss-q-item-label" for="entry_732687002"><div class="ss-q-title"><p>Committee (Preference 2)</p>
                                                            <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                        </div>
                                                        <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                        <select name="entry.732687002" id="entry_732687002" aria-label="Committee (Preference 2)  " aria-required="true" required=""><option value=""></option>
                                                            <option value="DISEC">DISEC</option> <option value="SPECPOL">SPECPOL</option> <option value="Legal">Legal</option> <option value="Historical UNHRC">Historical UNHRC</option> <option value="UNODC">UNODC</option> <option value="Constellis and Syrian Government 2020">Constellis and Syrian Government 2020</option> <option value="Security Council">Security Council</option> <option value="Reconstructing Russia">Reconstructing Russia</option></select>
                                                        </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                                        <div dir="ltr" class="ss-item ss-item-required ss-select"><div class="ss-form-entry">
                                                            <label class="ss-q-item-label" for="entry_1306549594"><div class="ss-q-title"><p>Committee (Preference 3)</p>
                                                                <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                            </div>
                                                            <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                            <select name="entry.1306549594" id="entry_1306549594" aria-label="Committee (Preference 3)  " aria-required="true" required=""><option value=""></option>
                                                                <option value="DISEC">DISEC</option> <option value="SPECPOL">SPECPOL</option> <option value="Legal">Legal</option> <option value="Historical UNHRC">Historical UNHRC</option> <option value="UNODC">UNODC</option> <option value="Constellis and Syrian Government 2020">Constellis and Syrian Government 2020</option> <option value="Security Council">Security Council</option> <option value="Reconstructing Russia">Reconstructing Russia</option></select>
                                                            </div></div></div>


                                                            <div class="ss-form-question errorbox-good" role="listitem">
                                                                <div dir="ltr" class="ss-item ss-item-required ss-paragraph-text"><div class="ss-form-entry">
                                                                    <label class="ss-q-item-label" for="entry_1756157452"><div class="ss-q-title"><p>Please list out your past Model United Nations or debate experience (limit to past 10 conference).</p>
                                                                        <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                                    </div>
                                                                    <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                                    <textarea name="entry.1756157452" rows="8" cols="0" class="ss-q-long" id="entry_1756157452" dir="auto" aria-label="Please list out your past Model United Nations or debate experience (limit to past 10 conference).  " aria-required="true" required=""></textarea>
                                                                    <div class="error-message" id="1741763134_errorMessage"></div>

                                                                </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                                                <div dir="ltr" class="ss-item ss-item-required ss-paragraph-text"><div class="ss-form-entry">
                                                                    <label class="ss-q-item-label" for="entry_986852018"><div class="ss-q-title"><p>What personal qualities do you have which make you suitable for the position of an Assistant Director?</p>
                                                                        <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                                    </div>
                                                                    <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                                    <textarea name="entry.986852018" rows="8" cols="0" class="ss-q-long" id="entry_986852018" dir="auto" aria-label="What personal qualities do you have which make you suitable for the position of an Assistant Director?  " aria-required="true" required=""></textarea>
                                                                    <div class="error-message" id="800436438_errorMessage"></div>

                                                                </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                                                <div dir="ltr" class="ss-item ss-item-required ss-paragraph-text"><div class="ss-form-entry">
                                                                    <label class="ss-q-item-label" for="entry_1800814472"><div class="ss-q-title"><p>What are the best and worst attributes you have seen in Directors and Assistant Directors who have moderated a conference you attended at in the past?</p>
                                                                        <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                                    </div>
                                                                    <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                                    <textarea name="entry.1800814472" rows="8" cols="0" class="ss-q-long" id="entry_1800814472" dir="auto" aria-label="What are the best and worst attributes you have seen in Directors and Assistant Directors who have moderated a conference you attended at in the past?  " aria-required="true" required=""></textarea>
                                                                    <div class="error-message" id="320963430_errorMessage"></div>

                                                                </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                                                <div dir="ltr" class="ss-item ss-item-required ss-text"><div class="ss-form-entry">
                                                                    <label class="ss-q-item-label" for="entry_1260015182"><div class="ss-q-title"><p>What song is a good depiction of your personality?</p>
                                                                        <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                                    </div>
                                                                    <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                                    <input type="text" name="entry.1260015182" value="" class="ss-q-short" id="entry_1260015182" dir="auto" aria-label="What song is a good depiction of your personality?  " aria-required="true" required="" title="">
                                                                    <div class="error-message" id="1998680564_errorMessage"></div>

                                                                </div></div></div> 

                                                                <div class="ss-form-question errorbox-good" role="listitem">
                                                                    <div dir="ltr" class="ss-item ss-item-required ss-paragraph-text"><div class="ss-form-entry">
                                                                        <label class="ss-q-item-label" for="entry_2039382281"><div class="ss-q-title"><p>Briefly explain your top three committee preferences.</p>
                                                                            <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                                        </div>
                                                                        <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                                        <textarea name="entry.2039382281" rows="8" cols="0" class="ss-q-long" id="entry_2039382281" dir="auto" aria-label="Briefly explain your top three committee preferences.  " aria-required="true" required=""></textarea>
                                                                        <div class="error-message" id="2091284170_errorMessage"></div>

                                                                    </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                                                    <div dir="ltr" class="ss-item ss-item-required ss-paragraph-text"><div class="ss-form-entry">
                                                                        <label class="ss-q-item-label" for="entry_1108165490"><div class="ss-q-title"><p>What is your craziest or funniest Model United Nations story?</p>
                                                                            <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                                        </div>
                                                                        <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                                        <textarea name="entry.1108165490" rows="8" cols="0" class="ss-q-long" id="entry_1108165490" dir="auto" aria-label="What is your craziest or funniest Model United Nations story?  " aria-required="true" required=""></textarea>
                                                                        <div class="error-message" id="439557112_errorMessage"></div>

                                                                    </div></div></div> <div class="ss-form-question errorbox-good" role="listitem">
                                                                    <div dir="ltr" class="ss-item ss-item-required ss-paragraph-text"><div class="ss-form-entry">
                                                                        <label class="ss-q-item-label" for="entry_1258061015"><div class="ss-q-title"><p>What are your other time commitments (that you know of) in the next few months</p>
                                                                            <label for="itemView.getDomIdToLabel()" aria-label="(Required field)"></label>
                                                                        </div>
                                                                        <div class="ss-q-help ss-secondary-text" dir="ltr"></div></label>
                                                                        <textarea name="entry.1258061015" rows="8" cols="0" class="ss-q-long" id="entry_1258061015" dir="auto" aria-label="What are your other time commitments (that you know of) in the next few months  " aria-required="true" required=""></textarea>
                                                                        <div class="error-message" id="1523574321_errorMessage"></div>

                                                                    </div></div></div></fieldset>
                                                                    <p> Please make sure that there are no errors in the form before pressing "Submit". </p>
                                                                    <p>In case you have any questions please feel free to email us at <a href="mailto: staff@ilmunc-india.com">staff@ilmunc-india.com</a>.</p>
                                                                    <input type="hidden" name="draftResponse" value="[,,&quot;-7349687973918508973&quot;]
                                                                    ">
                                                                    <input type="hidden" name="pageHistory" value="0">


                                                                    <input type="hidden" name="fbzx" value="-7349687973918508973">

                                                                    <div class="ss-item ss-navigate">
                                                                        <input type="submit" name="submit" value="Submit" id="ss-submit" class="button">

                                                                    </div></ol></form>-->
                                                                </div>

                                                                <? getAnnouncement(); ?>

                                                            </section>

                                                            <? getFooter(); ?>

                                                        </body>
                                                        </html>
