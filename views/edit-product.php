<?php 
    include_once '../businessLogic/ProductMapper.php';
    include_once '../businessLogic/Product.php';
    include '../components/header.php';

    if(!empty($_SESSION['is_logged_in']) && isset($_SESSION['is_logged_in']) 
        && $_SESSION['is_logged_in'] == 1 && $_SESSION['role'] == 1){

        $errors = [];
        $mapper = new ProductMapper();
        if(isset($_GET['action']) && $_GET['action'] == 'edit'){
            $product = $mapper->getProductsById($_GET['prod-id']);
        }  

        if(isset($_POST['update-product-btn'])){
            $id = $_POST['id'];
            $prod_name = $_POST['name'];
            $price = $_POST['price'];
            $desc = $_POST['desc'];
            $quantity = $_POST['quantity'];

            $mapper->updateProduct($id, $prod_name, $price, $desc, $quantity);
            header("Location: dashboard.php?action=view-products");
        }
?>  
    <div class="edit-product-main">
        <img src="<?= $product['image']?>">
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" class="edit-product-card">
            <input readonly type="text" name="id" value="<?= $product['id'] ?>">
            <input type="text" name="name" value="<?= $product['name'] ?>">
            <input type="number" name="price" value="<?= $product['price'] ?>">
            <textarea name="desc" value="<?= $product['description'] ?>"><?= $product['description'] ?></textarea>
            <input type="number" name="quantity" value="<?= $product['quantity'] ?>">
            <input class="button" type="submit" name="update-product-btn" value="Save changes">
            <a href="dashboard.php?action=view-products">Anulo</a>
        </form>
    </div>
<?php } else {
    header("Location: ../views/index.php");
}
?>

<?php include '../components/footer.php'?>