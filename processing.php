<?php

$mysqli = mysqli_connect('localhost', 'root', 'root', 'lamplogin') or die(mysqli_connect_error($mysqli));


if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $mysqli->query("INSERT INTO data (email, pwd) VALUES ('$email', '$pass')") or die($mysqli->error);
}