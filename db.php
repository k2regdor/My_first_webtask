<?php
$servername = "127.0.0.1";
$username = "root";
$password = "kali";
$dbName = "first";
//Log in BD
$link = mysqli_connect($servername, $username, $password);
if (!$link) {
    die ("Erorr log in: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbName";

if (!mysqli_query($link, $sql)) {
    echo "Cannot create BD";
}

mysqli_close($link);

$link = mysqli_connect($servername, $username, $password, $dbName);

$sql = "CREATE TABLE IF NOT EXISTS users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(15) NOT NULL,
    email VARCHAR(50) NOT NULL,
    pass VARCHAR(20) NOT NULL
    )";

    if (!mysqli_query($link, $sql)) {
        echo "CANNOT CREATE TABLE Users";
    }

$sql = "CREATE TABLE IF NOT EXISTS posts(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(20) NOT NULL,
        main_text VARCHAR(400) NOT NULL
        )";

        if(!mysqli_query($link, $sql)) {
          echo "CANNOT CREATE TABLE posts";
        }

mysqli_close($link);
?>