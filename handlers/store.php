<?php

session_start();
// Inserting Data
$con = mysqli_connect("localhost", "root", "", "todoapp");

if (!$con) {
    $_SESSION['errors'] =  "Connection Error " . mysqli_connect_error($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'])) {

    $title = trim(htmlentities(htmlentities($_POST['title'])));
    if (strlen($title) < 3) {
        $_SESSION['errors'] = "title of task must be greater than 3 chars ";
    }

    if (empty($_SESSION['errors'])) {

        $sql = "INSERT INTO `tasks` (`title`) VALUES ('$title')";
        $insert = mysqli_query($con, $sql);

        if (mysqli_affected_rows($con) == 1) {
            $_SESSION['success'] = "Insertion Completed!";
        }
    }

    header("Location: ../index.php");
}