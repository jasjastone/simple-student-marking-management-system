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