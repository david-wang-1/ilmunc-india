<?php 
include_once('function.php');
getHeader("ILMUNC India | Rules");
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
                    <h2> Rules of Procedure </h2>

                     <img src ="./assets/rules_img.png" style="margin-bottom: 10px;" />
                    <div id="download_link"><a href="./assets/rules/rules.pdf" class="download_link" target="_blank" onclick="return true"><span>Rules of Procedure<br>[Download]</span></a></div> <br> </br>

                    <img src ="./assets/ps_img.png" style="margin-bottom: 10px;" />
                    <div id="download_link"><a href="./assets/rules/position_paper_guide.pdf" class="download_link" target="_blank" onclick="return true"><span>Position Paper Guide<br>[Download]</span></a></div> <br> </br>

                    <img src ="./assets/rg_img.png" style="margin-bottom: 10px;" />
                    <div id="download_link"><a href="./assets/rules/resolution_guide.pdf" class="download_link" target="_blank" onclick="return true"><span>Resolution Guide<br>[Download]</span></a></div> <br> </br>

                    <img src ="./assets/wp_img.png" style="margin-bottom: 10px;" />
                    <div id="download_link"><a href="./assets/rules/working_paper.pdf" class="download_link" target="_blank" onclick="return true"><span>Working Paper Guide<br>[Download]</span></a></div> <br> </br>
                                        
                </div>
                     <? getAnnouncement(); ?>
                
        </section>


<? getFooter(); ?>

    </body>
</html>
