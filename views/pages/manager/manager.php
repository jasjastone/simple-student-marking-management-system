<main>
    <div class="container">
        <div class="text-center h3 text-info"><?php
                                                if (isset($_GET['msg'])) {
                                                    echo $_GET['msg'];
                                                }
                                                ?></div>
        <form action="" method="get">
            <p class="text-info h4">Add a new Course(Program)
            </p>
            <div class="col-md-10">
                <input type="hidden" name="route" value='/pages/manager/manager'>
                <input type="hidden" name="name" value='Manager'>
                <select id='course-department' name='department' style='width: 500px;'>
                    <option value=''>---SELECT DEPARTMENTS---</option>
                    <?php
                    $query = "SELECT * FROM departments";
                    $queryex = mysqli_query($connection, $query);
                    while ($row = $queryex->fetch_array()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
                <input type="text" name="coursename" id="coursename" placeholder="Course Name eg. Computer Science" class="form-control mt-2">
                <div class="d-flex justify-content-end">
                    <button type="submit" name="addcourse" class="btn btn-primary mt-2">Submit</button>
                </div>
                <hr>
            </div>
        </form>
        <form action="" method="get">
            <p class="text-info h4">Add a new Module
            </p>
            <div class="col-md-10">
                <input type="hidden" name="route" value='/pages/manager/manager'>
                <input type="hidden" name="name" value='Manager'>
                <select id='course-module' name='course' style='width: 500px;'>
                    <option value=''>---SELECT COURSE TO ASSAIGN TO---</option>
                    <?php
                    $courses = $connection->query("SELECT * FROM courses");
                    while ($row = $courses->fetch_array()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['course'] . "</option>";
                    }
                    ?>
                </select>
                <input type="text" name="modulename" id="modulename" placeholder="Module Name eg. Computer Applications" class="form-control mt-2">
                <input type="text" name="modulecode" id="modulecode" placeholder="Module Code eg. ITT0435" class="form-control mt-2">
                <input type="number" name="credit" id="credit" placeholder="Module Credits eg. 12" class="form-control mt-2">
                <div class="d-flex justify-content-end">
                    <button type="submit" name="addmodule" class="btn btn-primary mt-2">Submit</button>
                </div>
                <hr>
            </div>
        </form>
        <form action="" method="get">
            <p class="text-info h4">Add a new Department
            </p>
            <div class="col-md-10">
                <input type="hidden" name="route" value='/pages/manager/manager'>
                <input type="hidden" name="name" value='Manager'>
                <input type="text" name="departmentname" id="departmentname" placeholder="Department Name eg. ICT" class="form-control mt-2">
                <div class="d-flex justify-content-end">
                    <button type="submit" name="adddepartment" class="btn btn-primary mt-2">Submit</button>
                </div>
                <hr>
            </div>
        </form>


    </div>
    <script>
        $(document).ready(function() {
            // Initialize select2 for searching
            $("#course-department").select2();
            $("#course-module").select2();
        });
    </script>
</main>

<!-- handle all of the forms above here -->
<?php
if (isset($_GET['adddepartment'])) {
    $departmentname = $_GET['departmentname'];
    $querinsert = "INSERT INTO departments(`name`) VALUES ('$departmentname')";
    $exinsert = mysqli_query($connection, $querinsert);
    if ($exinsert) {
        reload_currentpage("msg=Department Added Successfully");
        exit();
    }
}
if (isset($_GET['addmodule'])) {
}
if (isset($_GET['addcourse'])) {
    $departmentid = $_GET['department'];
    $coursename = $_GET['coursename'];
    $courseexist = mysqli_query($connection, "SELECT COUNT(id) FROM courses WHERE course LIKE '%$coursename%'");
    if ($courseexist->fetch_array()['id'] > 0) {
        reload_currentpage("msg=Course Exist");
        exit();
    }
    $insertquery = "INSERT INTO courses (course,department_id) VALUES ('$coursename',$departmentid)";
    $exinsert = mysqli_query($connection, $insertquery);
    if ($exinsert) {
        reload_currentpage("msg=Course Added Successfully");
        exit();
    }
    reload_currentpage("msg=Something went try please try again");
    exit();
}
if (isset($_GET['adddepartment'])) {
}

?>