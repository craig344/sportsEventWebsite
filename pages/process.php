<?php

$mysqli = new mysqli("localhost", "root", "", "sports") or die(mysqli_error($mysqli));

if(isset($_POST["login"])){
    session_start();
    $uname = $_POST["uname"];
    $passwd = $_POST["psw"];
    $sql = "SELECT * FROM user WHERE id='$uname' AND password='$passwd'";
    $result = $mysqli->query($sql) or die($mysqli->error);

    if(mysqli_num_rows($result)){
        $_SESSION["logged-in"] = $uname;
        header("location: admin-pannel.php");
    }else{
        $_SESSION["message"] = "Invalid credentials!";
        $_SESSION["msg_class"] = "danger";
        header("location: login.php");
    }
    exit();
}

if(isset($_POST["log-out"])){
    session_destroy();
    header("location: ../");
}
?>