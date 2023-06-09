<?php
if($user['course_id'] != ""){
    $course = $connection->query("SELECT * FROM courses WHERE id=".$user['course_id'])->fetch_array();
}
else{
    $course = ['course'=>"Not Available"];
}
if($user['department_id'] != null){
    $department = $connection->query("SELECT * FROM departments WHERE id=".$user['department_id'])->fetch_array();
}
else{
    $department = ['name'=>"Not Available"];

}
if($user['admission_number'] == null){
    $user['admission_number'] = "Not Available";
}
if($user['semister'] == null){
    $user['semister'] = "Not Available";
}
if($user['academic_year'] == null){
    $user['academic_year'] = "Not Available";
}
if($user['level_id'] != null){
    $level = $connection->query("SELECT * FROM levels WHERE id=".$user['level_id'])->fetch_array();
}
else{
    $level = ['level'=>"Not Available"];
}

?>
<main>
    <section>
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="./files/images/<?=$user['profile_image']?>" alt="Avatar" class="img-fluid my-5 rounded-circle" style="width: 84px;" />
                                <h5><?=$user['fname'].' '.$user['mname']." ".$user['lname'] ?></h5>
                                <p class="text-capitalize"><?=$_SESSION['role_name']?></p>
                                <i class="far fa-edit mb-5"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email Address</h6>
                                            <p class="text-muted"><?=$user['email']?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted"><?=$user['phone_number']?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Admission Number</h6>
                                            <p class="text-muted"><?=$user['admission_number']?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Course</h6>
                                            <p class="text-muted"><?=$course['course']?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>NTA Level</h6>
                                            <p class="text-muted"><?=$level['level']?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Department</h6>
                                            <p class="text-muted"><?=$department['name']?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Semister</h6>
                                            <p class="text-muted"><?=$user['semister']?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Academic Year</h6>
                                            <p class="text-muted"><?=$user['academic_year']?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>