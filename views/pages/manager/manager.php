<main>
    <div class="container">
        <div class="text-center h3 text-info"><?php
                                                if (isset($_GET['msg'])) {
                                                    echo $_GET['msg'];
                                                }
                                                ?></div>
        <form action="./php/manager.php" method="get">
            <p class="text-info h4">Add a new Course(Program)
            </p>
            <div class="col-md-10">
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
                    <input value="Submit" type="submit" name="addcourse" class="btn btn-primary mt-2" />
                </div>
                <hr>
            </div>
        </form>
        <form action="./php/manager.php" method="get">
            <p class="text-info h4">Add a new Module
            </p>
            <div class="col-md-10">
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
                    <input value="Submit" type="submit" name="addmodule" class="btn btn-primary mt-2" />
                </div>
                <hr>
            </div>
        </form>
        <form action="./php/manager.php" method="get">
            <p class="text-info h4">Add a new Department
            </p>
            <div class="col-md-10">
                <input type="text" name="departmentname" id="departmentname" placeholder="Department Name eg. ICT" class="form-control mt-2">
                <div class="d-flex justify-content-end">
                    <input value="Submit" type="submit" name="adddepartment" class="btn btn-primary mt-2" />
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