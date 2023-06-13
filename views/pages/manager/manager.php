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
                <select id='course-department' name='department' style='width: 30vw;'>
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
                <select id='course-module' name='course' style='width: 30vw;'>
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
            </div>
        </form>
    </div>

    <div class="container">
        <hr>

        <div class="module-table sized-table">
            <h4 class="h4">Modules List</h4>
            <p class="text-muted">HINT: You can not delete modules that contain results for some students</p>
            <table class="table table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Module Name</th>
                        <th>Module Code</th>
                        <th>Module Credits</th>
                        <th>Course assaigned</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $modules = mysqli_query($connection, "SELECT m.*,c.course FROM modules m INNER JOIN courses c ON m.course_id=c.id");
                    $sno = 1;
                    while ($row = $modules->fetch_array()) {
                        echo '
                        <tr>
                            <td>' . $sno++ . '</td>
                            <td>' . $row['modulename'] . '</td>
                            <td>' . $row['modulecode'] . '</td>
                            <td>' . $row['credit'] . '</td>
                            <td>' . $row['course'] . '</td>
                            <td><a class="text-primary text-decoration-none" href="./index.php?route=/pages/manager/edit&name=Edit Manager&edit=module&id=' . $row['id'] . '">Edit</a> <a class="text-danger text-decoration-none" href="./php/manager.php?deletemodule=true&id=' . $row['id'] . '">Delete</a></td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <hr>
        <div class="courses-table sized-table">
            <h4 class="h4">Courses List</h4>
            <p class="text-muted">HINT: You can not delete Course that has been assaign to some students</p>
            <table class="table table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Department assaigned</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $modules = mysqli_query($connection, "SELECT c.*,d.name FROM courses c INNER JOIN departments d ON c.department_id=d.id");
                    $sno = 1;
                    while ($row = $modules->fetch_array()) {
                        echo '
                        <tr>
                            <td>' . $sno++ . '</td>
                            <td>' . $row['course'] . '</td>
                            <td>' . $row['name'] . '</td>
                            <td><a class="text-primary text-decoration-none" href="./index.php?route=/pages/manager/edit&name=Edit Manager&edit=course&id=' . $row['id'] . '">Edit</a> <a class="text-danger text-decoration-none" href="./php/manager.php?deletecourse=true&id=' . $row['id'] . '">Delete</a></td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="department-table sized-table">
            <h4 class="h4">Departments List</h4>
            <p class="text-muted">HINT: You can not delete Department that has been assaign to some students</p>
            <table class="table table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $modules = mysqli_query($connection, "SELECT * FROM  departments");
                    $sno = 1;
                    while ($row = $modules->fetch_array()) {
                        echo '
                        <tr>
                            <td>' . $sno++ . '</td>
                            <td>' . $row['name'] . '</td>
                            <td><a class="text-primary text-decoration-none" href="./index.php?route=/pages/manager/edit&name=Edit Manager&edit=department&id=' . $row['id'] . '">Edit</a> <a class="text-danger text-decoration-none" href="./php/manager.php?deletedepartment=true&id=' . $row['id'] . '">Delete</a></td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Initialize select2 for searching
            $("#course-department").select2();
            $("#course-module").select2();
        });
    </script>
</main>