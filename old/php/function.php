<?php
@session_start();
function getNavBar() {

?>        
        <style>
            #register a:hover {
                color: #808080 !important;
            }
        </style>
        
        <div class="contain-to-grid sticky nav-bar">
                        <nav class="top-bar" data-topbar data-options="sticky_on: large">
                            <ul class="title-area">
                                <li class="name"><h1></h1></li>
                                <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
                            </ul>
                            <section class="top-bar-section">
                            <ul class="flex-container">
                                <li><a href="./index.php"> HOME </a></li>
                                <li class="has-dropdown"><a href="./about.php">
                                    ABOUT</a> 
                                    <ul class="dropdown">
                                        <li><a href="./about.php"> ILMUNC INDIA </a></li>
                                        <li><a href="./muncafe.php"> MUNCafé </a></li>
                                        <li><a href="http://www.upenn.edu" target="_blank"> UNIVERSITY OF PENNSYLVANIA </a></li>
                                        <li><a href="http://www.ilmunc.com" target="_blank"> ILMUNC </a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown"><a href="#">
                                    CONFERENCE</a> 
                                    <ul class="dropdown">
                                        <li><a href="./invitation.php"> INVITATION </a></li>
                                        <li><a href="./secretariat.php"> SECRETARIAT </a></li>
                                        <li><a href="./hotel.php"> HOTEL INFORMATION </a></li>
                                        <li><a href="./schedule.php"> CONFERENCE SCHEDULE </a></li>
                                        <li><a href="./faq.php"> FAQ </a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown" id ="register" style="background-color: #C43700 !important; box-shadow: 0px 5px 8px#555;"><a href="#">
                                    REGISTER </a>
                                    <ul class="dropdown">
                                        <li class="reg"><a href="./school.php"> SCHOOL REGISTRATION </a></li>
                                        <li class="reg"><a href="./individual.php"> INDIVIDUAL REGISTRATION </a></li>
                                         <li class="has-dropdown"><a href="#"> APPLICATIONS </a> 
                                            <ul class="dropdown">
                                                <li><a href="./ad.php"> ASSISTANT DIRECTOR APPLICATION </a></li>
                                                <li><a href="./envoy.php"> ENVOY APPLICATION </a></li>
                                             </ul>
                                        </li>
                                        <li class="reg"><a href="./fees.php"> REGISTRATION INFORMATION </a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown"><a href="#">
                                    COMMITTEES </a>
                                    <ul class="dropdown">
                                       <li class="has-dropdown"><a href="#">
                                           GENERAL ASSEMBLY </a>
                                            <ul class="dropdown">
                                                <li><a href="./disec.php"> DISEC </a></li>
                                                <li><a href="./specpol.php"> SPECPOL </a></li>
                                                <li><a href="./legal.php"> LEGAL </a></li>
                                             </ul>
                                         </li>
                                        <li class="has-dropdown"><a href="#">
                                            SPECIALIZED </a>
                                            <ul class="dropdown">
                                                <li><a href="./unhrc.php"> HISTORICAL UNHRC </a></li>
                                                <li><a href="./unodc.php"> UNODC </a></li>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown"><a href="#">
                                            CRISIS </a>
                                            <ul class="dropdown">
                                                <li><a href="./constellis.php">  CONSTELLIS & SYRIAN GOVERNMENT, 2020 </a></li>
                                                <li><a href="./security.php"> SECURITY COUNCIL </a></li>
                                                <li><a href="./russia.php"> RECONSTRUCTING RUSSIA </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-dropdown"><a href="#">
                                    RESEARCH </a>
                                    <ul class="dropdown">
                                        <li><a href="./webinar.php"> WEBINARS </a></li>
                                        <li><a href="./research-links.php"> RESEARCH LINKS </a></li>
                                        <li><a href="./training-videos.php"> TRAINING VIDEOS </a></li>
                                        <li><a href="./rules.php"> RULES OF PROCEDURE </a></li>
                                    </ul>
                                </li>
                                <!-- <li><a href="./fees.php"> REGISTRATION INFORMATION </a></li> -->
                                <li><a href="./login.php"> LOGIN </a></li>
                            </ul>
                        </section>
                        </nav>


        </div>

        <? }

function getHeader($title) { ?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title> <?echo $title;?></title>
        <link rel="shortcut icon" href="assets/favicon.ico" />

        <!--FACEBOOK META DESCRIPTION-->
        <meta property="og:title" content="ILMUNC India 2015" />
        <meta property="og:site_name" content="ILMUNC India 2015"/>
        <meta property="og:image" content="http://www.ilmunc-india.com/assets/fb.JPG"/>
        <meta property="og:description" content="Welcome to The Ivy League Model United Nations Conference India, a championship conference hosted by the University of Pennsylvania in New Delhi from November 26th-29th." />


        <!-- FOUNDATION -->
        <link rel="stylesheet" href="libs/css/normalize.css" />
        <link rel="stylesheet" href="libs/css/foundation.min.css" />

        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="libs/css/font-awesome.min.css" \>

        <link rel="stylesheet" href="css/style.css" \>

        <!-- Analytics Code -->
                <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-62515222-1', 'auto');
          ga('send', 'pageview');

        </script>
        
<? }
function getFooter() { ?>
    
                        <footer>
                    <div class="footer-bar">
                        <h3> CONTACT </h3>
                        <div class="large-6 column">
                        <p class="name">Santosh Vallabhaneni</b></p>
                        <p>Secretary-General</p>
                        <a style="color: #f74500;" href="mailto:secgen@ilmunc-india.com">secgen@ilmunc-india.com</a>
                        </div>
                        <div class="large-6 column">
                        <p class="name">Jyothi Vallurupalli</b></p>
                        <p>Director-General</p>
                        <a style="color: #f74500;" href="mailto:dirgen@ilmunc-india.com">dirgen@ilmunc-india.com</a>
                        </div>
                        <div class="social-media">
                            <!-- FACEBOOK -->
                            <a href="https://www.facebook.com/ilmuncindia"><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M10,0.5c-5.247,0-9.5,4.253-9.5,9.5c0,5.247,4.253,9.5,9.5,9.5c5.247,0,9.5-4.253,9.5-9.5C19.5,4.753,15.247,0.5,10,0.5 M10,18.637c-4.77,0-8.636-3.867-8.636-8.637S5.23,1.364,10,1.364S18.637,5.23,18.637,10S14.77,18.637,10,18.637 M10.858,7.949c0-0.349,0.036-0.536,0.573-0.536h0.719v-1.3H11c-1.38,0-1.866,0.65-1.866,1.743v0.845h-0.86V10h0.86v3.887h1.723V10h1.149l0.152-1.299h-1.302L10.858,7.949z"></path></svg></a>
                            <!-- TWITTER  -->
                            <!-- <a href=""><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M14.467,6.707c-0.34,0.198-0.715,0.342-1.115,0.419c-0.318-0.335-0.775-0.545-1.279-0.545c-0.969,0-1.754,0.773-1.754,1.727c0,0.135,0.015,0.267,0.045,0.394C8.905,8.628,7.612,7.94,6.747,6.896C6.596,7.151,6.509,7.448,6.509,7.764c0,0.599,0.31,1.128,0.78,1.438C7.002,9.192,6.732,9.115,6.495,8.985c0,0.007,0,0.014,0,0.021c0,0.837,0.605,1.535,1.408,1.694c-0.147,0.04-0.302,0.06-0.462,0.06c-0.113,0-0.223-0.011-0.33-0.031c0.223,0.687,0.871,1.186,1.638,1.199c-0.6,0.464-1.356,0.739-2.179,0.739c-0.142,0-0.281-0.007-0.418-0.023c0.777,0.489,1.699,0.775,2.689,0.775c3.228,0,4.991-2.63,4.991-4.913c0-0.075-0.002-0.149-0.004-0.223c0.342-0.244,0.639-0.547,0.875-0.894c-0.316,0.137-0.652,0.23-1.008,0.272C14.057,7.448,14.336,7.11,14.467,6.707 M10,0.594c-5.195,0-9.406,4.211-9.406,9.406c0,5.195,4.211,9.406,9.406,9.406c5.196,0,9.407-4.211,9.407-9.406C19.406,4.805,15.195,0.594,10,0.594 M10,18.552c-4.723,0-8.551-3.829-8.551-8.552S5.277,1.449,10,1.449c4.723,0,8.551,3.829,8.551,8.551S14.723,18.552,10,18.552"></path></svg></a> -->
                            <!-- INSTAGRAM -->
                            <a href="https://instagram.com/ilmuncindia"><svg class="svg-icon" viewBox="0 0 20 20"><path fill="none" d="M9.969,0.594c-5.195,0-9.406,4.211-9.406,9.406c0,5.195,4.211,9.406,9.406,9.406c5.195,0,9.406-4.211,9.406-9.406C19.375,4.805,15.164,0.594,9.969,0.594 M9.969,18.552c-4.723,0-8.551-3.829-8.551-8.552s3.829-8.551,8.551-8.551S18.521,5.277,18.521,10S14.691,18.552,9.969,18.552 M12.534,5.724H7.403c-0.944,0-1.71,0.766-1.71,1.71v5.131c0,0.944,0.766,1.71,1.71,1.71h5.131c0.944,0,1.71-0.766,1.71-1.71V7.435C14.244,6.49,13.479,5.724,12.534,5.724M11.679,7.007h1.283V8.29h-1.283V7.007z M9.969,8.29c0.944,0,1.71,0.766,1.71,1.71s-0.766,1.71-1.71,1.71s-1.71-0.766-1.71-1.71S9.024,8.29,9.969,8.29 M13.39,12.565c0,0.472-0.384,0.854-0.855,0.854H7.403c-0.472,0-0.855-0.383-0.855-0.854V9.573h0.898C7.423,9.712,7.403,9.854,7.403,10c0,1.417,1.149,2.565,2.565,2.565c1.416,0,2.565-1.148,2.565-2.565c0-0.146-0.02-0.288-0.043-0.427h0.898V12.565z"></path></svg></a>
                        </div>
                                                                                    
                        <p class="copyright">&#169; University of Pennsylvania International Affairs Association 2015</p>
                    </div>
                </footer>

        <!-- JQUERY -->
        <script src="libs/js/jquery.min.js"></script>
        
        <!-- FOUNDATION -->
        <script src="libs/js/foundation.min.js"></script>
        
        <!-- STELLAR.JS -->
        <script src="libs/js/jquery.stellar.js"></script>

        <script>
            $(document).foundation();
        </script>
<? }

function getAnnouncement() { ?>
<SCRIPT LANGUAGE="JavaScript">
        <!--
        // Author: Patrick Fairfield
        // Fairfield Consulting
        // change your event date event here.

        var eventdate = new Date("November 26, 2015 08:30:00");

        function toSt(n) {
        s=""
        if(n<10) s+="0"
        return s+n.toString();
        }

        function countdown() {
        cl=document.clock;
        d=new Date();
        count=Math.floor((eventdate.getTime()-d.getTime())/1000);
        if(count<=0)
        {cl.days.value ="----";
        cl.hours.value="--";
        cl.mins.value="--";
        cl.secs.value="--";
        return;
        }
        cl.secs.value=toSt(count%60);
        count=Math.floor(count/60);
        cl.mins.value=toSt(count%60);
        count=Math.floor(count/60);
        cl.hours.value=toSt(count%24);
        count=Math.floor(count/24);
        cl.days.value=count; 

        setTimeout("countdown()",500);
        }
        // end hiding script-->
        </SCRIPT>
            <body onLoad="countdown()">
<div class="annoucements large-4 column">
                    <h2> Announcements </h2>
                    <!-- <h4>Countdown to Conference</h4>

        <FORM name="clock">
        <table style="border: none;">
        <TR>
        <TD style="text-align: center; color: rgba(1, 37, 110, 0.9); font-family: "Garamond", serif;"><INPUT style="text-align: center; background-color: white; font-size: 20px; border: none;" name="days" disabled size=4></TD>
        <TD style="text-align: center; color: rgba(1, 37, 110, 0.9); font-family: "Garamond", serif;"><INPUT style="text-align: center; background-color: white; font-size: 20px; border: none;" name="hours" disabled size=2></TD>
        <TD style="text-align: center; color: rgba(1, 37, 110, 0.9); font-family: "Garamond", serif;"><INPUT style="text-align: center; background-color: white; font-size: 20px; border: none;" name="mins" disabled size=2></TD>
        <TD style="text-align: center; color: rgba(1, 37, 110, 0.9); font-family: "Garamond", serif;"><INPUT style="text-align: center; background-color: white; font-size: 20px; border: none;" name="secs" disabled size=2></TD>
        </TR>

        <TR style="background-color: white;">
        <TD style="text-align: center; color: #C43700; font-size: 18px; font-family: "Garamond", serif;"><B>Days</B></FONT></TD>
        <TD style="text-align: center; color: #C43700; font-size: 18px; font-family: "Garamond", serif;"><B>Hours</B></FONT></TD>
        <TD style="text-align: center; color: #C43700; font-size: 18px; font-family: "Garamond", serif;"><B>Mins</B></FONT></TD>
        <TD style="text-align: center; color: #C43700; font-size: 18px; font-family: "Garamond", serif;"><B>Secs</B></FONT></TD>
        </TR>
        </table>
        </FORM> -->
        <!-- <h4> Priority Registrations Now Open!</h4> -->
        <!-- <p>Less than a month to go before Priority Registrations close!</p> -->
        <div id="download_link"><a href="school.php" class="download_link" onclick="return true"><p style="margin-bottom: 0px; font-size: 1.2rem;">Register Now!</p></a></div>
        <h4> Conference Schedule released</h4>
        <p> The day-by-day conference schedule has now been released! Check it out at our <a href="schedule.php">schedule</a> page.</p>
        <h4> Background Guides are now LIVE!</h4>
        <p> All background guides are now available for download. Please reach out to your faculty advisors for the document password. For individual delegates, the password will be emailed to you.</p>
        <h4>Co Hosted by</h4>
        <a href="./muncafe.php" ><img style="padding-bottom: 15px; padding-left: 20px;" src="assets/mun-cafe.png" /></a>
        <h4> Connect with ILMUNC India </h4>
            <a style="margin-left: 65px;" href="https://www.facebook.com/ilmuncindia" target="_blank" class="fa fa-facebook-square fa-2x"></a>
            <a style="margin-left: 65px;" href="http://instagram.com/ilmuncindia" target="_blank" class="fa fa-instagram fa-2x"></a><br /><br />
            <a style="margin-left: 5px;" class="fa fa-phone fa-lg"> </a> +91 40 64630095
            <a style="margin-left: 5px;" class="fa fa-mobile fa-lg"> </a> +91 8886134284
           <!-- <a style="margin-left: 35px;" href="http://twitter.com/ilmunc" target="_blank" class="fa fa-twitter-square fa-2x"></a> -->
        </div>
            </div>
                        
<? }
?>