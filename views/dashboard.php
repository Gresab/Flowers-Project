<?php
include '../components/header.php';
include_once '../businessLogic/UserMapper.php';
include_once '../businessLogic/ProductMapper.php';
include_once '../businessLogic/MessageMapper.php';
include_once '../businessLogic/Admin.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] == 0) {
    header("Location: index.php");
}
if (isset($_SESSION['is_logged_in']) && $_SESSION['role'] == 1) {
    $mapper =  new UserMapper();
    $userList = $mapper->getAllUsers();
    $user = $mapper->getUserByEmail($_SESSION['email']);
    $pmapper = new ProductMapper();
    $productList = $pmapper->getAllProducts();
    $msgmapper = new MessageMapper();
    $msgList = $msgmapper->getAllMessages();
}
?>

<main id='main'>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'view-products') { ?>
        <div class="db-container">
            <table class="db-table">
                <thead>
                    <tr>
                        <th colspan="6">Flowers</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th colspan="3">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productList as $product) { ?>
                        <tr>
                            <td>
                                <?php echo $product['name']; ?>
                            </td>
                            <td>
                                <?php echo $product['price']; ?> &euro;
                            </td>
                            <td>
                                <?php echo $product['quantity']; ?> artikuj
                            </td>
                            <td>
                                <a href="<?php echo "../businessLogic/modifications.php?action=delete-product&prod-id=" . $product['id']; ?>">Delete
                                </a>
                            </td>
                            <td>
                                <?php if ($product['show'] == 0) { ?>
                                    <a href="<?php echo "../businessLogic/modifications.php?action=promote-product&prod-id=" . $product['id']; ?>">Show
                                    </a>
                                <?php } else if ($product['show'] == 1) { ?>
                                    <a href="<?php echo "../businessLogic/modifications.php?action=demote-product&prod-id=" . $product['id']; ?>">Hide
                                    </a>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="<?php echo "../businessLogic/modifications.php?action=edit-product&prod-id=" . $product['id']; ?>">Edito
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    <?php } else if (isset($_GET['action']) && $_GET['action'] == 'add-product') {
        if (isset($_GET['upload']) && $_GET['upload'] == 'success') {
            echo '<script>alert("Product was added  successfully")</script>';
        } else if (isset($_GET['upload']) && $_GET['upload'] == 'error') {
            echo '<script>alert("Product is not added")</script>';
        } ?>
        <div class="edit-product-main">
            <form method="POST" action="../businessLogic/upload.php" enctype="multipart/form-data" class="edit-product-card">
                <h2>Shto produkt</h2>
                <hr class="divider">
                <label for="name">Flower name</label>
                <input type="text" name="name" value="" required>
                <label for="price">Price</label>
                <input type="number" step="any" name="price" value="" required>
                <label for="desc">Description</label>
                <textarea name="desc" value="" required></textarea>
                <label for="quantity">How many are in stock</label>
                <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required>
                <label for="image">Upload a picture</label>
                <input type="file" name="image" required>
                <input class="button" type="submit" name="add-product-btn" value="Add product">
                <a href="dashboard.php">Cancle</a>
            </form>
        </div>
    <?php } else if (isset($_GET['action']) && $_GET['action'] == 'view-users') { ?>
        <div class="db-container">
            <table class="db-table">
                <thead>
                    <tr>
                        <th colspan="6">Users</th>
                    </tr>
                    <tr class="users-email-col">
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th colspan="3">Opsionet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userList as $user) { ?>
                        <tr class="users-email-col">
                            <td>
                                <?php echo $user['username']; ?>
                            </td>
                            <td>
                                <?php echo $user['lastname']; ?>
                            </td>
                            <td>
                                <?php echo $user['email']; ?>
                            </td>
                            <td><a href="<?php echo "../businessLogic/modifications.php?action=delete-user&user-id=" . $user['id']; ?>">Delete</a></td>
                            <?php if ($user['role'] == 1) { ?>
                                <td><a href="<?php echo "../businessLogic/modifications.php?action=remove-admin&user-id=" . $user['id']; ?>">Delete admin</a></td>
                            <?php } else { ?>
                                <td><a href="<?php echo "../businessLogic/modifications.php?action=make-admin&user-id=" . $user['id']; ?>">Make në admin</a></td>
                            <?php } ?>
                            <td><a href="<?php echo "../businessLogic/modifications.php?action=edit-user&user-id=" . $user['id']; ?>">Edit</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else if (isset($_GET['action']) && $_GET['action'] == 'all-messages') { ?>
        <div class="db-container">
            <table class="db-table">
                <thead>
                    <tr>
                        <th colspan="5">All messages</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th colspan="2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($msgList as $msg) { ?>
                        <tr>
                            <td>
                                <?php echo $msg['name']; ?>
                            </td>
                            <td>
                                <?php echo $msg['lastname']; ?>
                            </td>
                            <td>
                                <?php echo $msg['email']; ?>
                            </td>
                            <td><a href="<?php echo "../businessLogic/modifications.php?action=delete-msg&msg-id=" . $msg['id']; ?>">Delete</a></td>
                            <td><a href="<?= "view-message.php?action=view&msg_id=" . $msg['id'] ?>">Read</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</main>
<?php
include '../components/footer.php'; ?>