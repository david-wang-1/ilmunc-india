<?php
    include_once("function.php");
    getHeader('ILMUNC India | Research');
?>
        <style>
            .header-image {
                background-image: url("assets/headers/registration.png");
                background-position-y: 0;
            }
            dt {
                float: left;
                clear: left;
            }
            dd {
                float: left;
                clear: left;
                padding-bottom: 5px;
            }
            .clear {
                clear: both;
            }
            a:hover {
                color: #01256E;
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
                    <h2> Research Links </h2>
                    <div class="tabs-content">
                        <div class="content active" id="panel1">
                            <ul class="accordion" data-accordion>
                                <li class="accordion-navigation">
                                    <a href="#panel1a">General Sources of Information</a>
                                    <div id="panel1a" class="content">
                                        <a target="_blank" href="http://www.un.org/">United Nations</a><br> </br>
                                        <a target="_blank" href="http://www.unausa.org/">UNA-USA</a><br> </br>
                                        <a target="_blank" href="http://www.un.org/cyberschoolbus">UN Cyber School Bus</a><br> </br>
                                        <a target="_blank" href="https://www.cia.gov/cia/publications/factbook">CIA World Factbook</a><br> </br>
                                        <a target="_blank" href="http://www.state.gov/">United States Department of State</a><br> </br>
                                        <a target="_blank" href="http://www.gatesfoundation.org/">Bill and Melinda gates Foundation</a><br> </br>
                                        <a target="_blank" href="http://www.fordfound.org/">Ford Foundation</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1b">News Sources</a>
                                    <div id="panel1b" class="content">
                                        <a target="_blank" href="http://www.nytimes.com/">New York Times</a><br> </br>
                                        <a target="_blank" href="http://www.timesonline.co.uk/">Times</a><br> </br>
                                        <a target="_blank" href="http://www.wsj.com/">Wall Street Journal</a><br> </br>
                                        <a target="_blank" href="http://www.ft.com/">Financial Times</a><br> </br>
                                        <a target="_blank" href="http://www.economist.com/">Economist</a><br> </br>
                                        <a target="_blank" href="http://www.washingtonpost.com/">Washington Post</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1c">Specific UN Sources</a>
                                    <div id="panel1c" class="content">
                                        <a target="_blank" href="http://www.un.org/">United Nations</a><br> </br>
                                        <a target="_blank" href="http://www.un.org/issues">Issues on the UN Agenda</a><br> </br>
                                        <a target="_blank" href="http://www.un.org/ga">General Assembly</a><br> </br>
                                        <a target="_blank" href="http://www.un.org/docs/ecosoc">Economic and Social Council</a><br> </br>
                                        <a target="_blank" href="http://www.undp.org/">United Nations Development Program</a><br> </br>
                                        <a target="_blank" href="http://www.unhchr.ch/html/menu2/2/chr.htm">United Nations Human Rights Council</a><br> </br>
                                        <a target="_blank" href="http://www.unctad.org/Templates/StartPage.asp?intItemID=2529">United Nations Commission on Science and Technology</a><br> </br>
                                        <a target="_blank" href="http://www.unicef.org/">United Nations Children's Fund</a><br> </br>
                                        <a target="_blank" href="http://www.who.int/en/">World Health Organization</a><br> </br>
                                        <a target="_blank" href="http://www.icj-cij.org/">International Court of Justice</a><br> </br>
                                        <a target="_blank" href="http://www.9-11commission.gov/">9/11 Commission</a><br> </br>
                                        <a target="_blank" href="http://unfccc.int/">United Nations Framework Convention on Climate Change</a><br> </br>
                                        <a target="_blank" href="http://www.oas.org/">Organization of American States</a><br> </br>
                                        <a target="_blank" href="http://www.un.org/docs/sc/">Security Council of the United Nations</a><br> </br>
                                        <a target="_blank" href="http://unstats.un.org/unsd/default.htm">UN Statistics Division</a><br> </br>
                                        <a target="_blank" href="http://www.unausa.org/">UNA-USA</a><br> </br>
                                        <a target="_blank" href="http://www.un.org/cyberschoolbus">United Nations Cyber School Bus</a><br> </br>
                                        <a target="_blank" href="http://www.unaids.org/en/">Joint United Nations Programme on HIV/AIDS</a><br> </br>
                                        <a target="_blank" href="http://www.iaea.org/">International Atomic Energy Agency</a><br> </br>
                                        <a target="_blank" href="http://www.ilo.org/global/lang--en/index.htm">International Labour Organization</a><br> </br>                      </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1d">International Agencies</a>
                                    <div id="panel1d" class="content">
                                        <a target="_blank" href="http://www.greenpeace.org/">Greenpeace</a><br> </br>
                                        <a target="_blank" href="http://www.amnesty.org/">Amnesty International</a><br> </br>
                                        <a target="_blank" href="www.gatesfoundation.org">Bill and Melinda Gates Foundation</a><br> </br>
                                        <a target="_blank" href="http://www.hrw.org/">Human Rights Watch</a><br> </br>
                                        <a target="_blank" href="http://www.csis.org/">Center for Strategic and International Studies</a><br> </br>
                                        <a target="_blank" href="http://www.fordfound.org/">Ford Foundation</a><br> </br>
                                        <a target="_blank" href="http://www.transparency.org/">Transparency International</a><br> </br>
                                        <a target="_blank" href="http://www.data.org/">Debt AIDS Trade Africa (DATA)</a><br> </br>
                                        <a target="_blank" href="http://www.brookings.org/">Brookings Institution</a><br> </br>
                                        <a target="_blank" href="http://www.foreignaffairs.org/">Foreign Affairs</a><br> </br>
                                        <a target="_blank" href="http://www.cfr.org/">Council on Foreign Relations</a><br> </br>
                                        <a target="_blank" href="http://www.foreignpolicy.com/">Foreign Policy</a><br> </br>
                                        <a target="_blank" href="http://www.globalpolicy.org/">Global Policy Forum</a><br> </br>
                                        <a target="_blank" href="http://www.isn.ethz.ch/">International Relations and Security Network</a><br> </br>
                                        <a target="_blank" href="http://www.ccd21.org/">Council for a Community of Democracies</a><br> </br>
                                        <a target="_blank" href="http://www.9-11commission.gov/">9/11 Commission</a><br> </br>
                                        <a target="_blank" href="http://www.hrw.org/">Human Rights Watch</a><br> </br>
                                        <a target="_blank" href="http://www.icrc.org/">International Committee of the Red Cross</a><br> </br>
                                        <a target="_blank" href="http://www.doctorswithoutborders.org/">Doctors Without Borders</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1e">Country-Specific Information</a>
                                    <div id="panel1e" class="content">
                                        <a target="_blank" href="http://europa.eu/">European Union</a><br> </br>
                                        <a target="_blank" href="http://lcweb2.loc.gov/frd/cs/profiles.html">Library of Congress Country Profiles</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1f">Children</a>
                                    <div id="panel1f" class="content">
                                        <a target="_blank" href="http://www.crin.org">Child Rights Information Network</a><br> </br>
                                        <a target="_blank" href="http://child-abuse.com/childhouse/childwatch/cwi/RI-DB/info.html">Database on Research and Information on Children’s Rights</a><br> </br>
                                        <a target="_blank" href="http://www.savethechildren.org/">Childwatch International Research Network</a><br> </br>
                                        <a target="_blank" href="http://www.savethechildren.org/">Save the Children</a><br> </br>
                                        <a target="_blank" href="http://www.unicef.org">UNICEF</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1g">Disarmament and Security</a>
                                    <div id="panel1g" class="content">
                                        <a target="_blank" href="http://www.fas.org/">Federation of American Scientists</a><br> </br>
                                        <a target="_blank" href="http://www.ceip.org/">Carnegie Endowment for International Peace</a><br> </br>
                                        <a target="_blank" href="http://www.icg.org/">International Crisis Group</a><br> </br>
                                        <a target="_blank" href="http://disarmament.un.org/">United Nations Department for Disarmament Affairs</a><br> </br>
                                        <a target="_blank" href="http://www.unidir.org/">United Nations Institute for Disarmament Research</a><br> </br>
                                        <a target="_blank" href="http://www.ncix.gov/">US National Counterintelligence Executive</a><br> </br>
                                        <a target="_blank" href="http://www.nsa.gov/">US National Security Agency</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1h">Environment</a>
                                    <div id="panel1h" class="content">
                                        <a target="_blank" href="http://www.ecolex.org/">Ecolex—Environmental Law Information</a><br> </br>
                                        <a target="_blank" href="http://www.igc.org/home/econet/index.html">EcoNet</a><br> </br>
                                        <a target="_blank" href="http://www.eel.nl">European Environmental Law Page</a><br> </br>
                                        <a target="_blank" href="http://www.environmenthouse.ch/">Geneva Environment Network</a><br> </br>
                                        <a target="_blank" href="http://www.greenpeace.org/">Greenpeace</a><br> </br>
                                        <a target="_blank" href="http://earthwatch.unep.net/">United Nations System—Wide Earth Watch</a><br> </br>
                                        <a target="_blank" href="http://www.wri.org/">World Resources Institute</a><br> </br>
                                        <a target="_blank" href="http://unfccc.int/">United Nations Framework Convention on Climate Change</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1i">Economics and Development</a>
                                    <div id="panel1i" class="content">
                                        <a target="_blank" href="http://www.un.org/docs/ecosoc/">Economic and Social Council</a><br> </br>
                                        <a target="_blank" href="http://www.undp.org/">United Nations Development Programme</a><br> </br>
                                        <a target="_blank" href="http://hdr.undp.org/statistics/data">United Nations Development Programme—Human Development Report</a><br> </br>
                                        <a target="_blank" href="http://www.unctad.org/Templates/StartPage.asp?intItemID=2529">United Nations Conference on Trade and Development (UNCTAD)</a><br> </br>
                                        <a target="_blank" href="http://www.imf.org/external/index.htm">International Monetary Fund</a><br> </br>
                                        <a target="_blank" href="http://www.wto.org/">World Trade Organization</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1j">Human Rights</a>
                                    <div id="panel1j" class="content">
                                       <a target="_blank" href="http://www.unhchr.ch/html/menu2/2/chr.htm">United Nations Human Rights Council</a><br> </br>
                                        <a target="_blank" href="http://www.amnesty.org/">Amnesty International</a><br> </br>
                                        <a target="_blank" href="http://www.bayefsky.com/">Bayefsky List of UN Human Rights Treaties</a><br> </br>
                                        <a target="_blank" href="http://www.yale.edu/lawweb/avalon/diana/index.html">Project DIANA at Yale - Human Rights Documents</a><br> </br>
                                        <a target="_blank" href="http://www.columbia.edu/cu/humanrights">Center for the Study of Human Rights</a><br> </br>
                                        <a target="_blank" href="http://www.humanrightsfirst.org/">Human Rights First</a><br> </br>
                                        <a target="_blank" href="http://www.hri.ca/">Human Rights Internet</a><br> </br>
                                        <a target="_blank" href="http://www.hrw.org/">Human Rights Watch</a><br> </br>
                                        <a target="_blank" href="http://www.law.depaul.edu/institutes_centers/ihrli/index.asp">International Human Rights Law Institute</a><br> </br>
                                        <a target="_blank" href="http://www.ilhr.org/">International League for Human Rights</a><br> </br>
                                        <a target="_blank" href="http://www.un.org/Overview/rights.html">Universal Declaration of Human Rights</a><br> </br>
                                        <a target="_blank" href="http://www.udhr.org/">50th Anniversary of the Universal Declaration of Human Rights</a><br> </br>
                                        <a target="_blank" href="http://www.umn.edu/humanrts">University of Minnesota Human Rights Library</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1k">International Law</a>
                                    <div id="panel1k" class="content">
                                        <a target="_blank" href="http://www.un.org/law">United Nations Homepage—International Law</a><br> </br>
                                        <a target="_blank" href="http://cils.net/">Center for International Legal Studies</a><br> </br>
                                        <a target="_blank" href="http://www.glin.gov/">ULibrary of Congress—Global Legal Information Network</a><br> </br>
                                        <a target="_blank" href="hthttp://www.ila-hq.org/">International Law Association</a><br> </br>
                                        <a target="_blank" href="http://www.uncitral.org/en-index.htm/">International Trade Lawe</a><br> </br>
                                        <a target="_blank" href="http://www.un.org/Depts/los/index.htm">Law of the Sea</a><br> </br>
                                        <a target="_blank" href="http://untreaty.un.org/">United Nations Treaty Collection</a><br> </br>
                                        <a target="_blank" href="http://www.icj-cij.org/">International Court of Justice</a><br> </br>
                                        <a target="_blank" href="http://www.icc-cpi.int/home.html&l=en">International Criminal Court</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1l">Landmines</a>
                                    <div id="panel1l" class="content">
                                        <a target="_blank" href="http://www.landmines.org/">Adopt-A-Minefield</a><br> </br>
                                        <a target="_blank" href="http://www.minereaction.org/">United Nations Mine Action Service</a><br> </br>
                                        <a target="_blank" href="http://www.icbl.org/">International Campaign to Ban Landmines</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1m">Women</a>
                                    <div id="panel1m" class="content">
                                        <a target="_blank" href="http://www.un.org/womenwatch">Women Watch</a><br> </br>
                                        <a target="_blank" href="http://www.un.org/womenwatch/daw">UN Division for the Advancement of Women</a><br> </br>
                                        <a target="_blank" href="http://www.un-instraw.org/">UN International Training Institute for the Advancement of Women</a><br> </br>
                                        <a target="_blank" href="http://www.americansforunfpa.org/getinvolved/">Americans for UNFPA - One Woman Can</a><br> </br>
                                    </div>
                                </li>
                                <li class="accordion-navigation">
                                    <a href="#panel1n">Friends of... Organizations</a>
                                    <div id="panel1n" class="content">
                                        <a target="_blank" href="http://www.americansforunfpa.org/">Americans for UNFPA</a><br> </br>
                                        <a target="_blank" href="http://www.friendsofwfp.org/">Friends of WFP</a><br> </br>
                                        <a target="_blank" href="http://www.unrefugees.org/">USA for UNHCR</a><br> </br>
                                        <a target="_blank" href="http://www.undp-usa.org/">US Committee for UNDP</a><br> </br>
                                        <a target="_blank" href="http://www.unifemusa.org/">US Committee for UNIFEM</a><br> </br>
                                        <a target="_blank" href="http://www.unicefusa.org/">US Fund for UNICEF</a><br> </br>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
               
                    <? getAnnouncement(); ?>
                
        </section>


<? getFooter(); ?>

    </body>
</html>
