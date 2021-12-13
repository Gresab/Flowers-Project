<?php
$page = basename($_SERVER['PHP_SELF']);
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <nav>
            <a href="index.php"><img src="../images/maple.png" alt="logo"></a>
            <div class="nav-links" id="links">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li class="<?php if ($page == 'index.php') {
                                    echo ' active';
                                } ?>"><a href="index.php">Home</a></li>
                    <li class="<?php if ($page == 'produktet.php') {
                                    echo ' active';
                                } ?>"><a href="produktet.php">Products</a></li>
                    <li class="<?php if ($page == 'kontakt.php') {
                                    echo ' active';
                                } ?>"><a href="aboutUs.php">About us</a></li>
                    <li class="<?php if ($page == 'aboutUs.php') {
                                    echo ' active';
                                } ?>"><a href="kontakt.php">Contact</a></li>
                    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['role'] == 1) { ?>
                        <li class="<?php if ($page == 'dashboard.php') {
                                        echo ' active';
                                    } ?>"><a href="dashboard.php">Dashboard</a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION['is_logged_in'])) { ?>
                        <li><a href="logout.php" class="button">Logout</a></li>
                    <?php } else { ?>
                        <li class="<?php if ($page == 'llogaria.php') {
                                        echo ' active';
                                    } ?>">
                            <a href="llogaria.php" class="button-lgt">
                                Llogaria
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
    </div>