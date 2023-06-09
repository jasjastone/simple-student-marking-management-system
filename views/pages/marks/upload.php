<main>
    <div class="container">
        <div class="text-center h3 text-info"><?php
                                                if (isset($_GET['msg'])) {
                                                    echo $_GET['msg'];
                                                }
                                                ?></div>
        <?php if (!isset($_GET['semister'])) : ?>
            <form action="index.php" method="get">
                <p class="text-info h4">The following fields are required inorder to process the marks successully field
                    <label class='text-danger'>Courses * </label><br>
                    <label class='text-danger'>Module *</label><br>
                    <label class='text-danger'>Student *</label><br>
                    <label class='text-danger'>Semister *</label>
                </p>
                <div class="col-md-12">
                    <input type="hidden" name="route" value='/pages/marks/upload'>
                    <input type="hidden" name="name" value='Upload Marks'>
                    <select id='departments' name='departments' style='width: 100px;'>
                        <option value=''>---SELECT DEPARTMENTS---</option>
                        <?php
                        $query = "SELECT * FROM departments";
                        $queryex = mysqli_query($connection, $query);
                        while ($row = $queryex->fetch_array()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                        ?>
                    </select>
                    <select id='courses' name='courses' style='width: 200px;'>
                        <option value=''>---SELECT COURSES---</option>
                        <?php
                        $courses = $connection->query("SELECT * FROM courses");
                        while ($row = $courses->fetch_array()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['course'] . "</option>";
                        }
                        ?>
                    </select>
                    <select id='modules' name='modules' style='width: 200px;'>
                        <option value=''>---SELECT MODULES---</option>
                        <?php
                        $modules = $connection->query("SELECT * FROM modules");
                        while ($row = $modules->fetch_array()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['modulename'] . " " . $row['modulecode'] . "</option>";
                        }
                        ?>
                    </select>
                    <div class="d-inline p-1" id="student-div">
                        <select id='students' name='students' style='width: 200px;'>
                            <option value=''>---SELECT STUDENTS---</option>
                            <?php
                            $students = $connection->query("SELECT u.* FROM users u INNER JOIN roles r ON u.role_id=r.id WHERE r.role='" . STUDENT . "'");
                            while ($row = $students->fetch_array()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['fname'] . " " . $row['mname'] . " " . $row['lname'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <select id='semister' name="semister">
                        <option value=''>---SELECT SEMISTER---</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                    </select>
                </div>
                <button class="btn btn-primary">Start Marking</button>
                <hr>
            </form>
        <?php endif; ?>
        <?php if (isset($_GET['semister'])) : ?>
            <form action="./php/marking.php" method="post">
                <div class="col-md-12">
                    <select id='departments' name='departments' style='width: 100px;'>
                        <option value=''>---SELECT DEPARTMENTS---</option>
                        <?php
                        $query = "SELECT * FROM departments";
                        $queryex = mysqli_query($connection, $query);
                        while ($row = $queryex->fetch_array()) {
                            echo "<option " . ($_GET['departments'] == $row['id'] ? "selected='selected'" : '') . " value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                        ?>
                    </select>
                    <select id='courses' name='courses' style='width: 200px;'>
                        <option value=''>---SELECT COURSES---</option>
                        <?php
                        $courses = $connection->query("SELECT * FROM courses");
                        while ($row = $courses->fetch_array()) {
                            echo "<option " . ($_GET['courses'] == $row['id'] ? "selected='selected'" : '') . " value='" . $row['id'] . "'>" . $row['course'] . "</option>";
                        }
                        ?>
                    </select>
                    <select id='modules' name='modules' style='width: 200px;'>
                        <option value=''>---SELECT MODULES---</option>
                        <?php
                        $modules = $connection->query("SELECT * FROM modules");
                        while ($row = $modules->fetch_array()) {
                            echo "<option " . ($_GET['modules'] == $row['id'] ? "selected='selected'" : '') . " value='" . $row['id'] . "'>" . $row['modulename'] . " " . $row['modulecode'] . "</option>";
                        }
                        ?>
                    </select>
                    <div class="d-inline p-1" id="student-div">
                        <select id='students' name='students' style='width: 200px;'>
                            <option value=''>---SELECT STUDENTS---</option>
                            <?php
                            $students = $connection->query("SELECT u.* FROM users u INNER JOIN roles r ON u.role_id=r.id WHERE r.role='" . STUDENT . "'");
                            while ($row = $students->fetch_array()) {

                                echo "<option " . ($_GET['students'] == $row['id'] ? "selected='selected'" : '') . "  value='" . $row['id'] . "'>" . $row['fname'] . " " . $row['mname'] . " " . $row['lname'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <select id='semister' value="<?php echo $_GET['semister'] ?>" name="semister">
                        <option value=''>---SELECT SEMISTER---</option>
                        <option value='1' <?php echo $_GET['semister'] == 1 ? "selected='selected'" : '' ?>>1</option>
                        <option value='2' <?php echo $_GET['semister'] == 2 ? "selected='selected'" : '' ?>>2</option>
                    </select>
                    <a href="index.php?route=/pages/marks/upload&name=Upload Marks" class="btn btn-success">New Search</a>
                </div>
                <hr>
                <div class="muted-text">NOTE: Leave blank marks that you currently don't need to upload</div>

                <?php
                $student = $_GET['students'];
                $semister = $_GET['semister'];
                $modules = $_GET['modules'];
                $query = "SELECT * FROM marks WHERE module_id=$modules AND student_id=$student AND semister=$semister";
                $exquery = mysqli_query($connection, $query);
                $assaignment1 = "";
                $assaignment2 = "";
                $test1 = "";
                $test2 = "";
                $final = "";
                $supp = "";
                while ($row = $exquery->fetch_array()) {
                    $assaignment1 = $row['assaignment1'];
                    $assaignment2 = $row['assaignment2'];
                    $test1 = $row['test1'];
                    $test2 = $row['test2'];
                    $final = $row['final_exam'];
                    $supp = $row['sup_exam'];
                }
                ?>
                <div class="col-md-12">
                    <div class="table-data">
                        <table class="table table-striped table-hover table-primary">
                            <thead class="primary-color">

                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Mark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <th>Assaignment 1</th>
                                    <th><input type="number" value="<?= $assaignment1 ?>" name="assaignment1" class="form-control"></th>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <th>Assaignment 2</th>
                                    <th><input type="number" value="<?= $assaignment2 ?>" name="assaignment2" class="form-control"></th>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <th>Test 1</th>
                                    <th><input type="number" name="test1" value="<?= $test1 ?>" class="form-control"></th>
                                </tr>
                                <tr>
                                    <th>4</th>
                                    <th>Test 2</th>
                                    <th><input type="number" name="test2" value="<?= $test2 ?>" class="form-control"></th>
                                </tr>
                                <tr>
                                    <th>5</th>
                                    <th>Final Exam</th>
                                    <th><input type="number" name="finalexam" value="<?= $final ?>" class="form-control"></th>
                                </tr>
                                <tr>
                                    <th>6</th>
                                    <th>Supplimentary Exam</th>
                                    <th><input type="number" name="suppexam" value="<?= $final ?>" class="form-control"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary" name="mark" type="submit">Submit Marks</button>
                </div>
                <div class="col-md-7"></div>
            </form>
        <?php endif; ?>

    </div>
    <script>
        $(document).ready(function() {
            // Initialize select2 for searching
            $("#departments").select2();
            $("#courses").select2();
            $("#semister").select2();
            $("#modules").select2();
            $("#students").select2();
            $("#students").change(function() {
                document.getElementById("student-div").style.backgroundColor = "";
                var semister = document.getElementById("semister");
            });

            $("#semister").change(function() {
                var studentid = $('#students').val();
                if (studentid == "") {

                    document.getElementById("student-div").style.backgroundColor = "red";
                }
            });
            // Read selected option
            $('#departments').change(function() {
                var departmentname = $('#departments option:selected').text();
                var departmentid = $('#departments').val();
                $.ajax({
                    type: "POST",
                    data: {
                        departmentid: departmentid,
                        loaduserandcourse: true,
                    },
                    url: "./php/handle_ajax_request.php",
                    success: function(response) {
                        var data = JSON.parse(response);
                        var optiontagdefault = document.createElement("option");
                        optiontagdefault.setAttribute("value", "");
                        var courses = document.getElementById("courses");
                        courses.innerHTML = "";
                        var students = document.getElementById("students");
                        optiontagdefault.innerHTML = "---SELECT STUDENTS---"
                        students.innerHTML = "";
                        students.appendChild(optiontagdefault);
                        var coursesoptiontags = [];
                        for (const courserow of data['courses']) {
                            const optiontag = document.createElement("option");
                            optiontag.setAttribute("value", courserow['id']);
                            optiontag.innerHTML = courserow['course'];
                            coursesoptiontags.push(optiontag);
                        }
                        for (const studentrow of data['students']) {
                            const optiontag = document.createElement("option");
                            optiontag.setAttribute("value", studentrow['id']);
                            optiontag.innerHTML = `${studentrow['fname']} ${studentrow['mname']} ${studentrow['lname']}`
                            students.appendChild(optiontag);
                        }
                        const optiontag = document.createElement("option");
                        optiontag.setAttribute("value", '');
                        optiontag.innerHTML = "---SELECT COURSES---";
                        courses.appendChild(optiontag);
                        for (const optiontag of coursesoptiontags) {
                            courses.appendChild(optiontag);
                        }
                    },
                    error: function(error) {

                    }
                })
            });
            $('#courses').change(function() {
                var courseid = $('#courses').val();
                console.log(courseid);
                $.ajax({
                    type: "POST",
                    data: {
                        courseid: courseid,
                        loadstudentusingcourseid: true
                    },
                    url: "./php/handle_ajax_request.php",
                    success: function(response) {
                        var data = JSON.parse(response);
                        var optiontagdefault = document.createElement("option");
                        optiontagdefault.setAttribute("value", "");
                        var students = document.getElementById("students");
                        var modules = document.getElementById("modules");
                        optiontagdefault.innerHTML = "---SELECT STUDENTS---"
                        students.innerHTML = "";
                        students.appendChild(optiontagdefault);
                        var optiontagdefaultcopy = document.createElement("option");
                        optiontagdefaultcopy.setAttribute("value", "");
                        optiontagdefaultcopy.innerHTML = "---SELECT MODULES---"
                        modules.innerHTML = "";
                        modules.appendChild(optiontagdefaultcopy);
                        for (const studentrow of data['students']) {
                            const optiontag = document.createElement("option");
                            optiontag.setAttribute("value", studentrow['id']);
                            optiontag.innerHTML = `${studentrow['fname']} ${studentrow['mname']} ${studentrow['lname']}`
                            students.appendChild(optiontag);
                        }
                        for (const modulerow of data['modules']) {
                            const optiontag = document.createElement("option");
                            optiontag.setAttribute("value", modulerow['id']);
                            optiontag.innerHTML = `${modulerow['modulename']} ${modulerow['modulecode']}`
                            modules.appendChild(optiontag);
                        }
                    },
                    error: function(error) {

                    }
                })
            });
        });
    </script>
</main>
<?php
if (isset($_POST['approve_button'])) {
    $id = $_POST['request_id'];
    $update = $connection->query('UPDATE requests SET approvedrequest=true WHERE id=' . $id);
    if ($update) {
        reload(routename: $_GET['name'], route: $_GET['route'], from: $_GET['route'], fromname: $_GET['name'], with: '&message=Approve Successfully');
    } else {
        reload(routename: $_GET['name'], route: $_GET['route'], from: $_GET['route'], fromname: $_GET['name'], with: '&error=Fail Approve Successfully');
    }
}

?>