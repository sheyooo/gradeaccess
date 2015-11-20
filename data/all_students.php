<?php
//AJAX NOT IMPORTANT
require_once("includes/functions.inc");
$conn = mysqli_connect("localhost", $db_user, $db_pass, $database) or die("error");
$command = "SELECT * FROM students RIGHT JOIN assesment
                ON (students.student_id = assesment.student_id)
                RIGHT JOIN class
                ON (students.class = class.class_id)
                WHERE assesment.year = {$_SESSION['year']} ";
$result = mysqli_query($conn, $command);

if (mysqli_num_rows($result) !== 0) {
    print_r($result);
} else {
    echo "No Data";
}

?>