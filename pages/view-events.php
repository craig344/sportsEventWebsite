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
                <li><a href="http://localhost/sportsEventWebsite/pages/view-events.php">View/edit/delete Events</a></li>
            </ul>
        </div>
        <div class="container content">
            <?php
            if (isset($_SESSION["message"])) { ?>
                <div class="container <?= $_SESSION["msg_class"] ?>"><?= $_SESSION["message"] ?></div>
            <?php
            }
            unset($_SESSION["msg_class"]);
            unset($_SESSION["message"]);
            ?>
            <h2>View/Delete Events</h2>
            <?php
            $mysqli = new mysqli("localhost", "root", "", "sports") or die(mysqli_error($mysqli));
            $sql = "SELECT * FROM event";
            $result = $mysqli->query($sql) or die($mysqli->error);
            while ($row = $result->fetch_assoc()) { ?>
                <?php
                    $id = $row["category_id"];
                    $sql1 = "SELECT * FROM event_categories WHERE id=$id";
                    $result1 = $mysqli->query($sql1) or die($mysqli->error);
                    $row1 = $result1->fetch_assoc();
                    ?>
                <table>
                    <thead>
                        <tr>
                            <th><?= $row1["name"] ?></th>
                            <th><?= $row["name"] ?></th>
                            <th><?= $row["date"] ?></th>
                        </tr>
                    </thead>
                    <tr>
                        <td colspan="3"><img src="<?= $row["image"] ?>" alt="image"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><?= $row["description"] ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <a href="http://localhost/sportsEventWebsite/pages/process.php?delete-event=<?= $row["id"] ?>"><button class="logout-btn">Delete</button></a>
                            <a href="http://localhost/sportsEventWebsite/pages/process.php?<?php
                                                                                                if ($row["active"] == 0) {
                                                                                                    echo "add-active";
                                                                                                } else {
                                                                                                    echo "remove-active";
                                                                                                }
                                                                                                ?>=<?= $row["id"] ?>">
                                <button class="normal-btn">
                                    <?php
                                        if ($row["active"] == 0) {
                                            echo "Add to Active Events";
                                        } else {
                                            echo "Remove from Active Events";
                                        }
                                        ?>
                                </button>
                            </a>
                            <a href="http://localhost/sportsEventWebsite/pages/process.php?<?php
                                                                                                if ($row["featured"] == 0) {
                                                                                                    echo "add-featured";
                                                                                                } else {
                                                                                                    echo "remove-featured";
                                                                                                }
                                                                                                ?>=<?= $row["id"] ?>">
                                <button class="login-btn">
                                    <?php
                                        if ($row["featured"] == 0) {
                                            echo "Add to featured";
                                        } else {
                                            echo "Remove from featured";
                                        }
                                        ?>
                                </button>
                            </a>
                            <a href="http://localhost/sportsEventWebsite/pages/edit-event.php?event=<?= $row["id"] ?>"><button class="normal-btn">Edit</button></a>
                        </td>
                    </tr>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="footer">
</body>