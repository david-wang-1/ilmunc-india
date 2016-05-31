<?php
    include_once("function.php");
    getHeader('ILMUNC India | Invitation');
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
        
        <?php
            getNavBar();
        ?>

        <section class="content">
            <div class="row">
                <div class="main large-8 column text-justify">
                    <h2> Invitation from the Secretary-General </h2>
                    <!--<img width = "217px" height = "367px" style="float: left; margin-right: 30px;" src ="./assets/sec/sunny.jpg" />
                    <h3>Dear Delegates,</h3>
                    <p>It is my pleasure to invite you to The Ivy League Model United Nations Conference India ​co- ​hosted by the International Affairs Association of the University of Pennsylvania, an Ivy League institution​ and MUN Cafe- A Brand of Worldview Education​. This year’s iteration of ILMUNC India will take place from November 26th to November 29th at the Kempinski Ambience Hotel, New Delhi. The Ivy League Model United Nations Conference is one of the most reputed high school conferences in the United States bringing together over 3000 delegates from across the globe and is a unique academic, social and cultural experience.</p>
                    <p>We are excited to bring this experience to India this year in what will be one of the largest and most enriching Model United Nations symposiums. A large part of what makes ILMUNC so incredible is the commitment of its amazing staff. These leaders flying in from the University of Pennsylvania have a diverse range of majors, interests, classes, and schools – from Finance at the Wharton School of Business to Computer Science and Nanotechnology at the School of Engineering. At ILMUNC we believe in providing a professional collegiate experience to our high school delegates both within and outside the committee room.</p>
                    <p>The Secretariat is working hard to ensure that the quality of the conference is unparalleled. This year will bring together over 1000 delegates in 8 distinct committees. The topics we are discussing are pertinent issues in today’s world and we are excited to witness the unique and diverse solutions that our delegates will bring to the table. The ILMUNC India team is continuously searching for ways to make the conference better and more engaging for our delegates. We are proud to announce technological advancement in the Model United Nations circuit including a groundbreaking mobile application that will soon be released.</p>
                    <p>W​e are also pleased to announce ​our association with MUN Cafe for ILMUNC India this year. MUN Cafe brings with it years of experience in facilitating high quality Model UN experiences through its various international programs, training modules and conferences. Together, we've envisioned a conference that will provide an enriching experience for our delegates that will better them professionally and personally. This will be facilitated through numerous college and career fairs, personal mentoring sessions with current students and alumni, keynote speeches from prominent members of society and, of course, enthralling social events.</p>
                    <p>Our delegates are the most integral part of our story and I’d like to once again thank you for choosing to be a part of the next chapter of ILMUNC India 2015. We are certain that you will walk away from this conference with memories that you will cherish for a long time to come. If you have any questions, concerns, or comments between now and the conference, I encourage you to reach out to me at secgen@ilmunc-india.com or to call me at +1 (267)-432-3696. On behalf of the entire Secretariat, I cannot wait to host you and your school in Delhi this November.</p>
                    <p id="best-regards">Yours Sincerely,</p>
                    <p class="santosh">Santosh Vallabhaneni</p>
                    <p id="best-regards">Secretary-General</p>
                    <p id="best-regards">ILMUNC India 2015</p>
                    <a href="mailto:secgen@ilmunc-india.com" id="best-regards">secgen@ilmunc-india.com</a>-->

<iframe src="http://docs.google.com/gview?url=http://ilmunc-india.com/assets/letter.pdf&embedded=true" style="width:680px; height:890px;" frameborder="0"></iframe>
                </div>
                
                    <? getAnnouncement(); ?>
                
        </section>


<? getFooter(); ?>


    </body>
</html>
