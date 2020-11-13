<?php require_once('../Utilities/helpers.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?= $title ?> </title>

	<!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="<?= WEBROOT?>assets/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?= WEBROOT?>assets/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= WEBROOT?>assets/font-awesome/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= WEBROOT?>assets/datatable.bootstrap.css"/>

  <!--Script -->
  <script src="<?= WEBROOT?>assets/jquery.js"></script>
  <script src="<?= WEBROOT?>assets/jquery.datatable.js"></script>
  <script src="<?= WEBROOT?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= WEBROOT?>assets/datatable.bootstrap.js"></script>
</head>
<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <br>
                <?php require_once('_partials/header.php');  ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <?= $content ?>
            </div>
            <div class="col-lg-4">
              <?php
                if($this instanceof BlogController) require_once('_partials/menu.php');
                else require_once('_partials/default_menu.php');
              ?>
            </div>
        </div>
    </div>


    <script src="<?= WEBROOT?>assets/sweetalert.js"></script>
    <script src="<?= WEBROOT?>assets/sweetalert2.js"></script>
</body>
</html>
