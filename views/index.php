<?php 
include '../businessLogic/ProductMapper.php';
include '../components/header2.php';

    $mapper = new ProductMapper();
    $recentProducts = $mapper->getRecentProducts();
    $promotedProducts = $mapper->getPromotedProducts();
?>

<div class="text-content">
    <h1>Take time to smell the roses</h1>
    <p>Flowers always make people better, happier and more helpful;<br>
        they are sunshine, food and medicine for the soul.</p>
    <a href="llogaria.php" class="rgt-btn">Register to see more</a>
</div>

<div class="info">
    <h1>KOSOVOS’S FINEST ROSES & FLOWERS ONLINE FROM EXPERT FLORISTS</h1>
    <p class="text" >Roses Only, your premium online florist, delivers flower arrangements Australia wide. Whatever the occasion, you can trust us to deliver love to someone special. Nothing says: 'I love you' or 'I am thinking of you' like a
        delivery of boxed flowers in our signature rose box, or an arrangement of premium quality roses or lilies.
    </p>

    <div class="row">
        <div class="workers-col">
            <img src="../images/index/mmm1.png" alt="">
        </div>
        <div class="workers-col">
            <img src="../images/index/mmm2.png" alt="">
        </div>
        <div class="workers-col">
            <img src="../images/index/mmm3.png" alt="">
        </div>
    </div>
</div>

<main id="main">
        <?php if(count($promotedProducts) > 0) { ?>
            <div class="section-title">
                <h3>Produkte të promovuara</h3>
                <hr class="divider">
            </div>
            <div class="products-container">
                <div class="products-panel wrapper">
                    <?php foreach($promotedProducts as $product){
                        $productid = $product['id']; ?>
                        <div class="square">
                        <div>
                            <a href="<?php echo "view-product.php?productid=$productid" ?>"><img src=<?php echo $product['image']; ?> alt=""></a>
                        </div>
                        <div>
                            <h3><?php echo $product['name']; ?></h3>
                            <h2><?php echo $product['price']; ?>&euro;</h2>
                            <a class="button" href="<?php echo "view-product.php?productid=$productid" ?>">Shiko Produktin</a>
                        </div>
                    </div>
                        <?php } ?>
                </div>
            </div>
        <?php }?>    
            <!--Produktet-->
            <div class="section-title">
                <h3>Freshest flowers</h3>
                <hr class="divider">
            </div>
            <div class="products-container">
                <div class="products-panel wrapper">
                    <?php foreach($recentProducts as $product){
                        $productid = $product['id']; ?>
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