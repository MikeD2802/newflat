<?php

session_start();

$mysqli = mysqli_connect('localhost', 'root', 'root', 'lamplogin') or die(mysqli_connect_error($mysqli));
$username = '';
$email = '';
$password = '';
$updateRecord = false;
$id = 0;

// create record
if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $un = $_POST['username'];
    mysqli_query($mysqli, "INSERT INTO data (email, pwd, username) VALUES ('$email', '$pass', '$un')") or die($mysqli->error());

    $_SESSION['message'] = "User has been registered!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

// delete record
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($mysqli, "DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "User has been deleted!";
    $_SESSION['msg_type'] = "danger";

    // header("location: index.php");
}

// update record
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = mysqli_query($mysqli, "Select * FROM data WHERE id=$id") or die($mysqli->error());

    if (count($result)==1) {
        $updateRecord = true;
        $row = $result->fetch_array();
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['pwd'];
        $_SESSION['message'] = "Record has been found, edit fields and click 'Save Changes'";
        $_SESSION['msg_type'] = "info";
    }
    // $_SESSION['message'] = "User has been deleted!";
    // $_SESSION['msg_type'] = "danger";
    // header("location: index.php");
}

// insert updated record
if (isset($_POST['saveChanges'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $un = $_POST['username'];
    $id = $_POST['id'];
    mysqli_query($mysqli, "UPDATE data SET email='$email', username='$un', pwd='$pass' WHERE id='$id'") or die($mysqli->error());

    $_SESSION['message'] = "User information has been updated!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

?>