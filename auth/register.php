<?php
require "../php/connection.php";
require "../modules/Validation/Validator.php";
require "../php/globalfunction.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if (isset($_POST['register'])) {
    $fname =  Validator::input($_POST['fname'], $connection, 'First Name Required');
    if ($fname == null) {
        header("Location:../views/auth/register.php?error=First Name Required");
        exit();
    }
    $mname =  Validator::input($_POST['mname'], $connection, 'Middle Name Required');
    if ($mname == null) {
        header("Location:../views/auth/register.php?error=Middle Name Required");
        exit();
    }
    $lname =  Validator::input($_POST['sname'], $connection, 'Sur Name Required');
    if ($lname == null) {
        header("Location:../views/auth/register.php?error=Sur Name Required");
        exit();
    }
    $admission_number = Validator::input($_POST['admission_number'], $connection);
    if ($admission_number == null) {
        header("Location:../views/auth/register.php?error=Admission Number Required");
        exit();
    }
    $academic_year = Validator::input($_POST['academic_year'], $connection);
    if ($academic_year == null) {
        header("Location:../views/auth/register.php?error=Academic Year Required");
        exit();
    }
    $course = Validator::input($_POST['course_id'], $connection);
    if ($course == null) {
        header("Location:../views/auth/register.php?error=  Course Required");
        exit();
    }
    $phone_number = Validator::input($_POST['phone_number'], $connection);
    if ($phone_number == null) {
        header("Location:../views/auth/register.php?error='Phone Number Required");
        exit();
    }
    $email = Validator::input($_POST['email'], $connection);
    if ($email == null) {
        header("Location:../views/auth/register.php?error=  Email Required");
        exit();
    }
    $password = Validator::input($_POST['password'], $connection,);
    if ($password == null) {
        header("Location:../views/auth/register.php?error='Password Required");
        exit();
    }
    $confirmPassword = Validator::input($_POST['password_confirm'], $connection);
    if ($confirmPassword == null) {
        header("Location:../views/auth/register.php?error=Password Confirm Required");
        exit();
    }
    $NTALEVEL = Validator::input($_POST['nta_level'], $connection,);
    if ($NTALEVEL == null) {
        header("Location:../views/auth/register.php?error=Nta Level Required");
        exit();
    }
    $semister = Validator::input($_POST['semister'], $connection);
    if ($semister == null) {
        header("Location:../views/auth/register.php?error='Semister Required");
        exit();
    }
    $department_id = Validator::input($_POST['department_id'], $connection,);
    if ($department_id == null) {
        header("Location:../views/auth/register.php?error=Choose a Department Required");
        exit();
    }
    $signature =  $_FILES['signature']['name'];
    $signaturePath = strval(time() . "." . $signature);

    $directory = "../files/images/";
    if (Validator::image($signature)) {
        Validator::createDirectoryIfNotExist($directory);
        $path = $directory . $signaturePath;
    } else {
        header("Location:../views/auth/register.php?message='Please provide image with .png,.jpg or .jpeg format'");
    }
    if ($password !== $confirmPassword) {
        header("Location:../views/auth/register.php?message='Password and Confirm does'nt match'");
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $select = "SELECT `admission_number`,`email` FROM users WHERE admission_number=$admission_number";
    $roleId = $connection->query("SELECT `id` FROM roles WHERE role='student'")->fetch_array()['id'];
    $selectExe = mysqli_query($connection, $select);
    if (mysqli_num_rows($selectExe)) {
        header("Location:../views/auth/register.php?message='Admission Number exist please login'");
        die();
    }
    if (move_uploaded_file($_FILES['signature']['tmp_name'], $path)) {
        $insertExe = $connection->query("INSERT INTO `users`(`fname`, `mname`, `lname`, `email`, `password`, `course_id`, `admission_number`, `phone_number`, `academic_year`, `level_id`, `profile_image`, `semister`, `role_id`, `department_id`) VALUES ('$fname','$mname', '$lname', '$email', '$password', $course, '$admission_number', $phone_number, $academic_year, $NTALEVEL, '$signaturePath', $semister, $roleId,$department_id)");
        if ($insertExe) {
            header("Location:../views/auth/login.php?message=Register success Please login");
            die();
        } else {
            header("Location:../views/auth/register.php?message='Could Not Register'");
            die();
        }
    }
}




if (isset($_POST['save-user-details'])) {
    $user_id = $_POST['user_id'];
    $user = $connection->query("SELECT * FROM users WHERE id=" . $user_id)->fetch_array();
    $fname = $_POST['fname'] != null ? $_POST['fname'] : $user['fname'];
    $mname = $_POST['mname'] != null ? $_POST['mname'] : $user['mname'];
    $lname = $_POST['lname'] != null ? $_POST['lname'] : $user['lname'];
    $level_id = $_POST['level_id'] != null ? $_POST['level_id'] : $user['level_id'];
    $role_id = $_POST['role_id'] != null ? $_POST['role_id'] : $user['role_id'];
    $course_id = $_POST['course_id'] != null ? $_POST['course_id'] : $user['course_id'];
    $email = $_POST['email'] != null ? $_POST['email'] : $user['email'];
    $password = $_POST['password'] != null ? $_POST['password'] : $user['password'];
    $admission_number = $_POST['admission_number'] != null ? $_POST['admission_number'] : $user['admission_number'];
    $phone_number = $_POST['phone_number'] != null ? $_POST['phone_number'] : $user['phone_number'];
    $academic_year = $_POST['academic_year'] != null ? $_POST['academic_year'] : $user['academic_year'];
    $profile_image = $_FILES['profile_image']['name'] != null ? $_FILES['profile_image']['name'] : $user['profile_image'];
    $semister = $_POST['semister'] != null ? $_POST['semister'] : $user['semister'];
    $department_id = $_POST['department_id'] != null ? $_POST['department_id'] : $user['department_id'];
    if ($_FILES['profile_image']['name'] != null) {
        $directory = "../files/images/";
        if (Validator::image($profile_image)) {
            Validator::createDirectoryIfNotExist($directory);
            $profile_image =  $_FILES['profile_image']['name'];
            $profile_image = strval(time() . "." . $profile_image);
            $path = $directory . $profile_image;
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $path);
        } else {
            reload(headerroutepathfile: '../index.php?route=/pages/register/edituser', header: true, routename: "Manage Users", with: "&id=$user_id&error=Invalid Image Format only .png,.jpeg,.jpg file are allowed");
        }
    }
    $update = $connection->query("UPDATE users SET
    `fname`='$fname',`mname`='$mname',
    `lname`='$lname',`email`='$email',
    `password`='$password',`course_id`=$course_id,
    `admission_number`='$admission_number',`phone_number`=$phone_number,
    `academic_year`=$academic_year,`level_id`=$level_id,
    `profile_image`='$profile_image',`semister`='$semister',
    `role_id`=$role_id,`department_id`=$department_id
     WHERE id=" . $user_id) or die(mysqli_error($connection));
    if ($update) {
        echo "hi";
        reload(headerroutepathfile: '../index.php?route=/pages/register/users', header: true, routename: "Manage Users", with: "&message=Update the user successfully");
        exit();
    } else {
        reload('route=/pages/register/users', routename: "Manage Users", with: "&message=Could not update " . mysqli_error($connection));
        exit();
    }
}


if (isset($_POST['adduser'])) {
    $fname =  Validator::input($_POST['fname'], $connection, 'First Name Required');
    if ($fname == null) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=First Name is required");
        exit();
    }
    $mname =  Validator::input($_POST['mname'], $connection, 'Middle Name Required');
    if ($mname == null) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Middle Name Required");
        exit();
    }
    $lname =  Validator::input($_POST['sname'], $connection, 'Sur Name Required');
    if ($lname == null) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Sur Name Required");
        exit();
    }
    $admission_number = Validator::input($_POST['admission_number'], $connection);
    $academic_year = Validator::input($_POST['academic_year'], $connection);
    $course = Validator::input($_POST['course_id'], $connection);
    $phone_number = Validator::input($_POST['phone_number'], $connection);
    if ($phone_number == null) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Phone Number Required");
        exit();
    }
    $email = Validator::input($_POST['email'], $connection);
    if ($email == null) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Email Required");
        exit();
    }
    $password = Validator::input($_POST['password'], $connection,);
    if ($password == null) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Password Required");
        exit();
    }
    $confirmPassword = Validator::input($_POST['password_confirm'], $connection);
    if ($confirmPassword == null) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Password Confirm Required");
        exit();
    }
    $NTALEVEL = Validator::input($_POST['nta_level'], $connection,);
    $semister = Validator::input($_POST['semister'], $connection);
    $signature =  $_FILES['signature']['name'];
    $signaturePath = strval(time() . "." . $signature);
    $directory = "../files/images/";
    if ($password !== $confirmPassword) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Password and Confirm does'nt match");
        exit();
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $selectAdmission = $connection->query("SELECT `admission_number`,`email` FROM users WHERE admission_number=$admission_number");
    $selectEmail = $connection->query("SELECT `admission_number`,`email` FROM users WHERE email='$email'")->fetch_array();
    $roleId = $_POST['role_id'];
    if ($selectEmail) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Email already taken");
        exit();
    }
    try {
        if (mysqli_num_rows($selectAdmission)) {
            reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Admission Number exist");
            exit();
        }
    } catch (\Throwable $th) {}
    if ($_FILES['signature']['name'] != null) {
        if (Validator::image($signature)) {
            Validator::createDirectoryIfNotExist($directory);
            $path = $directory . $signaturePath;
        } else {
            reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Please provide image with .png,.jpg or .jpeg format");
            exit();
        }
        move_uploaded_file($_FILES['signature']['tmp_name'], $path);
    }
    $admission_number = $admission_number == null?"NULL":$admission_number;
    $NTALEVEL = $NTALEVEL != null?$NTALEVEL:"NULL";
    $semister = $semister != null?$semister:"NULL";
    $academic_year = $academic_year!= null?$academic_year:"NULL";
    $course = $course!= null?$course:"NULL";
    // echo "INSERT INTO `users`(`fname`, `mname`, `lname`, `email`, `password`, `course_id`, `admission_number`, `phone_number`, `academic_year`, `level_id`, `profile_image`, `semister`, `role_id`) VALUES ('$fname','$mname', '$lname', '$email', '$password', $course, '$admission_number', $phone_number, $academic_year, $NTALEVEL, '$signaturePath', $semister, $roleId)";
    $insertExe = $connection->query("INSERT INTO `users`(`fname`, `mname`, `lname`, `email`, `password`, `course_id`, `admission_number`, `phone_number`, `academic_year`, `level_id`, `profile_image`, `semister`, `role_id`) VALUES ('$fname','$mname', '$lname', '$email', '$password', $course, '$admission_number', $phone_number, $academic_year, $NTALEVEL, '$signaturePath', $semister, $roleId)") or die(mysqli_error($connection));
    if ($insertExe) {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Register successfully");
        exit();
    } else {
        reload(headerroutepathfile: '../index.php?route=/pages/register/adduser', header: true, routename: "Add User", with: "&error=Could Not Register");
        exit();
    }
}
