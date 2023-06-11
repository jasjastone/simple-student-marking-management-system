<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
require "./php/connection.php";
require "./php/globalfunction.php";
require "./php/globalconstants.php";
require "./modules/Validation/Validator.php";
$user = $connection->query("SELECT * FROM users WHERE email='" . $_SESSION['email'] . "'")->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/css/index.css">
    <link rel="stylesheet" href="./resources/css/libraries/select2.css">
    <link rel="stylesheet" href="./resources/css/dashboard.css">
    <link rel="stylesheet" href="./resources/css/spinner.css">
    <link rel="stylesheet" href="./resources/css/register.css">
    <script src="./resources/js/libraries/jquery.min.js"></script>
    <script src="./resources/js/libraries/feather.min.js"></script>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <title><?php  echo APPNAME; ?> </title>
</head>
<!-- <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div> -->

<header class="navbar navbar-dark sticky-top primary-bg flex-md-nowrap p-0 shadow">

    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="index.php?route=/home"><img src="./files/systemimages/atc.svg" width="35" height="35" alt="atc logo"> <?php echo APPSHORTNAME; ?></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search"> -->
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="./auth/logout.php">Sign out</a>
        </div>
    </div>
</header>

<body>