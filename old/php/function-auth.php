<?php
function getDashStyle(){
    ?>

        <style>
            .hidden {
                display: none;
            }
            form {
                display: none;
            }
            .country-preference form {
                display: initial;
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
            .edit {
                text-align: right;
            }
            .edit a {
                font-size: 12px;
                font-weight: regular;
            }
            a.edit {
                background-color: #022F88;
            }
            table#country-selection tr td:first-child {
                width: 50%;
            }
            .country-preference {
                cursor: pointer;
            }
            #total {
                font-weight: bold;
            }
        </style>


    <?
}

function getDashboardNav($active) {
	if($active == "dashboard"){
	?>

	     <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li class="active"><a href="dashboard.php"> DASHBOARD </a></li>
                    <li><a href="dash_countries.php"> COUNTRIES </a></li>
                    <li><a href="delegation.php"> DELEGATION </a></li>
                    <li><a href="position-papers.php"> POSITION PAPERS </a></li>
                    <li><a href="applications.php"> APPLICATIONS </a></li>
                    <li><a href="billing.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>



	<?
	} else if($active == "delegation") {
		?>

	     <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard.php"> DASHBOARD </a></li>
                    <li><a href="dash_countries.php"> COUNTRIES </a></li>
                    <li class="active"><a href="delegation.php"> DELEGATION </a></li>
                    <li><a href="position-papers.php"> POSITION PAPERS </a></li>
                    <li><a href="applications.php"> APPLICATIONS </a></li>
                    <li><a href="billing.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>

        <?
    } else if($active == "position-papers") {
        ?>

         <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard.php"> DASHBOARD </a></li>
                    <li><a href="dash_countries.php"> COUNTRIES </a></li>
                    <li><a href="delegation.php"> DELEGATION </a></li>
                    <li class="active"><a href="position-papers.php"> POSITION PAPERS </a></li>
                    <li><a href="applications.php"> APPLICATIONS </a></li>
                    <li><a href="billing.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>



	<?
	} else if($active == "applications") {
		?>

	     <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard.php"> DASHBOARD </a></li>
                    <li><a href="dash_countries.php"> COUNTRIES </a></li>
                    <li><a href="delegation.php"> DELEGATION </a></li>
                    <li><a href="position-papers.php"> POSITION PAPERS </a></li>
                    <li class="active"><a href="applications.php"> APPLICATIONS </a></li>
                    <li><a href="billing.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>



	<?
	}else if($active == "billing"){
				?>

	     <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard.php"> DASHBOARD </a></li>
                    <li><a href="dash_countries.php"> COUNTRIES </a></li>
                    <li><a href="delegation.php"> DELEGATION </a></li>
                    <li><a href="position-papers.php"> POSITION PAPERS </a></li>
                    <li><a href="applications.php"> APPLICATIONS </a></li>
                    <li class="active"><a href="billing.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>



	<?
	} else if($active == "dashboard_ind"){
                ?>

         <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li class="active"><a href="dashboard_ind.php"> DASHBOARD </a></li>
                    <li><a href="dash_committees.php"> COMMITTEES </a></li>
                    <li><a href="position-papers_ind.php"> POSITION PAPERS </a></li>
                    <li><a href="applications_ind.php"> APPLICATIONS </a></li>
                    <li><a href="billing_ind.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>



    <?
    } else if($active == "billing_ind"){
                ?>

         <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard_ind.php"> DASHBOARD </a></li>
                    <li><a href="dash_committees.php"> COMMITTEES </a></li>
                    <li><a href="position-papers_ind.php"> POSITION PAPERS </a></li>
                    <li><a href="applications_ind.php"> APPLICATIONS </a></li>
                    <li class="active"><a href="billing_ind.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>



    <?
    } else if($active == "applications_ind"){
                ?>

         <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard_ind.php"> DASHBOARD </a></li>
                    <li><a href="dash_committees.php"> COMMITTEES </a></li>
                    <li><a href="position-papers_ind.php"> POSITION PAPERS </a></li>
                    <li class="active"><a href="applications_ind.php"> APPLICATIONS </a></li>
                    <li><a href="billing_ind.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>

        <?
    } else if($active == "position-papers_ind"){
                ?>

         <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard_ind.php"> DASHBOARD </a></li>
                    <li><a href="dash_committees.php"> COMMITTEES </a></li>
                    <li class="active"><a href="position-papers_ind.php"> POSITION PAPERS </a></li>
                    <li><a href="applications_ind.php"> APPLICATIONS </a></li>
                    <li><a href="billing_ind.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>



    <?
    } else if($active == "committees"){
                ?>

         <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard_ind.php"> DASHBOARD </a></li>
                    <li class="active"><a href="dash_committees.php"> COMMITTEES </a></li>
                    <li><a href="position-papers_ind.php"> POSITION PAPERS </a></li>
                    <li><a href="applications_ind.php"> APPLICATIONS </a></li>
                    <li><a href="billing_ind.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>

    <?
    } else if($active == "countries"){
                ?>

         <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard.php"> DASHBOARD </a></li>
                    <li class="active"><a href="dash_countries.php"> COUNTRIES </a></li>
                    <li><a href="delegation.php"> DELEGATION </a></li>
                    <li><a href="position-papers.php"> POSITION PAPERS </a></li>
                    <li><a href="applications.php"> APPLICATIONS </a></li>
                    <li><a href="billing.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>

    <?
    } else {
		?>

	     <div class="contain-to-grid fixed nav-bar">
            <nav class="top-bar" data-topbar data-options="sticky_on: large">
                <section class="top-bar-section">
                <ul class="flex-container admin">
                    <li><a href="dashboard.php"> DASHBOARD </a></li>
                    <li><a href="dash_countries.php"> COUNTRIES </a></li>
                    <li><a href="delegation.php"> DELEGATION </a></li>
                    <li><a href="position-papers.php"> POSITION PAPERS </a></li>
                    <li><a href="applications.php"> APPLICATIONS </a></li>
                    <li><a href="billing.php"> BILLING </a></li>
                    <li><a href="logout.php"> LOGOUT </a></li>
                </ul>
            </section>
            </nav>
        </div>



	<?
	}
}