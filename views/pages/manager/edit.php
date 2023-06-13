<main>
    <div class="container">
        <?php if ($_GET['edit'] == 'department') : ?>
            <form action="./php/manager.php" method="get">
                <?php
                $departmentid = $_GET['id'];
                $department = mysqli_query($connection, "SELECT * FROM departments WHERE id=" . $departmentid)->fetch_array();
                ?>
                <input type="hidden" name="id" value="<?= $department['id'] ?>">
                <input placeholder="Department Name" class="form-control" type="text" name="departmentname" value="<?= $department['name'] ?>">
                <div class="d-flex justify-content-end">
                    <input value="Submit" type="submit" name="updatedepartment" class="btn btn-primary mt-2" />
                </div>
            </form>
        <?php endif; ?>
        <?php if ($_GET['edit'] == 'course') : ?>
            <form action="./php/manager.php" method="get">
                <?php
                $courseid = $_GET['id'];
                $course = mysqli_query($connection, "SELECT * FROM courses WHERE id=" . $courseid)->fetch_array();
                ?>
                <input type="hidden" name="id" value="<?= $course['id'] ?>">
                <select id='course-department' name='department' style='width: 30vw;'>
                    <option value=''>---SELECT DEPARTMENTS---</option>
                    <?php
                    $query = "SELECT * FROM departments";
                    $queryex = mysqli_query($connection, $query);
                    while ($row = $queryex->fetch_array()) {
                        echo "<option " . ($course['department_id'] == $row['id'] ? 'selected="selected"' : '') . " value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
                <input type="text" name="coursename" id="coursename" value="<?= $course['course'] ?>" placeholder="Course Name eg. Computer Science" class="form-control mt-2">
                <div class="d-flex justify-content-end">
                    <input value="Submit" type="submit" name="updatecourse" class="btn btn-primary mt-2" />
                </div>
            </form>
            <div></div>
        <?php endif; ?>
        <?php if ($_GET['edit'] == 'module') : ?>
            <form action="./php/manager.php" method="get">
                <?php
                $moduleid = $_GET['id'];
                $module = mysqli_query($connection, "SELECT * FROM modules WHERE id=" . $moduleid)->fetch_array();
                ?>
                <input type="hidden" name="id" value="<?= $module['id'] ?>">
                <select id='course-module' name='course' style='width: 30vw;'>
                    <option value=''>---SELECT COURSE TO ASSAIGN TO---</option>
                    <?php
                    $courses = $connection->query("SELECT * FROM courses");
                    while ($row = $courses->fetch_array()) {
                        echo "<option " . ($module['course_id'] == $row['id'] ? 'selected="selected"' : '') . " value='" . $row['id'] . "'>" . $row['course'] . "</option>";
                    }
                    ?>
                </select>
                <input type="text" name="modulename" value="<?= $module['modulename'] ?>" id="modulename" placeholder="Module Name eg. Computer Applications" class="form-control mt-2">
                <input type="text" name="modulecode" value="<?= $module['modulecode'] ?>" id="modulecode" placeholder="Module Code eg. ITT0435" class="form-control mt-2">
                <input type="number" name="credit" value="<?= $module['credit'] ?>" id="credit" placeholder="Module Credits eg. 12" class="form-control mt-2">
                <div class="d-flex justify-content-end">
                    <input value="Submit" type="submit" name="updatemodule" class="btn btn-primary mt-2" />
                </div>
            </form>
        <?php endif; ?>
    </div>
</main>