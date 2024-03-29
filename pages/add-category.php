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
    <title>Add a category</title>
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
                <li><a href="http://localhost/sportsEventWebsite/pages/view-events.php">View/edit/delete events</a></li>
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
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                $mysqli = new mysqli("localhost", "root", "", "sports") or die(mysqli_error($mysqli));
                $sql = "SELECT * FROM event_categories";
                $result = $mysqli->query($sql) or die($mysqli->error);
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row["name"] ?></td>
                        <td>
                            <a href="http://localhost/sportsEventWebsite/pages/process.php?delete-category=<?= $row["id"] ?>"><button class="logout-btn">Delete</button></a>
                            <a href="http://localhost/sportsEventWebsite/pages/add-category.php?edit-category=<?= $row["id"] ?>"><button class="login-btn">Edit</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <?php
            if (isset($_GET["edit-category"])) {
                $id = $_GET["edit-category"];
                $sql = "SELECT * FROM event_categories WHERE id=$id";
                $result = $mysqli->query($sql) or die($mysqli->error);
                $row = $result->fetch_assoc();
                ?>
                <h2>Edit Category: <?= $row["name"]; ?></h2>
                <form action="process.php" method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <label for="cname"><b>Category Name:</b></label>
                    <input type="text" placeholder="Enter Category Name" name="cname" value="<?= $row["name"] ?>" required>
                    <button type="submit" name="edit-category">Save</button>
                </form>
            <?php
            } else { ?>
                <h2>Add a category</h2>
                <form action="process.php" method="post">
                    <label for="cname"><b>Category Name:</b></label>
                    <input type="text" placeholder="Enter Category Name" name="cname" required>
                    <button type="submit" name="add-category">Add</button>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="footer">
</body>

</html>