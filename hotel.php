<?php
    include_once("function.php");
    getHeader('ILMUNC India | Hotel');
?>
        <style>
            .header-image {
                background-image: url("assets/headers/hotel-header.jpg");
                background-position-y: -100px;
            }
            .content img.inline-hotel {
                padding-bottom: 30px;
            }

            .content img.block-hotel {
                width: 100%;
                padding-bottom: 30px;
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
                <div class="main large-8 column text-justify">
                    <h2> Hotel Information </h2>
                    <img src="assets/hotel1.jpg" class="block-hotel" />
                    <h3> Kempinski Ambience </h3>
                    <p> <span class="emph"> ILMUNC India 2015 </span> will be held at the Kempinski Ambience, New Delhi. This accommodation is just 19 kilometres from Connaught Place, 17 kilometres from Chandni Chowk market and a 40 minute drive from the Indira Gandhi International Airport, making it easily accessible by transport. The Kempinski Ambience is known for being a part of a legacy of unmatched standards in hospitality, which raises the bar higher when it comes to customer satisfaction, while upholding the hotel's singular mission of building valued customer relationships to cater to all your needs and to ensure you have a memorable stay.</p>
                    <div class="row">
                        <div class="large-6 column show-for-large-up">
                            <img src="assets/hotel2.jpg" class="inline-hotel" />
                            <img src="assets/hotel3.jpg" class="inline-hotel" />
                            <img src="assets/hotel4.jpg" class="inline-hotel" />
                        </div>
                        <div class="large-6  column">
                            <p>The hotel is especially suited to host ILMUNC India 2015. Encased within two towers are 480 rooms and suites, two outdoor swimming pools, luxurious recreational facilities and specialty dining options. It boasts of a pillar-less ballroom of 25,000 sq.ft., the largest in a luxury hotel in India with a total meeting space of 70,000 sq.ft. that can comfortably accommodate 6000 guests.</p>
                            <p>ILMUNC India 2015 will be a residential conference. Modern rooms at the Kempinski Ambience are equipped with a flat-screen cable TV, minibar and a tea/coffee maker. The spacious en suite bathroom is fitted with a bath and shower.</p>
                            <p> The fantastic amenities, dedicated staff, and customer-focused mindset at the Kempinski Ambience Hotel promises to make your experience second to none, leaving you with a satisfying and fulfilling conference experience.</p>
                        </div>
                    </div>
                            <p> For more information on the hotel <a href="http://www.kempinski.com/en/delhi/ambience-hotel/welcome/"> click here.</a> </p>
                            <p> Any questions can be directed to: <br> 
                                <a href="mailto:secgen@ilmunc-india.com">secgen@ilmunc-india.com</a> </p>
                </div>
               
                    <? getAnnouncement(); ?>
                
        </section>

<? getFooter(); ?>

    </body>
</html>
