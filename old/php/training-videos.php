<?php
    include_once("function.php");
    getHeader('ILMUNC India | Training');
?>
        <style>
            .header-image {
                background-image: url("assets/headers/hotel-header.jpg");
                background-position-y: -100px;
            }
            .videoWrapper {
                position: relative;
                margin-bottom: 50px;
                padding-bottom: 56.25%; /* 16:9 */
                padding-top: 25px;
                height: 0;
            }
            .videoWrapper iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100% !important;
                height: 100% !important;
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
                    <h2> Training Videos </h2>
                    <h3> Part I </h3>
                    <div class="videoWrapper">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/QYu9mJz6S3I?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>                    </div>
                    <h3> Part II </h3>
                    <div class="videoWrapper">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/uebd006PtBw?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>                    </div>
                    <p>  </p>
                </div>
                    <? getAnnouncement(); ?>
                
        </section>


<? getFooter(); ?>

    </body>
</html>
