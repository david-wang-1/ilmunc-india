<?php
    include_once("function.php");
    getHeader('ILMUNC India | FAQ');
?>
        <style>
            .header-image {
                background-image: url("assets/headers/hotel-header.jpg");
                background-position-y: -100px;
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
        <?php
            getNavBar();
        ?>

        <section class="content">
            <div class="row">
                <div class="main large-12 column text-justify">
                    <h2> Frequently Asked Questions </h2>
                    <ul style = "margin-left: 120px; margin-right: 100px;"class="tabs" data-tab>
                        <li class="tab-title active"><a href="#panel1">General</a></li>
                        <li class="tab-title"><a href="#panel2">Conference Registration, Fees, and Logistics</a></li>
                        <li class="tab-title"><a href="#panel3">Research & Preparation</a></li>
                    </ul>
                    <div class="tabs-content">
                        <div class="content active" id="panel1">
                            <ul class="accordion" data-accordion>
                                <li class="accordion-navigation">
                                    <a href="#panel1a">Q: What is Model United Nations?</a>
                                    <div id="panel1a" class="content">
A: Model United Nations is a simulation of the UN General Assembly and other multilateral bodies. In Model UN, students step into the shoes of ambassadors from UN member states to debate current issues on the organization's agenda. While playing their roles as ambassadors, student "delegates" make speeches, prepare draft resolutions, negotiate with allies and adversaries, resolve conflicts, and navigate the Model UN conference rules of procedure - all in the interest of mobilizing international cooperation to resolve problems that affect countries all over the world. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel1b">Q: How much experience do I need to participate in Model UN conferences like ILMUNC India?</a>
                                    <div id="panel1b" class="content">
A: You do not require any experience to participate in general committees of most high school conferences like ILMUNC India! Although crisis committees warrant some experience as debate is not always linear, a good understanding of the committee’s mandate is usually adequate for any student to participate effectively. For more information, please visit the sections on crisis committees and preparatory research.  
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel1c">Q: What types of topics are discussed in Model UN conferences?</a>
                                    <div id="panel1c" class="content">
A: The agenda items discussed in committee vary at each conference. Most conferences tend to focus on current affairs issues that are being discussed in the United Nations. These issues can highlight political, financial and/or social concerns. However, the task of some committees might be to address hypothetical concerns or issues from the past or future. For example, at ILMUNC India, we have numerous specialized and crisis committees including the Historical UN Human Rights Council (UNHRC) and Constellis & Syrian Government, set in the year 2020. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel1d">Q: Why should I participate in Model UN conferences? </a>
                                    <div id="panel1d" class="content">
A: Model UN promotes students' and teachers' interest in the world around them and broadens a student's knowledge in a variety of subjects. Model UN also teaches vital skills in negotiation, public speaking, problem solving, conflict resolution, research and communication. At ILMUNC India, topics such as Emerging Technologies’ Impact on Arms Trade allow students to gain deeper insight into and participate in an extremely current global discussion. It also gives students and teachers the opportunity to connect with their peers from across India, and from across the world, while also connecting with undergraduate students and representatives from global higher education institutions. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel1e">Q: What are some educational benefits of Model UN? </a>
                                    <div id="panel1e" class="content">
A: Students and teachers benefit immensely from the highly interactive Model UN experience. It not only involves young people in the study and discussion of global issues, but also encourages the development of skills useful throughout their lives, such as research, writing, public speaking, problem solving, consensus building, conflict resolution, and compromise and cooperation while lobbying. 
</li>
                                </ul>
                        </div>
                        <div class="content" id="panel2">
                            <ul class="accordion" data-accordion>
                                <li class="accordion-navigation">
                                    <a href="#panel2a">Q: I am looking to register as an individual delegate, can I register during the priority registration period? </a>
                                    <div id="panel2a" class="content">
A: Yes, both individual delegates and delegations can register during the priority registration period! </li>
                                <li class="accordion-navigation">
                                    <a href="#panel2b">Q: Can I participate as an individual delegate? </a>
                                    <div id="panel2b" class="content">
A: Yes, you can register and participate as an individual delegate. You will be required to accept the terms & conditions that apply specifically to individual delegates upon registrations, and also provide the Secretariat with a no-objection letter from your parent or guardian. Upon registration, more information regarding this will be sent to the contact email that you provide. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel2c">Q: How many students can register together as a delegation? </a>
                                    <div id="panel2c" class="content">
A: A minimum of 4 students are required to registered as a delegation. The delegation needs to be accompanied by a faculty advisor, a parent or guardian, or an adult chaperone, in which case letters of no-objection are required from each delegation member’s parent or guardian. Feel free to reach out to the Secretariat at <a href="mailto:info@ilmunc-india.com"> info@ilmunc-india.com </a> if you have further questions or concerns regarding delegation registrations. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel2d">Q: What is included within the delegate conference fee?</a>
                                    <div id="panel2d" class="content">
A: For a detailed breakdown of the delegate conference fee, please refer to the <a href= "./fees.php">Fees and Dates</a> page. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel2e">Q: I am a delegate, can I stay in a single room instead of a double?</a>
                                    <div id="panel2e" class="content">
A: Yes, both individual delegates and members of delegations have the option of staying in a single room instead of the default double included in the conference fee. Please email the Secretariat at <a href="mailto:info@ilmunc-india.com"> info@ilmunc-india.com </a>, and we will provide you with revised rates according to the availability of single rooms at the time.</li>
                                <li class="accordion-navigation">
                                    <a href="#panel2f">Q: Can I commute to and from the conference?  </a>
                                    <div id="panel2f" class="content">
A: For the first time, we are excited to announce that ILMUNC India will be a 100% residential conference. We wanted to ensure a holistic and immersive experience for our delegates while also ensuring the highest levels of safety. By staying at the hotel you are surrounded by delegates from numerous countries and cities from around the world. It is a great opportunity to network, make friends, and immerse yourself in this experience. Furthermore, ILMUNC India’s social events tend to run a bit late into the night. We want our delegates to enjoy them in entirety and we do not believe it is fair for some delegations or delegates to miss out because they would need to travel home early. Finally, ILMUNC India may host special midnight crisis sessions, which are always exciting experiences, but is only possible when the conference is residential. We have worked hard to subsidize the accommodation and conference price for our delegates at one of the best 5 star hotels in Delhi. Model United Nations conferences such as ILMUNC are more than just committee simulations. Delegates learn from and enjoy their out of committee experience just as much as their committee one. We would be happy to talk further if you may have concerns about the nature of the conference. However, we are certain that this is the best way to make the most out of your ILMUNC India experience.
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel2g">Q: Can I access the school dashboard using the login information I used for last year’s conference? </a>
                                    <div id="panel2g" class="content">
A: No. Your login information used for previous conferences is not valid for future conferences. During the registration process for this year’s conference, you will receive information on how to create new login credentials to access the school dashboard. If you have forgotten these new login credentials, feel free to email the Secretariat at <a href="mailto:info@ilmunc-india.com"> info@ilmunc-india.com</a>. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel2h">Q: Where can I find more information about the Conference schedule? </a>
                                    <div id="panel2h" class="content">
A: You can find a detailed schedule on the <a href= "./schedule.php"> Conference Schedule </a> page, and you will also have access to a personalized schedule through the mobile application. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel2i">Q: Is attendance taken at committee sessions? </a>
                                    <div id="panel2i" class="content">
A: Yes, attendance will be taken at every committee session. If you are unable to attend a committee session for an unforeseen reason such as a sudden illness, please have your faculty advisor, parent, or chaperone at the conference notify your Chair and a member of the Secretariat. An absence will affect your consideration for an award for your committee. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel2j">Q: Can faculty advisors attend committee sessions?</a>
                                    <div id="panel2j" class="content">
A: Although faculty advisors cannot participate during committee sessions, faculty advisors are allowed, and encouraged, to be present as silent observers during the committee sessions.
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel2k">Q: What are the rules & regulations of the conference, and how are they enforced?</a>
                                    <div id="panel2k" class="content">
A: Although faculty advisors cannot participate during committee sessions, faculty advisors are allowed, and encouraged, to be present as silent observers during the committee sessions.
</li>
                            </ul>
                        </div>
                        <div class="content" id="panel3">
                            <ul class="accordion" data-accordion>
                                <li class="accordion-navigation">
                                    <a href="#panel3a">Q: How should I research for my committee? </a>
                                    <div id="panel3a" class="content">
A: There are numerous ways in which you can prepare to contribute effectively to your committee. The first and most effective way to prepare is to thoroughly go through the background guide for your specific committee. At ILMUNC India, we are also excited to announce the use of dynamic background guides - these will be an online interactive supplement to the traditional background guide, where we will have discussion forums, where you can interact with your Chairs and Directors, and where you can read relevant articles that will be regularly posted. You will receive information on how to access your background guide and dynamic background guide once you have been allocated to a committee and been assigned a country or position. Depending on your prior experience, do read through our <a href="./rules.php"> guidelines </a>regarding rules of procedure, writing resolutions, working papers, and position papers. Also familiarize yourself with the key points from our <a href = "./training-videos.php">training videos</a>, which will be updated regularly closer to the date of the conference. To research more comprehensively, you can also look through our compiled <a href = "./research-links.php">research links</a> to find resources pertinent to your committee, country, and topic. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel3b">Q: What are position papers, and how do I write one?</a>
                                    <div id="panel3b" class="content">
A: A position paper is an essay detailing your country’s policies on the topics being discussed in your committee. You will receive committee-specific information on deadlines and formats for the position paper. Delegates in crisis committees especially will receive more detailed information on what is expected from your position papers, if you are required to write one. Regardless, if you are required to write a position paper for your committee, you will have adequate time prior to the conference, and there will be a lot of resources to guide you in the writing process. You will be able to write a highly effective position paper if you refer to our <a href = "./assets/rules/position_paper_guide.pdf">Guide to Writing Position Papers</a>. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel3c">Q: What is a working paper? </a>
                                    <div id="panel3c" class="content">
A: A working paper is often the precursor to a resolution in that it can outline the issues of a topic area or propose solutions, without a particular format. A working paper may not be voted upon and may only contain signatories. Some chairs, however, may request that working papers be submitted in resolution format. You can find more information on working papers, including samples, by referring to our <a href = "./assets/rules/working_paper.pdf">Guide to Writing Working Papers</a>.                                        </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel3d">Q: What is a draft resolution? </a>
                                    <div id="panel3d" class="content">
A: During lobbying and debate, delegates with similar suggestions will begin to come together to form working groups, and will combine ideas and suggestions to create resolutions. Resolutions are suggested solutions to the global community for the topic at hand and are the end result of debate and working papers. Resolutions are written by these groups of delegates and voted on by the committee as whole. You can find information on resolutions, including a list of preambulatory and operations phrases, and a sample format, by referring to our Guide to Writing Resolutions. 
</li>
                                <li class="accordion-navigation">
                                    <a href="#panel3e">Q: Are pre-written resolutions allowed at ILMUNC India? </a>
                                    <div id="panel3e" class="content">
A: Although outside research is highly encouraged before the conference, pre-written resolutions are not allowed. ILMUNC India has a strict policy against any pre-written documents and plagiarism will be treated as a serious matter.</li>
                                </ul>
                        </div>

                    </div>
                </div>
        </section>

<? getFooter(); ?>
        

    </body>
</html>
