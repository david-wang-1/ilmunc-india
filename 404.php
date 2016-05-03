<?php 
include_once('function.php');
getHeader("ILMUNC India | 404");
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
                    <h2> Page Not Found! </h2>
                    
                    <p>We're sorry but the page you are looking for could not be found. Please click <a href="./index.php">here</a> to return to the home page.</p>
                    
                </div>
                
                    <? getAnnouncement(); ?>
               
        </section>


<? getFooter(); ?>

    </body>
</html>
