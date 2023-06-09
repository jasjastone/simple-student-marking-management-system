<?php

session_start();
session_unset();
session_destroy();
header("Location:../views/auth/login.php?message=Thank you for using the system");
die();