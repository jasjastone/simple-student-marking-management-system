<?php
if (!$_SESSION['role'] = 'admission-officer') {
    reload(route: '/home', routename: "Dashboard");
    exit();
}

if (!isset($_GET['id'])) {
    reload(route: $_GET['from'], routename: $_GET['fromname']);
}
$courses = $connection->query("SELECT * FROM courses");
$levels = $connection->query("SELECT * FROM levels");
$editUser = $connection->query("SELECT * FROM users WHERE id=" . $_GET['id'])->fetch_array() or die(mysqli_error($connection));
$userRole = $connection->query("SELECT * FROM roles WHERE id=" . $editUser['role_id'])->fetch_array();
$roles = $connection->query("SELECT * FROM roles");
if ($editUser['course_id'] != null) {
    $usercourse = $connection->query("SELECT * FROM courses WHERE id=" . $editUser['course_id'])->fetch_array();
} else {
    $usercourse['course'] = "Not Set";
}
if ($editUser['level_id'] != null) {
    $userlevel = $connection->query("SELECT * FROM levels WHERE id=" . $editUser['level_id'])->fetch_array();
} else {
    $userlevel['level'] = "Not Set";
}
?>
<style>
    .form-floating {
        margin-bottom: 10px;
    }
</style>
<main>
    <div class="container">
        <div class="layer-1-register-form">
            <div class="layer-2-register-form">
                <form action="./auth/register.php" method="post" class="text-center" enctype="multipart/form-data">
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

                    <div class="names">
                        <div class="form-floating">
                            <input type="text" placeholder="First Name" name="fname" value="<?= $editUser['fname'] ?>" class="form-control" id="fname">
                            <label for="fname">First Name</label>
                        </div>
                        <div class="form-floating">
                            <input placeholder="Middle Name" type="text" value="<?= $editUser['mname'] ?>" name="mname" class="form-control" id="mname">
                            <label for="mname">Middle Name</label>
                        </div>
                        <div class="form-floating">
                            <input placeholder="Sur Name" value="<?= $editUser['lname'] ?>" type="text" name="sname" class="form-control" id="sname">
                            <label for="sname">Sur Name</label>
                        </div>
                    </div>
                    <div class="form-floating">
                        <label for="admission_number">Admission Number</label>
                        <input type="number" placeholder="Admission Number" value="<?= $editUser['admission_number'] ?>" name="admission_number" class="form-control" id="admission_number">
                    </div>
                    <div class="form-floating">
                        <select class="form-select" require name="course_id" id="course">
                            <option value="<?= $editUser['course_id'] ?>"><?= $usercourse['course'] ?></option>
                            <?php while ($course = mysqli_fetch_array($courses)) { ?>
                                <option value="<?php echo $course['id']; ?>">
                                    <?php echo $course['course']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="names">
                        <div class="form-floating">
                            <input placeholder="Academic Year" type="number" value="<?= $editUser['academic_year'] ?>" name="academic_year" class="form-control" id="academic_year">
                            <label for="academic_year">Academic Year</label>
                        </div>
                        <div class="form-floating">
                            <input placeholder="Phone Number" type="number" value="<?= $editUser['phone_number'] ?>" name="phone_number" class="form-control" id="phone_number">
                            <label for="phone_number">Phone</label>
                        </div>
                        <div class="form-floating">
                            <input type="email" name="email" value="<?= $editUser['email'] ?>" placeholder="Email" class="form-control" id="email">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="names">
                        <div class="form-floating">
                            <input placeholder="Password" type="password" name="password" class="form-control" id="password">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="names">
                        <div class="form-group">
                            <label for="nta_level">NTA Level</label>
                            <select class="form-select" require name="level_id" id="nta_level">
                                <option value="<?= $editUser['level_id'] ?>"> <?= $userlevel['level'] ?> </option>
                                <?php while ($row = mysqli_fetch_array($levels)) { ?>
                                    <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['level']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semister">Semister</label>
                            <select class="form-select" require name="semister" id="semister">
                                <option value="<?= $editUser['semister'] ?>"><?= $editUser['semister'] ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-select" require name="role_id" id="role">
                                <option value="<?= $userRole['id'] ?>"> <?= $userRole['role'] ?> </option>
                                <?php while ($role = mysqli_fetch_array($roles)) { ?>
                                    <option value="<?php echo $role['id']; ?>">
                                        <?php echo $role['role']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-floating">
                        <img src="./files/images/<?= $editUser['profile_image'] ?>" width="50" alt="">
                        <input type="file" accept=".png,.jpg,.jpeg" name="profile_image" class="form-control" id="profile_image">
                        <label for="profile_image" class="text-bold">Profile Picture</label>
                    </div>
                    <div class="form-floating text-center">
                        <input type="hidden" value="<?= $editUser['id'] ?>" name="user_id">
                        <input type="submit" name="save-user-details" class="btn btn-warning" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>