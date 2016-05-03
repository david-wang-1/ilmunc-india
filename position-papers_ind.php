<?php 
include_once("function.php");
include_once("config.php");
include_once("function-auth.php");
if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
  header("Location: login.php");
}
getHeader("ILMUNC India | Position Papers "); 
?>

<style>
.hidden {
  display: none;
}
table {
  width: 100%;
  margin: 0;
}
h3 {
  margin-top: 50px;
}
h4 {
  margin-top: 30px;
}
.text-right {
  text-align: right;
}
#notes {
  list-style: none;
  margin-left: 0;
  padding-left: 0.75em;
}
.country-select {
  display: none;
}
.button-td {
  text-align: right;
}
.button-td a {
  margin: 0;
}
form input:first-child, form select:first-child {
  margin: 0 !important;
}
table td form input, table td form select {
  margin: 10px 0 !important;
}
#total {
  font-weight: bold;
}
</style>
<!-- MODERNIZR -->
<script src="libs/js/modernizr.js"></script>
<script src="libs/js/jquery.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function() { 
  if(navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") == -1){
    alert("Core functionality of the ILMUNC India site is incompatible with Safari. Please use Google Chrome, Firefox or Internet Explorer (v.10 or above)");
    window.location = "../index.php"
  }
});
</script>
</head>
<body>
  <? getDashboardNav("position-papers_ind"); ?>

  <section class="content">
    <div class="row">
      <div class="large-8 large-centered column">

        <h2> Submit Position Papers </h2>
        <p> Please click on the committee for which you would like to submit a position paper.</p>
        <ul class="small-block-grid-2 large-block-grid-3">
          <li>
            <a target="_blank" target="_blank" href="https://www.dropbox.com/request/BBNYQ7B7DX6dAFeFva7S?oref=e">
              <img class="portrait" src="./assets/disec-pp.JPG" />
            </a>
            <a target="_blank" href="https://www.dropbox.com/request/BBNYQ7B7DX6dAFeFva7S?oref=e"><h4 style="margin-bottom: 0px; text-align: center;"> DISEC </h4></a>
          </li>
          <li>
            <a target="_blank" href="https://www.dropbox.com/request/vQGVfRcyeNNhGi8i3pDM?oref=e">
              <img class="portrait" src="./assets/specpol-pp.JPG" />
            </a>
            <a target="_blank" href="https://www.dropbox.com/request/vQGVfRcyeNNhGi8i3pDM?oref=e"><h4 style="margin-bottom: 0px; text-align: center;"> SPECPOL </h4></a>
          </li>
          <li>
            <a target="_blank" href="https://www.dropbox.com/request/Lp6kklPM8SWQTYpWayN8?oref=e">
              <img class="portrait" src="./assets/legal-pp.JPG" />
            </a>
            <a target="_blank" href="https://www.dropbox.com/request/Lp6kklPM8SWQTYpWayN8?oref=e"><h4 style="margin-bottom: 0px; text-align: center;"> Legal </h4></a>
          </li>
        </ul>
        <ul class="small-block-grid-2 large-block-grid-3">
          <li>
            <a target="_blank" href="https://www.dropbox.com/request/vELzVvbQY2xFLgGxG1km?oref=e">
              <img class="portrait" src="./assets/unodc-pp.JPG" />
            </a>
            <a target="_blank" href="https://www.dropbox.com/request/vELzVvbQY2xFLgGxG1km?oref=e"><h4 style="margin-bottom: 0px; text-align: center;"> UNODC </h4></a>
          </li>
          <li>
            <a target="_blank" href="https://www.dropbox.com/request/BxOGmJqkJj0VqDjNAEwA?oref=e">
              <img class="portrait" src="./assets/unhrc-pp.JPG" />
            </a>
            <a target="_blank" href="https://www.dropbox.com/request/BxOGmJqkJj0VqDjNAEwA?oref=e"><h4 style="margin-bottom: 0px; text-align: center;"> UNHRC </h4></a>
          </li>
          <li>
            <a target="_blank" href="https://www.dropbox.com/request/muZw6zFzbVnPp5uLb0Bi?oref=e">
              <img class="portrait" src="./assets/security-pp.JPG" />
            </a>
            <a target="_blank" href="https://www.dropbox.com/request/muZw6zFzbVnPp5uLb0Bi?oref=e"><h4 style="margin-bottom: 0px; text-align: center;"> Security Council </h4></a>
          </li>
        </ul>
      </div>
       <br />
                <p>If you have any questions please contact the secretariat at <a href = "mailto:info@ilmunc-india.com">info@ilmunc-india.com</a>.</p>

    </div>
               
          </section>
          <?php getFooter() ?>
        </body>
        </html>