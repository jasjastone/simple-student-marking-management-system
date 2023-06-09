<?php
require "../../config/app_config.php";
session_start();
if (isset($_SESSION['email'])) {
    header("Location:../../index.php?route=/home");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../resources/css/signin.css">
    <link rel="stylesheet" href="../../resources/css/index.css">
    <link rel="stylesheet" href="../../resources/css/register.css">
    <link rel="stylesheet" href="../../resources/css/spinner.css">
    <title>Postpondment System</title>
    <style>
        .form-floating {
            margin-bottom: 10px;
        }

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
</head>

<body class="text-center primary-bg">
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <main class="w-100 m-auto">
        <div class="layer-1-register-form">
            <div class="layer-2-register-form">
                <form action="../../auth/login.php" method="post">
                    <img class="mb-4" src="../../files/systemimages/atc.svg" alt="" width="72" height="57">
                    <h3 class="h3 mb-3 fw-normal info-color">ATC Postpondment Management System</h3>
                    <h3 class="h3 mb-3 fw-normal">Please sign in</h3>
                    <?php if (isset($_GET['message'])) : ?>
                        <div class="alert-info p-3 rounded-pill">
                            <?php echo $_GET['message']; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" name="login" type="submit">Sign in</button>
                    <p class="p-3 text-center"><label>Not registered</label> <a href="./register.php">Register here</a></p>
                </form>
            </div>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </main>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="../js/index.js"></script>
</html>