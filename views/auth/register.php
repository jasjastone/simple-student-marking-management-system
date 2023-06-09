<?php
require "../../config/app_config.php";
session_start();
if (!empty($_SESSION['email'])) {
    header("Location:../../index.php?route=/home");
    exit();
}
require "../../php/connection.php";
require "../../modules/Validation/Validator.php";
$selectCourse = "SELECT * FROM courses";
$deparments = $connection->query("SELECT * FROM departments");
$exe = mysqli_query($connection, $selectCourse);
$selectLevels = "SELECT * FROM levels";
$exeLevel = mysqli_query($connection, $selectLevels);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/spinner.css">
    <title><?= APPNAME ?></title>
    <style>
        .form-floating {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="primary-bg">
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <main>
        <div class="container">
            <div class="layer-1-register-form">
                <div class="layer-2-register-form">
                    <form action="../../auth/register.php" method="post" class="text-center" enctype="multipart/form-data">
                        <?php
                        if (isset($_GET['message'])) {
                            echo "<div class='text-info'>" . $_GET['message'] . "</div>";
                        }
                        ?>
                        <?php
                        if (isset($_GET['error'])) {
                            echo "<div class='text-danger'>" . $_GET['error'] . "</div>";
                        }
                        ?>
                        <img class="mb-4" src="../../files/systemimages/atc.svg" alt="" width="72" height="57">
                        <h3 class="h3 mb-3 fw-normal info-color"><?= APPNAME ?></h3>
                        <h3 class="h3 mb-3 fw-normal">Sign up</h3>
                        <h3 class="text-center"></h3>
                        <div class="names">
                            <div class="form-floating">
                                <input type="text" placeholder="First Name" name="fname" class="form-control" id="fname">
                                <label for="fname">First Name</label>
                            </div>
                            <div class="form-floating">
                                <input placeholder="Middle Name" type="text" name="mname" class="form-control" id="mname">
                                <label for="mname">Middle Name</label>
                            </div>
                            <div class="form-floating">
                                <input placeholder="Sur Name" type="text" name="sname" class="form-control" id="sname">
                                <label for="sname">Sur Name</label>
                            </div>
                        </div>
                        <div class="form-floating">
                            <input type="number" placeholder="Admission Number" name="admission_number" class="form-control" id="admission_number">
                            <label for="admission_number">Admission Number</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" require name="course_id" id="course">
                                <option value="">---Select Course---</option>
                                <?php while ($row = mysqli_fetch_array($exe)) { ?>
                                    <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['course']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="names">
                            <div class="form-floating">
                                <input placeholder="Academic Year" type="text" name="academic_year" class="form-control" id="academic_year">
                                <label for="academic_year">Academic Year</label>
                            </div>
                            <div class="form-floating">
                                <input placeholder="Phone Number" type="number" name="phone_number" class="form-control" id="phone_number">
                                <label for="phone_number">Phone</label>
                            </div>
                            <div class="form-floating">
                                <input type="email" name="email" placeholder="Email" class="form-control" id="email">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="names">
                            <div class="form-floating">
                                <input placeholder="Password" type="password" name="password" class="form-control" id="password">
                                <label for="password">Password</label>
                            </div>
                            <div class="form-floating">
                                <input placeholder="Confirm Password" type="password" name="password_confirm" class="form-control" id="password">
                                <label for="password">Confirm Password</label>
                            </div>
                        </div>
                        <div class="names">
                            <div class="form-floating">
                                <select class="form-select" require name="nta_level" id="nta_level">
                                    <option value=""> ---Select Level-- </option>
                                    <?php while ($row = mysqli_fetch_array($exeLevel)) { ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['level']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-floating">
                                <select class="form-select" require name="semister" id="semister">
                                    <option value="">---Select Current Semister---</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                        <div class="names">
                            <div class="form-floating">
                                <select class="form-select" require name="department_id" id="department_id">
                                    <option value=""> ---Select Department-- </option>
                                    <?php while ($row = mysqli_fetch_array($deparments)) { ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-floating">
                                <input type="file" accept=".png,.jpg,.jpeg" name="signature" class="form-control" id="signature">
                                <label for="signature" class="text-bold">Profile Picture</label>
                            </div>
                        </div>
                        <div class="form-floating text-center">
                            <input type="submit" name="register" class="btn btn-primary" value="Register">
                        </div>
                        <p class="text-center text-capitalize"><label>already registerd</label> <a href="./login.php">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <p class="mt-5 mb-3 text-center text-muted">&copy; 2022</p>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="../js/index.js"></script>

</html>