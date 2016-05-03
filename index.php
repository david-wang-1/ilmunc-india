<?php 
    include_once("function.php");
    include_once("config.php");
    if(isset($_SESSION['auth']) || $_SESSION['auth'] == 1) {
      unset($_SESSION['auth']);
      unset($_SESSION['school_id']);
    }
    getHeader('Welcome to ILMUNC India');
?>

        <style>
            .down-arrow {
                height: 10vh;
                width: 100vw;
                text-align: center;
                margin-top: 10vh;
            }
            .down-arrow .circle {
                height: 80px;
                width: 80px;
                display: block;
                margin: auto;
                background-color: rgba(34, 34, 34, 0.5);
                border-radius: 40px;
                cursor: pointer;
            }
            .down-arrow i {
                color: white;
            }
            #best-regards {
                margin-bottom: 0;
            }
        </style>

    

        <!-- MODERNIZR -->
        <script src="libs/js/modernizr.js"></script>
    </head>

    <body>


        <div class="splash">
            <div class="logo-bar">
                <img src="assets/india-header-white.png" />
            </div>
            <div class="down-arrow">
                <div class="circle">
                    <i class="fa fa-angle-down fa-5x"></i>
                </div>
            </div>
        </div>

<? 
    getNavBar();
?>


        <section class="content">
            <div class="row">
                <div class="main large-8 column text-justify">
                    <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; height: auto; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube-nocookie.com/embed/jc0AQfRq5vA?modestbranding=1&amp;rel=0&amp;controls=1&amp;hd=1&amp;autoplay=0&amp;autohide=1&amp;playsinline=1' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
                    <h2>Welcome to ILMUNC India 2015!</h2>
                    <img src="assets/sec/santosh_resize.jpg" style="float:left; padding-right: 30px; padding-top: 35px;"/>
                    <h3>Dear Delegates,</h3>
                    <p>It is my pleasure to invite you to The Ivy League Model United Nations Conference India hosted by the International Affairs Association of the University of Pennsylvania, an Ivy League institution. This year’s iteration of ILMUNC India will take place from November 26th to November 29th at the Kempinski Ambience Hotel, New Delhi. They Ivy League Model United Nations Conference is one of the most reputed high school conferences in the United States bringing together over 3000 delegates from across the globe in an unique academic, social and cultural experience. </p>
                    <p>We are excited to bring this experience to India this year in what will be one of the largest and most enriching Model United Nations symposiums. A large part of what makes ILMUNC so incredible is the commitment of its amazing staff.  These leaders flying in from the University of Pennsylvania have a diverse range of majors, interests, classes, and schools – from Finance at the Wharton School of Business to Computer Science and Nanotechnology at the School of Engineering. At ILMUNC we believe in providing a professional collegiate experience to our high school delegates both within and outside the committee room. </p>
                    <p>The Secretariat is working hard to ensure that the quality of the conference is unparalleled. This year will bring together close to 500 delegates in 8 distinct committees. The topics we are discussing are pertinent issues in today’s world and we are excited to witness the unique and diverse solutions that our delegates will bring to the table. The ILMUNC India team is continuously searching for ways to make the conference better and more engaging for our delegates. We are proud to announce technological advancement in the Model United Nations circuit including a groundbreaking mobile application that will soon be released. </p>
                    <p>Our delegates’ experiences outside of committee are just as vital as their experiences within committee. At ILMUNC India we ensure that our delegates take away memories and experiences that will better them personally and professionally. Outside of the invaluable Model United Nations experience, we host numerous college and career fairs, personal mentoring sessions with current students and alumni, keynote speeches from prominent members of society and, of course, enthralling social events.  </p>
                    <p>Our delegates are the most integral part of our story and I’d like to once again thank you for choosing to be a part of our next chapter of ILMUNC India 2015. We are certain that you will walk away from this conference with memories that you will cherish for a long time to come. If you have any questions, concerns, or comments between now and the conference, I encourage you to reach out to me at secgen@ilmunc-india.com or to call me at +1 (267)-432-3696. On behalf of the entire Secretariat, I cannot wait to host you and your school in Delhi this November. </p>
                    <p id="best-regards">Yours Sincerely,</p>
                    <p class="santosh">Santosh Vallabhaneni</p>
                </div>
                
                    <? getAnnouncement(); ?>
                
        </section>

<? getFooter(); ?>

        <!-- SCROLL DOWN ARROW BUTTON ON SPLASH -->
        <script>
            $('.circle').click(function() {
                $('html, body').animate({
                    scrollTop: $('section.content').offset().top - 2 * $('.nav-bar').height()
                }, 750);
            });
        </script>

    </body>
</html>
