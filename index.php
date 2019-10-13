<html lang="en">
<?php
$mysqli = new mysqli("localhost", "root", "", "sports") or die(mysqli_error($mysqli));
$sql = "SELECT * FROM event WHERE featured = 1";
$result = $mysqli->query($sql) or die($mysqli->error);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sports Events</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="script/slider.js"></script>
</head>

<body onload="plusSlides1(1)">
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
                <li><a href="#">View Events</a></li>
                <li><a href="#">Search</a></li>
            </ul>
        </div>
        <div class="content">
            <h2>Featured Events:</h2>
            <?php
            if ($total = mysqli_num_rows($result)) { ?>
                <!-- Slideshow container -->
                <div class="slideshow-container">
                    <?php
                        $count = 1;
                        while ($row = $result->fetch_assoc()) { ?>
                        <!-- Full-width images with number and caption text -->
                        <div class="mySlides fade">
                            <div class="numbertext"><?= $count++ ?> / <?= $total ?></div>
                            <img src="images/<?= $row["image"]; ?>" style="width:100%">
                            <div class="text"><h1><?= $row["name"]; ?></h1></div>
                        </div>
                    <?php
                        }
                        ?>
                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>
                <!-- The dots/circles -->
                <div style="text-align:center">
                    <?php
                        $count = 0;
                        while ($count++ < $total) { ?>
                        <span class="dot" onclick="currentSlide(<?= $count; ?>)"></span>
                    <?php
                        }
                        ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="footer">
    </div>
</body>