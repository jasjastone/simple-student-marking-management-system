<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require "../config/app_config.php";
require "../php/connection.php";
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
        header("Location:../views/auth/login.php?message=Please fill all the field");
        exit();
    }
    $select = "SELECT * FROM users WHERE email='$email'";
    $exe = mysqli_query($connection, $select);

    if (mysqli_num_rows($exe)) {
        $row = mysqli_fetch_array($exe);
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            $select = "SELECT * FROM roles WHERE id=" . $row['role_id'];
            $exe = mysqli_query($connection, $select);
            $rowRoles = mysqli_fetch_array($exe);
            $_SESSION['role'] = $rowRoles['role'];
            if ($rowRoles['role'] == "rector") {
                $_SESSION['role_name'] = "Rector";
                header("Location:../index.php?route=/home&name=Dashboard");
                exit();
            } else if ($rowRoles['role'] == "deputy-rector") {
                $_SESSION['role_name'] = "deputy rector";
                header("Location:../index.php?route=/home&name=Dashboard");
                exit();
            } else if ($rowRoles['role'] == "admission-officer") {
                $_SESSION['role_name'] = "admission-officer";
                header("Location:../index.php?route=/home&name=Dashboard");
                exit();
            } else if ($rowRoles['role'] == "hod") {
                $_SESSION['role_name'] = "Head of department";
                header("Location:../index.php?route=/home&name=Dashboard");
                exit();
            } else if ($rowRoles['role'] == "accountant") {
                $_SESSION['role_name'] = "accountant";
                header("Location:../index.php?route=/home&name=Dashboard");
                exit();
            } else {
                $_SESSION['role_name'] = "student";
                header("Location:../index.php?route=/home&name=Dashboard");
                exit();
            }
        } else {
            header("Location: ../views/auth/login.php?&message=Wrong!! Email or Password");
            exit();
        }
    } else {
        header("Location: ../views/auth/login.php?message=Wrong Email or Password");
        exit();
    }
} else {
    header("Location: ../index.php?route=/home&name=Dashboard");
    exit();
}
