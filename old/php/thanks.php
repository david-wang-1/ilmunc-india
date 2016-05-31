<?php 
include_once('function.php');
getHeader("ILMUNC India | Schedule");
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
                    <h2> Thank You! </h2>
                    <br />
                    <p> We have received your application and are really excited to read it!</p> 
                    <p>In case you have any questions please feel free to email us at <a href="mailto: staff@ilmunc-india.com">staff@ilmunc-india.com</a>.</p>
                    
                </div>
                
                    <? getAnnouncement(); ?>
               
        </section>


<? getFooter(); ?>

    </body>
</html>
