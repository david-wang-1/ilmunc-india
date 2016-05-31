<?php
    include_once("function.php");
    getHeader('ILMUNC India | Secretariat');
?>
        <style>
            .header-image {
                background-image: url("assets/headers/hotel-header.jpg");
                background-position-y: -100px;
            }
            .person {
                margin-top: 50px;
                margin-bottom: 100px;
            }
            .person .portrait {
                margin: 10px 10px 10px 10px;
                float: left;
                padding-bottom: 25px;
            }
            .person .name {
                margin-bottom: 0;
            }
            .person .position {
                margin-bottom: 0;
                font-style: italic;
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
        <? getNavBar(); ?>



        <section class="content">
            <div class="row">
                <div class="main large-8 column text-justify">
                    <h2> The Secretariat </h2>
                    <ul class="small-block-grid-2 large-block-grid-3">
                    <li><a data-reveal-id="santosh">
                            <img class="portrait" src="./assets/sec/santosh_resize.jpg" />
                    </a>
                            <a data-reveal-id="santosh"><h4 style="margin-bottom: 0px; text-align: center;"> Santosh Vallabhaneni </h4></a>
                            <p style="text-align: center;"> Secretary-General </p>
                    </li>
                    <li><a data-reveal-id="jyothi">
                            <img class="portrait" src="./assets/sec/jyothi_resize.jpg" />
                    </a>
                    <a data-reveal-id="jyothi"><h4 style="margin-bottom: 0px; text-align: center;"> Jyothi Vallurupalli </h4></a>
                    <p style="text-align: center;"> Director-General </p>
                    </li>
                    <li><a data-reveal-id="ana">
                            <img class="portrait" src="./assets/sec/ana_resize.jpg" />
                    </a>
                    <a data-reveal-id="ana"><h4 style="margin-bottom: 0px; text-align: center;"> Ana Rancic </h4></a>
                    <p style="text-align: center;"> Chief of Staff </p>
                    </li>
                    <li><a data-reveal-id="elise">
                            <img class="portrait" src="./assets/sec/elise_resize.jpg" />
                    </a>
                    <a data-reveal-id="elise"><h4 style="margin-bottom: 0px; text-align: center;"> Elise Pi </h4></a>
                    <p style="text-align: center;"> Chief Operations Officer </p></li>
                    <li><a data-reveal-id="dhruv">
                            <img class="portrait" src="./assets/sec/dhruv_resize.jpg" />
                    </a>
                    <a data-reveal-id="dhruv"><h4 style="margin-bottom: 0px; text-align: center;"> Dhruv Agarwal </h4></a>
                    <p style="text-align: center;"> Under Secretary-General Operations </p></li>
                    <li><a data-reveal-id="hannah">
                            <img class="portrait" src="./assets/sec/hannah_resize.jpg" />
                    </a>
                    <a data-reveal-id="hannah"><h4 style="margin-bottom: 0px; text-align: center;"> Hannah White </h4></a>
                    <p style="text-align: center;"> Under Secretary-General Administration </p></li>

                    <div class="person reveal-modal" data-reveal aria-hidden="true" id="santosh">
                        <a href="#" style="color: #000000;" class="close-reveal-modal">x</a>
                        <img class="portrait" src ="./assets/sec/santosh_resize.jpg" />
                        <h4 class="name"> Santosh Vallabhaneni</h4>
                        <p class="position">Secretary-General</p>
                        <a class="email" href="mailto:secgen@ilmunc-india.com">secgen@ilmunc-india.com</a>
                        <p>Santosh is currently a sophomore in the Jerome Fisher Program for Management and Technology at the University of Pennsylvania majoring in Finance and Computer Science. He was born in New Jersey, but has lived in Hyderabad, India for a majority of his high school life. He is extremely involved with numerous entrepreneurial endeavors and often spend hours reading about small college startups around the country. He is a part of various organizations on campus including the M&T Innovations Fund, the Pi Kappa Alpha Fraternity and of course, the International Affairs Association. He also loves playing basketball (Go Lakers!) and is a die-hard Game of Thrones fan. Santosh started participating in Model United Nations Conferences in 9th Grade and has never stopped. He has participated, chaired and organized over 40 conferences nationally and internationally. Besides heading ILMUNC India, he is also chairing at ILMUNC Philadelphia and UPMUNC and is a part of the University of Pennsylvania's Model United Nations travel team. He is extremely excited to meet all of you in Delhi this November!</p> 
                    </div>

                    <div class="person reveal-modal" data-reveal aria-hidden="true" id="jyothi">
                        <a href="#" style="color: #000000;" class="close-reveal-modal">x</a>
                        <img class="portrait" src ="./assets/sec/jyothi_resize.jpg" />
                        <h4 class="name"> Jyothi Vallurupalli</h4>
                        <p class="position">Director-General</p>
                        <a lass="email" href="mailto: dirgen@ilmunc-india.com">dirgen@ilmunc-india.com</a>
                        <p>Jyothi is a sophomore in the Wharton School of Business, and is originally from Hyderabad, India. 

She is interested in operations management, behavioural economics, and 

entrepreneurship. She loves contemporary art, music, stand-up comedy, and exploring 

Philadelphia’s restaurants. Jyothi has been involved in organizing and participating in 

Model United Nations conferences in both India and the United States. She is very excited to be 

your Director-General for ILMUNC India 2015, and cannot wait to make it an amazing 

experience for each one of you!</p>
                    </div>

                    <div class="person reveal-modal" data-reveal aria-hidden="true" id="ana">
                        <a href="#" style="color: #000000;" class="close-reveal-modal">x</a>
                        <img class="portrait" src ="./assets/sec/ana_resize.jpg" />
                        <h4 class="name"> Ana Rancic</h4>
                        <p class="position">Cheif of Staff</p>
                        <a class="email" href="mailto:staff@ilmunc-india.com">staff@ilmunc-india.com</a>
                        <p>Ana is a sophomore in the Huntsman Program of International Studies and Business, a dual-degree program between the College of Arts and Sciences and the Wharton School. She’s originally from Belgrade, Serbia but was raised in New Zealand and the United Arab Emirates before moving to Philadelphia. She is a total foodie, as well as total health and fitness nut and can be found either at the gym, with a yoga mat or sipping tea. She can’t wait to explore India. She is academically fascinated in behavioral economics, international relations and sociology. Ana was involved with MUN throughout high school, and she attended conferences on multiple continents as both a chair and delegate. She is so excited to be your Chief of Staff for ILMUNC India 2015 and to get to meet all of you!</p>
                    </div>

                    <div class="person reveal-modal" data-reveal aria-hidden="true" id="elise">
                        <a href="#" style="color: #000000;" class="close-reveal-modal">x</a>
                        <img class="portrait" src ="./assets/sec/elise_resize.jpg" />
                        <h4 class="name"> Elise Pi</h4>
                        <p class="position">Chief Operations Officer</p>
                        <a class="email" href="mailto:operations@ilmunc-india.com">operations@ilmunc-india.com</a>
                        <p>Elise is a senior in the College of Arts and Sciences studying Economics with a minor in Mathematics and English. Though originally from Cupertino, California, she has spent half her life living in Shanghai, China. Her Model UN experience includes roles as a delegate, Chair, USG Operations, and Secretary-General. Having worked on both ILMUNC and ILMUNC China conferences, she is ecstatic to be serving as Chief of Operations for ILMUNC India 2015. Outside of the International Affairs Association, Elise is heavily involved with the Assembly of International Students and is a research assistant in the Political Sciences department.</p>
                    </div>

                    <div class="person reveal-modal" data-reveal aria-hidden="true" id="dhruv">
                        <a href="#" style="color: #000000;" class="close-reveal-modal">x</a>
                        <img class="portrait" src ="./assets/sec/dhruv_resize.jpg"/>
                        <h4 class="name"> Dhruv Agarwal</h4>
                        <p class="position">Under Secretary-General - Opertations</p>
                        <a class="email" href="mailto:usg-ops@ilmunc-india.com">usg-ops@ilmunc-india.com</a>
                        <p>Dhruv is a sophomore in the School of Engineering and Applied Sciences majoring in Computer Science and minoring in Engineering Entrepreneurship. 
                            Originally from India, Dhruv attended high school in Nairobi, Kenya and has traveled to over 50 cities in 18 countries spanning 5 continents. 
                            He loves to meet new people and understand new cultures! Dhruv has been involved in Model UN since freshman year of high school, organizing and participating in various MUN conferences and has held various leadership roles in conferences on the East African circuit. 
                            When not helping plan the best ILMUNC India ever, Dhruv can be found either binge watching House of Cards, building the next big mobile app or taking photographs around campus. 
                            He couldn't be more excited to meet you at this year’s ILMUNC India!</p></div>

                    <div class="person reveal-modal" data-reveal aria-hidden="true" id="hannah">
                        <a href="#" style="color: #000000;" class="close-reveal-modal">x</a>
                        <img class="portrait" src ="./assets/sec/hannah_resize.jpg" />
                        <h4 class="name">Hannah White</h4>
                        <p class="position">Under Secretary-General - Administration</p>
                        <a class="email" href="mailto:admin@ilmunc-india.com">admin@ilmunc-india.com</a>
                        <p>Hannah is a third-year student at the University of Pennsylvania concentrating in Politics, Philosophy and Economics with a language citation in French. She grew up in Fairbanks, Alaska, a place where it is not uncommon for the temperatures to drop below 40 degrees Fahrenheit!
                        Hannah competes on Intercol, Penn’s competitive Model UN traveling team and also serves on the Intercol Board of Directors. She is also involved in other Penn Model UN conferences including UPMUNC and ILMUNC.
                        Aside from Model UN, Hannah runs a non-profit and is always looking for ways to get involved with her community. She enjoys being outdoors, writing comedy plays, and reading as much as she possibly can.
                        She is extremely excited to be a part of ILMUNC India 2015 and hopes to make it the best conference yet!</p>
                    </div>
                </div>
               
                    <? getAnnouncement(); ?>
                
        </section>

        <? getFooter(); ?>

    </body>
</html>
