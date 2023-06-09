<main>
    <div class="container">
        <div class="text-center h3 text-info"><?php
                                                if (isset($_GET['msg'])) {
                                                    echo $_GET['msg'];
                                                }
                                                ?></div>
        <?php if (!isset($_GET['semister'])) : ?>
            <form action="index.php" method="get">
                <div class="col-md-12">
                    <input type="hidden" name="route" value='/pages/marks/showresults'>
                    <input type="hidden" name="name" value='Students Result'>
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
                    <button class="btn btn-primary">Search</button>
                </div>
                <hr>
            </form>
        <?php endif; ?>
        <?php if ($_SESSION['role'] != STUDENT) : ?>
            <a class="btn btn-success" href="./index.php?route=/pages/marks/showresults&name=Students Result">New Search </a>
        <?php endif; ?>

        <?php if ((isset($_GET['students']) && $_GET['students'] != "") && (isset($_GET['courses']) && $_GET['courses'] != "")) { ?>
            <?php
            $student = $_GET['students'];
            $semister = "";
            if (isset($_GET['semister']) && $_GET['semister'] != "") {
                $semister = "AND m.semister=" . $_GET['semister'];
                $semisterno = $_GET['semister'];
            }
            $courses = $_GET['courses'];
            $departments = $_GET['departments'];
            $studentrow = mysqli_query($connection, "SELECT * FROM users u INNER JOIN levels l ON l.id=u.level_id WHERE u.id=$student LIMIT 1")->fetch_array();
            $noofmodulesresult = mysqli_query($connection, "SELECT COUNT(*) as noofmodulesresult FROM marks m INNER JOIN modules md ON md.id=m.module_id WHERE m.student_id=$student AND md.course_id=$courses $semister")->fetch_array()['noofmodulesresult'];
            $noofmodules = mysqli_query($connection, "SELECT COUNT(*) AS noofmodules FROM modules WHERE course_id=$courses")->fetch_array()['noofmodules'];

            ?>
            <div class="col-md-12">
                <div class="table-data">
                    <table class="table table-striped table-hover table-primary">
                        <thead class="primary-color">

                            <tr>
                                <th>Examination Result</th>
                                <th>NTA Level</th>
                                <th>Semister</th>
                                <th>Status</th>
                                <th>Course Work</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <a href="./index.php?routename=Released Result">**...Released...**</a> -->
                            <?php
                            if ($noofmodulesresult >= $noofmodules) {
                                // if the search has a semister number
                                if ($semister != "") {
                                    $query = "SELECT * FROM marks m WHERE student_id=$student $semister GROUP BY semister";
                                    $exquery = mysqli_query($connection, $query);
                                    while ($row = $exquery->fetch_array()) {
                                        echo '<tr>
                                         <th>End of Semister Examinations</th>
                                         <th>' . $studentrow['level'] . '</th>
                                         <th>' . $row['semister'] . '</th>
                                         <th><a href="index.php?route=/pages/marks/releasedresult&name=Released Result&student=' . $student . '&semister=' . $row['semister'] . '&course=' . $courses . '">**...Released...**</a> </th>
                                         <th>View Course Work</th>
                                         </tr>';
                                    }
                                } else {
                                    // if not then let check which semister has a result
                                    $query = "SELECT * FROM marks m WHERE student_id=$student $semister GROUP BY semister";
                                    $exquery = mysqli_query($connection, $query);
                                    while ($row = $exquery->fetch_array()) {
                                        $noofmodulesresult = mysqli_query($connection, "SELECT COUNT(*) as noofmodulesresult FROM marks m INNER JOIN modules md ON md.id=m.module_id WHERE m.student_id=$student AND md.course_id=$courses AND m.semister=" . $row['semister'])->fetch_array()['noofmodulesresult'];
                                        $noofmodules = mysqli_query($connection, "SELECT COUNT(*) AS noofmodules FROM modules WHERE course_id=$courses")->fetch_array()['noofmodules'];
                                        if ($noofmodulesresult >= $noofmodules) {
                                            echo '<tr>
                                         <th>End of Semister Examinations</th>
                                         <th>' . $studentrow['level'] . '</th>
                                         <th>' . $row['semister'] . '</th>
                                         <th><a href="index.php?route=/pages/marks/releasedresult&name=Released Result&student=' . $student . '&semister=' . $row['semister'] . '&course=' . $courses . '">**...Released...**</a> </th>
                                         <th>View Course Work</th>
                                     </tr>';
                                        }
                                    }
                                }
                            } else {
                                echo "NO Result Released yet";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        <?php } else {
            echo "" . $_GET['students'] . $_GET['modules'] . $_GET['semister'];
        }
        ?>

    </div>
    <script>
        $(document).ready(function() {
            // Initialize select2 for searching
            $("#departments").select2();
            $("#courses").select2();
            $("#semister").select2();
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
                        optiontagdefault.innerHTML = "---SELECT COURSES---"
                        courses.innerHTML = "";
                        courses.appendChild(optiontagdefault);
                        var students = document.getElementById("students");
                        optiontagdefault.innerHTML = "---SELECT STUDENTS---"
                        students.innerHTML = "";
                        students.appendChild(optiontagdefault);
                        for (const courserow of data['courses']) {
                            const optiontag = document.createElement("option");
                            optiontag.setAttribute("value", courserow['id']);
                            optiontag.innerHTML = courserow['course'];
                            courses.appendChild(optiontag);
                        }
                        for (const studentrow of data['students']) {
                            const optiontag = document.createElement("option");
                            optiontag.setAttribute("value", studentrow['id']);
                            optiontag.innerHTML = `${studentrow['fname']} ${studentrow['mname']} ${studentrow['lname']}`
                            students.appendChild(optiontag);
                        }
                    },
                    error: function(error) {

                    }
                })
            });
        });
    </script>
</main>