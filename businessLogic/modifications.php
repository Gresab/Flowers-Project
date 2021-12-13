<?php
include_once 'ProductMapper.php';
include_once 'UserMapper.php';
include_once 'MessageMapper.php';
session_start();

if (!empty($_SESSION['is_logged_in']) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == 1 && $_SESSION['role'] == 1) {

    $pmapper = new ProductMapper();
    $mapper = new UserMapper();
    $msgmapper = new MessageMapper();
    $user = $mapper->getUserByEmail($_SESSION['email']);

    if (isset($_GET['action']) && ($_GET['action'] == 'delete-product')) {


        if (isset($_GET['prod-id']) && (is_numeric($_GET['prod-id']))) {
            $product = $pmapper->getProductsById($_GET['prod-id']);
            $filepath = $product['image'];
            if (file_exists($filepath))
                unlink($filepath);
            $pmapper->deleteProduct($_GET['prod-id']);
            header("Location: ../views/dashboard.php?action=view-products");
        }
    } else if (isset($_GET['action']) && ($_GET['action'] == 'edit-product')) {
        if (isset($_GET['prod-id']) && (is_numeric($_GET['prod-id']))) {
            $prodId = $_GET['prod-id'];
            header("Location: ../views/edit-product.php?action=edit&prod-id=$prodId");
        }
    } else if (isset($_GET['action']) && ($_GET['action'] == 'promote-product')) {

        if (isset($_GET['prod-id']) && (is_numeric($_GET['prod-id']))) {
            $pmapper->promoteProduct($_GET['prod-id']);
            header("Location: ../views/dashboard.php?action=view-products");
        }
    } else if (isset($_GET['action']) && ($_GET['action'] == 'demote-product')) {

        if (isset($_GET['prod-id']) && (is_numeric($_GET['prod-id']))) {
            $pmapper->demoteProduct($_GET['prod-id']);
            header("Location: ../views/dashboard.php?action=view-products");
        }
    } else if (isset($_GET['action']) && ($_GET['action'] == 'delete-user')) {

        if (isset($_GET['user-id']) && (is_numeric($_GET['user-id']))) {
            if ($user['id'] == $_GET['user-id']) {
                $mapper->deleteUser($_GET['user-id']);
                header("Location: ../views/logout.php");
            }
        }
    } else if (isset($_GET['action']) && ($_GET['action'] == 'make-admin')) {
        if (isset($_GET['user-id']) && (is_numeric($_GET['user-id']))) {
            $mapper->makeAdmin($_GET['user-id']);
            header("Location: ../views/dashboard.php?action=view-users");
        }
    } else if (isset($_GET['action']) && ($_GET['action'] == 'remove-admin')) {
        if (isset($_GET['user-id']) && (is_numeric($_GET['user-id']))) {
            $mapper->removeAdmin($_GET['user-id']);
            header("Location: ../views/dashboard.php?action=view-users");
        }
    } else if (isset($_GET['action']) && ($_GET['action'] == 'edit-user')) {
        $user_id = $_GET['user-id'];
        header("Location: ../views/edit-user.php?action=edit-user&user-id=$user_id");
    }
} else {
    header("Location: ../views/index.php");
}
