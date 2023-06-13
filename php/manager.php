<!-- handle all of the manager forms in file view/pages/manager.php -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "../config/app_config.php";
require "./connection.php";
if (isset($_GET['adddepartment'])) {
    $departmentname = $_GET['departmentname'];
    $querinsert = "INSERT INTO departments(`name`) VALUES ('$departmentname')";
    $exinsert = mysqli_query($connection, $querinsert);
    if ($exinsert) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Department Added Successfully");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Fail To add department");
    exit();
}
if (isset($_GET['addmodule'])) {
    $courseid = $_GET['course'];
    $modulename = $_GET['modulename'];
    $modulecode = $_GET['modulecode'];
    $credit = $_GET['credit'];
    $insertquery = "INSERT INTO modules (modulename,modulecode,credit,course_id) VALUES('$modulename','$modulecode',$credit,$courseid)";
    $exinsert = mysqli_query($connection,$insertquery);
    if($exinsert){
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Module Added Successful");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=FAIL TO ADD MODULE");
    exit();
}
if (isset($_GET['editmodule'])) {
    $courseid = $_GET['course'];
    $modulename = $_GET['modulename'];
    $modulecode = $_GET['modulecode'];
    $credit = $_GET['credit'];
    $insertquery = "INSERT INTO modules (modulename,modulecode,credit,course_id) VALUES('$modulename','$modulecode',$credit,$courseid)";
    $exinsert = mysqli_query($connection,$insertquery);
    if($exinsert){
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Module Added Successful");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=FAIL TO ADD MODULE");
    exit();
}
if (isset($_GET['deletemodule'])) {
    $moduleid = $_GET['moduleid'];
    $insertquery = "DELETE FROM modules WHERE id=$moduleid";
    $exinsert = mysqli_query($connection,$insertquery);
    if($exinsert){
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Module Delete Successful");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=FAIL TO DELETE MODULE");
    exit();
}
if (isset($_GET['addcourse'])) {
    $departmentid = $_GET['department'];
    $coursename = $_GET['coursename'];
    $courseexist = mysqli_query($connection, "SELECT COUNT(id) FROM courses WHERE course LIKE '%$coursename%'");
    if ($courseexist->fetch_array()['id'] > 0) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Course Exist");
        exit();
    }
    $insertquery = "INSERT INTO courses (course,department_id) VALUES ('$coursename',$departmentid)";
    $exinsert = mysqli_query($connection, $insertquery);
    if ($exinsert) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Course Added Successfully");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Something went try please try again");
    exit();
}

?>