<main>
    <div class="container">
        <?php
        $student = $_GET['student'];
        $semister = $_GET['semister'];
        $course = $_GET['course'];
        $query = "SELECT * FROM marks m LEFT JOIN modules md ON md.id=m.module_id WHERE m.student_id=$student AND md.course_id=$course AND m.semister=$semister AND m.module_id=" . $_GET['mark'];
        $studentrow = mysqli_query($connection, "SELECT * FROM users u INNER JOIN levels l ON l.id=u.level_id LEFT JOIN courses c ON c.id=u.course_id WHERE u.id=$student LIMIT 1")->fetch_array();
        $exquery = mysqli_query($connection, $query);
        ?>
        <div class="col-md-12">
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
                            <th>Type Of Assessment</th>
                            <th>Marks Scores</th>
                        </tr>
                        <?php
                        $row = $exquery->fetch_array();
                        $totalmarksca = calTotalMarkCA($row['assaignment1'], $row['assaignment2'], $row['test1'], $row['test2']);
                        ?>
                        <tr>
                            <td rowspan="4"><?= $row['modulename'] ?></td>
                            <td rowspan="4"><?= $row['modulecode'] ?></td>
                            <td>Assaignment 1</td>
                            <td><?= $row['assaignment1'] ?></td>
                        </tr>
                        <tr>
                            <td>Assaignment 2</td>
                            <td><?= $row['assaignment2'] ?></td>
                        </tr>
                        <tr>
                            <td>Test 1</td>
                            <td><?= $row['test1'] ?></td>
                        </tr>
                        <tr>
                            <td>Test 2</td>
                            <td><?= $row['test2'] ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total</td>
                            <td><?php echo $assaignment1 + $assaignment2 + $test1 + $test2; ?></td>
                        </tr>
                    </tfoot>
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