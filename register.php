<?php
    include_once("function.php");
    getHeader('Crisis Committee');
?>
        <style>
            .header-image {
                background-image: url("assets/headers/hotel-header.jpg");
                background-position-y: -100px;
            }
            h2 {
                text-align: center
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
                <h2> ILMUNC India 2015 School Registration Form </h2>
                <div class="main large-9 large-centered column">
                    <form>
                        <fieldset>
                            <legend>Delegate Information</legend>
                            <input type="text" name="first-name" aria-label="first-name" placeholder="First Name" />
                            <input type="text" name="last-name" aria-label="last-name" placeholder="Last Name" />
                            <label> Prefix
                                <select name="prefix">
                                    <option> Mr. </option>
                                    <option> Ms. </option>
                                </select>
                            </label>
                            <input type="text" name="del-address-1" aria-label="del-address-1" placeholder="Address Line 1" />
                            <input type="text" name="del-address-2" aria-label="del-address-2" placeholder="Address Line 2" />
                            <input type="text" name="del-city" aria-label="del-city" placeholder="City" />
                            <input type="text" name="del-state" aria-label="del-state" placeholder="State" />
                            <input type="text" name="del-zip" aria-label="del-zip" placeholder="Zip/Postal Code" />
                            <input type="text" name="del-country" aria-label="del-country" placeholder="Country" />
                            <input type="text" name="phone" aria-label="phone" placeholder="Phone Number" />
                            <input type="text" name="email" aria-label="email" placeholder="Email" />
                            <label> Do you intend to stay at the conference hotel? 
                                <select name="hotel">
                                    <option> Yes </option>
                                    <option> No </option>
                                </select>
                            </label>
                        </fieldset>
                        <fieldset>
                            <legend>School Information</legend>
                            <input type="text" name="school-name" aria-label="school-name" placeholder="School Name"/>
                            <input type="text" name="school-address-1" aria-label="school-address-1" placeholder="Address Line 1" />
                            <input type="text" name="school-address-2" aria-label="school-address-2" placeholder="Address Line 2" />
                            <input type="text" name="school-city" aria-label="school-city" placeholder="City" />
                            <input type="text" name="school-state" aria-label="school-state" placeholder="State" />
                            <input type="text" name="school-zip" aria-label="school-zip" placeholder="Zip/Postal Code" />
                            <input type="text" name="school-country" aria-label="school-country" placeholder="Country" />
                        </fieldset>
                        <fieldset>
                            <legend>Past Experience</legend>
                            <input type="number" name="conferences-attended" aria-label="conferences-attended" placeholder="Number of Conferences Attended" />
                            <p> Please list the top 3 awards you have recieved below. This includes positions on the secretariat of other conferences and chair positions etc. </p>
                            <input type="text" name="award-1" aria-label="award-1" placeholder="Award 1" />
                            <input type="text" name="award-2" aria-label="award-2" placeholder="Award 2" />
                            <input type="text" name="award-3" aria-label="award-3" placeholder="Award 3" />
                        </fieldset>
                        <p> Please make sure that there are no errors in the form before pressing "Register". </p>
                        <div id="submit">
                            <input type="submit" class="button" value="Register" /> 
                        </div>
                    </form>
                </div>
                
                    <? getAnnouncement(); ?>

        </section>

<? getFooter(); ?>

    </body>
</html>
