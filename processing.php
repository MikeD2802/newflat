<?php

session_start();

$mysqli = mysqli_connect('localhost', 'root', 'root', 'lamplogin') or die(mysqli_connect_error($mysqli));


if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $un = $_POST['username'];
    mysqli_query($mysqli, "INSERT INTO data (email, pwd, username) VALUES ('$email', '$pass', '$un')") or die($mysqli->error());

    $_SESSION['message'] = "User has been registered!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($mysqli, "DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "User has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

?>