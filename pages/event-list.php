<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sports Events</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/search.js"></script>
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
            <h2>Click on an Event to View details:</h2>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search...(Includes event description)">
            <table id="myTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <?php
                $mysqli = new mysqli("localhost", "root", "", "sports") or die(mysqli_error($mysqli));
                $sql = "SELECT * FROM event WHERE active=1  ORDER BY date DESC";
                $result = $mysqli->query($sql) or die($mysqli->error);
                while ($row = $result->fetch_assoc()) {
                    $id = $row["category_id"];
                    $sql1 = "SELECT * FROM event_categories WHERE id=$id";
                    $result1 = $mysqli->query($sql1) or die($mysqli->error);
                    $row1 = $result1->fetch_assoc();
                    ?>
                    <tr onclick="window.location.href = 'http://localhost/sportsEventWebsite/pages/event-details.php?view-id=<?= $row["id"] ?>';">
                        <td><?= $row["name"] ?></td>
                        <td><?= $row1["name"] ?></td>
                        <td><?= $row["date"] ?></td>
                        <td style="display:none;"><?= $row["description"] ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</body>