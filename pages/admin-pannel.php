<html lang="en">
<?php
session_start();
if (!isset($_SESSION["logged-in"])) {
    header("location: login.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <form action="process.php" method="post">
        <button type="submit" name="log-out">Log Out</button>
    </form>
</body>
</html>