<?php
require "../config/app_config.php";
require "./connection.php";
require "./globalconstants.php";
if (isset($_POST['loaduserandcourse'])) {
    $departmentid = $_POST['departmentid'];
    $coursesquery = "SELECT * FROM courses WHERE department_id=$departmentid";
    $studentquery = "SELECT u.* FROM users u INNER JOIN roles r ON r.id=u.role_id WHERE u.department_id=$departmentid and r.role='" . STUDENT . "'";
    $excourses = mysqli_query($connection, $coursesquery);
    $exstudents = mysqli_query($connection, $studentquery);
    $courses = [];
    $students = [];
    while ($row = $excourses->fetch_array()) {
        array_push($courses, $row);
    }
    while ($row = $exstudents->fetch_array()) {
        array_push($students, $row);
    }
    $response = ['courses' => $courses, 'students' => $students];
    die(json_encode($response));
    exit();
}
if (isset($_POST['loadstudentusingcourseid'])) {
    $courseid = $_POST['courseid'];
    $studentquery = "SELECT u.* FROM users u INNER JOIN roles r ON r.id=u.role_id WHERE course_id=$courseid and r.role='" . STUDENT . "'";
    $modulesquery = "SELECT * FROM modules WHERE course_id=$courseid";
    $exstudents = mysqli_query($connection, $studentquery);
    $exmodules = mysqli_query($connection, $modulesquery);
    $students = [];
    $modules = [];
    while ($row = $exstudents->fetch_array()) {
        array_push($students, $row);
    }
    while ($row = $exmodules->fetch_array()) {
        array_push($modules, $row);
    }
    $response = ['students' => $students,'modules'=>$modules];
    die(json_encode($response));
    exit();
}
