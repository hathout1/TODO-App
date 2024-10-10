<?php

session_start();

if (isset($_GET['id'])) {

    $con = mysqli_connect("localhost", "root", "", "todoapp");
    if (!$con) {
        $_SESSION['errors'] =  "Connection Error " . mysqli_connect_error($conn);
    }
    $sql = "SELECT * FROM `tasks` WHERE `id` = '$id'";
    $read = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($read);
    if (!$rwo) {
        $_SESSION['error'] = "No Record Found!";
    } else {
        $id = $_GET['id'];
        $sql = "DELETE FROM `tasks` WHERE `id` = '$id'";
        $delete = mysqli_query($con, $sql);
        if (mysqli_affected_rows($con) == 1) {
            $_SESSION['success'] = "Deletion Completed!";
        }
    }



    header("Location:../index.php");
}