<?php
include_once '../businessLogic/ProductMapper.php';
include_once '../businessLogic/Product.php';
include_once '../businessLogic/UserMapper.php';
include '../components/header.php';

if (isset($_GET['productid'])) {
    $pmapper = new ProductMapper();
    $mapper = new UserMapper();

    $productid = $_GET['productid'];
    $product = $pmapper->getProductsById($productid);

    if (isset($_SESSION['is_logged_in']) == 1) {
        $userCart = $mapper->getUserByEmail($_SESSION['email']);
    }
} ?>

<main id="main">
    <div class="wrapper">
        <div class="view-product">
            <div class="view-product-image">
                <img src="<?= $product['image'] ?>" alt="">
            </div>
            <div class="product-info">
                <div>
                    <h1><?= $product['name'] ?></h1>
                </div>
                <div>
                    <p><b>Quantity: </b><?= $product['quantity'] ?> in stock</p>
                    <p><b>Description: </b><?= $product['description'] ?></p>
                </div>
                <div>
                    <p><b>price </b><?= $product['price'] ?>&euro;</p>
                </div>
            </div>
        </div>
</main>
<?php
include '../components/footer.php'
?>