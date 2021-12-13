<?php
require_once 'ProductMapper.php';
require_once 'Product.php';
require_once 'UserMapper.php';
require_once 'MessageMapper.php';
session_start();

if (isset($_POST['add-product-btn'])) {

    $mapper = new UserMapper();

    $current = $mapper->getUserByEmail($_SESSION['email']);

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['desc'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image'];

    $fileTmpName = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $fileDestination = '../images/flowers/' . $imageName;

    move_uploaded_file($fileTmpName, $fileDestination);

    $mapper = new ProductMapper();
    $product = new Product($name, $price, $description, $quantity, $fileDestination);

    if ($mapper->insertProduct($product)) {
        header("Location: ../views/dashboard.php?action=add-product&upload=success");
    } else {
        header("Location: ../views/dashboard.php?action=add-product&upload=error");
    }
} else if (isset($_POST['send-msg'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    $mapper = new MessageMapper();
    $mapper->insertMessage($name, $lastname, $email, $msg);
    header("Location: ../views/kontakt.php?messagesend=success");
} else {
    header("Location: ../views/index.php");
}
