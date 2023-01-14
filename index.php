<?php
    ob_start();
    include 'temp/header.inc';
    include 'db_connect.php';
    include 'temp/nav.inc';
?>
    <div class="abasy-bg padof-nav">
        <main class="container">
            <div class="row">
            <?php foreach(get_all_products() as $pro){ ?>
                    <div class="col-xs-12  col-md-4">
                        <div class="uc-product">
                            <img src="images/uc_img.jpeg" class="pro-img" />
                            <h1><?php echo $pro['PRODUCT_NAME'] ?></h1>
                            <h4>PRICE: <?php echo $pro['PRODUCT_PRICE'] ?> POUND </h4>
                                <a class="btn buy" href="order.php?id=<?php echo $pro['PRODUCT_ID'] ?>">
                                    BUY NOW
                                </a>
                    </div> 
                </div>
            <?php } ?>
            </div>
        </main>
    </div>

<?php 
    include 'temp/footer.inc';
    ob_end_flush();
?>