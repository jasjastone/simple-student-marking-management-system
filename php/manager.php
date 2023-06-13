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
    $exinsert = mysqli_query($connection, $insertquery);
    if ($exinsert) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Module Added Successful");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=FAIL TO ADD MODULE");
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
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=SOMETHING WENT WRONG FAIL TO ADD COURSE PLEASE TRY AGAIN");
    exit();
}

// ############# FOR DELETE REQUEST
if (isset($_GET['deletecourse'])) {
    $courseid = $_GET['id'];
    $courseexist = mysqli_query($connection, "SELECT COUNT(*) AS nocourse FROM `courses` c INNER JOIN modules m ON m.course_id=c.id INNER JOIN marks ma ON ma.module_id=m.id WHERE c.id=" . $courseid);
    if ($courseexist->fetch_array()['nocourse'] > 0) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=You can't delete this course, it have a subject(s) with marks");
        exit();
    }
    $deletequery = "DELETE FROM courses WHERE id=" . $courseid;
    $exdelete = mysqli_query($connection, $deletequery);
    if ($exdelete) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Course Deleted Successfully");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=SOMETHING WENT WRONG FAIL TO DELETE COURSE PLEASE TRY AGAIN");
    exit();
}
if (isset($_GET['deletedepartment'])) {
    $departmentid = $_GET['id'];
    $courseexist = mysqli_query($connection, "SELECT COUNT(*) AS nocourse FROM departments d INNER JOIN `users` u ON u.department_id=d.id WHERE d.id=" . $departmentid);
    if ($courseexist->fetch_array()['nocourse'] > 0) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=You can't delete this department, it have a subject(s) with students");
        exit();
    }
    $deletequery = "DELETE FROM departments WHERE id=" . $departmentid;
    $exdelete = mysqli_query($connection, $deletequery);
    if ($exdelete) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Department Deleted Successfully");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=SOMETHING WENT WRONG FAIL TO DELETE DEPARTMENT PLEASE TRY AGAIN");
    exit();
}
if (isset($_GET['deletemodule'])) {
    $moduleid = $_GET['id'];
    $moduleexist = mysqli_query($connection, "SELECT COUNT(*) AS nocourse FROM modules m INNER JOIN marks ma ON ma.module_id=m.id WHERE m.id=" . $moduleid);
    if ($moduleexist->fetch_array()['nocourse'] > 0) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=You can't delete this module, it have students with marks");
        exit();
    }
    $deletequery = "DELETE FROM modules WHERE id=$moduleid";
    $exdelete = mysqli_query($connection, $deletequery);
    if ($exdelete) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Module Delete Successful");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=SOMETHING WENT WRONG FAIL TO DELETE MODULE PLEASE TRY AGAIN");
    exit();
}

// ############# FOR UPDATES REQUEST
if (isset($_GET['updatecourse'])) {
    $courseid = $_GET['id'];
    $coursename = $_GET['coursename'];
    $departmentid = $_GET['department'];
    $updatequery = "UPDATE courses SET department_id=$departmentid,course='$coursename' WHERE id=$courseid";
    $exupdatequery = mysqli_query($connection, $updatequery);
    if ($exupdatequery) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Course updated successfully");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=SOMETHING WENT WRONG FAIL TO UPDATE COURSE PLEASE TRY AGAIN");
    exit();
}

if (isset($_GET['updatedepartment'])) {
    $departmentname = $_GET['departmentname'];
    $id = $_GET['id'];
    $updatequery = "UPDATE departments SET `name`='$departmentname' WHERE id=" . $id;
    $exinsert = mysqli_query($connection, $updatequery);
    if ($exinsert) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Department Updated Successfully");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=SOMETHING WENT WRONG FAIL TO UPDATE DEPARTMENT PLEASE TRY AGAIN");
    exit();
}

if (isset($_GET['updatemodule'])) {
    $moduleid = $_GET['id'];
    $courseid = $_GET['course'];
    $modulename = $_GET['modulename'];
    $modulecode = $_GET['modulecode'];
    $credit = $_GET['credit'];
    $updatequery = "UPDATE modules SET modulename='$modulename',modulecode='$modulecode',credit=$credit,course_id=$courseid WHERE id=$moduleid";
    $exupdatequery = mysqli_query($connection, $updatequery);
    if ($exupdatequery) {
        header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=Module Updated Successful");
        exit();
    }
    header("Location: ../index.php?route=/pages/manager/manager&name=Manager&msg=SOMETHING WENT WRONG FAIL TO UPDATE MODULE PLEASE TRY AGAIN");
    exit();
}
?>