<?php

$mysqli = mysqli_connect('localhost', 'root', 'root', 'lamplogin') or die(mysqli_connect_error($mysqli));


if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $un = $_POST['username'];

    mysqli_query($mysqli, "INSERT INTO data (email, pwd, username) VALUES ('$email', '$pass', '$un')") or die($mysqli->error);
}

?>