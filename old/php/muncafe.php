<?php
include_once('function.php');
getHeader("ILMUNC India | MUNCafé");
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
            #best-regards {
                margin-bottom: 0;
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
                    <h2>MUNCafé</h2>

<p>MUNCafé is a Global Academic Simulations Platform that designs, develops and delivers enriching leadership experiences with a focus on personal, academic & professional development. Over 6000 school students & young people from India, The USA, China, Pakistan, Sri Lanka, Hong Kong, Bangladesh, the United Arab Emirates, Oman, Malaysia, Columbia, Canada, Nepal, and Singapore have participated in various learning programs & experiences facilitated by MUNCafe since 2009. MUNCafé is a brand of Worldview Education which is founded and managed by professionals with many decades of cumulative experience in experiential education through simulations like Model UN. At Worldview we firmly believe in co-creation and leveraging the power of partnership which has helped us get associated with a variety of reputed global organisations and leadership schools. The common thread among all offerings of the company is experiential learning which can develop personal potential attributes in an individual including Thinking & Creativity, Knowledge, Communication Skills, Ethics & Integrity, Team Work, and Planning & Organization. The balanced mix of learning tools & methods include simulation-based learning, travel experiences, real-time work, internships, entrepreneurial projects and case studies</p>
</div>
                
                    <? getAnnouncement(); ?>
                
        </section>


<? getFooter(); ?>

    </body>
</html>
