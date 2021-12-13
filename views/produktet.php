<?php include '../components/header.php';
include_once '../businessLogic/ProductMapper.php';
include_once '../businessLogic/Product.php';
include_once '../businessLogic/UserMapper.php';

$umapper = new UserMapper();
$mapper = new ProductMapper();
$products = $mapper->getAllProducts();
?>
  
<main id="main">
        <div class="products-container"> 
            <div class="products-panel wrapper">
                <?php foreach($products as $product){
                    $productid = $product['id'];
                ?>
                <input class="hidden" type="text" name="product_id" value=<?php $productid; ?>> 
                    <div class="square">
                        <div>
                            <a href="<?php echo "view-product.php?productid=$productid" ?>"><img src=<?php echo $product['image']; ?> alt=""></a>
                        </div>
                        <div>
                            <h3><?php echo $product['name']; ?></h3>
                            <h2><?php echo $product['price']; ?>&euro;</h2>
                            <a class="button" href="<?php echo "view-product.php?productid=$productid" ?>">View</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </div>
</main>
<?php include '../components/footer.php'?>

