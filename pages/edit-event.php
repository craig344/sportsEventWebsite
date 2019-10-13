<html lang="en">
<?php
session_start();
if (!(isset($_SESSION["logged-in"]))) {
    header("location: login.php");
}
if (isset($_GET["event"])) {
    $id = $_GET["event"];
    $mysqli = new mysqli("localhost", "root", "", "sports") or die(mysqli_error($mysqli));
    $sql = "SELECT * FROM `event` WHERE `event`.`id` = $id";
    $result = $mysqli->query($sql) or die($mysqli->error);
    $row = $result->fetch_assoc();
}else{
    header("location: view-events.php");
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sports Events (Admin pannel)</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="container header">
        <a href="http://localhost/sportsEventWebsite/pages/admin-pannel.php">
            <h1>Sports Events - Admin Pannel</h1>
        </a>
        <form action="process.php" method="post"><button type="submit" class="logout-btn" name="log-out">Log Out</button></form>
    </div>
    <div class="body">
        <div class="container nav-bar">
            <ul>
                <li><a href="http://localhost/sportsEventWebsite/pages/admin-pannel.php">Home</a></li>
                <li><a href="http://localhost/sportsEventWebsite/pages/add-category.php">Add/Delete categories</a></li>
                <li><a href="http://localhost/sportsEventWebsite/pages/add-event.php">Add New Event</a></li>
                <li><a href="http://localhost/sportsEventWebsite/pages/view-events.php">View/edit/delete Events</a></li>
            </ul>
        </div>
        <div class="container content">
            <h2>Edit Event</h2>
            <form action="process.php" method="post" enctype="multipart/form-data">
                <label for="ename"><b>Event Name:</b></label>
                <input type="text" placeholder="Enter Event Name" name="ename" value="<?=$row["name"]?>" required>
                <label for="description"><b>Event Description:</b></label>
                <textarea name="description" placeholder="Write something.." style="height:100px" required><?=$row["description"]?></textarea>
                <label for="image"><b>Event Image:</b></label>
                <img src="<?=$row["image"];?>" alt="image" class="small-img">
                <input type="file" name="image" id="image">
                <label for="Category"><b>Event Category:</b></label>
                <select name="category">
                    <?php
                    $sql1 = "SELECT * FROM event_categories";
                    $result1 = $mysqli->query($sql1) or die($mysqli->error);
                    while ($row1 = $result1->fetch_assoc()) { ?>
                        <option <?php if($row1["id"] == $row["category_id"]) echo "selected";?> value="<?= $row1["id"] ?>">
                            <?= $row1["name"] ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
                <label for="type"><b>Event Type:</b></label>
                <select name="type">
                    <option value="1">Enabled</option>
                    <option <?php if(!$row["active"]) echo "selected";?> value="0">Disabled</option>
                </select>
                <button type="submit" name="edit-event">Save Changes</button>
                <input type="hidden" value="<?= $id ?>" name="edit-id">
            </form>
        </div>
    </div>
    <div class="footer">
</body>