<?php
session_start();

function redirect_to($url)
{
    header("Location: {$url}");
}

;

$db_user = "root";
$db_pass = "";
$database = "pupil";

?>