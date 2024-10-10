<?php
// connecting RDBMS To Line 7
$con = mysqli_connect("localhost", "root", "");

if (!$con) {
    echo "Connection Failed" . mysqli_connect_error($con);
}
// Creating Database
$sql = "CREATE DATABASE IF NOT EXISTS todoapp";
$create = mysqli_query($con, $sql); // Running Query

echo mysqli_error($con); // Error Message

mysqli_close($con);

// Creating Table
$con = mysqli_connect("localhost", "root", "", "todoapp");

if (!$con) {
    $_SESSION['errors']=  "Connection Error " . mysqli_connect_error($conn);}
$sql = "CREATE TABLE IF NOT EXISTS tasks(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(200) NOT NULL
)";
$create = mysqli_query($con, $sql); // Running Query

echo mysqli_error($con); // Error Message

mysqli_close($con);


echo "<pre>";
var_dump($con);
echo "</pre>";