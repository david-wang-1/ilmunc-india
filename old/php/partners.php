<?php 
include_once('function.php');
getHeader("ILMUNC India | Partners");
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
h3 {
	margin-top: 50px; 
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
				<h2> Our Partners </h2>

				<div class="tier1" style="width: 200px; margin: 0 auto;">
					<a href="#"><img src="assets/ivycentral.png"></a>
				</div>
				<h3>NGO Fair Partners</h3>
				<div class="tier2">
					<a href="#"><img src="assets/ivycentral.png"></a>
					<a href="#"><img src="assets/ivycentral.png"></a>
					<a href="#"><img src="assets/ivycentral.png"></a>
					<a href="#"><img src="assets/ivycentral.png"></a>
				</div>
				<h3>College Fair Partners </h3>
				<div class="tier3">
					<a href="#"><img src="assets/mun-cafe.png"></a>
					<a href="#"><img src="assets/mun-cafe.png"></a>
					<a href="#"><img src="assets/mun-cafe.png"></a>
					<a href="#"><img src="assets/mun-cafe.png"></a>
				</div>

			</div>

			<? getAnnouncement(); ?>

		</section>


		<? getFooter(); ?>

	</body>
	</html>
