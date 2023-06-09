<?php
$exe = $connection->query("SELECT * FROM courses");
$exeLevel = $connection->query("SELECT * FROM levels");
$roles = $connection->query("SELECT * FROM roles");
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
                        <label for="admission_number">Admission Number</label>
                        <input type="number" placeholder="Admission Number" name="admission_number" class="form-control" id="admission_number">
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
                            <input placeholder="eg. 2022/2023" type="text" name="academic_year" class="form-control" id="academic_year">
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
                        <div class="form-floating">
                            <select class="form-select" require name="role_id" id="role_id">
                                <option value=""> ---Select Role-- </option>
                                <?php while ($row = $roles->fetch_array()) { ?>
                                    <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['role']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="file" accept=".png,.jpg,.jpeg" name="signature" class="form-control" id="signature">
                        <label for="signature" class="text-bold">Profile Picture</label>
                    </div>
                    <div class="form-floating text-center">
                        <input type="submit" name="adduser" class="btn btn-primary" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>