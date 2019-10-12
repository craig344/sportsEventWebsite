<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "sports") or die(mysqli_error($mysqli));

if (isset($_POST["login"])) {
    $uname = $_POST["uname"];
    $passwd = $_POST["psw"];
    $sql = "SELECT * FROM user WHERE id='$uname' AND password='$passwd'";
    $result = $mysqli->query($sql) or die($mysqli->error);

    if (mysqli_num_rows($result)) {
        $_SESSION["logged-in"] = $uname;
        header("location: admin-pannel.php");
    } else {
        $_SESSION["message"] = "Invalid credentials!";
        $_SESSION["msg_class"] = "danger";
        header("location: login.php");
    }
    exit();
}

if (isset($_POST["log-out"])) {
    session_destroy();
    header("location: ../");
}

if (isset($_POST["add-category"])) {
    $cname = $_POST["cname"];
    $sql = "INSERT INTO `event_categories` (`id`, `name`) VALUES (NULL, '$cname')";
    $mysqli->query($sql) or die($mysqli->error);
    $_SESSION["message"] = "Category Successfully added!";
    $_SESSION["msg_class"] = "success";
    header("location: add-category.php");
}

if (isset($_GET["delete-category"])) {
    $id = $_GET["delete"];
    $sql = "DELETE FROM event_categories WHERE id=$id";
    $mysqli->query($sql) or die($mysqli->error);
    $_SESSION["message"] = "Category Successfully deleted!";
    $_SESSION["msg_class"] = "danger";
    header("location: add-category.php");
}

if (isset($_POST["add-event"])) {
    $name = $_POST["ename"];
    $description = $_POST["description"];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOK = true;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $category_id = $_POST["category"];
    $active = $_POST["type"];
    $date = date("Y/m/d");
    $sql = "INSERT INTO `event` (`id`, `name`, `description`, `date`, `image`, `category_id`, `active`) VALUES (NULL, '$name', '$description', '$date', '$target_file', $category_id, $active)";

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check == false) {
        $message = "File is not an image.";
        $uploadOk = false;
    }
    if (file_exists($target_file)) {
        $message = "Sorry, file already exists.";
        $uploadOk = false;
    }
    if ($_FILES["image"]["size"] > 500000) {
        $message = "Sorry, your file is too large.";
        $uploadOk = false;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = false;
    }
    if($uploadOK){
        if (!(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))) {
            $message = "Sorry, there was an error uploading your file.";
            $uploadOk = false;
        }
    }
    if(!$uploadOK){
        $_SESSION["msg_class"] = "danger";
    }else{
        $_SESSION["msg_class"] = "success";
        $mysqli->query($sql) or die($mysqli->error);
        $message = "Event Successfully added";
    }
    $_SESSION["message"] = $message;
    header("location: add-event.php");
}
