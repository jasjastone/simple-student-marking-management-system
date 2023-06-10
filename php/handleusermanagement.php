<?php
require "../config/app_config.php";
require "./connection.php";
require "./globalfunction.php";
if (isset($_POST['delete-user-button'])) {
    $id = $_POST['student_id'];
    $delete = $connection->query("DELETE FROM users WHERE id=$id") or die(mysqli_error($connection));
    if ($delete) {
        echo "Delete Successully";
        exit();
    } else {
        echo "Could not delete the user";
        exit();
    }
}
if (isset($_POST['edit-user-button'])) {
    $id = $_POST['student_id'];
    $data = $connection->query("SELECT * FROM users WHERE id=$id")->fetch_array();
    $user = ['fname' => $data['fname'], 'mname' => $data['mname'], 'lname' => $data['lname']];
}
if (isset($_POST['update-user'])) {
}
if (isset($_POST['get-user-details'])) {
    $id = $_POST['student_id'];
    $user = $connection->query("SELECT * FROM users WHERE id=$id")->fetch_array();
    $role = $connection->query("SELECT * FROM roles WHERE id=".$user['role_id'])->fetch_array()['role'];
    $roles = array();
    $roles_q = $connection->query("SELECT * FROM roles");
    while($row = $roles_q->fetch_array(MYSQLI_ASSOC)){
        $roles[] = $row;
    }
    $levels = $connection->query("SELECT * FROM levels")->fetch_array(MYSQLI_ASSOC);

    echo json_encode(["user"=> json_encode($user),"role"=>json_encode($role),"roles"=>json_encode($roles),"levels"=>json_encode($levels)]);
    exit();
}
