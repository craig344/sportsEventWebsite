<html lang="en">
<?php
session_start();
if (!(isset($_SESSION["logged-in"]))) {
    header("location: login.php");
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
                <li><a href="">View/edit/delete events</a></li>
            </ul>
        </div>
        <div class="container content">
            <h2>Welcome to the admin pannel!</h2>
        </div>
    </div>
    <div class="footer">
</body>