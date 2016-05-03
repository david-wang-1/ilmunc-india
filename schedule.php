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
                <div class="main large-12 column text-justify">
                    <h2> Conference Schedule </h2>
                    
                    <style type="text/css">
    table.tableizer-table {
    border: 0px solid #CCC; font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    border-collapse: separate;
    border-spacing: 2px;
} 
.tableizer-table td {
    padding: 4px;
    margin: 3px;
    border-radius: 4px;
    width: 23%;
    /*border: 1px solid #ccc;*/
}
.time {
    width: 12% !important;
}
.tableizer-table th {
    background-color: #104E8B; 
    color: #FFF;
    font-weight: bold;
    text-align: center;
}
.food {
    background: #D3F0C2;
    color: #366719;
    border-left: 2px solid #7BD148 !important;

}
.committee {
    color: rgb(0, 3, 231);
    background: rgb(206, 206, 255);
    border-left: 2px solid rgb(154, 156, 255) !important;

}
.events {
    color: rgb(149, 26, 4);
    background: rgb(253, 191, 180);
    border-left: 2px solid rgb(250, 87, 60) !important;

}
.misc {
    color: rgb(125, 28, 150);
    background: rgb(240, 212, 247);
    border-left: 2px solid rgb(205, 116, 230) !important;
}
.curfew {
    color: #000;
    background: #B7B7B7;
    border-left: 2px solid #000 !important;
}
</style><table class="tableizer-table">
<tr class="tableizer-firstrow"><th></th><th>Day 1</th><th>Day 2 </th><th>Day 3</th><th>Day 4 </th></tr>
 <tr><td class="time">8:00 to 8:30 </td><td>&nbsp;</td><td rowspan="2" class="food">Breakfast (Round Table with Caroline Linger of Ivy Central)</td><td rowspan="2" class="food">Breakfast (Round Table with Caroline Linger of Ivy Central)</td><td rowspan="2" class="food">Breakfast (Round Table with Caroline Linger of Ivy Central)</td></tr>
 <tr><td class="time">8:30 to 9:00</td><td>&nbsp;</td></tr>
 <tr><td class="time">9:00 to 9:30</td><td>&nbsp;</td><td class="events">Speaker Session </td><td rowspan="4" class="committee">Committee Session 5 </td><td rowspan="4" class="committee">Committee Session 8</td></tr>
 <tr><td class="time">9:30 to 10:00</td><td rowspan="5" class="misc">On site Registrations </td><td rowspan="3" class="committee">Committee session 2 </td></tr>
 <tr><td class="time">10:00 to 10:30</td></tr>
 <tr><td class="time">10:30 to 11:00</td></tr>
 <tr><td class="time"> 11:00 to 11:30</td><td class="food">Tea Break </td><td class="food">Tea Break </td><td rowspan="2" class="food">Tea Break & Check Out </td></tr>
 <tr><td class="time">11:30 to 12:00 </td><td rowspan="4" class="committee">Committee Session 3 </td><td rowspan="4" class="committee">Committee Session 6 </td></tr>
 <tr><td class="time">12:00 to 12:30 </td><td rowspan="2" class="events">University Panel </td><td rowspan="3" class="events">Closing Ceremony </td></tr>
 <tr><td class="time">12:30 to 13:00</td></tr>
 <tr><td class="time">13:00 to 13:30 </td><td rowspan="2" class="food">Lunch (Not Included in the Conference fee) </td></tr>
 <tr><td class="time">13:30 to 14:00</td><td rowspan="2" class="food">Lunch </td><td rowspan="2" class="food">Lunch</td><td rowspan="2" class="food">Lunch </td></tr>
 <tr><td class="time">14:00 to 14:30 </td><td rowspan="2" class="misc">Check In </td></tr>
 <tr><td class="time">14:30 to 15:00 </td><td rowspan="4" class="committee">Committee Session 4 </td><td rowspan="2" class="events">College Fair </td><td>&nbsp;</td></tr>
 <tr><td class="time">15:00 to 15:30 </td><td rowspan="2" class="events">Opening Ceremony</td><td>&nbsp;</td></tr>
 <tr><td class="time">15:30 to 16:00 </td><td rowspan="4" class="committee">Commitee Session 7</td><td>&nbsp;</td></tr>
 <tr><td class="time">16:00 to 16:30</td><td class="misc">GA and Crisis Training </td><td></td></tr>
 <tr><td class="time">16:30 to 17:00</td><td class="food">Tea Break </td><td class="food">Tea Break </td><td>&nbsp;</td></tr>
 <tr><td class="time">17:00 to 17:30 </td><td rowspan="5" class="committee">Committee Session 1 </td><td rowspan="2" class="events">Career Workshop with Caroline Linger </td><td>&nbsp;</td></tr>
 <tr><td class="time">17:30 to 18:00 </td><td class="food">Tea Break </td><td>&nbsp;</td></tr>
 <tr><td class="time">18:00 to 18:30 </td><td rowspan="2" class="events">Speaker Sessions</td><td rowspan="2" class="events">Speaker Session </td><td>&nbsp;</td></tr>
 <tr><td class="time">18:30 to 19:00 </td><td>&nbsp;</td></tr>
 <tr><td class="time">19:00 to 19:30 </td><td>Free time </td><td>Free time</td><td>&nbsp;</td></tr>
 <tr><td class="time">19:30 to 20:00 </td><td>Free time </td><td rowspan="2" class="food">Dinner </td><td rowspan="2" class="food">Dinner</td><td>&nbsp;</td></tr>
 <tr><td class="time">20:00 to 20:30 </td><td rowspan="2" class="food">Dinner </td><td>&nbsp;</td></tr>
 <tr><td class="time">20:30 to 21:00 </td><td rowspan="4" class="events">Socials </td><td rowspan="5" class="events">Socials </td><td>&nbsp;</td></tr>
 <tr><td class="time">21:00 to 21:30</td><td rowspan="4" class="events">Socials </td><td>&nbsp;</td></tr>
 <tr><td class="time">21:30 to 22:00 </td><td>&nbsp;</td></tr>
 <tr><td class="time">22:00 to 22:30 </td><td>&nbsp;</td></tr>
 <tr><td class="time">22:30 to 23:00 </td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td class="time">23:00 to 23:30 </td><td class="curfew">Curfew</td><td class="curfew">Curfew </td><td class="curfew">Curfew</td><td>&nbsp;</td></tr>
</table>

                    
                </div>
                               
        </section>


<? getFooter(); ?>

    </body>
</html>
