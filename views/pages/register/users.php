<?php
if ($_SESSION['role_name'] != 'admission-officer') {
    reload("/home", routename: "Dashboard",from:$_GET['from'],fromname:$_GET['fromname']);
}
$users = $connection->query("SELECT * FROM users");
?>
<main>
    <!-- Button trigger modal -->
    <table class="table table-striped table-hover table-primary">
        <thead class="primary-color">
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Course</th>
                <th>Admission Number</th>
                <th>Phone Number</th>
                <th>Academic Year</th>
                <th>NTA Level</th>
                <th>Semister</th>
                <th>Department</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>


            <?php
            $i = 1;
            while ($student = $users->fetch_array()) :
                $course_id = $student['course_id'];
                $level_id = $student['level_id'];
                $role_id = $student['role_id'];
                $department_id = $student['department_id'];
                $role = $connection->query("SELECT * FROM roles WHERE id=$role_id")->fetch_array();
                if ($student['admission_number'] == null) {
                    $student['admission_number'] = "Not Available";
                }
                try {
                    $course = $connection->query("SELECT * FROM courses WHERE id=$course_id")->fetch_array();
                } catch (\Throwable $th) {
                    $course['course'] = "Not Available";
                }

                try {
                    $level = $connection->query("SELECT * FROM levels WHERE id=$level_id")->fetch_array();
                } catch (\Throwable $th) {
                    $level['level'] = "Not Available";
                }
                try {
                    $department = $connection->query("SELECT * FROM departments WHERE id=$department_id")->fetch_array();
                } catch (\Throwable $th) {
                    $department['name'] = "Not Available";
                }
                if($user['id'] == $student['id']){
                    continue;
                }
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><img class="d-block" style="border: 1px solid;border-radius:50%;" src="./files/images/<?= $student['profile_image'] ?>" width="50px" alt=""><?php echo $student['fname'] . " " . $student['mname'] . " " . $student['lname'] ?></td>
                    <td><?php echo $student['email'] ?></td>
                    <td><?php echo $course['course'] ?></td>
                    <td><?php echo $student['admission_number'] ?></td>
                    <td><?php echo $student['phone_number'] ?></td>
                    <td><?php echo $student['academic_year'] ?></td>
                    <td><?php echo $level['level'] ?></td>
                    <td><?php echo $student['semister'] ?></td>
                    <td><?php echo $department['name'] ?></td>
                    <td><?php echo $role['role'] ?></td>
                    <td>
                        <button type="button"  class="btn w-100 m-1 delete-user-button-first fw-bold btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropDelete" data-id="<?php echo $student['id']; ?>">Delete</button>
                        <a  class="btn w-100 m-1 fw-bold btn-warning" href="index.php?route=/pages/register/edituser&id=<?php echo $student['id']."&from=".$_GET['route']."&fromname=".$_GET['name']; ?>&name=Edit User">Edit</a>
                        <!-- <a class="btn btn-warning disabled" href="./index.php?route=/pages/forms/processform&id=<?php //= $row['id']
                                                                                                                        ?>&name=Process Request"></a> -->
                    </td>

                </tr>
            <?php

            endwhile;
            ?>
        </tbody>
    </table>
    <!-- Modal Delete-->
    <div class="modal fade" id="staticBackdropDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Are you sure you want to Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deleteForm">
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <label for="">Full Name</label><span id="fullname"></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <label for="">User Role</label><span id="userrole"></span>
                        </div>
                        <!-- this input is must because we will use it to check if the delete button is clicked in php -->
                        <input type="hidden" name="student_id" id="student_id">
                        <input type="hidden" name="delete-user-button" value="clicked" id="delete-user-button">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="delete-user" id="delete-user-button" value="Delete" class="btn btn-danger" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>