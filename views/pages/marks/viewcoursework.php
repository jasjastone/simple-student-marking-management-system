<main>
    <div class="container">
        <?php
        $student = $_GET['student'];
        $semister = $_GET['semister'];
        $course = $_GET['course'];
        $query = "SELECT * FROM marks m LEFT JOIN modules md ON md.id=m.module_id WHERE m.student_id=$student AND md.course_id=$course AND m.semister=$semister";
        $studentrow = mysqli_query($connection, "SELECT * FROM users u INNER JOIN levels l ON l.id=u.level_id LEFT JOIN courses c ON c.id=u.course_id WHERE u.id=$student LIMIT 1")->fetch_array();
        $exquery = mysqli_query($connection, $query);
        ?>
        <div class="col-md-12">
            <?php if ($_SESSION['role'] == STUDENT) : ?>
                <a href="index.php?route=/pages/marks/showresults&name=Students Result&departments=<?= $user['department_id'] ?>&courses=<?= $user['course_id'] ?>&students=<?= $user['id'] ?>&semister=&from=<?= $_GET['from'] ?>&fromname=<?= $_GET['fromname'] ?>" class="text-decoration-none bg-primary rounded-2 p-1 bg-opacity-10">GO Back to results</a>
            <?php endif; ?>
            <div class="d-flex justify-content-end"><button onclick="printdata('report-div')" class="btn btn-primary">Print</button></div>
            <div class="table-data" id='report-div'>
                <table class="table table-striped table-hover table-primary">
                    <thead class="primary-color">
                        <tr>
                            <th>Name Of Candidate</th>
                            <th><?php echo $studentrow['fname'] . " " . $studentrow['mname'] . " " . $studentrow['lname']  ?></th>
                            <th colspan="6">Admission NO. <?php echo $studentrow['admission_number'] ?> </th>
                        </tr>
                        <tr>
                            <td>Programme</td>
                            <td colspan="7"> <?php echo $studentrow['course'] ?> </td>
                        </tr>
                        <tr>
                            <td>Academic Year</td>
                            <td colspan="7"><?php echo $studentrow['academic_year'] . " NTA LEVEL " . $studentrow['level'] . " Semester " . $semister ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Module Code</th>
                            <th>Module Name</th>
                            <th>CA Marks</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        while ($row = $exquery->fetch_array()) {
                            $totalmarksca = calTotalMarkCA($row['assaignment1'], $row['assaignment2'], $row['test1'], $row['test2']);
                            echo '<tr>
                                <td>' . $row['modulecode'] . '</td>
                                <td>' . $row['modulename'] . '</td>
                                <td>' . $totalmarksca . '/40</td>
                                <td>' . ($totalmarksca >= $studentrow['minimumca'] ? "Pass" : "Fail") . '</td>
                                <td><a href="index.php?route=/pages/marks/viewcourseworkdetail&name=Course Work Details&student=' . $student . '&semister=' . $row['semister'] . '&course=' . $course . '&mark=' . $row['id'] . '">View Course Work Details</a> </td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
<?php

function calTotalMarkCA($assaignment1, $assaignment2, $test1, $test2)
{
    $totalmarks = $assaignment1 + $assaignment2 + $test1 + $test2;
    if ($totalmarks > 40) {
        $totalmarks = 40;
    }
    return $totalmarks;
}
?>