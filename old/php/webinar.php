<?php 
include_once('function.php');
getHeader("ILMUNC India | Webinar");
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
				<h2> ILMUNC India Webinar </h2>
				<div class="row">   
				<div class="main large-12 column text-justify">                 
					<iframe width="80%" height="600px" src="http://www.ustream.tv/embed/21478414?html5ui" allowfullscreen webkitallowfullscreen scrolling="no" frameborder="0" style="border: 0 none transparent; float:left"></iframe>                    
					<iframe id="BlyveEvent" frameborder="0" style="position: absolute; top: 0; height: 100%; float:left" src="http://blyve.com/embed/88c33c5629e3da2d06000000"></iframe>
				</div>
				</div>
			</div>


		</section>


		<? getFooter(); ?>

	</body>
	</html>

