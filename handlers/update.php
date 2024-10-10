<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'])) {
    $con = mysqli_connect("localhost", "root", "", "todoapp");
    if (!$con) {
        $_SESSION['errors'] =  "Connection Error " . mysqli_connect_error($conn);
    }
    $title = trim(htmlentities(htmlentities($_POST['title'])));
    $id = $_GET['id'];

    if (strlen($title) < 3) {
        $_SESSION['errors'] = "title of task must be greater than 3 chars ";
    }

    if (empty($_SESSION['errors'])) {
        $sql = "UPDATE `tasks` SET `title` = '$title' WHERE `id` = '$id'";
        $update = mysqli_query($con, $sql);

        if ($update) {
            $_SESSION['success'] = "Updation Completed!";
        }
    } else {
        header("Location:../show-update.php?id=$id");
        die;
    }

    header("Location:../index.php");
}