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
    <title>Sports Events</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="container">
        <div class="container header">
            <a href="http://localhost/sportsEventWebsite/"><h1>Sports Events</h1></a>
            <form action="process.php" method="post"><button type="submit" class="logout-btn" name="log-out">Log Out</button></form>
        </div>
        <div class="container body">
            <div class="container nav-bar">
                <ul>
                    <li></li>
                </ul>
            </div>
            <div class="container content">

            </div>
        </div>
        <div class="footer">

        </div>
</body>