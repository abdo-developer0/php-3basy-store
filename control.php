<?php

    ob_start();
    session_start();
    include 'temp/header.inc';
    include 'temp/ctrl-nav.inc';
    include 'db_connect.php';
    if(!isset($_SESSION['admin'])) header('location:login.php');

    if(isset($_GET['page'])){
        $page = $_GET['page'];
        
        if($page=='main'){
?>

            <div class="show-data">
                <h1>Welcome (   ) To Adminbord </h1>
            </div>

<?php

        }elseif($page=='edit_product'){
            if(!isset($_GET['id'])){
                header('control.php?page=main');
                exit();
            }
            $old = select('products','*','where product_id='.$_GET['id'])->fetch();
?>
<!-- start of add new_product -->
            <div class="login">
                            <h1>Edit Product </h1>
                            <form action="control.php">
                            <input type="hidden" name="page" value="update_product"/>
                            <input type="hidden" name="id" value="<?php echo $old[0] ?>"/>
                                <input 
                                    type="text" 
                                    placeholder="Productname" 
                                    class="form-control" 
                                    name="name"
                                    value="<?php echo $old[1] ?>"
                                />
                                <input 
                                    type="text" 
                                    placeholder="Price" 
                                    class="form-control" 
                                    name="price"
                                    value="<?php echo $old[2] ?>"
                                />
                                <input type="submit" value="update" class="btn btn-primary" />
                            </form>
                        </div>
<!-- start of add new_product -->

<?php
        }elseif($page=='new_product'){
?>
<!-- start of add new_product -->

            <div class="login">
                <h1>New Product </h1>
                <form action="control.php">
                    <input type="hidden" name="page" value="insert_product"/>
                    <input type="text" placeholder="Productname" class="form-control" name="name"/>
                    <input type="text" placeholder="Price" class="form-control" name="price"/>
                    <input type="submit" value="Make it" class="btn btn-primary" />
                </form>
            </div>
            
<!-- start of add new_product -->


<?php

        }elseif($page=='show_products'){
            $i= 1;
            $rows= get_all_products();
?>
<!-- start of products Page -->

            <div class="show-data">
                    <h1>This Your Products</h1>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <th scope="col">
                        <a href="control.php?page=new_product" class="btn btn-primary col">New</a>
                    </th>
                    <th scope="col">ProductName</th>
                    <th scope="col">Price</th>
                    <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $row){ ?>
                    <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $row['PRODUCT_NAME'] ?></td>
                    <td><?php echo $row['PRODUCT_PRICE'].' EGP' ?></td>
                    <td>
                        <a href="control.php?page=edit_product&id=<?php echo $row['PRODUCT_ID'] ?>" class="btn btn-primary">Edit.</a>
                        <a href="control.php?page=del_product&id=<?php echo $row['PRODUCT_ID'] ?>" class="btn btn-danger">Remove</a>
                    </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
                </table>
            </div>

<!-- end of product Page -->

<?php
        }elseif($page=='show_orders'){
            $i=1;
            $rows=get_all_orders();
?>

<!-- start of orders Page -->

            <div class="show-data">
                <h1>This's Yor Orders</h1>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <th scope="col">RowNumber</th>
                    <th scope="col">GameID</th>
                    <th scope="col">SelectedOrder</th>
                    <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($rows as $row){?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $row['ORDER_GID'] ?></td>
                    <td><?php echo $row['ORDER_UC'] ?></td>
                    <td>
                    <a href="control.php?page=order_details&id=<?php echo $row['ORDER_ID'] ?>" class="col btn btn-info">Details</a>
                    </td>
                    </tr>
                <?php $i++; } ?>
                    
                </tbody>
                </table>
            </div>

<!-- end of orders Page -->

<?php   
        }elseif($page=='order_details'){
            if(!isset($_GET['id'])){
                header('control.php?page=main');
                exit();
            }
            $data = select('orders','*','where order_id='.$_GET['id'])->fetch();
            $order = select('products','*','where product_id='.$data['ORDER_UC'])->fetch();
?>
<!-- start of order details -->

            <div class="show-data">
                <h1>Order Details</h1>
                <div class="row">
                    <img src="<?php echo $data['POST_IMG']  ?>" alt="post" class="col-md-6">
                    <div class="col-md-6 info">
                        <H2>order is <?php echo $order['PRODUCT_NAME'] ?></H2>
                        <H2>game id is <?php  echo $data['ORDER_GID'] ?></H2>
                        <h2>email address is <?php echo $data['ORDER_EMAIL'] ?></h2>
                        <a href="control.php?page=del_order&id=<?php echo $data['ORDER_ID'] ?>" class="btn btn-danger">Finished</a>
                    </div>
                </div>
            </div>

<!-- start of order details -->

<?php   
        }elseif($page=='insert_product'){
            $d = $_GET;
            if( isset($d['name']) && isset($d['price']) ){
                new_product($d['name'],$d['price']);
                header('location:control.php?page=show_products');
                exit();
            }else{
                header('location:control.php?page=show_products');
                exit();
            }

        }elseif($page=='update_product'){
            $d = $_GET;
            if(isset($d['id'])&&isset($d['name'])&&isset($d['price'])){
                edit_product($d['id'],$d['name'],$d['price']);
                header('location:control.php?page=show_products');
                exit();
            }

        }elseif($page=='del_product'){

            if(isset($_GET['id'])){
                delete('products','where product_id='.$_GET['id']);
                header('location:control.php?page=show_products');
                exit();
            }
            
        }elseif($page=='del_order'){
            delete('orders','where order_id='.$_GET['id']);
            header('location:control.php?page=show_orders');
            exit();
        }
    }else{
        header('location:control.php?page=main');
        exit();
    }

    include 'temp/footer.inc';
    ob_end_flush();
?>