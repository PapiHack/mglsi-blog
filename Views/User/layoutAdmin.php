<?php require_once('../Utilities/helpers.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?= $title ?> </title>

	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="<?= asset('style.css') ?>"/>
	<link rel="stylesheet" type="text/css" href="<?= asset('bootstrap/css/bootstrap.min.css') ?>"/>
	<link rel="stylesheet" type="text/css" href="<?= asset('font-awesome/css/font-awesome.min.css') ?>"/>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <?php require_once('../Views/_partials/header.php'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <?= $content ?>
            </div>
            <div class="col-lg-4">
                <?php require_once('../Views/_partials/menu_admin.php'); ?>
            </div>
        </div>
    </div>

<script src="<?= asset('bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= asset('jquery.js') ?>"></script>
<script src="<?= asset('jquery.datatable.js') ?>"></script>
<script src="<?= asset('datatable.bootstrap.js') ?>"></script>
<script src="<?= asset('sweetalert.js') ?>"></script>
<script src="<?= asset('sweetalert2.js') ?>"></script>
</body>
</html>