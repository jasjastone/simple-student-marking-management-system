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
        <a href="index.php?route=/pages/marks/showresults&name=Students Result&departments=<?=$user['department_id']?>&courses=<?=$user['course_id']?>&students=<?=$user['id']?>&semister=&from=<?= $_GET['from'] ?>&fromname=<?= $_GET['fromname'] ?>" class="text-decoration-none bg-primary rounded-2 p-1 bg-opacity-10">GO Back to results</a>
            <div class="table-data">
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
                            <th>Grade (G)</th>
                            <th>Grade Point(GP)</th>
                            <th>Module Credit (C)</th>
                            <th>Credit * Grade Point(CGP)</th>
                            <th>Remark</th>
                        </tr>
                        <?php
                        $sumofcreditpoints = 0;
                        $sumofgradepoints = 0;
                        $sumofgptimescp = 0;
                        while ($row = $exquery->fetch_array()) {
                            $calculatedgradeandgp = calGradeAndGP($studentrow['minimumgpa'], $row['assaignment1'], $row['assaignment2'], $row['test1'], $row['test2'], $row['final_exam'], $row['sup_exam']);
                            $gptimescp = $row['credit'] * $calculatedgradeandgp['gp'];
                            $sumofgptimescp += $gptimescp;
                            $sumofcreditpoints += $row['credit'];
                            $sumofgradepoints += $calculatedgradeandgp['gp'];
                            echo '<tr>
                                <td>' . $row['modulecode'] . '</td>
                                <td>' . $row['modulename'] . '</td>
                                <td>' . $calculatedgradeandgp['grade'] . '</td>
                                <td>' . $calculatedgradeandgp['gp'] . '</td>
                                <td>' . $row['credit'] . '</td>
                                <td>' . $gptimescp . '</td>
                                <td>' . ((($calculatedgradeandgp['gp'] >= 3 && $minimumgpa > 4) ||($calculatedgradeandgp['gp'] >= 2 && $minimumgpa < 5)) ? 'Pass' : 'Fail') . '</td>
                            </tr>';
                        }
                        $gpa = number_format($sumofgptimescp / $sumofcreditpoints, 1);
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Semister GPA</td>
                            <td><?= $gpa ?></td>
                            <td colspan="2">GPA=Sum of CGP/ Total Credits</td>
                            <td>SUM(C) = <?= $sumofcreditpoints ?></td>
                            <td>SUM(CGP) = <?= $sumofgptimescp ?></td>
                            <td>GPA=SUM(GP*C)/SUM(C) <br>
                                GPA=<?= $sumofgptimescp ?>/<?= $sumofcreditpoints ?> => <?= $gpa ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</main>
<?php

function calGradeAndGP($minimumgpa, $assaignment1, $assaignment2, $test1, $test2, $final_exam, $sup_exam)
{
    $grade = "";
    $gp = 0;
    $total = $assaignment1 + $assaignment2 + $test1 + $test2;
    if (($final_exam != null && $final_exam != "") && ($sup_exam == null || $sup_exam == "")) {
        $total += $final_exam;
    }
    // making sure the student get c even if they score more on their supplimentary exam :D that is how it works
    if ($sup_exam >= 30) {
        $grade = "C";
    } else if ($total >= 80 && $total <= 100) {
        $grade = "A";
    } else if (($total >= 75 && $total < 80) && $minimumgpa > 4) {
        $grade = "B+";
    } else if ($total >= 65 && $total < 75) {
        $grade = "B";
    } else if ($total >= 50 && $total < 65) {
        $grade = "C";
    } else if ($total >= 40 && $total < 50) {
        $grade = "D";
    } else {
        $grade = $total;
    }
    if ($grade == "A" && $minimumgpa > 4) {
        $gp = 5;
    } else if ($grade == "A" && $minimumgpa < 5) {
        $gp = 4;
    } else if ($grade == "B+") {
        $gp = 4;
    } else if ($grade == "B") {
        $gp = 3;
    } else if ($grade == "C") {
        $gp = 2;
    } else if ($grade == "D") {
        $gp = 1;
    } else {
        $gp = 1;
    }
    return ['grade' => $grade, "gp" => $gp];
}

?>