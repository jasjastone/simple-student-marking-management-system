<?php

/**
 * This function used to reload the page or route to the next page
 * @param string $route
 * @param bool $header set the header to true to choose to route using a header location
 * @param string $routename
 * @param string $from
 * @param string $fromname
 * @param string $with
 * @param string $headerroutepathfile this path is relative to the current file so put the fullpath of the file
 * @return null
 */
function reload($route = null,$header=false, $routename = "", $from = '', $fromname = '', $with = '',$headerroutepathfile='')
{
    if ($header) {
        header("Location:$headerroutepathfile&name=$routename&from=$from&fromname=$fromname$with");
        exit();
        return;
    }
    else if ($route != null) {
        echo "hi";
        echo "<script>window.location.replace(window.location.href='index.php?route=$route&name=$routename&from=$from&fromname=$fromname$with')</script>";
        exit();
        return;
    }
    else{
        echo "<script>window.location.replace(window.location.href+'&name=$routename&from=$from&fromname=$fromname&$with')</script>";
    }
    exit();
    return;
}

/**
 * Function to delete user and its assosiative data from the relationships
 * @param \mysqli $connection
 * @param int $id
 * @return bool
 */
function deleteUserAndAssosiativeData($connection, $id)
{
    $user = $connection->query("SELECT * FROM users WHERE id=$id");
    $request = $connection->query("SELECT * FROM requests WHERE id=" . $user['id']);
    $request = $connection->query("SELECT * FROM requests WHERE id=" . $user['id']);
    $approve = $connection->query("SELECT * FROM approved WHERE id=" . $user['id']);
    if (mysqli_num_rows($request) > 0) {
        while ($row = $request->fetch_array()) {
            $connection->query("DELETE FROM requests WHERE id=" . $row['id']);
        }
    }
    if (mysqli_num_rows($approve) > 0) {
        while ($row = $approve->fetch_array()) {
            $connection->query("DELETE FROM approved WHERE id=" . $row['id']);
        }
    }
    $userDelete = $connection->query("DELETE FROM users WHERE id=".$user['id']);
    if($userDelete){
        return true;
    }
    return false;
}
