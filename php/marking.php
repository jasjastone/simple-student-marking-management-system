<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../config/app_config.php";
include "../php/connection.php";
session_start();
if (isset($_POST['mark'])) {
    $assaignment1 = $_POST['assaignment1'];
    $assaignment2 = $_POST['assaignment2'];
    $suppexam = $_POST['suppexam'];
    $finalexam = $_POST['finalexam'];
    $test2 = $_POST['test2'];
    $test1 = $_POST['test1'];
    $semister = $_POST['semister'];
    $students = $_POST['students'];
    $modules = $_POST['modules'];
    $courses = $_POST['courses'];
    $departments = $_POST['departments'];
    $useremail = $_SESSION['email'];
    if (empty($useremail)) {
        // force the user to login if their not login
        header("Location:../views/auth/login.php?message=Please login");
        die();
    }
    $userid = mysqli_query($connection, "SELECT id FROM users WHERE email='" . $useremail . "' LIMIT 1")->fetch_array()['id'];
    $teacherid = $userid;
    $columns = "";
    if (!empty($assaignment1)) {
        $columns .= ",assaignment1=$assaignment1";
    }
    if (!empty($assaignment2)) {
        $columns .= ",assaignment2=$assaignment2";
    }
    if (!empty($test1)) {
        $columns .= ",test1=$test1";
    }
    if (!empty($test2)) {
        $columns .= ",test2=$test2";
    }
    if (!empty($finalexam)) {
        $columns .= ",final_exam=$finalexam";
    }
    if (!empty($suppexam)) {
        $columns .= ",sup_exam=$suppexam";
    }
    $markexist = "SELECT COUNT(id) AS marks FROM marks WHERE student_id=$students";
    $querresult = mysqli_query($connection, $markexist);
    if ($querresult->fetch_array()['marks'] > 0) {
        try {
            $markexist = "SELECT id FROM marks WHERE student_id=$students AND semister=$semister";
            $querresult = mysqli_query($connection, $markexist);
            $markid = $querresult->fetch_array()['id'];
            $query = "UPDATE marks SET semister=$semister$columns WHERE id=$markid";
            $msg = "";
            $result = mysqli_query($connection, $query);
            if ($result) {
                $msg = "RESULT RECOREDED SUCCESSFULLY";
            }
            else{
                $msg = mysqli_error($connection);
            }
        } catch (\Throwable $th) {
            $msg = "SOMETHING WENT WRONG! FAIL TO RECORD THE RESULT!";
        }
        header("Location:../index.php?route=/pages/marks/upload&name=Upload Marks&msg=$msg");
    }
    if($assaignment1 ==null ||$assaignment1 ==""){
        $assaignment1 = "NULL";
    }
    if($assaignment2 =="NULL" ||$assaignment2 ==""){
        $assaignment2 = "NULL";
    }
    if($test1 =="NULL" ||$test1 ==""){
        $test1 = "NULL";
    }
    if($test2 =="NULL" ||$test2 ==""){
        $test2 = "NULL";
    }
    if($finalexam =="NULL" ||$finalexam ==""){
        $finalexam = "NULL";
    }
    if($suppexam =="NULL" ||$suppexam ==""){
        $suppexam = "NULL";
    }
    $insertquery = "INSERT INTO marks(assaignment1, assaignment2, test1, test2, semister, student_id, teacher_id, module_id, department_id, final_exam, sup_exam) VALUES($assaignment1, $assaignment2, $test1, $test2, $semister, $students, $teacherid, $modules, $departments, $finalexam, $suppexam)";
    $insertexcute = mysqli_query($connection,$insertquery);
    if($insertexcute){
        header("Location:../index.php?route=/pages/marks/upload&name=Upload Marks&msg=RESULT INSERTED SUCCESSFULLY");
    }
    die(mysqli_error($connection));
}
