<html lang="en">
<?php
if (isset($_GET["view-id"])) {
    $mysqli = new mysqli("localhost", "root", "", "sports") or die(mysqli_error($mysqli));
    $id = $_GET["view-id"];
    $sql = "SELECT * FROM event WHERE id=$id";
    $result = $mysqli->query($sql) or die($mysqli->error);
    $row = $result->fetch_assoc();

    $id1 = $row["category_id"];
    $sql1 = "SELECT * FROM event_categories WHERE id=$id1";
    $result1 = $mysqli->query($sql1) or die($mysqli->error);
    $row1 = $result1->fetch_assoc();
} else
    header("location: event-list.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sports Events</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="container header">
        <a href="http://localhost/sportsEventWebsite/">
            <h1>Sports Events</h1>
        </a>
        <a href="http://localhost/sportsEventWebsite/pages/login.php"><button class="login-btn">Login</button></a>
    </div>
    <div class="body">
        <div class="container nav-bar">
            <ul>
                <li><a href="http://localhost/sportsEventWebsite/">Home</a></li>
                <li><a href="http://localhost/sportsEventWebsite/pages/event-list.php">View Events</a></li>
            </ul>
        </div>
        <div class="container content">
            <h1><?= $row["name"]; ?></h1>
            <p><?= $row1["name"]; ?> <?= $row["date"]; ?></p>
            <img src="<?= $row["image"]; ?>" alt="image">
            <p><?= $row["description"]; ?></p>
        </div>
    </div>
    <div class="footer">
    </div>
</body>