<?php 
include_once('function.php');
getHeader("ILMUNC India | UNHRC");
?>
        <link rel="stylesheet" href="css/committees.css" \>
        <style>
            .header-image {
                background-image: url("assets/headers/hotel-header.jpg");
                background-position-y: -100px;
            }
            #no-space{
                margin-bottom: 0;
            }
        </style>
        
        <!-- MODERNIZR -->
        <script src="libs/js/modernizr.js"></script>
    </head>

    <body>
         <div class="header">
        <div class="logo-bar">
               <img src="assets/india-header-white.png" />
        </div>
        </div>
        
        <?getNavBar();?>


         <section class="content">
            <div class="row">
                <h2> Welcome to the Historical UN Human Rights Council</h2>
                <div class="horizontal-border" style="border-bottom-style: solid; border-bottom-width: 3px; border-color: rgba(1, 37, 110, 0.9);">
                    
                    <div id="download_link"><a href="/assets/bg/UNHRC.pdf" target="_blank" class="download_link" onclick="return true"><span>Background Guide<br>[password required]</span></a></div>
                <div id="download_text">The password for the guide can be obtained from your faculty advisor.</div>
                <br> </br>

                    <img class="chair-portrait" src ="./assets/chairs/madeline.jpg" width = "250px" style="padding-right: 20px; padding-bottom: 30px;" />
                    <h4> Dear Delegates and Faculty Advisors, </h4>
                    <p>It is my pleasure to welcome you to ILMUNC India! My name is Madeline Su, and I am stoked be your chair for the United Nations Human Rights Council. I am looking forward to this coming conference that I am sure will filled with lots of fun and exciting debate. </p>
                    <p>To share a bit about myself, I was originally born in Shanghai, China and am now from a town in Pennsylvania. I have always been incredibly interested in international affairs and have been involved in Model UN and debate since high school. In the past, I’ve chaired for ILMUNC, Penn’s high school Model UN conference, and I also serve on the secretariat of Penn’s collegiate Model UN conference, UPMUNC. I am currently a junior in the Wharton School of Business studying Marketing/Operations Management and Statistics. Apart from school and other organizations, I play the piano and love listening to music and going to concerts. Some may describe me as being a bit of an adrenaline junkie, and I’m interested in entrepreneurship and love to travel whenever I can.</p> 
                    <p>I cannot express how excited I am to get to watch you engage in debate. This will be such a great opportunity for you to hone in your critical thinking and presentation skills, and I have no doubt it will be a fantastic experience for us all. Please do not hesitate to contact me with any questions you may have, and I look forward to meeting you all! </p>
                    <p>All the best, <br>
                    <span class="santosh">Madeline Su</span> <br>
                    Chair, Historical UN Human Rights Council <br>
                    ILMUNC India 2015</p>
                </div>
            </div>
            <div class="row topics">
                <div class="large-6 column justify">
                    <h4> Topic A: Caravan of Death (Pinochet’s Chile) </h4>
                    <p>The “Caravan of Death” was a “delegation" of men sent to Chile's provincial towns by General Pinochet,

the leader of the 1973 coup of Chile. The unit travelled from town to town in a Puma helicopter, armed 

with machine guns, grenades, guns and knives, systematically killing opponents of the coup. The Caravan 

of Death landed in sixteen towns in the north and south of Chile and killed 97 people between 30 

September and 22 October 1973, according to figures compiled by the NGO Memory and Justice. Many 

of the people who were executed had voluntarily turned themselves in to the military authorities and 

served no immediate threat to General Pinochet or his supporters. How should the international 

community handle General Pinochet and the men in the unit who executed the crimes?</p></div>
                <div class="large-6 column justify">
                    <h4> Topic B: Khmer Rouge </h4>
                    <p>The Khmer Rouge is a radical communist group that waged civil war on the Cambodian government for 

five years until seizing power in 1975. Their goal is to return Cambodia to its pre-industrial agrarian roots 

by evacuating cities and forcing citizens into brutal farm labor. Pol Pot, leader of the Khmer Rouge, has 

ordered the purge of countless wealthy Cambodians, intellectuals, and political dissidents. Countless other 

Cambodians have died due to malnutrition as a result of Pol Pot’s failed agricultural plan. President 

Carter of the United States has accurately named the Khmer Rouge the “worst violator of human rights in 

the world.” The international community must come together in order to create a definitive plan of action 

to combat the evils of Pol Pot and the Khmer Rouge and protect the lives of innocent Cambodians. How 

can we end this human rights crisis? What is to be done with the Khmer Rouge once the crisis is dealt 

with?</p></div>
            </div>
        </section>


 <?getFooter();?>

    </body>
</html>
