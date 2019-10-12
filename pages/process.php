<?php
    session_start();

$mysqli = new mysqli("localhost", "root", "", "sports") or die(mysqli_error($mysqli));

if(isset($_POST["login"])){
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

if(isset($_POST["add-category"])){
    $cname = $_POST["cname"];
    $sql = "INSERT INTO `event_categories` (`id`, `name`) VALUES (NULL, '$cname')";
    $mysqli->query($sql) or die($mysqli->error);
    $_SESSION["message"] = "Category Successfully added!";
    $_SESSION["msg_class"] = "success";
    header("location: add-category.php");
}

if(isset($_GET["delete-category"])){
    $id = $_GET["delete"];
    $sql = "DELETE FROM event_categories WHERE id=$id";
    $mysqli->query($sql) or die($mysqli->error);
    $_SESSION["message"] = "Category Successfully deleted!";
    $_SESSION["msg_class"] = "danger";
    header("location: add-category.php");
}